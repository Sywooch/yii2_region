<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BusInfo;

/**
 * SearchBusInfo represents the model behind the search form about `common\models\BusInfo`.
 */
class SearchBusInfo extends BusInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'seat', 'active', 'bus_scheme_seats_id'], 'integer'],
            [['name', 'gos_number', 'date'], 'safe'],
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
        $query = BusInfo::find();

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
            'seat' => $this->seat,
            'date' => $this->date,
            'active' => $this->active,
            'bus_scheme_seats_id' => $this->bus_scheme_seats_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'gos_number', $this->gos_number]);

        return $dataProvider;
    }
}
