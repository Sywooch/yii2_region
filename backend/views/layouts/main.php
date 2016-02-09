<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
        $menuItems[] = [
            'label' => 'Пользователи',
            'items' => [
                ['label' => 'Информация о пользователях', 'url' => ['/userinfo']],
                ['label' => 'Права пользователей','url'=>['/user-role']]
            ],
        ];
        $menuItems[] = [
            'label' => 'Гостиницы',
            'items' => [
                ['label' => 'Звёзды','url'=>['/hotels-stars']],
                ['label' => 'Тип питания', 'url'=>['/hotels-type-of-food']],
                ['label' => 'Типы номеров', 'url'=>['/hotels-appartment-item']],
                ['label' => 'Справочник прочих цен', 'url'=>['/hotels-others-pricing-type']],
                ['label' => ''],
                ['label' => 'Информация о гостиницах', 'url' => ['/hotels-info']],
                ['label' => 'Номера','url'=>['/hotels-appartment']],
                ['label' => 'Название характеристик', 'url'=>['/hotels-character']],
                ['label' => 'Описание характеристик', 'url'=>['/hotels-character-item']],
                ['label' => 'Скидки', 'url'=>['/discount']],
                ['label' => 'Формирование основных цен', 'url'=>['/hotels-pricing']],
                ['label' => 'Формирование прочих цен', 'url'=>['/hotels-others-pricing']],
            ],
        ];
        $menuItems[] = [
            'label' => 'Транспорт',
            'items' => [
                ['label' => 'Тип вокзала','url'=>['/trans-type-station']],
                ['label' => 'Типы цен', 'url'=>['/trans-price-type']],
                ['label' => 'Типы транспорта', 'url'=>['/trans-type']],
                ['label' => ''],
                ['label' => 'Вокзалы (аэропорты)', 'url' => ['/trans-station']],
                ['label' => 'Маршруты','url'=>['/trans-route']],
                ['label' => 'Цены?', 'url'=>['/trans-price']],
                ['label' => 'Сводная информация', 'url'=>['/trans-info']],
            ],
        ];
        $menuItems[] = [
            'label' => 'Туры',
            'items' => [
                ['label' => 'Справочник типов транспорта для туров', 'url' => ['/tour-type-transport']],
                ['label' => 'Справочник типов тура', 'url' => ['/tour-type']],
                ['label' => 'Конструктор тура', 'url' => ['/tour-info']]
            ],

        ];

        $menuItems[] = [
            'label' => 'Автобусы',
            'items' => [
                ['label' => 'Путевые точки', 'url' => ['/bus-route-point']],
                ['label' => 'Маршруты', 'url' => ['/bus-route']],
                ['label' => 'Список автобусов', 'url' => ['/bus-info']],
                ['label' => 'Водители', 'url' => ['/bus-driver']],
                ['label' => 'Путевой лист', 'url' => ['/bus-way']],
                ['label' => 'Текущие маршруты', ['/bus-current']],
            ],
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
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
