<?php

namespace common\models\base;

use common\models\TransPrice;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "trans_reservation".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_begin
 * @property string $date_end
 * @property integer $number_seats
 * @property integer $price
 * @property integer $person_id
 * @property integer $status
 * @property integer $trans_price_id
 * @property integer $active
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\Person $person
 * @property \common\models\TransPrice $transPrice
 */
class TransReservation extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'trans_price_id'], 'required'],
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            [['number_seats', 'price', 'person_id', 'status', 'trans_price_id', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_reservation';
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
            'id' => Yii::t('app', 'Первичный ключ. Таблица содержит информацию о резервации посадочных мест в транспорте.'),
            'name' => Yii::t('app', 'Название'),
            'date_begin' => Yii::t('app', 'Дата начала резервирования (время отъезда).'),
            'date_end' => Yii::t('app', 'Дата окончания резервирования (время приезда).'),
            'number_seats' => Yii::t('app', 'Номер бронируемого места'),
            'price' => Yii::t('app', 'Цена резерва'),
            'person_id' => Yii::t('app', 'Информация о пассажире'),
            'status' => Yii::t('app', 'Статус резервации'),
            'trans_price_id' => Yii::t('app', '			'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Дата добавления резерва'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(\common\models\Person::className(), ['id' => 'person_id'])->inverseOf('transReservations');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransPrice()
    {
        return $this->hasOne(\common\models\TransPrice::className(), ['id' => 'trans_price_id'])->inverseOf('transReservations');
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
     * @return \common\models\TransReservationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TransReservationQuery(get_called_class());
    }

    /**
     * Функция возвращает количество свободных мест на конкретном маршруте
     * @param $transPrice - идентификатор путевого листа
     * @param $date - дата, на которую проверяется наличие мест
     * @return int - количество свободных мест
     */
    public static function getCountFreeSeats($transPrice)
    {

        $model = new \common\models\TransReservation();
        $count = $model::find()->andFilterWhere(['trans_price_id' => $transPrice])
            ->active()->count();

        $query = TransPrice::findOne($transPrice);

        $info = $query->getTransSeats()->all()[0]->count;

        $count = $info - $count;

        return $count;
    }

    public static function getMaxNumberSeats($transPriceId)
    {
        return \common\models\TransReservation::find()
            ->andFilterWhere(['trans_price_id', $transPriceId])
            ->select('number_seats')
            ->max();
    }


}
