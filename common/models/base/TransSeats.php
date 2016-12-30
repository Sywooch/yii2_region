<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "trans_seats".
 *
 * @property integer $id
 * @property integer $trans_info_id
 * @property integer $trans_seats_type_id
 * @property string $name
 * @property integer $count
 * @property integer $active
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\TransPrice[] $transPrices
 * @property \common\models\TransInfo $transInfo
 * @property \common\models\TransSeatsType $transSeatsType
 */
class TransSeats extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trans_info_id', 'trans_seats_type_id', 'name'], 'required'],
            [['trans_info_id', 'trans_seats_type_id', 'count', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['date_add', 'date_edit'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_seats';
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */
    public function optimisticLock()
    {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ'),
            'trans_info_id' => Yii::t('app', 'Транспорт'),
            'trans_seats_type_id' => Yii::t('app', 'Тип места'),
            'name' => Yii::t('app', 'Наименование схемы (номер вагона или прочее)'),
            'count' => Yii::t('app', 'Количество мест в данной схеме'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Когда создана запись'),
            'date_edit' => Yii::t('app', 'Когда обновлена запись'),
            'lock' => Yii::t('app', 'Оптимистическая блокировка'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransPrices()
    {
        return $this->hasMany(\common\models\TransPrice::className(), ['trans_seats_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransInfo()
    {
        return $this->hasOne(\common\models\TransInfo::className(), ['id' => 'trans_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransSeatsType()
    {
        return $this->hasOne(\common\models\TransSeatsType::className(), ['id' => 'trans_seats_type_id']);
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
     * @return \common\models\TransSeatsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TransSeatsQuery(get_called_class());
    }
}
