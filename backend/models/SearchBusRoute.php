<?php

namespace backend\models;

use common\models\BusRoute;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * backend\models\SearchBusRoute represents the model behind the search form about `common\models\BusRoute`.
 */
class SearchBusRoute extends BusRoute
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['name', 'date', 'date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
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
        $query = BusRoute::find();

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
            'date' => $this->date,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
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
