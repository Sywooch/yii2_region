<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HotelsPricing;

/**
 * SearchHotelsPricing represents the model behind the search form about `common\models\HotelsPricing`.
 */
class SearchHotelsPricing extends HotelsPricing
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hotels_appartment_id', 'hotels_appartment_hotels_info_id', 'hotels_others_pricing_id', 'discount_id', 'active', 'hotels_type_of_food_id'], 'integer'],
            [['date', 'name', 'date_begin', 'date_end'], 'safe'],
            [['full_price'], 'number'],
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
        $query = HotelsPricing::find();

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
            'hotels_appartment_id' => $this->hotels_appartment_id,
            'hotels_appartment_hotels_info_id' => $this->hotels_appartment_hotels_info_id,
            'hotels_others_pricing_id' => $this->hotels_others_pricing_id,
            'date' => $this->date,
            'full_price' => $this->full_price,
            'discount_id' => $this->discount_id,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'active' => $this->active,
            'hotels_type_of_food_id' => $this->hotels_type_of_food_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
