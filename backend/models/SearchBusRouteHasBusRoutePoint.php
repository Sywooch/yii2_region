<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BusRouteHasBusRoutePoint;

/**
* SearchBusRouteHasBusRoutePoint represents the model behind the search form about `common\models\BusRouteHasBusRoutePoint`.
*/
class SearchBusRouteHasBusRoutePoint extends BusRouteHasBusRoutePoint
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['bus_route_id', 'bus_route_point_id', 'first_point', 'end_point'], 'integer'],
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
$query = BusRouteHasBusRoutePoint::find();

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
            'bus_route_id' => $this->bus_route_id,
            'bus_route_point_id' => $this->bus_route_point_id,
            'first_point' => $this->first_point,
            'end_point' => $this->end_point,
        ]);

return $dataProvider;
}
}