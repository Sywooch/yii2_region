<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tour_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_begin
 * @property string $date_end
 * @property integer $days
 * @property integer $tour_type_id
 * @property integer $toury_type_transport_id
 * @property integer $active
 */
class TourInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'tour_type_id', 'toury_type_transport_id'], 'required'],
            [['name'], 'string'],
            [['date_begin', 'date_end'], 'safe'],
            [['days', 'tour_type_id', 'toury_type_transport_id', 'active'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Сводная информация о туре.'),
            'name' => Yii::t('app', 'Name'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'days' => Yii::t('app', 'Количество дней тура'),
            'tour_type_id' => Yii::t('app', 'Tour Type ID'),
            'toury_type_transport_id' => Yii::t('app', 'Toury Type Transport ID'),
            'active' => Yii::t('app', 'Признак активности тура'),
        ];
    }

    /**
     * @inheritdoc
     * @return TourInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TourInfoQuery(get_called_class());
    }
}
