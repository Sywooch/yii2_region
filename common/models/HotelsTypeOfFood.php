<?php

namespace common\models;

use common\models\base\HotelsTypeOfFood as BaseHotelsTypeOfFood;
use Yii;

/**
 * This is the model class for table "hotels_type_of_food".
 */
class HotelsTypeOfFood extends BaseHotelsTypeOfFood
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
            [['name', 'abbrev'], 'required'],
            [['name'], 'string'],
            [['price'], 'number'],
            [['type_price'], 'integer'],
                [['abbrev'], 'string', 'max' => 10],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'abbrev' => Yii::t('app', 'Abbrev'),
            'price' => Yii::t('app', 'Price'),
            'type_price' => Yii::t('app', 'Type Price'),
        ];
    }
}
