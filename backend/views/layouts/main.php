<?php
use backend\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Life Tour Voyage',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('app', 'Home'), 'url' => ['/index']],
    ];
    $menuItems[] =
        ['label' => 'Сайт', 'url' => Yii::$app->urlManagerFrontend->getBaseUrl()/*createUrl('/site/index')*/,
        'linkOptions' => ['target' => '_blank']];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/user/login']];
    } else {

        $menuItems[] = [
            'label' => 'Заказы',
            'items' => [
                ['label' => 'Справочник "Статусы заказов"', 'url' => ['/sal-order-status']],
                ['label' => 'Заказы','url'=>['/sal-order']],
                //['label' => 'Онлайн заявки','url'=>['/salary-feedback']],
                ['label' => 'Справочник туристы(пассажиры, отдыхающие)', 'url' => ['/person']]
            ],
        ];

        $menuItems[] = [
            'label' => 'Агенства',
            'items' => [
                ['label' => 'Администрирование пользователей', 'url' => ['/user/admin']],
                ['label' => ''],
                ['label' => 'Стандартные проценты агенств', 'url' => ['/agent-default-percent']],
                ['label' => 'Информация об агенствах', 'url' => ['/agent-rekv']],
                ['label' => 'Установка процентов', 'url' => ['/agent-percent']],
                ['label' => 'Выплаты', 'url' => ['/agent-payment']],
                //['label' => 'Права пользователей','url'=>['/user-role']],
                //['label' => 'Справочник Контрагенты (организации)','url'=>['/kontragent-persons']]
            ],
        ];
        $menuItems[] = [
            'label' => 'Гостиницы',
            'items' => [
                ['label' => 'Справочник. Звёзды','url'=>['/hotels-stars']],
                ['label' => 'Справочник. Тип питания', 'url'=>['/hotels-type-of-food']],
                ['label' => 'Справочник. Типы номеров', 'url'=>['/hotels-appartment-item']],
                //['label' => 'Справочник прочих цен', 'url'=>['/hotels-others-pricing-type']],
                //['label' => 'Справочник. Характеристики гостиниц', 'url'=>['/hotels-character']],
                ['label' => ''],
                ['label' => 'Информация о гостиницах', 'url' => ['/hotels-info']],
                ['label' => 'Номера','url'=>['/hotels-appartment']],
                //['label' => 'Инфраструктура гостиниц', 'url'=>['/hotels-character-item']],
                ['label' => 'Скидки на детей', 'url'=>['/discount']],
                /*['label' => 'Стоимость проживания', ''],*/
                ['label' => 'Стоимость проживания и питания', 'url'=>['/hotels-pricing']],
                //['label' => 'Дополнительные цены', 'url'=>['/hotels-others-pricing']],
            ],
        ];
        $menuItems[] = [
            'label' => 'Ж-Д/Авиа',
            'items' => [
                ['label' => 'Справочник. Тип вокзала', 'url' => ['/trans-type-station']],
                ['label' => 'Справочник. Типы мест', 'url' => ['/trans-seats-type']],
                ['label' => 'Справочник. Типы транспорта', 'url' => ['/trans-type']],
                ['label' => 'Вокзалы (аэропорты)', 'url' => ['/trans-station']],
                ['label' => 'Маршруты','url'=>['/trans-route']],
                ['label' => ''],
                ['label' => 'Транспорт', 'url' => ['/trans-info']],
                ['label' => 'Посадочные места', 'url' => ['/trans-seats']],
                ['label' => 'Цены за проезд', 'url' => ['/trans-price']],
                ['label' => 'Бронирование', 'url' => ['/trans-reservation']],

            ],
        ];
        $menuItems[] = [
            'label' => 'Туры',
            'items' => [
                /*['label' => 'Справочник типов транспорта для туров', 'url' => ['/tour-type-transport']],*/
                ['label' => 'Справочник типов тура', 'url' => ['/tour-type']],
                ['label' => 'Справочник стран','url'=>['/country']],
                ['label' => 'Справочник. Города', 'url' => ['/city']],
                ['label' => 'Туры', 'url' => ['/tour-info']],
                /*['label' => 'Цены тура', 'url' => ['/tour-price']]*/
            ],

        ];

        $menuItems[] = [
            'label' => 'Автобусы',
            'items' => [
                ['label' => 'Справочник. Путевые точки.', 'url' => ['/bus-route-point']],
                ['label' => 'Справочник. Маршруты', 'url' => ['/bus-route']],
                ['label' => 'Список автобусов', 'url' => ['/bus-info']],
                ['label' => 'Посадочные места', 'url' => ['/bus-scheme-seats']],
                ['label' => 'Водители', 'url' => ['/bus-driver']],
                ['label' => 'Путевой лист', 'url' => ['/bus-way']],
                /*['label' => 'Текущие маршруты', ['/bus-current']],
                ['label' => 'Бронь', ['/bus-bron']],
                /*['label' => 'Маршрут + путевые точки', 'url' => ['/bus-route-has-bus-route-point']],*/

                ['label' => 'Резервация посадочных мест', 'url' => ['/bus-reservation']]
            ],
        ];

        $menuItems[] = [
            'label' => 'Настройки',
            'items' => [
                ['label' => 'Статические страницы', 'url' => ['/pages/manager/index']],
                ['label' => 'Новости', 'url' => ['/articles/items/index']],
                ['label' => 'Баннер на главной', 'url' => ['/banner']],
                ['label' => 'Реквизиты', 'url' => ['/organization']],
            ],
        ];

        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['user/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];


    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        
        <?= $content ?>
            
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; Life Tour Voyage <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
