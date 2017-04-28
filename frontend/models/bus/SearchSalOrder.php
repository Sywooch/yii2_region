<?php

namespace frontend\models\bus;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * frontend\models\bus\SearchSalOrder represents the model behind the search form about `frontend\models\bus\SalOrder`.
 */
class SearchSalOrder extends SalOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sal_order_status_id', 'enable', 'hotels_info_id', 'hotels_appartment_id', 'trans_info_id', 'user_id', 'tour_info_id', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['date', 'date_begin', 'date_end', 'insurance_info', 'date_add', 'date_edit'], 'safe'],
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
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'enable' => $this->enable,
            'hotels_info_id' => $this->hotels_info_id,
            'hotels_appartment_id' => $this->hotels_appartment_id,
            'trans_info_id' => $this->trans_info_id,
            'user_id' => $this->user_id,
            'tour_info_id' => $this->tour_info_id,
            'full_price' => $this->full_price,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'insurance_info', $this->insurance_info]);

        return $dataProvider;
    }
}
