<?php

namespace backend\models\base;

use backend\models\BusWayGeneratorQuery;
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


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'bus_info_id', 'bus_route_id',
                'reverse_name','reverse_bus_info_id','reverse_bus_route_id'], 'required'],
            [['name','reverse_name'], 'string'],
            [['bus_info_id', 'active', 'bus_route_id',
                'reverse_bus_info_id', 'reverse_bus_route_id',
                'created_by', 'updated_by', 'lock', 'stop'], 'integer'],
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            [['reverse_date_begin', 'reverse_date_end', 'date_add', 'date_edit'], 'safe'],
            [['price','reverse_price'], 'number'],
            [['path_time'], 'string'],
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
        $model = new \backend\models\BusWayGenerator();
        $model -> load();
        return true;
    }

    public function generate(){

        return true;
    }
}
