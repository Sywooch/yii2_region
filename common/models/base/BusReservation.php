<?php

namespace common\models\base;

use common\models\BusInfo;
use common\models\BusWay;
use common\models\Person;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "bus_reservation".
 *
 * @property integer $id
 * @property string $name
 * @property integer $bus_info_id
 * @property integer $bus_way_id
 * @property integer $person_id
 * @property integer $number_seat
 * @property string $date
 * @property integer $status
 * @property integer $active
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\BusInfo $busInfo
 * @property \common\models\BusWay $busWay
 * @property \common\models\Person $person
 * @property \common\models\BusReservationHasPerson[] $busReservationHasPerson
 */
class BusReservation extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bus_info_id', 'bus_way_id'], 'required'],
            [['bus_info_id', 'bus_way_id', 'person_id', 'number_seat', 'status', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['date', 'date_add', 'date_edit'], 'safe'],
            [['name'], 'string', 'max' => 45],
            //[['number_seat'], 'unique', 'targetAttribute' => 'bus_way_id'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_reservation';
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */
    public function optimisticLock()
    {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'bus_info_id' => Yii::t('app', 'Bus Info ID'),
            'bus_way_id' => Yii::t('app', 'Bus Way ID'),
            'person_id' => Yii::t('app', 'Person'),
            'number_seat' => Yii::t('app', 'Номер места
'),
            'date' => Yii::t('app', 'Date'),
            'status' => Yii::t('app', 'Статус резервации'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
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
    public function getBusWay()
    {
        return $this->hasOne(\common\models\BusWay::className(), ['id' => 'bus_way_id'])->inverseOf('busReservations');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(\common\models\Person::className(), ['id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusReservationHasPerson()
    {
        return $this->hasMany(\common\models\BusReservationHasPerson::className(), ['bus_reservation_id' => 'id']);
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
     * @return \common\models\BusReservationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BusReservationQuery(get_called_class());
    }

    /**
     * Функция возвращает полное имя всех туристов или конкретного с его идентификатором
     * @param null $id - идентификатор туриста
     * @return array
     */
    public static function getPersonFullName($id = null)
    {
        if ($id != null && is_int($id)) {
            $model = Person::find()->andWhere(['id' => $id])->orderBy('lastname')->asArray()->all();
        } else {
            $model = Person::find()->orderBy('lastname')->asArray()->all();
        }
        $result = [];

        foreach ($model as $key => $value) {
            $result[$value['id']] = $value['lastname'] .
                " " . $value['firstname'] .
                " " . $value['secondname'] .
                " (" . $value['id'] . ")";
        }
        return $result;
    }

    public function getActiveBusWay()
    {
        $model = BusWay::find();
        $model->active();
        //$model->andWhere(['>=','date_begin',date('Y-m-d')]);
        return $model->all();
    }

    public function getActiveBusInfo()
    {
        $model = BusInfo::find();
        $model->active();
        return $model->all();
    }

    /**
     * Функция возвращает количество свободных мест на конкретном маршруте
     * @param $busWay - идентификатор путевого листа
     * @param $date - дата, на которую проверяется наличие мест
     * @return int - количество свободных мест
     */
    public static function getCountFreeSeats($busWay, $date = false)
    {
        /*$timestamp = strtotime($date);
        $dayBegin = date('Y-m-d', $timestamp) . ' 00:00:00';
        $dayEnd = date('Y-m-d', $timestamp) . ' 23:59:59';*/

        $model = new \common\models\BusReservation();
        $count = $model::find()->andFilterWhere(['bus_way_id' => $busWay])
            ->active()->count();

        $query = BusWay::findOne($busWay);

        $info = $query->getBusInfo()->all()[0]->seat;

        $count = $info - $count;

        return $count;
    }

    /**
     * Получаем массив с номерами забронированных мест
     * @param $busWay
     * @param bool $date
     * @return array
     */
    public static function getBronSeats($busWay, $date = false){
        $busReserv = \common\models\BusReservation::find()->active()
            ->andWhere(['bus_way_id'=>$busWay]);
        $bron = array();
        foreach ($busReserv->each() as $key=>$value){
            $bron[] = $value->number_seat;
        }
        return $bron;
    }

    /**
     * Возвращает массив с номерами свободных мест, отсортированных по возрастанию
     * @param $busWay
     * @param bool $date
     * @return array
     */
    public static function getFreeSeats($busWay, $date = false){
        $busReserv = \common\models\BusReservation::find();

        $busInfo = BusWay::findOne(['id' => $busWay])->busInfo;
        $allCount = $busInfo->seat;
        $seat = array();
        $bron = self::getBronSeats($busWay);
        for ($i = 1; $i < $allCount; $i++){
            if (!in_array($i,$bron)){
                $seat[] = $i;
            }
        }
        return $seat;
    }

    /**
     * Получаем максимальный номер занятого места
     * @param $busWayId
     * @return int
     */
    public static function getMaxSeats($busWayId)
    {
        return \common\models\BusReservation::find()
            ->andWhere(['bus_way_id'=> $busWayId])
            ->max('number_seat');
    }


}
