<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hotels_stars".
 *
 * @property integer $id
 * @property string $name
 * @property integer $count_stars
 *
 * @property HotelsInfo[] $hotelsInfos
 */
class HotelsStars extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_stars';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'count_stars'], 'required'],
            [['name'], 'string'],
            [['count_stars'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'count_stars' => Yii::t('app', 'Count Stars'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfos()
    {
        return $this->hasMany(HotelsInfo::className(), ['hotels_stars_id' => 'id']);
    }
}
