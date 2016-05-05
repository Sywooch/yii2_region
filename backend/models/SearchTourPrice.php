<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TourPrice;

/**
* SearchTourPrice represents the model behind the search form about `common\models\TourPrice`.
*/
class SearchTourPrice extends TourPrice
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'active', 'tour_info_id', 'in_hotels', 'in_trans', 'in_food'], 'integer'],
            [['price'], 'number'],
            [['date', 'date_begin', 'date_end'], 'safe'],
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
$query = TourPrice::find();

$dataProvider = new ActiveDataProvider([
'query' => $query,
]);

$this->load($params);

if (!$this->validate()) {
// uncomment the following line if you do not want to any records when validation fails
// $query->where('0=1');
return $dataProvider;
}

$query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'date' => $this->date,
            'active' => $this->active,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'tour_info_id' => $this->tour_info_id,
            'in_hotels' => $this->in_hotels,
            'in_trans' => $this->in_trans,
            'in_food' => $this->in_food,
        ]);

return $dataProvider;
}
}