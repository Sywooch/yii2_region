<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HotelsCharacterItem;

/**
 * SearchHotelsCharacterItem represents the model behind the search form about `common\models\HotelsCharacterItem`.
 */
class SearchHotelsCharacterItem extends HotelsCharacterItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hotels_character_id'], 'integer'],
            [['value', 'type', 'metrics'], 'safe'],
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
        $query = HotelsCharacterItem::find();

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
            'hotels_character_id' => $this->hotels_character_id,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'metrics', $this->metrics]);

        return $dataProvider;
    }
}
