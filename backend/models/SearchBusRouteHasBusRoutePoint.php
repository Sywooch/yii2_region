<?php

namespace backend\models;

use common\models\BusRouteHasBusRoutePoint;
use yii\base\Model;
use yii\data\ActiveDataProvider;

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
[['bus_route_id', 'bus_route_point_id', 'first_point', 'end_point', 'position', 'time_pause'], 'integer'],
            [['date_point_forward', 'date_point_reverse', 'date_add', 'date_edit'], 'safe'],
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
            'position' => $this->position,
    //'date_point_forward' => $this->date_point_path,
            'time_pause' => $this->time_pause,
            'date_point_reverse' => $this->date_point_reverse,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
        ]);

return $dataProvider;
}
}