<?php

namespace backend\models;

use common\models\TourComposition;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * backend\models\SearchTourComposition represents the model behind the search form about `common\models\TourComposition`.
 */
class SearchTourComposition extends TourComposition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hotel', 'transport', 'food', 'transfer', 'insure', 'visa', 'excursion', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['name', 'date_add', 'date_edit'], 'safe'],
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
        $query = TourComposition::find();

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
            'hotel' => $this->hotel,
            'transport' => $this->transport,
            'food' => $this->food,
            'transfer' => $this->transfer,
            'insure' => $this->insure,
            'visa' => $this->visa,
            'excursion' => $this->excursion,
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
