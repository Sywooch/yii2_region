<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "hotels_others_pricing_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_add
 * @property string $date_edit
 * @property integer $active
 * @property string $description
 *
 * @property \common\models\HotelsOthersPricing[] $hotelsOthersPricings
 * @property string $aliasModel
 */
abstract class HotelsOthersPricingType extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_others_pricing_type';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural=false)
    {
        if($plural){
            return Yii::t('app', 'HotelsOthersPricingTypes');
        }else{
            return Yii::t('app', 'HotelsOthersPricingType');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'description'], 'string'],
            [['date_add', 'date_edit'], 'safe'],
            [['active'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'active' => Yii::t('app', 'Active'),
            'description' => Yii::t('app', 'Description'),
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
            //'id' => Yii::t('app', 'Первичный ключ. Таблица-справочник хранит информацию о дополнительных ценах, применяемых к отелям (трансфер, доп. питание, экскурсии и т.д.).'),
            'name' => Yii::t('app', 'Название дополнительного типа цены (например: "Экскурсия")'),
            'date_add' => Yii::t('app', 'Дата добавления'),
            'date_edit' => Yii::t('app', 'Дата последнего изменения записи'),
            'active' => Yii::t('app', 'Признак активности записи'),
            'description' => Yii::t('app', 'Описание дополнительного типа цены'),
            ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsOthersPricings()
    {
        return $this->hasMany(\common\models\HotelsOthersPricing::className(), ['hotels_others_pricing_type_id' => 'id']);
    }




}
