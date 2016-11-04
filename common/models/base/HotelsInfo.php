<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use common\models\HotelsStars;
use Yii;

/**
 * This is the base-model class for table "hotels_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property integer $country
 * @property string $GPS
 * @property string $links_maps
 * @property integer $hotels_stars_id
 * @property string $image
 *
 * @property \common\models\Discount[] $discounts
 * @property \common\models\HotelsAppartment[] $hotelsAppartments
 * @property \common\models\HotelsCharacter[] $hotelsCharacters
 * @property \common\models\HotelsStars $hotelsStars
 * @property \common\models\HotelsInfoHasTourInfo[] $hotelsInfoHasTourInfos
 * @property \common\models\TourInfo[] $tourInfos
 * @property \common\models\HotelsOthersPricing[] $hotelsOthersPricings
 * @property \common\models\SalBasket[] $salBaskets
 * @property \common\models\SalOrder[] $salOrders
 * @property \common\models\City[] $city
 * @property string $aliasModel
 */
abstract class HotelsInfo extends \yii\db\ActiveRecord
{

    const IMAGE_PATH = '/uploads/images/hotels/';

    protected $imageFullPath;
    public $imageFiles;
    public $delImages;
    public $mainImage;
    public $hotels_character_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_info';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural=false)
    {
        if($plural){
            return Yii::t('app', 'HotelsInfos');
        }else{
            return Yii::t('app', 'HotelsInfo');
        }
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address','city_id'], 'required'],
            [['name', 'address', 'description', 'gps_point_m', 'gps_point_p', 'links_maps'], 'string'],
            [['country', 'hotels_stars_id','city_id', 'period_day'], 'integer'],
            [['imageFiles'], 'file', 'extensions' => 'png, jpg, gif', 'maxFiles' => 12],
            [['hotels_stars_id'], 'exist', 'skipOnError' => true, 'targetClass' => HotelsStars::className(), 'targetAttribute' => ['hotels_stars_id' => 'id']],
            [['delImages','mainImage','active', 'top'],'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'city_id' => Yii::t('app','City'),
            'address' => Yii::t('app', 'Address'),
            'country' => Yii::t('app', 'Country'),
            'gps_point_m' => Yii::t('app', 'GPS-координаты меридиана.'),
            'gps_point_p' => Yii::t('app', 'GPS-координаты паралели.'),
            'links_maps' => Yii::t('app', 'Links Maps'),
            'hotels_stars_id' => Yii::t('app', 'Hotels Stars ID'),
            'imageFiles' => Yii::t('app', 'Image Files'),
            'active' => Yii::t('app','Active'),
            'top' => Yii::t('app','inMain' ),
            'period_day' => Yii::t('app', 'Day Period'),
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
                //'id' => Yii::t('app', 'Первичный ключ. Таблица содержит общую информацию об отелях, в частности их название.'),
                'name' => Yii::t('app', 'Введите название гостиницы'),
                'description' => Yii::t('app', 'Заполните описание гостиницы (при необходимости)'),
                'city_id' => Yii::t('app','Выберите город-курорт, в котором находится гостиница'),
                'address' => Yii::t('app', 'Укажите адрес гостиницы'),
                'country' => Yii::t('app', 'Выберите страну'),
                'gps_point_m' => Yii::t('app', 'Щелкните по карте для определения координат гостиницы'),
                'gps_point_p' => Yii::t('app', 'Щелкните по карте для определения координат гостиницы'),
                'links_maps' => Yii::t('app', 'Ссылка на интернет-карту местонахождения отеля'),
                'hotels_stars_id' => Yii::t('app', 'Выберите количество звёзд гостиницы'),
                'imageFiles' => Yii::t('app', 'Загрузите изображения'),
                /*'active' => Yii::t('app','Active'),
                'top' => Yii::t('app','inMain' ),*/
                'period_day' => Yii::t('app', 'Периодичность заезда в гостиницу'),
            ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscounts()
    {
        return $this->hasMany(\common\models\Discount::className(), ['hotels_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsAppartments()
    {
        return $this->hasMany(\common\models\HotelsAppartment::className(), ['hotels_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsCharacters()
    {
        $model = $this->getHotelsCharacterItems();
        $this->hotels_character_id = $model->one()->hotels_character_id;
        return \common\models\HotelsCharacter::findOne(['id' => $this->hotels_character_id]);
        
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsCharacterItems()
    {
        return $this->hasMany(\common\models\HotelsCharacterItem::className(), ['hotels_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsStars()
    {
        return $this->hasOne(\common\models\HotelsStars::className(), ['id' => 'hotels_stars_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(\common\models\Country::className(), ['id' => 'country']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourInfos()
    {
        return $this->hasMany(\common\models\TourInfo::className(), ['hotels_info_id' => 'id'])->inverseOf('hotelsInfo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsOthersPricings()
    {
        return $this->hasMany(\common\models\HotelsOthersPricing::className(), ['hotels_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalBaskets()
    {
        return $this->hasMany(\common\models\SalBasket::className(), ['hotels_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrders()
    {
        return $this->hasMany(\common\models\SalOrder::className(), ['hotels_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsPricings()
    {
        return $this->hasMany(HotelsPricing::className(), ['hotels_appartemnt_hotels_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(\common\models\City::className(), ['id' => 'city_id']);
    }
    
    public function upload(){

        if ($this->validate()){
            foreach($this->imageFiles as $file){
                //$image = new Image();
                //$image
                $filename = uniqid() . '.' . $file->extension;
                $this->imageFullPath= \Yii::$app->getBasePath() . '/web/uploads/images/hotels/' . $filename;

                $file->saveAs($this->imageFullPath);

                $this->attachImage($this->imageFullPath);
                
            }
            return true;
        }
        else{
            return false;
        }
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
    static public function getImageOne($id){
        $model = \common\models\HotelsInfo::findOne($id);
        $image = $model->getImage();
        return $image->getUrl('120x');
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

    




}
