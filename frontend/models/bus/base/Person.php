<?php

namespace frontend\models\bus\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "person".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $secondname
 * @property string $date_new
 * @property string $date_edit
 * @property string $passport_ser
 * @property string $passport_num
 * @property string $contacts
 * @property string $other
 *
 * @property \frontend\models\bus\BusReservationHasPerson[] $busReservationHasPeople
 * @property \frontend\models\bus\BusReservation[] $busReservations
 * @property \frontend\models\bus\SalOrderHasPerson[] $salOrderHasPeople
 * @property \frontend\models\bus\SalOrder[] $salOrders
 */
class Person extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'secondname'], 'required'],
            [['date_new', 'date_edit'], 'safe'],
            [['contacts', 'other'], 'string'],
            [['firstname', 'lastname', 'secondname'], 'string', 'max' => 100],
            [['passport_ser'], 'string', 'max' => 10],
            [['passport_num'], 'string', 'max' => 15],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
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
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'secondname' => Yii::t('app', 'Secondname'),
            'date_new' => Yii::t('app', 'Date New'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'passport_ser' => Yii::t('app', 'Passport Ser'),
            'passport_num' => Yii::t('app', 'Passport Num'),
            'contacts' => Yii::t('app', 'Contacts'),
            'other' => Yii::t('app', 'Other'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusReservationHasPeople()
    {
        return $this->hasMany(\frontend\models\bus\BusReservationHasPerson::className(), ['person_id' => 'id'])->inverseOf('person');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusReservations()
    {
        return $this->hasMany(\frontend\models\bus\BusReservation::className(), ['id' => 'bus_reservation_id'])->viaTable('bus_reservation_has_person', ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrderHasPeople()
    {
        return $this->hasMany(\frontend\models\bus\SalOrderHasPerson::className(), ['person_id' => 'id'])->inverseOf('person');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrders()
    {
        return $this->hasMany(\frontend\models\bus\SalOrder::className(), ['id' => 'sal_order_id'])->viaTable('sal_order_has_person', ['person_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return type mixed
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
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \frontend\models\bus\PersonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\bus\PersonQuery(get_called_class());
    }
}
