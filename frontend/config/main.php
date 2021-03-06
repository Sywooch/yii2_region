<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [

        // Yii2 Articles
        'articles' => [
            // Select Path To Upload Category Image
            'categoryImagePath' => '@webroot/images/articles/categories/',
            // Select URL To Upload Category Image
            'categoryImageURL' => '@web/images/articles/categories/',
            // Select Path To Upload Category Thumb
            'categoryThumbPath' => '@webroot/images/articles/categories/thumb/',
            // Select URL To Upload Category Image
            'categoryThumbURL' => '@web/images/articles/categories/thumb/',

            // Select Path To Upload Item Image
            'itemImagePath' => '@webroot/images/articles/items/',
            // Select URL To Upload Item Image
            'itemImageURL' => '@web/images/articles/items/',
            // Select Path To Upload Item Thumb
            'itemThumbPath' => '@webroot/images/articles/items/thumb/',
            // Select URL To Upload Item Thumb
            'itemThumbURL' => '@web/images/articles/items/thumb/',

            // Show Titles in the views, 
            'showTitles' => true,
        ],
        /*'news' => [
            'class' => frontend\controllers\NewsController::className(),
            'userClass' => 'dektrium\user\models\User',
        ],*/


        /** Begin User Access Settings */
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin'],
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
        ],
        'rbac' => [
            'class' => dektrium\rbac\RbacWebModule::className(),
        ],

         /* /** End User Access Settings */

        /**Личный кабинет турагенства*/
        'lk' => [
            'class' => 'frontend\components\lk\Module',
        ],

    ],
    'components' => [
        'urlManager' => [
            'class' => 'yii\web\urlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => 'site/login',
                'logout' => 'site/logout',
                'pages/<page:[\w-]+>' => 'pages/default/index',
                'hotels' => 'tour',
            ],
        ],

        /*'user' => [
            'identityClass' => 'common\models\Userinfo',
            //'class'=>\dektrium\user\models\User::className(),
            'enableAutoLogin' => true,
        ],*/
        /*'authManager' => [
            'class' => \yii\rbac\DbManager::className(),
        ],*/
        /** Begin User Access Settings *
        'user' => [
        'identityClass' => 'dektrium\user\models\User',
        'enableAutoLogin' => true,
        ],
        'authManager' => [
        'class' => 'dektrium\rbac\components\DbManager',
        ],
        /** End User Access Settings */
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'page' => [
            'class' => 'infoweb\pages\components\Page'
        ],

    ],
    'params' => $params,
];
