<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "TransInfoController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class TransInfoController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\TransInfo';
}
