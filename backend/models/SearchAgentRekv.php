<?php

namespace backend\models;

use common\models\AgentRekv;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * backend\models\SearchAgentRekv represents the model behind the search form about `common\models\AgentRekv`.
 */
 class SearchAgentRekv extends AgentRekv
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'inn', 'kpp', 'ogrn', 'bik', 'created_by', 'updated_by', 'lock', 'active'], 'integer'],
            [['name', 'fullname', 'bankname', 'rs', 'ks', 'direktor_fio', 'direktor_dolgnost', 'glbuh_fio', 'glbuh_dolgnost', 'date_add', 'date_edit', 'phone', 'phone2'], 'safe'],
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
        $query = AgentRekv::find();

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
            'user_id' => $this->user_id,
            'inn' => $this->inn,
            'kpp' => $this->kpp,
            'ogrn' => $this->ogrn,
            'bik' => $this->bik,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'lock' => $this->lock,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'bankname', $this->bankname])
            ->andFilterWhere(['like', 'rs', $this->rs])
            ->andFilterWhere(['like', 'ks', $this->ks])
            ->andFilterWhere(['like', 'direktor_fio', $this->direktor_fio])
            ->andFilterWhere(['like', 'direktor_dolgnost', $this->direktor_dolgnost])
            ->andFilterWhere(['like', 'glbuh_fio', $this->glbuh_fio])
            ->andFilterWhere(['like', 'glbuh_dolgnost', $this->glbuh_dolgnost])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'phone2', $this->phone2]);

        return $dataProvider;
    }
}
