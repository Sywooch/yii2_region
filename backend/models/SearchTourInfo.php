<?php

namespace backend\models;

use common\models\TourInfo;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * backend\models\SearchTourInfo represents the model behind the search form about `common\models\TourInfo`.
 */
class SearchTourInfo extends TourInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'days', 'active', 'hotels_info_id', 'city_id', /*'tour_composition_id', */
                'created_by', 'updated_by', 'lock'], 'integer'],
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
        $query = TourInfo::find();

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
            'days' => $this->days,
            'active' => $this->active,
            'hotels_info_id' => $this->hotels_info_id,
            'city_id' => $this->city_id,
            //'tour_composition_id' => $this->tour_composition_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'lock' => $this->lock,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
