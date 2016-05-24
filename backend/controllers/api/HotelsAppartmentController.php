<?php

namespace backend\controllers\api;

/**
 * This is the class for REST controller "HotelsAppartmentController".
 */

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class HotelsAppartmentController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\HotelsAppartment';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'matchCallback' => function ($rule, $action) {
                                return \Yii::$app->user->can($this->module->id . '_' . $this->id . '_' . $action->id, ['route' => true]);
                            },
                        ]
                    ]
                ]
            ]
        );
    }
}