<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\KontragentPersons;

/**
* SearchKontragentPersons represents the model behind the search form about `common\models\KontragentPersons`.
*/
class SearchKontragentPersons extends KontragentPersons
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id'], 'integer'],
            [['fname', 'lname', 'oname', 'date_new', 'date_edit'], 'safe'],
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
$query = KontragentPersons::find();

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
        ]);

        $query->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'oname', $this->oname])
            ->andFilterWhere(['like', 'date_new', $this->date_new])
            ->andFilterWhere(['like', 'date_edit', $this->date_edit]);

return $dataProvider;
}
}