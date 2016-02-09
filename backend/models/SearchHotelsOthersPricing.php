<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HotelsOthersPricing;

/**
 * SearchHotelsOthersPricing represents the model behind the search form about `common\models\HotelsOthersPricing`.
 */
class SearchHotelsOthersPricing extends HotelsOthersPricing
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hotels_info_id', 'type_price', 'active', 'hotels_others_pricing_type_id'], 'integer'],
            [['price'], 'number'],
            [['date_begin', 'date_end'], 'safe'],
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
        $query = HotelsOthersPricing::find();

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
            'hotels_info_id' => $this->hotels_info_id,
            'price' => $this->price,
            'type_price' => $this->type_price,
            'active' => $this->active,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'hotels_others_pricing_type_id' => $this->hotels_others_pricing_type_id,
        ]);

        return $dataProvider;
    }
}
