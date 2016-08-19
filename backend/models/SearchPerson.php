<?php

namespace backend\models;

use common\models\Person;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * backend\models\SearchPerson represents the model behind the search form about `common\models\Person`.
 */
class SearchPerson extends Person
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'child', 'created_by', 'updated_by', 'lock', 'gender_id'], 'integer'],
            [['firstname', 'lastname', 'secondname', 'date_new', 'date_edit', 'passport_ser', 'passport_num', 'birthday', 'contacts', 'other', 'date_add'], 'safe'],
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
            'birthday' => $this->birthday,
            'child' => $this->child,
            'date_add' => $this->date_add,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'lock' => $this->lock,
            'gender_id' => $this->gender_id,
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
