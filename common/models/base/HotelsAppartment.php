<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "hotels_appartment".
 *
 * @property integer $id
 * @property integer $hotels_info_id
 * @property string $name
 * @property double $price
 * @property integer $hotels_appartment_item_id
 * @property string $date_add
 * @property string $date_edit
 * @property integer $active
 * @property integer $count_rooms
 * @property integer $count_beds
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\HotelsAppartmentItem $hotelsAppartmentItem
 * @property \common\models\HotelsInfo $hotelsInfo
 * @property \common\models\HotelsAppartmentHasHotelsTypeOfFood[] $hotelsAppartmentHasHotelsTypeOfFoods
 * @property \common\models\HotelsPricing[] $hotelsPricings
 * @property \common\models\SalOrder[] $salOrders
 */
class HotelsAppartment extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    public $country;
    const IMAGE_PATH = '/uploads/images/';

    protected $imageFullPath;
    public $imageFiles;
    public $delImages;
    public $mainImage;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotels_info_id', 'hotels_appartment_item_id'], 'required'],
            [['hotels_info_id', 'hotels_appartment_item_id', 'active', 'count_rooms', 'count_beds', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['name'], 'string'],
            [['price'], 'number'],
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
        return 'hotels_appartment';
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
            'id' => Yii::t('app', 'ID'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'hotels_appartment_item_id' => Yii::t('app', 'Hotels Appartment Item ID'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'active' => Yii::t('app', 'Active'),
            'count_rooms' => Yii::t('app', 'Количество комнат'),
            'count_beds' => Yii::t('app', 'Фактическое количество мест'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsAppartmentItem()
    {
        return $this->hasOne(\common\models\HotelsAppartmentItem::className(), ['id' => 'hotels_appartment_item_id'])->inverseOf('hotelsAppartments');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfo()
    {
        return $this->hasOne(\common\models\HotelsInfo::className(), ['id' => 'hotels_info_id'])->inverseOf('hotelsAppartments');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsAppartmentHasHotelsTypeOfFoods()
    {
        return $this->hasMany(\common\models\HotelsAppartmentHasHotelsTypeOfFood::className(), ['id' => 'id', 'hotels_info_id' => 'hotels_info_id'])->inverseOf('id0');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsPricings()
    {
        return $this->hasMany(\common\models\HotelsPricing::className(), ['hotels_appartment_id' => 'id', 'hotels_info_id' => 'hotels_info_id'])->inverseOf('hotelsAppartment');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrders()
    {
        return $this->hasMany(\common\models\SalOrder::className(), ['hotels_appartment_id' => 'id'])->inverseOf('hotelsAppartment');
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
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\HotelsAppartmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\HotelsAppartmentQuery(get_called_class());
    }

    public function getCountry()
    {
        $model = $this->getHotelsInfo();
        if ($model->one() != null){
            $this->country = $model->one()->country;
            return \common\models\Country::findOne(['id' => $this->country]);
        }
        else{
            return false;
        }
    }

    /**
     * @return string
     */
    public function getHotelsByCountry($idCountry)
    {
        $model = new \common\models\HotelsInfo();
        //$model->find()->andFilterWhere(['country'=>$idCountry]);
        return $model->findAll(['country'=>$idCountry]);
    }

    public function upload(){

        if ($this->validate('imageFiles')){
            foreach($this->imageFiles as $file){
                $filename = uniqid() . '.' . $file->extension;
                $this->imageFullPath= \Yii::$app->getBasePath() . '/web/uploads/images/' . $filename;
                $file->saveAs($this->imageFullPath);
                $this->attachImage($this->imageFullPath);
            }
            return true;
        }
        else{
            return false;
        }
    }

    public function getMinPrice($hotels_id){

    }

    public function getImage2amigos($modelViews=false){
        $items = array();
        $imageFiles = $this->getImages();
        foreach ($imageFiles as $image){
            if ($modelViews){
                $items[] = [
                    'url' => $image->getUrl(),
                    'src' => $image->getUrl('120px'),
                    'options' => ['title' => Yii::t('app', 'Photo hotels') . ' ' . $this->name],
                ];
            }
            else{
                $items[] = [
                    'url' => $image->getUrl(),
                    'src' => $image->getUrl('120px'),
                    'options' => ['title' => Yii::t('app', 'Photo hotels') . ' ' . $this->name],
                    'id'=>$image->urlAlias,
                    'main' => $image->isMain,
                ];
            }

        }
        return $items;
    }

    /**
     * Функция удаляет картинки по ее urlAlais
     * @param array $imageAlias
     * @return bool
     */
    public function imageDelete($imageAlias = array()){
        //Получаем отмеченные изображения
        try {
            if (is_array($imageAlias) && count($imageAlias) > 0) {
                foreach ($imageAlias as $idImage) {
                    $image = $this->getImageByField('urlAlias', $idImage);
                    $this->removeImage($image);
                }
                return true;
            } else {
                return false;
            }
        }
        catch (\Exception $e){
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $this->addError('_exception', $msg);
        }
    }


    //Резервация и проверка номеров (комнат)
    public function countFreeRoom($dateBegin, $dateEnd)
    {
        $rooms = $this->count_rooms;
        $countRoomSale = $this->getSalOrders()->
        andWhere(["<", 'date_end', $dateEnd])->count();
        return ($rooms - $countRoomSale);
    }
}
