<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\News;

/**
 * NewsSearch represents the model behind the search form about `common\models\News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'user_id'], 'integer'],
            [['title', 'annonce', 'content', 'created_at', 'updated_at', 'organizations'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = News::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'user_id' => $this->user_id,
        ]);
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'organizations', $this->organizations])
            ->andFilterWhere($this->getBetweenDatesFilterArray('created_at', ' - '))
            ->andFilterWhere($this->getBetweenDatesFilterArray('updated_at', ' - '));

        return $dataProvider;
    }

    /**
     * Преобразует строку переданную виджетом kartik\daterange\DateRangePicker
     * в массив параметров для andFilterWhere, вида ['between', $fieldName, $startDate, $endDate].
     * @param string $fieldName Имя проверяемого поля
     * @param string $separator Строка-разделитель между датами начала поиска и конца
     * @return array
     */
    public function getBetweenDatesFilterArray($fieldName, $separator){

        if(empty($this->$fieldName)){
            return [];
        }

        $timeArray = explode($separator, $this->$fieldName);
        $datesArray = array_splice($timeArray, 0, 2);
        if(count($datesArray) < 2){
            return [];
        }

        $filterArray = ['between', $fieldName];

        foreach($datesArray as $item){
            $item = trim($item);
            if(!$item){
                return [];
            }
            $filterArray[] = $item;
        }

        return $filterArray;
    }
}
