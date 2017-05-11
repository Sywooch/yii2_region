<?php


namespace frontend\models;

use cinghie\articles\models\ItemsSearch as BaseItemSearch;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\ForbiddenHttpException;

class ItemsSearch extends BaseItemSearch
{

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
     * @param array $params
     * @return ActiveDataProvider
     * @throws ForbiddenHttpException
     */
    public function search($params)
    {
        /*if(Yii::$app->user->can('articles-index-his-items'))
        {
            $query = Items::find()->where(['created_by' => Yii::$app->user->identity->id]);
        } elseif(Yii::$app->user->can('articles-index-all-items')) {
            $query = Items::find();
        } else {
            throw new ForbiddenHttpException;
        }*/
        //$query = Items::find();
        $query = News::find();

        $query->joinWith('category');
        $query->joinWith('createdby');
        $query->joinWith('modifiedby');
        $query->joinWith('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'userid' => $this->userid,
            'state' => $this->state,
            'access' => $this->access,
            'ordering' => $this->ordering,
            'hits' => $this->hits,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'category.name', $this->catid])
            ->andFilterWhere(['like', 'createdby.username', $this->created_by])
            ->andFilterWhere(['like', 'modifiedby.username', $this->modified_by])
            ->andFilterWhere(['like', 'introtext', $this->introtext])
            ->andFilterWhere(['like', 'fulltext', $this->fulltext])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'image_caption', $this->image_caption])
            ->andFilterWhere(['like', 'image_credits', $this->image_credits])
            ->andFilterWhere(['like', 'video', $this->video])
            ->andFilterWhere(['like', 'video_type', $this->video_type])
            ->andFilterWhere(['like', 'video_caption', $this->video_caption])
            ->andFilterWhere(['like', 'video_credits', $this->video_credits])
            ->andFilterWhere(['like', 'params', $this->params])
            ->andFilterWhere(['like', 'metadesc', $this->metadesc])
            ->andFilterWhere(['like', 'metakey', $this->metakey])
            ->andFilterWhere(['like', 'robots', $this->robots])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'copyright', $this->copyright]);

        return $dataProvider;
    }
}
