<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HotelsPayPeriod;

/**
* SearchHotelsPayPeriod represents the model behind the search form about `common\models\HotelsPayPeriod`.
*/
class SearchHotelsPayPeriod extends HotelsPayPeriod
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['hotels_pricing_id', 'active'], 'integer'],
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            [['price'], 'number'],
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
$query = HotelsPayPeriod::find();

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
            'hotels_pricing_id' => $this->hotels_pricing_id,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'active' => $this->active,
            'price' => $this->price,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
        ]);

return $dataProvider;
}
}