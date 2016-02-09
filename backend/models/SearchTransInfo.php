<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TransInfo;

/**
 * SearchTransInfo represents the model behind the search form about `common\models\TransInfo`.
 */
class SearchTransInfo extends TransInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'trans_type_id', 'trans_route_id', 'trans_price_id'], 'integer'],
            [['name'], 'safe'],
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
        $query = TransInfo::find();

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
            'trans_type_id' => $this->trans_type_id,
            'trans_route_id' => $this->trans_route_id,
            'trans_price_id' => $this->trans_price_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
