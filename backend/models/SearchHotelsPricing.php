<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HotelsPricing;

/**
* SearchHotelsPricing represents the model behind the search form about `common\models\HotelsPricing`.
*/
class SearchHotelsPricing extends HotelsPricing
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'hotels_appartment_id', 'hotels_appartment_hotels_info_id', 'hotels_type_of_food_id', 'active'], 'integer'],
            [['date', 'name'], 'safe'],
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
$query = HotelsPricing::find();

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
            'hotels_appartment_id' => $this->hotels_appartment_id,
            'hotels_appartment_hotels_info_id' => $this->hotels_appartment_hotels_info_id,
            'hotels_type_of_food_id' => $this->hotels_type_of_food_id,
            'date' => $this->date,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

return $dataProvider;
}
}