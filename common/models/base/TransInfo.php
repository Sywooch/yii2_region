<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "trans_info".
 *
 * @property integer $id
 * @property integer $trans_type_id
 * @property string $name
 * @property integer $trans_route_id
 * @property integer $seats
 * @property integer $active
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\SalBasket[] $salBaskets
 * @property \common\models\TransRoute $transRoute
 * @property \common\models\TransType $transType
 * @property \common\models\TransPrice[] $transPrices
 * @property \common\models\TransReservation[] $transReservations
 */
class TransInfo extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trans_type_id', 'name', 'trans_route_id'], 'required'],
            [['trans_type_id', 'trans_route_id', 'seats', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['name'], 'string'],
            [['trans_route_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\TransRoute::className(), 'targetAttribute' => ['trans_route_id' => 'id']],
            [['trans_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\TransType::className(), 'targetAttribute' => ['trans_type_id' => 'id']],
            [['date_add', 'date_edit'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_info';
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
            'trans_type_id' => Yii::t('app', 'Trans Type ID'),
            'name' => Yii::t('app', 'Name'),
            'trans_route_id' => Yii::t('app', 'Trans Route ID'),
            'seats' => Yii::t('app', 'Seats'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalBaskets()
    {
        return $this->hasMany(\common\models\SalBasket::className(), ['trans_info_id' => 'id'])->inverseOf('transInfo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransRoute()
    {
        return $this->hasOne(\common\models\TransRoute::className(), ['id' => 'trans_route_id'])->inverseOf('transInfos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransType()
    {
        return $this->hasOne(\common\models\TransType::className(), ['id' => 'trans_type_id'])->inverseOf('transInfos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransPrices()
    {
        return $this->hasMany(\common\models\TransPrice::className(), ['trans_info_id' => 'id'])->inverseOf('transInfo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransReservations()
    {
        return $this->hasMany(\common\models\TransReservation::className(), ['trans_info_id' => 'id'])->inverseOf('transInfo');
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
     * @return \common\models\TransInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TransInfoQuery(get_called_class());
    }
}
