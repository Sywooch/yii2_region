<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use common\models\TransRouteQuery;
use Yii;

/**
 * This is the base-model class for table "trans_route".
 *
 * @property integer $id
 * @property string $date_begin
 * @property string $date_end
 * @property integer $active
 * @property string $begin_point
 * @property string $end_point
 *
 * @property \common\models\TransInfo[] $transInfos
 * @property \common\models\TransRouteHasTransStation[] $transRouteHasTransStations
 * @property \common\models\TransStation[] $transStations
 * @property string $aliasModel
 */
abstract class TransRoute extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_route';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_begin', 'date_end'], 'safe'],
            ['date_end', 'compare', 'compareAttribute'=>'date_begin', 'operator' => '>'],
            [['active'], 'integer'],
            [['begin_point', 'end_point'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'active' => Yii::t('app', 'Active'),
            'begin_point' => Yii::t('app', 'Begin Point'),
            'end_point' => Yii::t('app', 'End Point'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'active' => Yii::t('app', 'Active'),
            'begin_point' => Yii::t('app', 'Begin Point'),
            'end_point' => Yii::t('app', 'End Point'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransInfos()
    {
        return $this->hasMany(\common\models\TransInfo::className(), ['trans_route_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransRouteHasTransStations()
    {
        return $this->hasMany(\common\models\TransRouteHasTransStation::className(), ['trans_route_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransStations()
    {
        return $this->hasMany(\common\models\TransStation::className(), ['id' => 'trans_station_id'])->viaTable('trans_route_has_trans_station', ['trans_route_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\TransRouteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransRouteQuery(get_called_class());
    }


}
