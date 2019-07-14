<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 14.07.2019
 * Time: 14:51
 */

namespace backend\controllers;

use Yii;
use ricco\ticket\controllers\AdminController;
use ricco\ticket\models\{
    TicketBody, TicketHead, User
};
use yii\helpers\{
    Html, Url
};
use \yii\web\Response;
use backend\models\TicketMailer;


class TicketController extends AdminController
{
    public function actionOpen()
    {
        $request = Yii::$app->request;
        $ticketHead = new TicketHead();
        $ticketBody = new TicketBody();

        $userModel = User::$user;

        $post = \Yii::$app->request->post();

        $users = $userModel::find()->select(['username as value', 'username as label', 'id as id'])->asArray()->all();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Открыть тикет",
                    'content' => $this->renderAjax('open', [
                        'ticketHead' => $ticketHead,
                        'ticketBody' => $ticketBody,
                        'qq' => $this->module->qq,
                        'users' => $users,
                    ]),
                    'footer' => Html::button('Закрыть', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Сохранить', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if (!empty($post)) {
                $ticketHead->load($post);
                $ticketBody->load($post);
                if ($ticketHead->validate() && $ticketBody->validate()) {

                    $ticketHead->user = $post['TicketHead']['user_id'];
                    $ticketHead->status = TicketHead::OPEN;
                    if ($ticketHead->save()) {
                        $ticketBody->id_head = $ticketHead->primaryKey;
                        $ticketBody->save();

                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Открыть тикет",
                            'content' => '<span class="text-success">Тикет открыт</span>',
                            'footer' => Html::button('Закрыть', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                                Html::a('Создать еще', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                        ];
                    }
                }
            } else {
                return [
                    'title' => "Открыть тикет",
                    'content' => $this->renderAjax('open', [
                        'ticketHead' => $ticketHead,
                        'ticketBody' => $ticketBody,
                        'qq' => $this->module->qq,
                        'users' => $users,
                    ]),
                    'footer' => Html::button('Закрыть', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Сохранить', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if (!empty($post)) {

                $ticketHead->load($post);
                $ticketBody->load($post);

                if ($ticketHead->validate() && $ticketBody->validate()) {

                    $ticketHead->user = $post['TicketHead']['user_id'];
                    $ticketHead->status = TicketHead::OPEN;
                    if ($ticketHead->save()) {
                        $ticketBody->id_head = $ticketHead->primaryKey;
                        $ticketBody->save();

                        $this->redirect(Url::previous());
                    }
                }
            }
            return $this->render('open', [
                'ticketHead' => $ticketHead,
                'ticketBody' => $ticketBody,
                'qq' => $this->module->qq,
                'users' => $users,
            ]);
        }
    }


    public function actionAnswer($id)
    {
        $thisTicket = TicketBody::find()->where(['id_head' => $id])->joinWith('file')->asArray()->orderBy('date DESC')->all();
        $newTicket = new TicketBody();

        $request = Yii::$app->request;
        $post = \Yii::$app->request->post();


        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Ответ на тикет",
                    'content' => $this->renderAjax('answer', ['thisTicket' => $thisTicket, 'newTicket' => $newTicket]),
                    'footer' => Html::button('Закрыть', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Сохранить', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if (!empty($post)) {
                $newTicket->load($post);
                $newTicket->id_head = $id;

                if ($newTicket->save()) {
                    $ticketHead = TicketHead::findOne($newTicket->id_head);
                    $ticketHead->status = TicketHead::ANSWER;

                    if ($ticketHead->save()) {

                        if ($ticketHead->status != TicketHead::CLOSED) {
                            $userModel = User::$user;
                            $mailer = new TicketMailer();
                            ($mailer)
                                ->sendMailDataTicket($ticketHead->topic, $ticketHead->status, $ticketHead->id,  $newTicket->text)
                                ->setDataFrom($newTicket->client == null ? Yii::$app->params['adminEmail'] : $userModel::findOne([
                                    'id' => $ticketHead->user_id,
                                ])['email'],
                                    'Уведомление с сайта - '.env('FRONTEND_URL')
                                )
                                ->senda('mail');
                        }

                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Открыть на тикет",
                            'content' => '<span class="text-success">Ответ на тикет записан</span>',
                            'footer' => Html::button('Закрыть', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])];
                    }
                }
            } else {
                return [
                    'title' => "Открыть тикет",
                    'content' => $this->renderAjax('answer', ['thisTicket' => $thisTicket, 'newTicket' => $newTicket]),
                    'footer' => Html::button('Закрыть', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Сохранить', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            if (!empty($post)) {
                $newTicket->load(\Yii::$app->request->post());
                $newTicket->id_head = $id;

                if ($newTicket->save()) {
                    $ticketHead = TicketHead::findOne($newTicket->id_head);
                    $ticketHead->status = TicketHead::ANSWER;

                    if ($ticketHead->save()) {
                        return $this->redirect(Url::to());
                    }
                }
            }

            return $this->render('answer', ['thisTicket' => $thisTicket, 'newTicket' => $newTicket]);
        }
    }

    /**
     * Delete an existing TicketHead model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;

        TicketHead::findOne($id)->delete();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Делаем выборку шапки тикета, меняем ему статус на закрытый и сохоаняем
     * Если $mailSendClosed === true, делаем отправку уведомления на email о закрытии тикета
     *
     * @param $id int id
     * @return \yii\web\Response
     */
    public function actionClosed($id)
    {
        $model = TicketHead::findOne($id);

        $model->status = TicketHead::CLOSED;

        $model->save();

        if ($this->module->mailSend !== false) {
            (new Mailer())
                ->sendMailDataTicket($model->topic, $model->status, $model->id, '')
                ->setDataFrom(Yii::$app->params['adminEmail'], $this->module->subjectAnswer)
                ->senda('closed');
        }

        return $this->redirect(Url::previous());
    }
}