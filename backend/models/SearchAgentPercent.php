<?php

namespace backend\models;

use common\models\AgentPercent;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * backend\models\SearchAgentPercent represents the model behind the search form about `common\models\AgentPercent`.
 */
 class SearchAgentPercent extends AgentPercent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'created_by', 'updated_by', 'lock', 'active'], 'integer'],
            [['percent'], 'number'],
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
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
        $query = AgentPercent::find();

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
            'percent' => $this->percent,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'lock' => $this->lock,
            'active' => $this->active,
        ]);

        return $dataProvider;
    }
}
