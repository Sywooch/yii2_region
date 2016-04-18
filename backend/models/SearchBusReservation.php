<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BusReservation;

/**
* SearchBusReservation represents the model behind the search form about `common\models\BusReservation`.
*/
class SearchBusReservation extends BusReservation
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'bus_info_id', 'bus_way_id', 'kontragent_persons_id', 'number_seat', 'status', 'active'], 'integer'],
            [['name', 'date'], 'safe'],
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
$query = BusReservation::find();

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
            'bus_info_id' => $this->bus_info_id,
            'bus_way_id' => $this->bus_way_id,
            'kontragent_persons_id' => $this->kontragent_persons_id,
            'number_seat' => $this->number_seat,
            'date' => $this->date,
            'status' => $this->status,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

return $dataProvider;
}
}