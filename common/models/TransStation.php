<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "trans_station".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $gps_parallel
 * @property string $gps_meridian
 * @property integer $address_id
 * @property integer $trans_type_station_id
 *
 * @property TransRouteHasTransStation[] $transRouteHasTransStations
 * @property TransRoute[] $transRoutes
 * @property Region-travelTransTypeStation $transTypeStation
 */
class TransStation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_station';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'gps_parallel', 'gps_meridian'], 'string'],
            [['address_id', 'trans_type_station_id'], 'integer'],
            [['trans_type_station_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ.'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'gps_parallel' => Yii::t('app', 'Gps Parallel'),
            'gps_meridian' => Yii::t('app', 'Gps Meridian'),
            'address_id' => Yii::t('app', 'Address ID'),
            'trans_type_station_id' => Yii::t('app', 'Trans Type Station ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransRouteHasTransStations()
    {
        return $this->hasMany(TransRouteHasTransStation::className(), ['trans_station_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransRoutes()
    {
        return $this->hasMany(TransRoute::className(), ['id' => 'trans_route_id'])->viaTable('trans_route_has_trans_station', ['trans_station_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransTypeStation()
    {
        return $this->hasOne(TransTypeStation::className(), ['id' => 'trans_type_station_id']);
    }

    public static function listAll($keyField = 'id', $valueField = 'name', $asArray = true)
    {
        $query = static::find();
        if ($asArray) {
            $query->select([$keyField, $valueField])->asArray();
        }

        return ArrayHelper::map($query->all(), $keyField, $valueField);
    }

    /**
     * Получаем данные на основании связной таблицы
     * @param array $id
     * @param string $keyField
     * @param bool $asArray
     * @return array
     */
    public static function getTransStationRelationField($id = [],$keyField = 'name', $asArray = true)
    {
        $query = static::find()->innerJoin('trans_route_has_trans_station',
            'trans_route_has_trans_station.trans_station_id = trans_station.id')
            ->where(['trans_route_has_trans_station.trans_route_id' => $id]);
        return ArrayHelper::map($query->all(),'id',$keyField);
    }
}
