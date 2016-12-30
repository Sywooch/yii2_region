<?php

namespace backend\models;

use common\models\TransReservation;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * backend\models\SearchTransReservation represents the model behind the search form about `common\models\TransReservation`.
 */
class SearchTransReservation extends TransReservation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'number_seats', 'price', 'person_id', 'status', 'trans_price_id', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['name', 'date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
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
        $query = TransReservation::find();

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
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'number_seats' => $this->number_seats,
            'price' => $this->price,
            'person_id' => $this->person_id,
            'status' => $this->status,
            'trans_price_id' => $this->trans_price_id,
            'active' => $this->active,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
