<?php

namespace backend\models;

use common\models\Discount;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SearchDiscount represents the model behind the search form about `common\models\Discount`.
 */
class SearchDiscount extends Discount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'years', 'active', 'hotels_info_id'], 'integer'],
            [['name', 'date_add', 'date_edit'], 'safe'],
            [['discount'], 'number'],
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
        $query = Discount::find();

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
            'discount' => $this->discount,
            'years' => $this->years,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
            'active' => $this->active,
            //'hotels_info_id' => $this->hotels_info_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
