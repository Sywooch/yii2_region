<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BusWay;

/**
 * SearchBusWay represents the model behind the search form about `common\models\BusWay`.
 */
class SearchBusWay extends BusWay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bus_info_id', 'active', 'ended', 'bus_path_id'], 'integer'],
            [['name', 'date_create', 'date_begin', 'date_end'], 'safe'],
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
            'date_create' => $this->date_create,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'active' => $this->active,
            'ended' => $this->ended,
            'bus_path_id' => $this->bus_path_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
