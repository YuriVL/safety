<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03.07.2019
 * Time: 15:27
 */

namespace frontend\controllers;

use ricco\ticket\controllers\TicketController as TC;


class TicketController extends TC
{
    public function beforeAction($action)
    {
        $this->layout = "@frontend/views/layouts/dashboard.php";
        return parent::beforeAction($action);
    }
}