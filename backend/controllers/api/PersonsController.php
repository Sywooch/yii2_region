<?php

namespace \api;

/**
* This is the class for REST controller "PersonsController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class PersonsController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Persons';
}
