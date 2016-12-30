<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "trans_price".
 *
 * @property integer $id
 * @property integer $trans_info_id
 * @property integer $trans_seats_id
 * @property string $date_begin
 * @property string $date_end
 * @property double $price
 * @property string $date_add
 * @property string $date_edit
 * @property integer $active
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\TransInfo $transInfo
 * @property \common\models\TransSeats $transSeats
 * @property \common\models\TransReservation[] $transReservations
 */
class TransPrice extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trans_info_id', 'trans_seats_id', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['trans_seats_id'], 'required'],
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            [['price'], 'number'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_price';
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
            'id' => Yii::t('app', 'Идентификатор'),
            'trans_info_id' => Yii::t('app', 'Trans Info ID'),
            'trans_seats_id' => Yii::t('app', 'Посадочные места'),
            'date_begin' => Yii::t('app', 'Дата начала маршрута'),
            'date_end' => Yii::t('app', 'Дата окончания маршрута'),
            'price' => Yii::t('app', 'Цена за одно место'),
            'date_add' => Yii::t('app', 'Дата создания записи'),
            'date_edit' => Yii::t('app', 'Дата изменения записи
'),
            'active' => Yii::t('app', 'Активность'),
            'lock' => Yii::t('app', 'Оптимистическая блокировка'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransInfo()
    {
        return $this->hasOne(\common\models\TransInfo::className(), ['id' => 'trans_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransSeats()
    {
        return $this->hasOne(\common\models\TransSeats::className(), ['id' => 'trans_seats_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransReservations()
    {
        return $this->hasMany(\common\models\TransReservation::className(), ['trans_price_id' => 'id']);
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
     * @return \common\models\TransPriceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TransPriceQuery(get_called_class());
    }
}
