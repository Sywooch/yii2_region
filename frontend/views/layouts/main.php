<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;


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
    <div class="container main">

        <header>
            <div class="logo col-sm-6 col-md-6 col-lg-6 col-xs-12">
                <a href="<?= Yii::$app->homeUrl ?>"><img class="logo-element" src="<?= Yii::$app->homeUrl ?>assets/img/logo.png" />
                </a>
            </div>
            <div class="pull-right col-sm-6 col-md-6 col-lg-6 col-xs-12">
                <p class="h1">
                    <span class="color1">
                        Оператор
                    </span>
                    <span class="color2">
                        Вашего
                    </span>
                    <span class="color3">
                        позитивного отдыха!
                    </span>
                </p>
                <p class="h1">
                    <strong>
                        <span class="color4">
                            8 (4752) 71-93-25
                        </span>
                    </strong>
                </p>
            </div>
            <div class="clear"></div>
        </header>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Лайф Тур Вояж',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar first-menu',
                ],
            ]);
            $menuItems = [
                ['label' => 'Контакты', 'url' => ['/site/contact']],
                ['label' => 'Частным лицам', 'url' => ['/site/about']],
                ['label' => 'Турагенствам', 'url' => ['/site/about']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>
            <?php
                NavBar::begin([
                    'options' => [
                        'class' => 'navbar',
                    ],
                ]);
                $menuItems = [
                    ['label' => 'Автобусные туры', 'url' => ['/site/index'],'options'=>['class' => 'menu_autobus']],
                    ['label' => 'Школьные туры', 'url' => ['/site/index'],'options'=>['class' => 'menu_schkola']],
                    ['label' => 'Пляжный отдых', 'url' => ['/site/index'],'options'=>['class' => 'menu_plyag']],
                    ['label' => 'Горнолыжные туры', 'url' => ['/site/index'],'options'=>['class' => 'menu_gory']],
                    ['label' => 'Отдых в России', 'url' => ['/site/index'],'options'=>['class' => 'menu_russia']],
                    ['label' => 'Отдых за границей', 'url' => ['/site/index'],'options'=>['class' => 'menu_zarubeg']],
                    ['label' => 'Горящие туры', 'url' => ['/site/index'],'options'=>['class' => 'menu_goryaschie']],
                    ['label' => 'Паломнические поездки', 'url' => ['/site/index'],'options'=>['class' => 'menu_hram']],
                    ['label' => 'Круизы', 'url' => ['/site/index'],'options'=>['class' => 'menu_kruiz']],

                    /*['label' => 'Автобусные туры',
                        'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],*/
                ];
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav'],
                    'items' => $menuItems,
                ]);
                NavBar::end();
            ?>

            <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
