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
            //'userClass' => 'dektrium\user\models\User',
            // Select Languages allowed
            'languages' => [
                "ru-RU" => "ru-RU",
            ],
            // Select Date Format
            //'dateFormat' => 'd F Y',
            // Select Editor: no-editor, ckeditor, imperavi, tinymce, markdown
            'editor' => 'ckeditor',
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
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\urlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            
            'rules' => [
                'login' => 'site/login',
                'logout' => 'site/logout',
                'pages/<page:[\w-]+>' => 'pages/default/index',
                '<id:\d+>/<alias:[A-Za-z0-9 -_.]+>' => 'articles/categories/view',
                '<cat>/<id:\d+>/<alias:[A-Za-z0-9 -_.]+>' => 'articles/items/view',
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
            ],
        ],

        /*'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],*/
    ],
];
