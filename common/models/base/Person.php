<?php

namespace common\models\base;

use mootensai\behaviors\UUIDBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

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
 * @property \common\models\BusReservationHasPerson[] $busReservationHasPeople
 * @property \common\models\BusReservation[] $busReservations
 * @property \common\models\SalOrderHasPerson[] $salOrderHasPeople
 * @property \common\models\SalOrder[] $salOrders
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
        return $this->hasMany(\common\models\BusReservationHasPerson::className(), ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusReservations()
    {
        return $this->hasMany(\common\models\BusReservation::className(), ['id' => 'bus_reservation_id'])->viaTable('bus_reservation_has_person', ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrderHasPeople()
    {
        return $this->hasMany(\common\models\SalOrderHasPerson::className(), ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrders()
    {
        return $this->hasMany(\common\models\SalOrder::className(), ['id' => 'sal_order_id'])->viaTable('sal_order_has_person', ['person_id' => 'id']);
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
     * @return \common\models\PersonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\PersonQuery(get_called_class());
    }
}
