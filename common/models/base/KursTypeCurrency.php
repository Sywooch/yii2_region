<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "kurs_type_currency".
 *
 * @property integer $id
 * @property string $name
 * @property integer $ncode
 * @property string $tcode
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $active
 * @property integer $lock
 *
 * @property \common\models\KursCurrency[] $kursCurrencies
 */
class KursTypeCurrency extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ncode', 'created_by', 'updated_by', 'active', 'lock'], 'integer'],
            [['date_add', 'date_edit'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['tcode'], 'string', 'max' => 10],
            [['ncode'], 'unique'],
            [['tcode'], 'unique'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kurs_type_currency';
    }

    /**
     * 
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock 
     * 
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'ncode' => Yii::t('app', 'Ncode'),
            'tcode' => Yii::t('app', 'Tcode'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'active' => Yii::t('app', 'Active'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKursCurrencies()
    {
        return $this->hasMany(\common\models\KursCurrency::className(), ['kurs_type_currency_id' => 'id']);
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
     * @return \common\models\KursTypeCurrencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\KursTypeCurrencyQuery(get_called_class());
    }
}
