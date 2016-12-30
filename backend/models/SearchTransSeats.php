<?php

namespace backend\models;

use common\models\TransSeats;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * backend\models\SearchTransSeats represents the model behind the search form about `common\models\TransSeats`.
 */
class SearchTransSeats extends TransSeats
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'trans_info_id', 'trans_seats_type_id', 'count', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
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
        $query = TransSeats::find();

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
            'trans_info_id' => $this->trans_info_id,
            'trans_seats_type_id' => $this->trans_seats_type_id,
            'count' => $this->count,
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
