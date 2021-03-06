<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

//Разрешаем использовать загрузку файлов в стат.страницах
\Yii::$container->set('vova07\imperavi\actions\UploadAction', ['uploadOnlyImage' => false]);
return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log', 'arhistory', 'admin',
    ],
    'modules' => [
        /*Добавлено Lykira*/
        /*'dashboard' => [
            'class' => 'cornernote\dashboard\Module',
            'layouts' => [
                'default' => 'cornernote\dashboard\layouts\DefaultLayout',
                'example' => 'cornernote\dashboard\layouts\ExampleLayout',
            ],
            'panels' => [
                'text' => 'cornernote\dashboard\panels\TextPanel',
                'user' => 'cornernote\dashboard\panels\UserPanel'
            ],
        ],*/
        /*'dashboard' => [4
            'class' => 'stronglab\dashboard\Module',
            'roles' => ['@'], // необязатьельный параметр, по-умолчанию доступ всем гостям
            'column' => 2, // необязательный параметр, количество столбцов в панели (возможные значения: 1-3)
            'modules' => [
                // список модулей, в которых будет производиться поиск файла dashboard.json
                'user',
                /*'moduleID' => [
                    'jsonPath' => 'config/dashboard/myconf.json', // отдельный путь к файлу настроек панели, прописывается от директории приложения
                ],*
            ],
        ],*/
        'gridview' => [
            'class' => '\kartik\grid\Module',
            // see settings on http://demos.krajee.com/grid#module
        ],
        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                \kartik\datecontrol\Module::FORMAT_DATE => 'dd.MM.yyyy',
                \kartik\datecontrol\Module::FORMAT_TIME => 'HH:mm',
                \kartik\datecontrol\Module::FORMAT_DATETIME => 'dd.MM.yyyy HH:mm',
            ],

            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                \kartik\datecontrol\Module::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
                \kartik\datecontrol\Module::FORMAT_TIME => 'php:H:i:s',
                \kartik\datecontrol\Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],

            // set your display timezone
            'displayTimezone' => 'Europe/Moscow',

            // set your timezone for date saved to db
            'saveTimezone' => 'Europe/Moscow',

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

            // use ajax conversion for processing dates from display format to save format.
            'ajaxConversion' => true,

            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                \kartik\datecontrol\Module::FORMAT_DATE => ['type' => 2, 'pluginOptions' => ['autoclose' => true]], // example
                \kartik\datecontrol\Module::FORMAT_DATETIME => [], // setup if needed
                \kartik\datecontrol\Module::FORMAT_TIME => [], // setup if needed
            ],

            // custom widget settings that will be used to render the date input instead of kartik\widgets,
            // this will be used when autoWidget is set to false at module or widget level.
            'widgetSettings' => [
                \kartik\datecontrol\Module::FORMAT_DATE => [
                    'class' => 'yii\jui\DatePicker', // example
                    'options' => [
                        'dateFormat' => 'php:d.M.Y',
                        'options' => ['class' => 'form-control'],
                    ],
                ],
            ],
        ],
        // If you use tree table
        'treemanager' => [
            'class' => '\kartik\tree\Module',
            // see settings on http://demos.krajee.com/tree-manager#module
        ],
        'menu' => [
            'class' => 'infoweb\menu\Module',
            'enablePrivateMenuItems' => true,
        ],
        // Yii2 Articles
        'articles' => [
            // Select Path To Upload Category Image
            'categoryImagePath' => '@frontend/web/images/articles/categories/',
            // Select URL To Upload Category Image
            'categoryImageURL' => '/images/articles/categories/',
            // Select Path To Upload Category Thumb
            'categoryThumbPath' => '@frontend/web/images/articles/categories/thumb/',
            // Select URL To Upload Category Image
            'categoryThumbURL' => '/images/articles/categories/thumb/',

            // Select Path To Upload Item Image
            'itemImagePath' => '@frontend/web/images/articles/items/',
            // Select URL To Upload Item Image
            'itemImageURL' => '/images/articles/items/',
            // Select Path To Upload Item Thumb
            'itemThumbPath' => '@frontend/web/images/articles/items/thumb/',
            // Select URL To Upload Item Thumb
            'itemThumbURL' => '/images/articles/items/thumb/',

            // Select Path To Upload Attachments
            'attachPath' => '@frontend/web/uploads/articles/',
            // Select URL To Upload Attachment
            'attachURL' => '@frontend/web/uploads/articles/',

            // Show Titles in the views,
            'showTitles' => false,
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            //'layout' => 'left-menu',
            'userClassName' => 'common\models\Userinfo',

            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                ],
            ],
            /*'menus' => [
                'assignment' => [
                    'label' => 'Grand Access' // change label
                ],
                //'route' => null, // disable menu route
            ]*/
        ],
        'arhistory' => [
            'class' => 'bupy7\activerecord\history\Module',
            'tableName' => '{{%arhistory}}', // table name of saving changes of model
            'storage' => 'bupy7\activerecord\history\storages\Database', // class name of storage for saving history of active record model
            'db' => 'db', // database connection component config or name
            'user' => 'user', // authentication component config or name
        ],
        /*'main' => [
            'class' => 'app\modules\main\Module',
        ],*/
        /*'user' => [
            'class' => 'app\modules\user\Module',
        ],*/
        /** Begin User Access Settings */
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin'],
            //'as backend' => 'dektrium\user\filters\BackendFilter',
        ],
        'rbac' => [
            'class' => dektrium\rbac\RbacWebModule::className(),
        ],
        /** End User Access Settings */


    ],
    'components' => [
        /*'user' => [
            'identityClass' => 'common\models\Userinfo',
            'enableAutoLogin' => true,

        ],*/
        /*'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],*/
        /** Begin User Access Settings */
        /*'user' => [
        'identityClass' => 'dektrium\user\models\User',
        'enableAutoLogin' => true,
        ],*/
        /*'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager',
        ],*/
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
        'urlManager' => [
            'class' => 'yii\web\urlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //'login' => 'user/login',
                //'logout' => 'user/logout',
                'index' => 'site/index',
                //'pages/<page:[\w-]+>' => 'pages/default/index',
                //'pages/<page:[\w-]+>' => 'pages/default/index',
            ],
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => 'http://турлайф.рф',
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => 'uploads/images/store', //path to origin images
            'imagesCachePath' => 'uploads/images/cache', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
            'placeHolderPath' => 'uploads/images/placeHolder.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
        ],
        'yandexMapsApi' => [
            'class' => 'mirocow\yandexmaps\Api',
        ],
    ],
    /*'as access' => [
        'class' => 'mdm\admin\classes\AccessControl',
        //'class' => \yii\filters\AccessControl::className(),
        'allowActions' => [
            'site/login',
            'site/logout',
            'login',
            'logout',
            'user/register/*',
            'user/confirm/*',
            'user/recovery/*'
            //'admin/*',
            //'menu/*',
            //'*',
            //'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],*/

    'params' => $params,
];
