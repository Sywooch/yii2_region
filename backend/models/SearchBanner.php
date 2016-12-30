<?php

namespace backend\models;

use common\models\Banner;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SearchBanner represents the model behind the search form about `common\models\Banner`.
 */
class SearchBanner extends Banner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['name', 'text', 'file', 'path', 'options', 'link', 'date_add', 'date_edit'], 'safe'],
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
        $query = Banner::find();

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
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'lock' => $this->lock,
            'count' => $this->count,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'options', $this->options])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}