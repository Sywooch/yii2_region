<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 03.08.16
 * Time: 18:29
 */

namespace frontend\components\lk\models;

use common\models\SalOrder;
use Yii;
use yii\db\ActiveRecord;

class Reservation extends ActiveRecord
{
    public $country_id;
    public $sal_order_status_id;
    public $city_id;
    public $hotels_info_id;
    public $stars_id;
    public $hotels_appartment_id;
    public $trans_info_id;
    public $userinfo_id;
    public $tour_info_id;
    public $date_begin;
    public $date_end;
    public $from_site;
    public $date_range;

    public static function tableName()
    {
        return '{{%sal_order}}';
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'sal_order_status_id' => Yii::t('app', 'Sal Order Status ID'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'enable' => Yii::t('app', 'Enable'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'hotels_appartment_id' => Yii::t('app', 'Hotels Appartment ID'),
            'trans_info_id' => Yii::t('app', 'Trans Info ID'),
            'userinfo_id' => Yii::t('app', 'Userinfo ID'),
            'tour_info_id' => Yii::t('app', 'Tour Info ID'),
            'full_price' => Yii::t('app', 'Full Price'),
            'insurance_info' => Yii::t('app', 'Insurance Info'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    public function rules()
    {
        return
            [
                [['country_id', 'sal_order_status_id', 'city_id', 'hotels_info_id', 'stars_id',
                    'hotels_appartment_id', 'trans_info_id', 'userinfo_id', 'tour_info_id'], 'integer'],
                [['date_begin', 'date_end'], 'date', 'format' => 'php:d-m-Y'],
                [['from_site'], 'boolean'],
            ];
    }

    public function processChooseTour()
    {
        $model = new Reservation();
        //$model->getSalOrder();
        return $model;
    }

    public function getSalOrder()
    {
        return $this->hasMany(SalOrder::className(), ['id' => 'sal_order_id']);
    }

}