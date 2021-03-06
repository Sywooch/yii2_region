<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use common\models\TourInfo;
use Yii;

/**
 * This is the base-model class for table "hotels_info_has_tour_info".
 *
 * @property integer $hotels_info_id
 * @property integer $tour_info_id
 *
 * @property \common\models\HotelsInfo $hotelsInfo
 * @property \common\models\TourInfo $tourInfo
 * @property string $aliasModel
 */
abstract class HotelsInfoHasTourInfo extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_info_has_tour_info';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural=false)
    {
        if($plural){
            return Yii::t('app', 'HotelsInfoHasTourInfos');
        }else{
            return Yii::t('app', 'HotelsInfoHasTourInfo');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotels_info_id', 'tour_info_id'], 'required'],
            [['hotels_info_id', 'tour_info_id'], 'integer'],
            [['hotels_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => HotelsInfo::className(), 'targetAttribute' => ['hotels_info_id' => 'id']],
            [['tour_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => TourInfo::className(), 'targetAttribute' => ['tour_info_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'tour_info_id' => Yii::t('app', 'Tour Info ID'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(),
            [
            'hotels_info_id' => Yii::t('app', 'Hotels Info Id'),
            'tour_info_id' => Yii::t('app', 'Tour Info Id'),
            ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfo()
    {
        return $this->hasOne(\common\models\HotelsInfo::className(), ['id' => 'hotels_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourInfo()
    {
        return $this->hasOne(\common\models\TourInfo::className(), ['id' => 'tour_info_id']);
    }




}
