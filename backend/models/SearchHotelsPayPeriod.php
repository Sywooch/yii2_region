<?php

namespace backend\models;

use common\models\HotelsPayPeriod;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * backend\models\SearchHotelsPayPeriod represents the model behind the search form about `common\models\HotelsPayPeriod`.
 */
class SearchHotelsPayPeriod extends HotelsPayPeriod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hotels_pricing_id', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
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
            // uncomment the following line if you do not want to return any records when validation fails
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
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'lock' => $this->lock,
        ]);

        return $dataProvider;
    }
}
