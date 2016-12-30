<?php

namespace backend\models;

use common\models\HotelsAppartment;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * backend\models\SearchHotelsAppartment represents the model behind the search form about `common\models\HotelsAppartment`.
 */
class SearchHotelsAppartment extends HotelsAppartment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hotels_info_id', 'hotels_appartment_item_id', 'active', 'count_rooms', 'count_beds', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['name', 'date_add', 'date_edit'], 'safe'],
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
        $query = HotelsAppartment::find();

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
            'hotels_info_id' => $this->hotels_info_id,
            'price' => $this->price,
            'hotels_appartment_item_id' => $this->hotels_appartment_item_id,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
            'active' => $this->active,
            'count_rooms' => $this->count_rooms,
            'count_beds' => $this->count_beds,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
