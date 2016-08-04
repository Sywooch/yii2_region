<?php

namespace frontend\models\bus;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\bus\BusRoutePoint;

/**
 * frontend\models\bus\SearchBusRoutePoint represents the model behind the search form about `frontend\models\bus\BusRoutePoint`.
 */
class SearchBusRoutePoint extends BusRoutePoint
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active', 'created_by', 'updated_by'], 'integer'],
            [['name', 'gps_point_m', 'gps_point_p', 'description', 'date', 'date_add', 'date_edit'], 'safe'],
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
        $query = BusRoutePoint::find();

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
            'active' => $this->active,
            'date' => $this->date,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'gps_point_m', $this->gps_point_m])
            ->andFilterWhere(['like', 'gps_point_p', $this->gps_point_p])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
