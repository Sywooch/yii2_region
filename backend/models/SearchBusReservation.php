<?php

namespace backend\models;

use common\models\BusReservation;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * backend\models\SearchBusReservation represents the model behind the search form about `common\models\BusReservation`.
 */
class SearchBusReservation extends BusReservation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bus_info_id', 'bus_way_id', 'person_id', 'number_seat', 'status', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['name', 'date', 'date_add', 'date_edit'], 'safe'],
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
        $query = BusReservation::find();

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
            'bus_info_id' => $this->bus_info_id,
            'bus_way_id' => $this->bus_way_id,
            'person_id' => $this->person_id,
            'number_seat' => $this->number_seat,
            'date' => $this->date,
            'status' => $this->status,
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
