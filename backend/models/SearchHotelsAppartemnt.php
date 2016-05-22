<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HotelsAppartment;

/**
* SearchHotelsAppartemnt represents the model behind the search form about `common\models\HotelsAppartment`.
*/
class SearchHotelsAppartemnt extends HotelsAppartment
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'hotels_info_id', 'type_price', 'hotels_appartment_item_id'], 'integer'],
            [['name', 'date_add', 'date_edit'], 'safe'],
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
$query = HotelsAppartment::find();

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
            'hotels_info_id' => $this->hotels_info_id,
            'price' => $this->price,
            'type_price' => $this->type_price,
            'hotels_appartment_item_id' => $this->hotels_appartment_item_id,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

return $dataProvider;
}
}