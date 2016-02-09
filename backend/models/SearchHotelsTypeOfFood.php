<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HotelsTypeOfFood;

/**
 * SearchHotelsTypeOfFood represents the model behind the search form about `common\models\HotelsTypeOfFood`.
 */
class SearchHotelsTypeOfFood extends HotelsTypeOfFood
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_price'], 'integer'],
            [['name', 'abbrev'], 'safe'],
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
        $query = HotelsTypeOfFood::find();

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
            'price' => $this->price,
            'type_price' => $this->type_price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'abbrev', $this->abbrev]);

        return $dataProvider;
    }
}
