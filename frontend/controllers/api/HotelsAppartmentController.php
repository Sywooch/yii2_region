<?php

namespace frontend\controllers\api;

/**
* This is the class for REST controller "HotelsAppartmentController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class HotelsAppartmentController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\HotelsAppartment';
}
