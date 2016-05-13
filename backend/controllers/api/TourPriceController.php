<?php

namespace \api;

/**
* This is the class for REST controller "TourPriceController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class TourPriceController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\TourPrice';
}
