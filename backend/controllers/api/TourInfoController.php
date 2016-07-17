<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "TourInfoController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class TourInfoController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\TourInfo';
}
