<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "organization".
 *
 * @property integer $id
 * @property string $name
 * @property string $fullname
 * @property integer $inn
 * @property integer $kpp
 * @property integer $ogrn
 * @property integer $bik
 * @property string $bankname
 * @property string $rs
 * @property string $ks
 * @property string $direktor_fio
 * @property string $direktor_dolgnost
 * @property string $glbuh_fio
 * @property string $glbuh_dolgnost
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 * @property integer $active
 * @property string $phone
 * @property string $phone2
 * @property integer $early_day
 */
class Organization extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['fullname', 'phone2'], 'string'],
            [['inn', 'kpp', 'ogrn', 'bik', 'created_by', 'updated_by',
                'lock', 'active', 'early_day'], 'integer'],
            [['date_add', 'date_edit'], 'safe'],
            [['name', 'direktor_fio', 'direktor_dolgnost', 'glbuh_fio', 'glbuh_dolgnost'], 'string', 'max' => 100],
            [['bankname'], 'string', 'max' => 150],
            [['rs', 'ks'], 'string', 'max' => 20],
            [['phone'], 'string', 'max' => 25],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization';
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
            'fullname' => Yii::t('app', 'Fullname'),
            'inn' => Yii::t('app', 'Inn'),
            'kpp' => Yii::t('app', 'Kpp'),
            'ogrn' => Yii::t('app', 'Ogrn'),
            'bik' => Yii::t('app', 'Bik'),
            'bankname' => Yii::t('app', 'Bankname'),
            'rs' => Yii::t('app', 'Rs'),
            'ks' => Yii::t('app', 'Ks'),
            'direktor_fio' => Yii::t('app', 'Direktor Fio'),
            'direktor_dolgnost' => Yii::t('app', 'Direktor Dolgnost'),
            'glbuh_fio' => Yii::t('app', 'Glbuh Fio'),
            'glbuh_dolgnost' => Yii::t('app', 'Glbuh Dolgnost'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
            'active' => Yii::t('app', 'Active'),
            'phone' => Yii::t('app', 'Phone'),
            'phone2' => Yii::t('app', 'Phone2'),
            'early_day' => Yii::t('app', 'Early Day'),
        ];
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
     * @return \common\models\OrganizationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\OrganizationQuery(get_called_class());
    }
}