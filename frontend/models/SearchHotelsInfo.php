<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HotelsInfo;

/**
* SearchHotelsInfo represents the model behind the search form about `common\models\HotelsInfo`.
*/
class SearchHotelsInfo extends HotelsInfo
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'country', 'hotels_stars_id'], 'integer'],
            [['name', 'address', 'gps_point_m', 'gps_point_p', 'links_maps', 'image', 'date_add', 'date_edit'], 'safe'],
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
$query = HotelsInfo::find();

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
            'country' => $this->country,
            'hotels_stars_id' => $this->hotels_stars_id,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gps_point_m', $this->gps_point_m])
            ->andFilterWhere(['like', 'gps_point_p', $this->gps_point_p])
            ->andFilterWhere(['like', 'links_maps', $this->links_maps])
            ->andFilterWhere(['like', 'image', $this->image]);

return $dataProvider;
}
}