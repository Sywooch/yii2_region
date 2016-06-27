<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "HotelsPricingController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class HotelsPricingController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\HotelsPricing';
}
