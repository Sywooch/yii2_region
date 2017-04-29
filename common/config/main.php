<?php
return [
    'language' => 'ru',
    'sourceLanguage' => 'en',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => 'uploads/images/store', //path to origin images
            'imagesCachePath' => 'uploads/images/cache', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
            'placeHolderPath' => 'uploads/images/placeHolder.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
        ],

        // Yii2 Articles
        'articles' => [
            'class' => 'cinghie\articles\Articles',
            'userClass' => 'dektrium\user\models\User', //'common\models\Userinfo',
            // Select Languages allowed
            'languages' => [
                "ru-RU" => "ru-RU",
            ],
            // Select Date Format
            //'dateFormat' => 'd F Y',
            // Select Editor: no-editor, ckeditor, imperavi, tinymce, markdown
            'editor' => 'ckeditor',

            // Select Path To Upload Category Image
            'categoryImagePath' => '@app/web/images/articles/categories/',
            // Select URL To Upload Category Image
            'categoryImageURL' => '/images/articles/categories/',
            // Select Path To Upload Category Thumb
            'categoryThumbPath' => '@app/web/images/articles/categories/thumb/',
            // Select URL To Upload Category Image
            'categoryThumbURL' => 'images/articles/categories/thumb/',

            // Select Path To Upload Item Image
            'itemImagePath' => '@app/web/images/articles/items/',
            // Select URL To Upload Item Image
            'itemImageURL' => '/images/articles/items/',


            // Select Path To Upload Item Thumb
            'itemThumbPath' => '@app/web/images/articles/items/thumb/',
            // Select URL To Upload Item Thumb
            'itemThumbURL' => '/images/articles/items/thumb/',

            // Select Path To Upload Attachments
            'attachPath' => '@backend/web/uploads/attachments/',
            // Select URL To Upload Attachment
            'attachURL' => '/images/uploads/attachments/articles/',

            // Select Image Name: categoryname, original, casual
            'imageNameType' => 'categoryname',
            // Select Image Types allowed
            'imageType' => 'jpg,jpeg,gif,png',
            // Select Image Types allowed
            'attachType' => 'application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, .csv, .pdf, text/plain, .jpg, .jpeg, .gif, .png',
            // Thumbnails Options
            'thumbOptions' => [
                'small' => ['quality' => 100, 'width' => 150, 'height' => 100],
                'medium' => ['quality' => 100, 'width' => 200, 'height' => 150],
                'large' => ['quality' => 100, 'width' => 300, 'height' => 250],
                'extra' => ['quality' => 100, 'width' => 400, 'height' => 350],
            ],

        ],
        // Module Kartik-v Markdown Editor
        'markdown' => [
            'class' => 'kartik\markdown\Module',
        ],
        'pages' => [
            'class' => 'bupy7\pages\Module',

            'controllerMap' => [
                'manager' => [
                    'class' => 'bupy7\pages\controllers\ManagerController',
                    'as access' => [
                        'class' => \yii\filters\AccessControl::className(),
                        'rules' => [
                            [
                                'allow' => true,
                                'roles' => ['Super Admin'],
                            ],
                        ],
                    ],
                ],
            ],
            'pathToImages' => '@backend/web/uploads/pages',
            'urlToImages' => '@backend/web/images',
            'pathToFiles' => '@backend/web/uploads/pages/files',
            'urlToFiles' => '/uploads/pages/files',
            'uploadImage' => true,
            'uploadFile' => true,
            'addImage' => true,
            'addFile' => true,
        ],
        'gridview' => [
            'class' => 'kartik\grid\Module',
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

        'user' => [
            'class' => 'dektrium\user\Module',
            'enableRegistration' => false,
            'enableConfirmation' => false,
            /*'modelMap' => [
                'User' => 'common\models\User',
            ],*/
        ],

    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /*'user' => [
            'identityClass' => 'common\models\Userinfo',
            'enableAutoLogin' => true,
        ],*/
        'urlManager' => [
            'class' => \yii\web\UrlManager::className(),
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            
            'rules' => [
                //'login' => 'user/login',
                //'logout' => 'user/logout',
                'pages/<page:[\w-]+>' => 'pages/default/index',
                '<id:\d+>/<alias:[A-Za-z0-9 -_.]+>' => 'articles/categories/view',
                '<cat>/<id:\d+>/<alias:[A-Za-z0-9 -_.]+>' => 'articles/items/view',
            ],
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        YII_ENV_DEV ? 'css/bootstrap.css' :         'css/bootstrap.min.css',
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                    ]
                ]
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'infoweb/menu' => 'infoweb/menu.php',

                    ],
                ],
                'articles*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'articles' => 'articles.php',
                    ],
                ],
                'essentials*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'essentials' => 'essentials.php',
                    ],
                ],
                'mtrelt*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@vendor/mootensai/yii2-relation-trait/messages',
                    'fileMap' => [
                        'mtrelt' => 'mtrelt.php',
                    ],
                ],
            ],
        ],

        /*'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],*/
        'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager',
        ],
    ],
];
