<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sal_order".
 *
 * @property integer $id
 * @property string $date
 * @property integer $sal_order_status_id
 * @property string $hotels_info
 * @property string $transport_info
 * @property string $persons
 * @property integer $child
 * @property string $date_begin
 * @property string $date_end
 * @property integer $enable
 * @property double $full_price
 * @property string $insurance_info
 * @property integer $hotels_info_id
 * @property integer $trans_info_id
 * @property integer $userinfo_id
 * @property integer $tour_info_id
 * @property integer $hotels_appartment_id
 * @property integer $hotels_appartment_hotels_info_id
 *
 * @property SalOrderStatus $salOrderStatus
 * @property HotelsAppartment $hotelsAppartment
 * @property HotelsInfo $hotelsInfo
 * @property TourInfo $tourInfo
 * @property TransInfo $transInfo
 * @property Userinfo $userinfo
 */
class SalOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sal_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'date_begin', 'date_end'], 'safe'],
            [['sal_order_status_id', 'hotels_info_id', 'trans_info_id', 'userinfo_id', 'tour_info_id', 'hotels_appartment_id', 'hotels_appartment_hotels_info_id'], 'required'],
            [['sal_order_status_id', 'child', 'enable', 'hotels_info_id', 'trans_info_id', 'userinfo_id', 'tour_info_id', 'hotels_appartment_id', 'hotels_appartment_hotels_info_id'], 'integer'],
            [['full_price'], 'number'],
            [['insurance_info'], 'string'],
            [['hotels_info', 'transport_info', 'persons'], 'string', 'max' => 45],
            [['sal_order_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalOrderStatus::className(), 'targetAttribute' => ['sal_order_status_id' => 'id']],
            [['hotels_appartment_id', 'hotels_appartment_hotels_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => HotelsAppartment::className(), 'targetAttribute' => ['hotels_appartment_id' => 'id', 'hotels_appartment_hotels_info_id' => 'hotels_info_id']],
            [['hotels_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => HotelsInfo::className(), 'targetAttribute' => ['hotels_info_id' => 'id']],
            [['tour_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => TourInfo::className(), 'targetAttribute' => ['tour_info_id' => 'id']],
            [['trans_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransInfo::className(), 'targetAttribute' => ['trans_info_id' => 'id']],
            [['userinfo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Userinfo::className(), 'targetAttribute' => ['userinfo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Таблица содержит полную информацию о заказе. Таблица декомпозирована.'),
            'date' => Yii::t('app', 'Дата создания заказа'),
            'sal_order_status_id' => Yii::t('app', 'Статус заказа.'),
            'hotels_info' => Yii::t('app', 'Информация об отеле'),
            'transport_info' => Yii::t('app', 'Информация о транспорте.'),
            'persons' => Yii::t('app', 'Информация о людях, которые отправляются в тур.'),
            'child' => Yii::t('app', 'количество детей'),
            'date_begin' => Yii::t('app', 'Дата начала тура'),
            'date_end' => Yii::t('app', 'Дата окончания тура'),
            'enable' => Yii::t('app', 'Признак того, что заказ закрыт и его невозможно отредактировать.'),
            'full_price' => Yii::t('app', 'Полная цена тура.'),
            'insurance_info' => Yii::t('app', 'Информация о страховке и страховой компании.'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'trans_info_id' => Yii::t('app', 'Trans Info ID'),
            'userinfo_id' => Yii::t('app', 'Userinfo ID'),
            'tour_info_id' => Yii::t('app', 'Tour Info ID'),
            'hotels_appartment_id' => Yii::t('app', 'Hotels Appartment ID'),
            'hotels_appartment_hotels_info_id' => Yii::t('app', 'Hotels Appartment Hotels Info ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrderStatus()
    {
        return $this->hasOne(SalOrderStatus::className(), ['id' => 'sal_order_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsAppartment()
    {
        return $this->hasOne(HotelsAppartment::className(), ['id' => 'hotels_appartment_id', 'hotels_info_id' => 'hotels_appartment_hotels_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfo()
    {
        return $this->hasOne(HotelsInfo::className(), ['id' => 'hotels_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourInfo()
    {
        return $this->hasOne(TourInfo::className(), ['id' => 'tour_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransInfo()
    {
        return $this->hasOne(TransInfo::className(), ['id' => 'trans_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserinfo()
    {
        return $this->hasOne(Userinfo::className(), ['id' => 'userinfo_id']);
    }

    /**
     * @inheritdoc
     * @return SalOrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SalOrderQuery(get_called_class());
    }
}
