<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "sal_basket".
 *
 * @property integer $id
 * @property string $date
 * @property integer $userinfo_id
 * @property integer $tour_info_id
 * @property integer $hotels_info_id
 * @property integer $trans_info_id
 * @property double $price
 * @property integer $col_day
 * @property integer $col_person
 * @property integer $col_kids
 *
 * @property \common\models\HotelsInfo $hotelsInfo
 * @property \common\models\TourInfo $tourInfo
 * @property \common\models\TransInfo $transInfo
 * @property \common\models\Userinfo $userinfo
 * @property string $aliasModel
 */
abstract class SalBasket extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sal_basket';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural=false)
    {
        if($plural){
            return Yii::t('app', 'SalBaskets');
        }else{
            return Yii::t('app', 'SalBasket');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['userinfo_id', 'tour_info_id', 'hotels_info_id', 'trans_info_id'], 'required'],
            [['userinfo_id', 'tour_info_id', 'hotels_info_id', 'trans_info_id', 'col_day', 'col_person', 'col_kids'], 'integer'],
            [['price'], 'number'],
            [['hotels_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\TransInfo::className(), 'targetAttribute' => ['hotels_info_id' => 'id']],
            [['tour_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\TourInfo::className(), 'targetAttribute' => ['tour_info_id' => 'id']],
            [['trans_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\TourInfo::className(), 'targetAttribute' => ['trans_info_id' => 'id']],
            [['userinfo_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Userinfo::className(), 'targetAttribute' => ['userinfo_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'userinfo_id' => Yii::t('app', 'Userinfo ID'),
            'tour_info_id' => Yii::t('app', 'Tour Info ID'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'trans_info_id' => Yii::t('app', 'Trans Info ID'),
            'price' => Yii::t('app', 'Price'),
            'col_day' => Yii::t('app', 'Col Day'),
            'col_person' => Yii::t('app', 'Col Person'),
            'col_kids' => Yii::t('app', 'Col Kids'),
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
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'userinfo_id' => Yii::t('app', 'Userinfo Id'),
            'tour_info_id' => Yii::t('app', 'Tour Info Id'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info Id'),
            'trans_info_id' => Yii::t('app', 'Trans Info Id'),
            'price' => Yii::t('app', 'Price'),
            'col_day' => Yii::t('app', 'Col Day'),
            'col_person' => Yii::t('app', 'Col Person'),
            'col_kids' => Yii::t('app', 'Col Kids'),
            ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfo()
    {
        return $this->hasOne(\common\models\HotelsInfo::className(), ['id' => 'hotels_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourInfo()
    {
        return $this->hasOne(\common\models\TourInfo::className(), ['id' => 'tour_info_id']);
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
    public function getUserinfo()
    {
        return $this->hasOne(\common\models\Userinfo::className(), ['id' => 'userinfo_id']);
    }




}
