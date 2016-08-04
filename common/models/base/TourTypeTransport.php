<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "tour_type_transport".
 *
 * @property integer $id
 * @property string $name
 *
 * @property \common\models\SalOrder[] $salOrders
 * @property \common\models\TourInfoHasTourTypeTransport[] $tourInfoHasTourTypeTransports
 * @property \common\models\TourInfo[] $tourInfos
 */
class TourTypeTransport extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour_type_transport';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrders()
    {
        return $this->hasMany(\common\models\SalOrder::className(), ['trans_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourInfoHasTourTypeTransports()
    {
        return $this->hasMany(\common\models\TourInfoHasTourTypeTransport::className(), ['tour_type_transport_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourInfos()
    {
        return $this->hasMany(\common\models\TourInfo::className(), ['id' => 'tour_info_id'])->viaTable('tour_info_has_tour_type_transport', ['tour_type_transport_id' => 'id']);
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
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\TourTypeTransportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TourTypeTransportQuery(get_called_class());
    }
}
