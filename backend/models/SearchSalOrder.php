<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SalOrder;

/**
 * SearchSalOrder represents the model behind the search form about `common\models\SalOrder`.
 */
class SearchSalOrder extends SalOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sal_order_status_id', 'child', 'enable', 'hotels_info_id', 'trans_info_id', 'userinfo_id', 'tour_info_id', 'hotels_appartment_id'], 'integer'],
            [['date', 'hotels_info', 'transport_info', 'persons', 'date_begin', 'date_end', 'insurance_info'], 'safe'],
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
        $query = SalOrder::find();

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
            'date' => $this->date,
            'sal_order_status_id' => $this->sal_order_status_id,
            'child' => $this->child,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'enable' => $this->enable,
            'full_price' => $this->full_price,
            'hotels_info_id' => $this->hotels_info_id,
            'trans_info_id' => $this->trans_info_id,
            'userinfo_id' => $this->userinfo_id,
            'tour_info_id' => $this->tour_info_id,
            'hotels_appartment_id' => $this->hotels_appartment_id,
            
        ]);

        $query->andFilterWhere(['like', 'hotels_info', $this->hotels_info])
            ->andFilterWhere(['like', 'transport_info', $this->transport_info])
            ->andFilterWhere(['like', 'persons', $this->persons])
            ->andFilterWhere(['like', 'insurance_info', $this->insurance_info]);

        return $dataProvider;
    }
}
