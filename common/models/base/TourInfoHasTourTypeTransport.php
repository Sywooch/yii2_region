<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "tour_info_has_tour_type_transport".
 *
 * @property integer $tour_info_id
 * @property integer $tour_type_transport_id
 *
 * @property \common\models\TourInfo $tourInfo
 * @property \common\models\TourTypeTransport $tourTypeTransport
 * @property string $aliasModel
 */
abstract class TourInfoHasTourTypeTransport extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour_info_has_tour_type_transport';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tour_info_id', 'tour_type_transport_id'], 'required'],
            [['tour_info_id', 'tour_type_transport_id'], 'integer'],
            [['tour_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\TourInfo::className(), 'targetAttribute' => ['tour_info_id' => 'id']],
            [['tour_type_transport_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\TourTypeTransport::className(), 'targetAttribute' => ['tour_type_transport_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tour_info_id' => Yii::t('app', 'Tour Info ID'),
            'tour_type_transport_id' => Yii::t('app', 'Tour Type Transport ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourInfo()
    {
        return $this->hasOne(\common\models\TourInfo::className(), ['id' => 'tour_info_id'])->inverseOf('tourInfoHasTourTypeTransports');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourTypeTransport()
    {
        return $this->hasOne(\common\models\TourTypeTransport::className(), ['id' => 'tour_type_transport_id'])->inverseOf('tourInfoHasTourTypeTransports');
    }


    
    /**
     * @inheritdoc
     * @return TourInfoHasTourTypeTransportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TourInfoHasTourTypeTransportQuery(get_called_class());
    }


}
