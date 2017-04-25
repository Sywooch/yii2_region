<?php

namespace frontend\components\lk\models;

use common\models\AgentPayment;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * frontend\components\lk\models\SearchAgentPayment represents the model behind the search form about `common\models\AgentPayment`.
 */
 class SearchAgentPayment extends AgentPayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['payment'], 'number'],
            [['comment', 'date_add', 'date_edit'], 'safe'],
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
        $query = AgentPayment::find()->andWhere(['user_id'=>Yii::$app->user->id]);

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
            //'user_id' => $this->user_id,
            'payment' => $this->payment,
            'status' => $this->status,
            'date_add' => $this->date_add,
            'date_edit' => $this->date_edit,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
