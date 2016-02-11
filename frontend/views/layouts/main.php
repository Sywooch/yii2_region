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
            <div class="logo">
                <a href="<?= Yii::$app->homeUrl ?>"><img class="logo-element" src="<?= Yii::$app->homeUrl ?>assets/img/logo.png" />
                </a>
            </div>
            <div>
                <p>
                    <span class="red">
                        Оператор
                    </span>
                    <span class="blue">
                        Вашего
                    </span>
                    <span class="green">
                        позитивного отдыха!
                    </span>
                    <span class="yellow">
                        8 (4752) 71-93-25
                    </span>
                </p>
            </div>

        </header>
        <div class="wrap">
            <?php
                NavBar::begin([
                    'brandLabel' => 'My Company',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar',
                    ],
                ]);
                $menuItems = [
                    ['label' => 'Домашняя', 'url' => ['/site/index'],'options'=>['class' => 'menu_gory']],
                    ['label' => Html::img(Yii::$app->homeUrl . 'assets/img/menu_autobus.png') . ' Автобусные туры',
                        'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
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
