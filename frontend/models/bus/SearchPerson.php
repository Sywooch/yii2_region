<?php

namespace frontend\models\bus;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * frontend\models\bus\SearchPerson represents the model behind the search form about `frontend\models\bus\Person`.
 */
class SearchPerson extends Person
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['firstname', 'lastname', 'secondname', 'date_new', 'date_edit', 'passport_ser', 'passport_num', 'contacts', 'other'], 'safe'],
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
        $query = Person::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date_new' => $this->date_new,
            'date_edit' => $this->date_edit,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'secondname', $this->secondname])
            ->andFilterWhere(['like', 'passport_ser', $this->passport_ser])
            ->andFilterWhere(['like', 'passport_num', $this->passport_num])
            ->andFilterWhere(['like', 'contacts', $this->contacts])
            ->andFilterWhere(['like', 'other', $this->other]);

        return $dataProvider;
    }
}
