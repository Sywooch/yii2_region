<?php

namespace backend\models;

use common\models\KursTypeCurrency;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * backend\models\SearchKursTypeCurrency represents the model behind the search form about `common\models\KursTypeCurrency`.
 */
 class SearchKursTypeCurrency extends KursTypeCurrency
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ncode', 'created_by', 'updated_by', 'active'], 'integer'],
            [['name', 'tcode', 'date_add', 'date_edit'], 'safe'],
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
        $query = KursTypeCurrency::find();

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
            'ncode' => $this->ncode,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'tcode', $this->tcode]);

        return $dataProvider;
    }
}
