<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "TransRouteController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class TransRouteController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\TransRoute';
}
