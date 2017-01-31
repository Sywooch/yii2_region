<?php

namespace frontend\models;

use common\models\HotelsInfo;
use common\models\TourInfo;
use common\models\TourType;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * SearchHotelsInfo represents the model behind the search form about `common\models\HotelsInfo`.
 */
class SearchAdvancedFilter extends TourInfo
{

    public $countryTo; //Страна прибытия (country -> id) +
    public $countryOut; //Страна отправления (country -> id)
    public $cityTo; //Город прибытия (city -> id - hotels_info -> city_id) +
    public $cityOut; //Город отправления (city -> id - tour_info -> city_id) +

    public $stars; //Звездность гостиниц (1, 2, 3 и т.д.) (hotels_stars -> id - hotels_info -> hotels_stars_id) +
    public $typeOfFood; //Тип питания (все включено, только завтрак и т.д.) (hotels_type_of_food -> id) +
    // hotels_appartment_has_hotels_type_of_food -> hotels_appartment_hotels_info_id)
    public $appartmentType; //Тип номера (стандарт, эконом и т.д.) (hotels_appartment_item -> id) +

    public $touristCount; //Количество туристов (для расчета нужного количества комнат)
    public $childCount; //Количество детей (должно быть меньше кол-ва туристов минимум на 1)
    public $birthdayChild; //Дата рождения ребенка, нужна для определения скидки.
    // (скидка не действует, если выбирается только проживание)
    //Для каждого тура скидка вбивается отдельно!!!

    public $tourTypes; //Тип тура (автобусный к морю, горячие) (tour_type -> id) +
    public $tourComposition; //Состав тура (все включено, проезд, трансфер и т.д.) (tour_composition -> id)
    public $days; //Количество дней тура (tour_info -> days) +

    //tour_info->price - минимальная цена тура, расчитывается автоматически

    public $priceMin; //Минимальная цена тура (tour_info -> price) +
    public $priceMax; //Максимальная цена тура

    public $date_begin; //Начало периода, в который ищется начало тура (tour_info -> date_begin) +
    public $date_end; //Окончание периода, в который ищется начало тура (tour_info -> date_end) +
    public $tour_type_name; //Добавлено для перехода из строки меню

    /**
     * TODO Формирование счета, сразу после подтверждения админом брони.
     * После оплаты счета, заявка становится подтвержденной и становятся доступны документы для скачки:
     * ваучеры, трансфер и т.д.
     */


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryTo', 'cityTo', 'countryOut', 'cityOut', 'stars', 'days', 'touristCount', 'childCount'], 'integer'],
            [['priceMin', 'priceMax'], 'number'],
            [['tour_type_name'], 'string'],
            //[['date_begin','date_end'],'required'],
            ['priceMax', 'compare', 'compareAttribute' => 'priceMin', 'operator' => '>='],
            //['childCount', 'compare','compareAttribute'=>'touristCount', 'operator' => '<'],
            [['name', 'address', 'gps_point_m', 'gps_point_p', 'links_maps', 'image', 'date_begin', 'date_end', 'tourTypes'], 'safe'],

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
            'tourTypes' => Yii::t('app', 'Tour type'),
            'address' => Yii::t('app', 'Address'),
            'countryTo' => Yii::t('app', 'Country To'),
            'countryOut' => Yii::t('app', 'Country Out'),
            'cityTo' => Yii::t('app', 'City To'),
            'cityOut' => Yii::t('app', 'City Out'),
            'typeOfFood' => Yii::t('app', 'Type Of Food'),
            'appartmentType' => Yii::t('app', 'Appartment Type'),
            'priceMin' => Yii::t('app', 'Price from'),
            'priceMax' => Yii::t('app', 'Price to'),
            'days' => Yii::t('app', 'Days'),
            'touristCount' => Yii::t('app', 'Count tourist'),
            'childCount' => Yii::t('app', 'Child'),
            'date_begin' => Yii::t('app', 'Date begin'),
            'date_end' => Yii::t('app', 'Date end'),
            'stars' => Yii::t('app', 'Hotels Stars'),
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
        //$query = TourInfo::find();
        $query = new Query();
        //$query->from('tour_info');

        $query->andWhere([
            'tour_info.active' => 1,
        ])
            //->andWhere(['>=', 'tour_info.date_end', date('Y-m-d')]);
;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (isset($params['tour_type_name']) && $params['tour_type_name'] != "") {
            $this->tourTypes = TourType::findOne(['name' => $params['tour_type_name']])->id;
        }
        if (!isset($this->date_begin) || $this->date_begin == "") {
            $date_begin = date("Y-m-d");
        } else {
            $date_begin = date("Y-m-d", strtotime(str_replace('.', '-', $this->date_begin)));
        }

        if (!isset($this->date_end) || $this->date_end == "") {
            $date_end = date("Y-m-d");
        } else {
            $date_end = date("Y-m-d", strtotime(str_replace('.', '-', $this->date_end)));
        }

        $query->from(" 
            (SELECT '$date_begin' + INTERVAL (6 * a.num + b.num) DAY as selected_date
                 FROM
                (SELECT 0 AS num UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5) AS a,
                (SELECT 0 AS num UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5) AS b
                WHERE '$date_begin' + INTERVAL (6 * a.num + b.num) DAY <= '$date_end'
                ORDER BY 1
                ) as s,tour_info
        ");

        /*if (key_exists('tour_type_name', $params)) {
            $typeName = TourType::findOne(['name' => $params['tour_type_name']]);
            $this->tour_type = $typeName->id;
        }*/

        if (!$this->validate()) {
// uncomment the following line if you do not want to any records when validation fails
// $query->where('0=1');
            return $dataProvider;
        }
        $query->select(['tour_info.id as tour_info_id',
            'tour_info.days',
            'hi.id as hotels_info_id',
            'hi.name as name',
            'hi.hotels_stars_id as hotels_stars_id',
            'hi.city_id as city_id',
            'hi.country as country_id',
            'ha.name as appartment_name',
            'ha.id as hotels_appartment_id',
            'htof.name as name_type_food',
            'htof.id as type_food_id',
            'hpp.price as price',
            'hpp.id as hotels_pay_period_id',
            'tp.price as min_full_price',
            'http.tour_type_transport_id',
            's.selected_date'
        ]);
        //$query->select(['date_begin'=>$date_begin,'date_end'=>$date_end]);
        //$query->distinct();



        $query->leftJoin('hotels_info as hi', 'tour_info.hotels_info_id = hi.id and hi.active=1')
            ->leftJoin('hotels_appartment as ha', 'ha.hotels_info_id = hi.id and ha.active=1')
            ->leftJoin('hotels_appartment_has_hotels_type_of_food as htf', 'htf.id = ha.id')
            ->leftJoin('`hotels_type_of_food` `htof`', 'htof.id = htf.hotels_type_of_food_id')
            ->leftJoin('tour_info_has_tour_type as htt', 'tour_info.id = htt.tour_info_id')
            ->leftJoin('hotels_pricing as hp', '
                hp.hotels_info_id = hi.id 
                and hp.active=1 
                and hp.hotels_appartment_id = ha.id 
                and hp.hotels_type_of_food_id = htf.hotels_type_of_food_id
            ')
            ->leftJoin('hotels_pay_period as hpp', 'hpp.hotels_pricing_id = hp.id and hpp.active=1')
            ->leftJoin('tour_price as tp', 'tour_info.id = tp.tour_info_id')
            ->leftJoin('`tour_info_has_tour_type_transport` as `http`', 'tour_info.id = http.tour_info_id');

        $query->andFilterWhere(['tour_info.active' => 1])
            ->andFilterWhere(['tour_info.days' => $this->days])
            //->andFilterWhere(['tour_info.price'=>$this->priceMin])
            /*->andFilterWhere(['<=', 'tour_info.date_begin', $this->date_begin])
            ->andFilterWhere(['>=', 'tour_info.date_end', $this->date_end])*/
            /*->andWhere("((`hpp`.`date_begin` <= \"$date_begin\") AND (`hpp`.`date_end` >= \"$date_begin\") )
    OR ((`hpp`.`date_begin` <= \"$date_end\")AND(`hpp`.`date_end` >= \"$date_end\"))")*/
            //->andFilterWhere([''])
            //->andFilterWhere(['IN','tour_info.city_id', $cityOut])
                ->andWhere('s.selected_date between hpp.date_begin and hpp.date_end')
            //->andWhere('(`hpp`.`date_begin` >= `s`.`selected_date` and `hpp`.`date_end` <= `s`.`selected_date`)')

            ->andFilterWhere(['hi.city_id' => $this->cityTo])
            ->andFilterWhere(['hi.country' => $this->countryTo])

            ->andFilterWhere(['hi.hotels_stars_id' => $this->stars])
            ->andFilterWhere(['hp.hotels_type_of_food_id' => $this->typeOfFood])
            ->andFilterWhere(['ha.hotels_appartment_item_id' => $this->appartmentType])
            ->andFilterWhere(['>','hpp.price','0'])
            ->andFilterWhere(['htt.tour_type_id' => $this->tourTypes]);
        if (isset($this->cityOut) && $this->cityOut != "") {
            $query->andWhere(['tour_info.city_id' => $this->cityOut]);
        } elseif (isset($this->countryOut) && $this->countryOut != "") {
            $query->andWhere("tour_info.city_id IN (SELECT id FROM city WHERE country_id=$this->countryOut)");
            //\common\models\City::find()->select('id')->andWhere(['country_id'=>$this->countryOut])->asArray()->all();
        }
        $query->groupBy('s.selected_date, tour_info_id, ha.id, name_type_food, days');
        $query->orderBy('(hpp.price * days)');
        /**
         * TODO Добавить фильтр по наличию мест в эти даты
         * Для этого надо сделать дополнительный запрос
         * На наличие мест в эти даты.
         * ID-шники допустимых номеров передать в основной запрос
         *
         *
         * SELECT id FROM hotels_appartment WHERE
         *
         * bron.date_begin <= $this->date_end
         * bron.date_end >= $this->date_begin
         */


        /*if ($this->childCount > 0){
            //Получаем размеры всех скидкок
            foreach ($this->birthdayChild as $birthDay){
                /**
                 * TODO Доделать расчет процента скидки
                 *
            }
        }*/


        /*$query->leftJoin('hotels_info as hi', 'tour_info.hotels_info_id = hi.id and active = 1') //гостиница
            ->leftJoin('hotels_pricing as hp', 'hi.id = hp.hotels_appartment_hotels_info_id and active = 1') //для цены
            ->leftJoin('hotels_pay_period as hpp', 'hp.id = hpp.hotels_pricing_id') //цена и дата для формирования цены
            ->leftJoin('')
            ->leftJoin('tour_info as c', 'hotels_info.id = c.hotels_info_id')
            ->leftJoin('tour_info_has_tour_type as d', 'd.tour_info_id = c.id');
        $query->andFilterWhere([
            'tour_info.id' => $this->id,
            'hotels_info.country' => $this->country,
            'hotels_info.city_id' => $this->city_id,
            'hotels_info.hotels_stars_id' => $this->hotels_stars_id,
        ])
            ->andFilterWhere(['d.tour_type_id' => $this->tour_type])
            ->andFilterWhere(['>=', 'ha.price', $this->price_from])
            ->andFilterWhere(['<=', 'ha.price', $this->price_to])
            ->andFilterWhere(['>=', 'hotels_info.date_begin', $this->date_beg])
            ->andFilterWhere(['<=', 'hotels_info.date_begin', $this->date_end]);
        //Todo Добавить innerjoin на связанные таблицы, а именно, цена тура, тип тура

        /*$query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gps_point_m', $this->gps_point_m])
            ->andFilterWhere(['like', 'gps_point_p', $this->gps_point_p]);*/

        //Формируем запрос по поиску направлений и гостиниц (туров)

        return $dataProvider;
    }

    public function searchInHotels($params)
    {


        $query = new Query();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        //!!!!!!!!Если выбирается страна и/или город отправления, тогда переходим на обычный поиск туров
        if ((isset($this->countryOut) && $this->countryOut > 0) || (isset($this->cityOut) && $this->cityOut > 0)){
            return $this->search($params);
        }
        //!!!!!!!!

        if (isset($params['tour_type_name']) && $params['tour_type_name'] != "") {
            $this->tourTypes = TourType::findOne(['name' => $params['tour_type_name']])->id;
        }
        /*if (!isset($this->date_begin) || $this->date_begin == "") {
            $date_begin = date("Y-m-d");
        } else {
            $date_begin = date("Y-m-d", strtotime(str_replace('.', '-', $this->date_begin)));
        }

        if (!isset($this->date_end) || $this->date_end == "") {
            $date_end = date("Y-m-d");
        } else {
            $date_end = date("Y-m-d", strtotime(str_replace('.', '-', $this->date_end)));
        }*/
        $date = new Tour();
        $date = $date->datePeriodDays($this->date_begin, 1, $this->date_end);
        $date_begin = $date['begin'];
        $date_end = $date['end'];

        $query->from(" 
            (SELECT '$date_begin' + INTERVAL (6 * a.num + b.num) DAY as selected_date
                 FROM
                (SELECT 0 AS num UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5) AS a,
                (SELECT 0 AS num UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5) AS b
                WHERE '$date_begin' + INTERVAL (6 * a.num + b.num) DAY <= '$date_end'
                ORDER BY 1
                ) as s,hotels_info as hi
        ");

        /*if (key_exists('tour_type_name', $params)) {
            $typeName = TourType::findOne(['name' => $params['tour_type_name']]);
            $this->tour_type = $typeName->id;
        }*/

        if (!$this->validate()) {
// uncomment the following line if you do not want to any records when validation fails
// $query->where('0=1');
            return $dataProvider;
        }
        $query->select([
            'hi.id as hotels_info_id',
            'hi.name as name',
            'hi.hotels_stars_id as hotels_stars_id',
            'hi.city_id as city_id',
            'hi.country as country_id',
            'ha.name as appartment_name',
            'ha.id as hotels_appartment_id',
            'htof.name as name_type_food',
            'htof.id as type_food_id',
            'hpp.price as price',
            'hpp.id as hotels_pay_period_id',
            '`s`.`selected_date`, "1" as days'
        ]);

        //$query->select(['date_begin'=>$date_begin,'date_end'=>$date_end]);
        //$query->distinct();

        $query
            ->leftJoin('hotels_appartment as ha', 'ha.hotels_info_id = hi.id and ha.active=1')
            ->leftJoin('hotels_appartment_has_hotels_type_of_food as htf', 'htf.id = ha.id')
            ->leftJoin('`hotels_type_of_food` `htof`', 'htof.id = htf.hotels_type_of_food_id')
            ->leftJoin('hotels_pricing as hp', 'hp.hotels_info_id = hi.id and hp.active=1')
            ->leftJoin('hotels_pay_period as hpp', 'hpp.hotels_pricing_id = hp.id and hpp.active=1');

        $query->andFilterWhere(['hi.active' => 1])
            ->andWhere('s.selected_date between hpp.date_begin and hpp.date_end')
            ->andFilterWhere(['hi.city_id' => $this->cityTo])
            ->andFilterWhere(['hi.country' => $this->countryTo])
            ->andFilterWhere(['hi.hotels_stars_id' => $this->stars])
            ->andFilterWhere(['hp.hotels_type_of_food_id' => $this->typeOfFood])
            ->andFilterWhere(['ha.hotels_appartment_item_id' => $this->appartmentType])
            ->andFilterWhere(['>','hpp.price','0'])
            ;
        $query->groupBy('s.selected_date, hotels_info_id, ha.id, name_type_food');
        $query->orderBy('hpp.price');

        /**
         * TODO Добавить фильтр по наличию мест в эти даты
         * Для этого надо сделать дополнительный запрос
         * На наличие мест в эти даты.
         * ID-шники допустимых номеров передать в основной запрос
         *
         *
         * SELECT id FROM hotels_appartment WHERE
         *
         * bron.date_begin <= $this->date_end
         * bron.date_end >= $this->date_begin
         */


        /*if ($this->childCount > 0){
            //Получаем размеры всех скидкок
            foreach ($this->birthdayChild as $birthDay){
                /**
                 * TODO Доделать расчет процента скидки
                 *
            }
        }*/

        //Todo Добавить innerjoin на связанные таблицы, а именно, цена тура, тип тура


        return $dataProvider;
    }

    public function searchTop()
    {
        $query = HotelsInfo::find();
        $query->distinct();
        //$query->select('hotels_info.*, hp.id, hpp.id , price');
        //$query->leftJoin('tour_info','tour_info.hotels_info_id = hotels_info.id');
        $query->leftJoin('hotels_pricing hp','hp.hotels_info_id = hotels_info.id')
            ->leftJoin('hotels_pay_period hpp', 'hpp.hotels_pricing_id = hp.id')
            ->innerJoin('hotels_appartment ha', 'ha.hotels_info_id = hotels_info.id')
        ;
        $query->andFilterWhere([
            //'tour_info.active' => 1,
            'hotels_info.active' => 1,
            'top' => 1,
            //'hot' => 1,
        ]);
            /*$query->andFilterWhere(['>', 'hpp.price', 0]);
       $query->andFilterWhere(['>', 'DATE_FORMAT(`hpp`.`date_end`,"%Y-%m-%d")', date('Y-m-d')]);*/
            $query->orderBy(['date_add'=>SORT_DESC,'top_num'=>SORT_ASC]);
            $query->limit(12);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            /*'pagination' => [
                'pageSize' => 12,
            ],*/
            'pagination' => false,
        ]);

        /*$this->load($params);

        if (!$this->validate()) {*/
// uncomment the following line if you do not want to any records when validation fails
// $query->where('0=1');
        return $dataProvider;
    }

    public static function getCharacters($id)
    {
        //$model = HotelsCharacterItem::find();
        $model = new Query();
        $model->select('hotels_character.name name, hotels_character_item.value value');
        $model->from(['hotels_character_item']);
        $model->innerJoin('hotels_character', '`hotels_character`.`id`=`hotels_character_item`.`hotels_character_id`');

        $model->andFilterWhere([
            'hotels_character_item.hotels_info_id' => $id,
            'hotels_character.active' => 1,
            'hotels_character_item.active' => 1,
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 0,
            ]
        ]);
        return $dataProvider;
    }

    /**
     * Получаем полных лет ребенка на текущую дату
     * @return int
     */
    public function getChildYears($birthDay)
    {
        $dateBegin = new \DateTime($birthDay);
        $dateCurrent = new \DateTime();
        $years = $dateCurrent->diff($dateBegin);
        return $years->y;
    }

    public function categorizedTour()
    {

    }

    public function searchTour($params)
    {
        $find = new GenTour();
        return $find->search($params);
    }
}