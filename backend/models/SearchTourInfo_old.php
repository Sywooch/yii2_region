<?php

namespace backend\models;

use common\models\TourInfo;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SearchTourInfo represents the model behind the search form about `common\models\TourInfo`.
 */
class SearchTourInfo extends TourInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'days', 'active', 'hotels_info_id'], 'integer'],
            [['name', 'date_begin', 'date_end'], 'safe'],
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
// uncomment the following line if you do not want to any records when validation fails
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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}