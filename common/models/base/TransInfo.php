<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "trans_info".
 *
 * @property integer $id
 * @property string $name
 * @property integer $trans_type_id
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
 * @property \common\models\TransSeats[] $transSeats
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
            [['name', 'trans_type_id', 'trans_route_id'], 'required'],
            [['name'], 'string'],
            [['trans_type_id', 'trans_route_id', 'seats', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
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
            'id' => Yii::t('app', 'Первичный ключ'),
            'name' => Yii::t('app', 'Наименование транспорта'),
            'trans_type_id' => Yii::t('app', 'Необходимый тип трансопрт'),
            'trans_route_id' => Yii::t('app', 'Транспортный маршрут'),
            'seats' => Yii::t('app', 'Общее количество посадочных мест в транспорте (не обязательно)'),
            'active' => Yii::t('app', 'Активность'),
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
    public function getTransSeats()
    {
        return $this->hasMany(\common\models\TransSeats::className(), ['trans_info_id' => 'id'])->inverseOf('transInfo');
    }

    /**
     * @return $this
     */
    public function getTransReservation()
    {
        return $this->hasMany(\common\models\TransReservation::className(), ['trans_price_id' => 'id'])->inverseOf('transPrice');
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

    /*public function getRouteFullName(){
        $model = TransRoute::find()->orderBy('begin_point')->asArray()->all();
        $result = [];
        foreach ($model as $key=>$value){
            $result[$key] = $value['begin_point'].
                " ".$value['end_point'];
        }
        return $result;
    }*/
}
