<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TransStation;

/**
 * SearchTransStation represents the model behind the search form about `common\models\TransStation`.
 */
class SearchTransStation extends TransStation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'address_id', 'trans_type_station_id'], 'integer'],
            [['name', 'description', 'gps_parallel', 'gps_meridian'], 'safe'],
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
        $query = TransStation::find();

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
            'address_id' => $this->address_id,
            'trans_type_station_id' => $this->trans_type_station_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'gps_parallel', $this->gps_parallel])
            ->andFilterWhere(['like', 'gps_meridian', $this->gps_meridian]);

        return $dataProvider;
    }
}
