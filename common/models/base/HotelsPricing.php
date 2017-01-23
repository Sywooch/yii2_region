<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "hotels_pricing".
 *
 * @property integer $id
 * @property integer $hotels_appartment_id
 * @property integer $hotels_info_id
 * @property integer $hotels_type_of_food_id
 * @property string $name
 * @property integer $active
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\HotelsPayPeriod[] $hotelsPayPeriods
 * @property \common\models\HotelsAppartment $hotelsAppartment
 * @property \common\models\HotelsInfo $hotelsInfo
 * @property \common\models\HotelsTypeOfFood $hotelsTypeOfFood
 */
class HotelsPricing extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    public $country;

    const SAL_ORDER_COUNT_PEOPLE = 1;
    const CHECKOUT_TIME = "12:00";

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotels_appartment_id', 'hotels_info_id', 'hotels_type_of_food_id', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['name'], 'string'],
            [['date_add', 'date_edit'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_pricing';
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
            'id' => Yii::t('app', 'Первичный ключ. В таблице должно содержаться цены на проживание в гостиницах. Цена будет зависеть от характеристик номера и гостиницы'),
            'hotels_appartment_id' => Yii::t('app', 'Hotels Appartment ID'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'hotels_type_of_food_id' => Yii::t('app', 'Hotels Type Of Food ID'),
            'name' => Yii::t('app', 'Name'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'country' => Yii::t('app', 'Country'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsPayPeriods()
    {
        return $this->hasMany(\common\models\HotelsPayPeriod::className(), ['hotels_pricing_id' => 'id'])->inverseOf('hotelsPricing');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsAppartment()
    {
        return $this->hasOne(\common\models\HotelsAppartment::className(), ['id' => 'hotels_appartment_id', 'hotels_info_id' => 'hotels_info_id'])->inverseOf('hotelsPricings');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfo()
    {
        return $this->hasOne(\common\models\HotelsInfo::className(), ['id' => 'hotels_info_id'])->inverseOf('hotelsPricings');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsTypeOfFood()
    {
        return $this->hasOne(\common\models\HotelsTypeOfFood::className(), ['id' => 'hotels_type_of_food_id'])->inverseOf('hotelsPricings');
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
     * @return \common\models\HotelsPricingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\HotelsPricingQuery(get_called_class());
    }


    public function getCountry()
    {
        $model = $this->getHotelsInfo();
        if ($model->one() != null) {
            $this->country = $model->one()->country;
            return \common\models\Country::findOne(['id' => $this->country]);
        } else {
            return false;
        }
    }

    public function getHotelsByCountry($idCountry)
    {
        $model = new \common\models\HotelsInfo();
        //$model->find()->andFilterWhere(['country'=>$idCountry]);
        return $model->findAll(['country' => $idCountry]);
    }

    /**
     * Функция расчитывает сумму проживания в номере в зависимости от периодичности цен
     *
     * @param $appartmentId - ИД номера в отеле
     * @param $dayBegin - дата заезда в отель
     * @param $dayEnd - дата отъезда из отеля
     * @param $typeOfFood - тип питания
     * @param $countTourist - количество туристов
     * @return int - финальная сумма за проживание
     */
    public static function calculatedAppartmentPrice($appartmentId, $dayBegin, $dayEnd, $typeOfFood, $countTourist = \common\models\HotelsPricing::SAL_ORDER_COUNT_PEOPLE, $countChild = 0)
    {
        //TODO Уточнить правила формирования платы, сколько дней, ночей и т.п.
        //TODO Добавить правило подсчета количества туристов и разбиения большего количества туристов на номера.
        $query = self::find();
        //Переводим даты из строкового формата
        $newDateBegin = new \DateTime($dayBegin);
        $newDateEnd = new \DateTime($dayEnd);
        //Получение данных о цене
        $query/*->select('hpp.price, hpp.date_begin, hpp.date_end')*/
            ->innerJoin('hotels_pay_period hpp', 'hpp.hotels_pricing_id = hotels_pricing.id')
            ->andWhere([
                'hotels_appartment_id' => $appartmentId,
                'hotels_type_of_food_id' => $typeOfFood,
            ])
            ->andWhere("((`hpp`.`date_begin` <= \"$dayBegin\") AND (`hpp`.`date_end` >= \"$dayBegin\") )
    OR ((`hpp`.`date_begin` <= \"$dayEnd\")AND(`hpp`.`date_end` >= \"$dayEnd\"))");
        $result = $query->asArray()->all();
        //Расчет окончательной цены за проживание
        ///Проверяем находится ли период заезда в одном диапазоне цен
        $dayRange = 0; //Количество ночей

        $countDay = 0;
        $finalPrice = 0;
        //Расчитваем фактическое количество (да, дробное, зависит от детей) туристов
        $percent = \common\models\Discount::findOne(['id' => 1])->discount;
        if ((isset($countChild) && ($countChild != 0)) & (isset($countTourist) & ($countTourist > 0))) {

            $countTourist = $countTourist - $countChild * ($percent / 100);
        } elseif (isset($countChild) && ($countChild != 0)) {
            $countTourist = $countChild - $countChild * ($percent / 100);
        } elseif (!isset($countTourist) && !($countTourist > 0)) {
            return false;
        }

        if (count($result) > 1) {
            foreach ($result as $key => $value) {
                $dbDateBegin = new \DateTime($value['date_begin'] . \common\models\HotelsPricing::CHECKOUT_TIME);
                $dbDateEnd = new \DateTime($value['date_end'] . \common\models\HotelsPricing::CHECKOUT_TIME);
                if ($dbDateBegin <= $newDateBegin) {
                    $dayRange = $dbDateEnd->diff($newDateBegin)->days;
                    $countDay += $dayRange;
                    $finalPrice += $value['price'] * $dayRange * $countTourist;
                } elseif (($dbDateBegin < $newDateEnd) & ($dbDateEnd < $newDateEnd)) {
                    $dayRange = $dbDateEnd->diff($dbDateBegin)->days;
                    $countDay += $dayRange;
                    $finalPrice += $value['price'] * $dayRange * $countTourist;
                } elseif ($dbDateEnd >= $newDateEnd) {
                    $dayRange = $dbDateBegin->diff($newDateEnd)->days;
                    $countDay += $dayRange;
                    $finalPrice += $value['price'] * $dayRange * $countTourist;
                }
            }
        } elseif (count($result) == 1) {
            $dayRange = $newDateBegin->diff($newDateEnd)->days;
            $countDay = $dayRange;
            $finalPrice = $result[0]['price'] * $dayRange * $countTourist;
        }

        return $finalPrice;
    }
}
