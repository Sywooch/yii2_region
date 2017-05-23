<?php

namespace backend\models\base;

use backend\models\BusWayGeneratorQuery;
use common\models\BusInfo;
use common\models\BusRoute;
use common\models\BusWay;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "bus_way".
 *
 * @property integer $id
 * @property string $name
 * @property integer $bus_info_id
 * @property string $date_begin
 * @property string $date_end
 * @property integer $active
 * @property integer $ended
 * @property integer $bus_route_id
 * @property string $path_time
 * @property double $price
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 * @property integer $stop
 *
 * @property \common\models\BusReservation[] $busReservations
 * @property \common\models\BusInfo $busInfo
 * @property \common\models\BusRoute $busRoute
 */
class BusWayGenerator extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    public $rangedate1;
    public $rangedate2;
    //Добавляем переменные для автоматического создания обратного путевого листа
    public $b_reverse;
    public $reverse_date_begin;
    public $reverse_date_end;

    public $reverse_name;
    public $reverse_bus_info_id;
    public $reverse_bus_route_id;
    public $reverse_price;
    public $reverse_path_time;
    public $reverse_active;

    public $data;
    public $reverse_data;

    public $count;
    public $period; //Периодичность выезда на маршрут (дни). Через какое количество дней будет очередной рейс.
    public $reverse_period;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bus_info_id', 'bus_route_id',
                'reverse_bus_info_id','reverse_bus_route_id'], 'required'],
            [['name','reverse_name'], 'string'],
            [['bus_info_id', 'active', 'bus_route_id',
                'reverse_bus_info_id', 'reverse_bus_route_id',
                'created_by', 'updated_by', 'lock', 'stop'], 'integer'],
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            [['reverse_date_begin', 'reverse_date_end', 'date_add', 'date_edit'], 'safe'],
            [['price','reverse_price'], 'number'],
            [['path_time', 'reverse_path_time','period','reverse_period'], 'string'],
            //[['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_way';
    }

    /**
     * 
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock 
     * 
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Данная таблица содержит информацию о всех маршрутах автобусов.'),
            'name' => Yii::t('app', 'Наименование путевого листа (пример, Икарус Тамбов-Сочи 5 января 2016)'),
            'bus_info_id' => Yii::t('app', 'Автобус, который совершает поездку'),
            'date_begin' => Yii::t('app', 'Время начала поездки'),
            'date_end' => Yii::t('app', 'Время окончания поездки'),
            'active' => Yii::t('app', 'Поле указывает, опубликовано (активно) ли событие в данный момент.'),
            'ended' => Yii::t('app', 'Поле указывает на завершенное событие'),
            'bus_route_id' => Yii::t('app', 'Маршрут поездки'),
            'path_time' => Yii::t('app', 'Время в пути'),
            'price' => Yii::t('app', 'Цена одного места в автобусе'),
            'date_add' => Yii::t('app', 'Когда создана запись'),
            'date_edit' => Yii::t('app', 'Когда обновлена запись'),
            'lock' => Yii::t('app', 'Оптимистическая блокировка'),
            'stop' => Yii::t('app', 'Запрет изменения записи'),
            'period' => Yii::t('app', 'Period'),
            'reverse_id' => Yii::t('app', 'Первичный ключ. Данная таблица содержит информацию о всех маршрутах автобусов.'),
            'reverse_name' => Yii::t('app', 'Наименование путевого листа (пример, Икарус Тамбов-Сочи 5 января 2016)'),
            'reverse_bus_info_id' => Yii::t('app', 'Автобус, который совершает поездку'),
            'reverse_date_begin' => Yii::t('app', 'Время начала поездки'),
            'reverse_date_end' => Yii::t('app', 'Время окончания поездки'),
            'reverse_active' => Yii::t('app', 'Поле указывает, опубликовано (активно) ли событие в данный момент.'),
            'reverse_ended' => Yii::t('app', 'Поле указывает на завершенное событие'),
            'reverse_bus_route_id' => Yii::t('app', 'Маршрут обратной поездки'),
            'reverse_path_time' => Yii::t('app', 'Время в пути'),
            'reverse_price' => Yii::t('app', 'Цена одного места в автобусе'),
            'reverse_date_add' => Yii::t('app', 'Когда создана запись'),
            'reverse_date_edit' => Yii::t('app', 'Когда обновлена запись'),
            'reverse_lock' => Yii::t('app', 'Оптимистическая блокировка'),
            'reverse_stop' => Yii::t('app', 'Запрет изменения записи'),
            'reverse_period' => Yii::t('app', 'Period'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusReservations()
    {
        return $this->hasMany(\common\models\BusReservation::className(), ['bus_way_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusInfo()
    {
        return $this->hasOne(\common\models\BusInfo::className(), ['id' => 'bus_info_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRoute()
    {
        return $this->hasOne(\common\models\BusRoute::className(), ['id' => 'bus_route_id']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_add',
                'updatedAtAttribute' => 'date_edit',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\BusWayGeneratorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BusWayGeneratorQuery(get_called_class());
    }

    public function loadGenerateData($data){
        //$model = new \backend\models\BusWayGenerator();
        if ($this->load($data)){
            $this->calcCountIteration();
            return true;
        }
        return false;
    }

    public function generate(){
        $stop = false;
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $busName = BusInfo::findOne(['id'=>$this->bus_info_id])->name;
        $routeName = BusRoute::findOne(['id' => $this->bus_route_id])->name;
        $busNameReverse = BusInfo::findOne(['id'=>$this->reverse_bus_info_id])->name;
        $routeNameReverse = BusRoute::findOne(['id' => $this->reverse_bus_route_id])->name;
        $nameFirst = $busName . ' - ' . $routeName . ' ';
        $nameFirstReverse = $busNameReverse . ' - ' . $routeNameReverse . ' ';
        $date_begin = $this->date_begin;
        $active = 1;
        $date_range = $this->calcNextDate($date_begin, false);
        $date_begin_reverse = $this->reverse_date_begin;
        $date_range_reverse = $this->calcNextDate($date_begin_reverse, false);
        for ($i = 0; $i < $this->count; $i++){
            $model = new BusWay();
            $model->name = $nameFirst . $date_begin;
            $model->bus_route_id = $this->bus_route_id;
            $model->bus_info_id = $this->bus_info_id;
            $model->date_begin = $date_range['date_begin'];
            $model->date_end = $date_range['date_end'];
            $model->price = $this->price;
            $model->path_time = $this->path_time;
            $model->active = $active;
            $model_reverse = new BusWay();
            $model_reverse->name = $nameFirstReverse . $date_begin;
            $model_reverse->bus_route_id = $this->reverse_bus_route_id;
            $model_reverse->bus_info_id = $this->reverse_bus_info_id;
            $model_reverse->date_begin = $date_range_reverse['date_begin'];
            $model_reverse->date_end = $date_range_reverse['date_end'];
            $model_reverse->price = $this->reverse_price;
            $model_reverse->path_time = $this->reverse_path_time;
            try{
                $model->save();
                $model_reverse->save();
            }
            catch (\Exception $e){
                //$transaction->rollBack();
                $stop= true;
                exit;
            }
            $date_range = $this->calcNextDate($date_begin);
            $date_range_reverse = $this->calcNextDate($date_begin_reverse);
            $date_begin = $date_range['date_begin'];
            $date_begin_reverse = $date_range_reverse['date_begin'];
        }

        if ($stop === true){
            return false;
        }
        $transaction->commit();
        return true;

    }

    public function calcCountIteration(){
        //Получаем начальное время и конечное время
        $bDate = strtotime($this->date_begin);
        $eDate = strtotime($this->date_end);
        $allHours = abs($bDate-$eDate)/3600/24;
        //Считаем количество новых записей (итераций)
        $this->count = floor($allHours/intval($this->period));
        if ($this->count > 0){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Функция формирует следующую дату (по определенному периоду)
     * @param $date - дата с которой начнется формирование
     * @param bool $calc - switch, указывает на то, увеличивать ли $date на период
     * @return array ['date_begin'=>$value_begin,'date_end'=>$value_end];
     */
    public function calcNextDate($date, $calc=true){
        if ($calc){
            $period = $this->period;
        }
        else{
            $period = 0;
        }
        $date_begin = new \DateTime($date);
        //Увеличиваем дату
        //Получаем время новой начальной точки маршрута
        $date_begin->add(new \DateInterval("P". $period . "D"));
        //Получаем время конечной точки
        $date_end = new \DateTime($date_begin->format('Y-m-d H:i'));
        $date_end->add(new \DateInterval("PT".$this->path_time."H"));

        return array('date_begin'=>$date_begin->format('Y-m-d H:i'),
            'date_end'=>$date_end->format('Y-m-d H:i'));
    }
}
