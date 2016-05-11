<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log','arhistory','admin'],
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
        'dashboard' => [
            'class' => 'stronglab\dashboard\Module',
            'roles' => ['@'], // необязатьельный параметр, по-умолчанию доступ всем гостям
            'column' => 2, // необязательный параметр, количество столбцов в панели (возможные значения: 1-3)
            'modules' => [
                // список модулей, в которых будет производиться поиск файла dashboard.json
                'user',
                /*'moduleID' => [
                    'jsonPath' => 'config/dashboard/myconf.json', // отдельный путь к файлу настроек панели, прописывается от директории приложения
                ],*/
            ],
        ],
        'menu' => [
            'class' => 'infoweb\menu\Module',
        ],
		'gridview' => [
			'class' => 'kartik\grid\Module',
		],

        /*'admin' => [
            'class' => 'app\modules\admin\Module',
        ],*/
        'admin' => [
            'class' => 'mdm\admin\Module',
            /*'layout' => 'left-menu',*/
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    /* 'userClassName' => 'app\models\User', */
                    'idField' => 'id',
                    'usernameField' => 'username',
                    /*'fullnameField' => 'profile.full_name',*/
                    /*'extraColumns' => [
                        [
                            'attribute' => 'full_name',
                            'label' => 'Full Name',
                            'value' => function($model, $key, $index, $column) {
                                return $model->profile->full_name;
                            },
                        ],
                        [
                            'attribute' => 'dept_name',
                            'label' => 'Department',
                            'value' => function($model, $key, $index, $column) {
                                return $model->profile->dept->name;
                            },
                        ],
                        [
                            'attribute' => 'post_name',
                            'label' => 'Post',
                            'value' => function($model, $key, $index, $column) {
                                return $model->profile->post->name;
                            },
                        ],
                    ],*/
                    'searchClass' => 'app\models\UserinfoSearch'
                ],
            ],
        ],
        'arhistory' => [
            'class' => 'bupy7\activerecord\history\Module',
            'tableName' => '{{%arhistory}}', // table name of saving changes of model
            'storage' => 'bupy7\activerecord\history\storages\Database', // class name of storage for saving history of active record model
            'db' => 'db', // database connection component config or name
            'user' => 'user', // authentication component config or name
        ],


        'main' => [
            'class' => 'app\modules\main\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        /*'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],*/
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
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

        'yandexMapsApi' => [
            'class' => 'mirocow\yandexmaps\Api',
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\classes\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
            'menu/*',
            '*',
            'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],

    'params' => $params,
];
