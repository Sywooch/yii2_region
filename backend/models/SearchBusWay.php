<?php

namespace backend\models;

use common\models\BusWay;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * backend\models\SearchBusWay represents the model behind the search form about `common\models\BusWay`.
 */
class SearchBusWay extends BusWay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bus_info_id', 'active', 'ended', 'bus_route_id', 'created_by', 'updated_by', 'lock', 'stop'], 'integer'],
            [['name', 'date_begin', 'date_end', 'path_time', 'date_add', 'date_edit'], 'safe'],
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
        $query = BusWay::find();

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
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'active' => $this->active,
            'ended' => $this->ended,
            'bus_route_id' => $this->bus_route_id,
            'price' => $this->price,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'lock' => $this->lock,
            'stop' => $this->stop,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'path_time', $this->path_time]);

        return $dataProvider;
    }
}
