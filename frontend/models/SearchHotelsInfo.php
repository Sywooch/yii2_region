<?php

namespace frontend\models;

use common\models\HotelsCharacterItem;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HotelsInfo;
use yii\db\Query;

/**
 * SearchHotelsInfo represents the model behind the search form about `common\models\HotelsInfo`.
 */
class SearchHotelsInfo extends HotelsInfo
{

    public $price_from;
    public $price_to;
    public $count_tourist;
    public $child;
    public $date_beg;
    public $date_end;
    public $tour_type;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country', 'hotels_stars_id'], 'integer'],
            [['name', 'address', 'gps_point_m', 'gps_point_p', 'links_maps', 'image', 'date_add', 'date_edit','tour_type'], 'safe'],
            
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

    public function attributeHints()
    {
        //return parent::attributeHints(); // TODO: Change the autogenerated stub
        return false;
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name hotels'),
            'tour_type' => Yii::t('app','Tour type'),
            'address' => Yii::t('app', 'Kurort'),
            'country' => Yii::t('app', 'Country'),
            'price_from' => Yii::t('app', 'Price from'),
            'price_to' => Yii::t('app', 'Price to'),
            'count_tourist' => Yii::t('app', 'Count tourist'),
            'child' => Yii::t('app', 'Child'),
            'date_beg' => Yii::t('app', 'Date begin'),
            'date_end' => Yii::t('app', 'Date end'),
            'hotels_stars_id' => Yii::t('app','Hotels Stars'),
        ];
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
        $query = HotelsInfo::find();
        $query->andFilterWhere([
            'active' => 1,
        ]);

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
            'country' => $this->country,
            'hotels_stars_id' => $this->hotels_stars_id,
        ]);
        $query->andFilterWhere(['<=','date_begin',$this->date_beg]);
        $query->andFilterWhere(['>=','date_begin',$this->date_end]);

        /*$query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gps_point_m', $this->gps_point_m])
            ->andFilterWhere(['like', 'gps_point_p', $this->gps_point_p]);*/

        //Формируем запрос по поиску направлений и гостиниц (туров)

        return $dataProvider;
    }

    public function searchTop(){
        $query = HotelsInfo::find();
        $query->andFilterWhere([
            'active' => 1,
            'top' => 1,
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        /*$this->load($params);

        if (!$this->validate()) {*/
// uncomment the following line if you do not want to any records when validation fails
// $query->where('0=1');
            return $dataProvider;
        //}


        return $dataProvider;
    }

    public static function getCharacters($id){
        //$model = HotelsCharacterItem::find();
        $model = new Query();
        $model->select('hotels_character.name name, hotels_character_item.value value');
        $model->from(['hotels_character','hotels_character_item']);
        $model->innerJoin('hotels_character','`hotels_character`.`id`=`hotels_character_item`.`hotels_character_id`');

        $model->andFilterWhere([
            'hotels_info_id'=>$id,
            'hotels_character.active'=>1,
            'hotels_character_item.active'=>1,
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination'=>[
                'pageSize'=>0,
            ]
        ]);
        return $dataProvider;
    }
}