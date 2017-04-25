<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "kurs_currency".
 *
 * @property integer $id
 * @property integer $kurs_type_currency_id
 * @property string $date_add
 * @property double $okurs
 * @property double $skurs
 * @property double $percent
 * @property integer $active
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \common\models\KursTypeCurrency $kursTypeCurrency
 */
class KursCurrency extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kurs_type_currency_id', 'active', 'created_by', 'updated_by'], 'integer'],
            [['date_add', 'date_edit','date'], 'safe'],
            [['okurs', 'skurs', 'percent'], 'number'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kurs_currency';
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
            'kurs_type_currency_id' => Yii::t('app', 'Kurs Type Currency ID'),
            'date' => Yii::t('app', 'Date Kurs'),
            'date_add' => Yii::t('app', 'Date Add'),
            'okurs' => Yii::t('app', 'Okurs'),
            'skurs' => Yii::t('app', 'Skurs'),
            'percent' => Yii::t('app', 'Внутренний курс'),
            'active' => Yii::t('app', 'Active'),
            'date_edit' => Yii::t('app', 'Date Edit'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKursTypeCurrency()
    {
        return $this->hasOne(\common\models\KursTypeCurrency::className(), ['id' => 'kurs_type_currency_id']);
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
     * @return \common\models\KursCurrencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\KursCurrencyQuery(get_called_class());
    }

    /**/
    public function saveCurrency($kursTypeCurrencyId){
        //устанавливаем все поля active для текущей валюты равными 0
        \common\models\KursCurrency::updateAll(['active'=>0],[
            'kurs_type_currency_id' => $kursTypeCurrencyId,
            'active'=>1
            ]);
        if (!$this->saveAll()){
            return false;
        }
        return true;
    }


    /**Функция получения данных у банка*/
    private function CurrentCurrency($ncode, $date = 'current')
    {
        /*Получаем текущий курс*/
        if ($date === 'current') {
            $date = date('d/m/Y');
        }
        $link = "http://www.cbr.ru/scripts/XML_daily.asp"; // Ссылка на XML-файл с курсами валют
        $uri = "?date_req=$date";
        //Если есть известен внутренний код валюты (в системе ЦБ РФ)
        //Получаем прямой запрос
        $xml = simplexml_load_file($link.$uri);
        //TODO Получить список валют, необходимых для обновления
        //$ncode = ["840","978"];
        //Получаем курсы
        $upload = false;
        $aCurrency = array();
        foreach ($xml as $k){
            //Разбираем каждую валюту
            $container = (array)$k;
            if (in_array($container['NumCode'], $ncode)){
                //Записать значение в базу данных
                //echo 'Курс валюты "' . $container['Name'] . '" = ' . $container['Value'] . '<br />';
                $aCurrency[$container['NumCode']] = str_replace(',','.',$container['Value']);
                $upload = true;
                //Останавливаем поиск, так как уже все необходимое найдено
                //break;
            }
        }
        return $aCurrency;
    }

    /**
     * Получить курсы валют, необходимые для обновления
     */
    public function CurrencyUpdated(){
        //Получаем все валюты
        $currencyOld = \common\models\KursTypeCurrency::find()->active()->asArray()->all();
        $ncode = array();
        foreach ($currencyOld as $currencyOne){
            //Формируем массив валют
            $ncode[$currencyOne['id']] = $currencyOne['ncode'];
        }
        //Обновляем все курсы валют
        $aCurrency = $this->CurrentCurrency($ncode);
        //Пересчитываем процент и сохраняем обновленные курсы валют
        $error = false;
        foreach ($aCurrency as $key => $value){
            if (!$this->CurrencyAdd(array_search($key,$ncode), $value)){
                $error = true;
            }
        }
        return !$error;
    }

    /**
     * Записать обновленные списки валют в БД
     * @param $kursTypeCurrencyId
     * @param $value
     * @return bool
     */
    private function CurrencyAdd($kursTypeCurrencyId, $value){
        //Получаем процент, на который надо увеличить текущий курс
        $percent = $this->getKursPercentValue();
        $cur = new \common\models\KursCurrency();
        $cur->kurs_type_currency_id = $kursTypeCurrencyId;
        $cur->date = date('Y-m-d');
        $cur->okurs = (float)$value;
        //Увеличиваем собственный курс на наше значение
        $cur->skurs = (float)$value+$percent;
        $cur->percent = $percent;
        $cur->active = 1;
        //j
        if (!$cur->saveCurrency($kursTypeCurrencyId)){
            Yii::error('Ошибка сохранения валюты');
            return false;
        }
        unset($cur);
        return true;
    }

    /**
     * Получаем процент, на который увеличиваем официальный курс валюты ЦБ РФ
     * @return float
     */
    private function getKursPercentValue(){
        $model = \common\models\KursPercent::find()->orderBy('id desc')->one();
        return (float)$model->percent;
    }

    public function getActiveCurrency(){

    }



}
