<?php

namespace backend\models;

use common\models\KursCurrency;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * backend\models\SearchKursCurrency represents the model behind the search form about `common\models\KursCurrency`.
 */
 class SearchKursCurrency extends KursCurrency
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kurs_type_currency_id', 'active', 'created_by', 'updated_by'], 'integer'],
            [['date_add', 'date_edit'], 'safe'],
            [['okurs', 'skurs', 'percent'], 'number'],
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
        $query = KursCurrency::find();

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
            'kurs_type_currency_id' => $this->kurs_type_currency_id,
            'date_add' => $this->date_add,
            'okurs' => $this->okurs,
            'skurs' => $this->skurs,
            'percent' => $this->percent,
            'active' => $this->active,
            'date_edit' => $this->date_edit,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
