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
//$this->registerJs('jQuery("div.animation")')
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
    <div class="main">
    <div class="container">


        <header>
            <div class="animation">
                <img class="logo-element" src="<?= Yii::$app->homeUrl ?>images/tr.gif" style="max-width: 100%;
        position: absolute;
        display: block;
        left: 0;"/>
            </div>
            <div class="logo col-sm-6 col-md-6 col-lg-6 col-xs-12">
                <a href="<?= Yii::$app->homeUrl ?>"><img class="logo-element" src="<?= Yii::$app->homeUrl ?>images/logo.png" />
                </a>
            </div>
            <div class="pull-right col-sm-6 col-md-6 col-lg-6 col-xs-12">
                <p class="h1 text-right">
                    <span class="color1">
                        <strong>Оператор</strong>
                    </span>
                    <span class="color2">
                        <strong>позитивного</strong>
                    </span>
                    <span class="color3">
                        <strong>отдыха!</strong>
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
        </div>
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
                ['label' => 'Способы оплаты', 'url' => ['/pages/payment_methods']],
                ['label' => 'Контакты', 'url' => ['/site/contact']],
                ['label' => 'Частным лицам', 'url' => ['/pages/individual']],
                ['label' => 'Турагенствам', 'url' => ['/pages/touragent']],
            ];
            /*if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }*/
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
                    ['label' => 'Экскурсионные туры', 'url' => ['/site/index'],'options'=>['class' => 'menu_russia']],
                    ['label' => 'Отдых за границей', 'url' => ['/site/index'],'options'=>['class' => 'menu_zarubeg']],
                    ['label' => 'Горящие туры', 'url' => ['/site/index'],'options'=>['class' => 'menu_goryaschie']],
                    ['label' => 'Паломнические поездки', 'url' => ['/site/index'],'options'=>['class' => 'menu_hram']],
                    ['label' => 'Круизы', 'url' => ['/site/index'],'options'=>['class' => 'menu_kruiz']],
                    ['label' => 'Продажа автобусных билетов', 'url'=>['/'],'options'=>['class'=>'menu_sale']],

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
                <div class="row">
                    <div class="col-lg-2">
                        <p class="pull-left">&copy; Life Tour Voyage <?= date('Y') ?></p>
                    </div>
                    <div class="col-lg-6">
                        <!-- ShareButtons -->
                        <div class="pull-left social-icon">
                            <a href="http://www.ok.ru/turyna7dn7" target="_blank"
                            title="Лайф Тур Вояж. ОТДЫХ НА МОРЕ, АВТОБУСНЫЕ ТУРЫ,ЭКСКУРСИИ,КРУИЗЫ">
                                <img src="<?= Yii::$app->homeUrl ?>images/social/ok.png"
                                alt="Лайф Тур Вояж. ОТДЫХ НА МОРЕ, АВТОБУСНЫЕ ТУРЫ,ЭКСКУРСИИ,КРУИЗЫ"/>
                            </a>
                        </div>
                        <div class="pull-left social-icon">
                            <a href="https://plus.google.com/b/105714513864315239027/105714513864315239027" target="_blank"
                               title="Лайф Тур Вояж. Оператор позитивного отдыха">
                                <img src="<?= Yii::$app->homeUrl ?>images/social/google_plus.png" alt="Лайф Тур Вояж. Оператор позитивного отдыха"/>
                            </a>
                        </div>

                        <div class="pull-left social-icon">
                            <a href="https://vk.com/id205834588" target="_blank"
                            title="Лайф Тур Вояж. ВЕСЬ СПЕКТР ПЛЯЖНОГО И ЭКСКУРСИОННОГО ОТДЫХА! АВТОБУСНЫЕ ТУРЫ К МОРЮ ИЗ ТАМБОВА, ВОРОНЕЖА, ЛИПЕЦКА 8-953-729-00-33">
                                <img src="<?= Yii::$app->homeUrl ?>images/social/vk.png"
                                alt="Лайф Тур Вояж. ВЕСЬ СПЕКТР ПЛЯЖНОГО И ЭКСКУРСИОННОГО ОТДЫХА! АВТОБУСНЫЕ ТУРЫ К МОРЮ ИЗ ТАМБОВА, ВОРОНЕЖА, ЛИПЕЦКА 8-953-729-00-33"/>
                            </a>
                        </div>
                        <div class="pull-left social-icon">
                            <a href="https://www.youtube.com/channel/UCQndO27YFHsh3QEzwcJNw2w" target="_blank"
                            title="Лайф Тур Вояж. Видеоблог туроператора.">
                                <img src="<?= Yii::$app->homeUrl ?>images/social/youtube.png"
                                alt="Лайф Тур Вояж. Видеоблог туроператора."/>
                            </a>
                        </div>
                        <div class="pull-left social-icon">
                            <a href="https://www.instagram.com/laiftur/" target="_blank"
                               title="Лайф Тур Вояж. Оператор позитивного отдыха.">
                                <img src="<?= Yii::$app->homeUrl ?>images/social/instagram.png"
                                     alt="Лайф Тур Вояж. Оператор позитивного отдыха."/>
                            </a>
                        </div>
                        <div class="pull-left social-icon">
                            <a href="https://www.facebook.com/trevel.petersburg" target="_blank"
                               title="Лайф Тур Вояж. Путешествие Санкт-Петербург.">
                                <img src="<?= Yii::$app->homeUrl ?>images/social/facebook.png"
                                     alt="Лайф Тур Вояж. Путешествие Санкт-Петербург."/>
                            </a>
                        </div>

                        <div class="pull-left social-icon">
                            <a href="https://twitter.com/LifeTourVoyage" target="_blank"
                               title="Лайф Тур Вояж. Оператор позитивного отдыха.">
                                <img src="<?= Yii::$app->homeUrl ?>images/social/twitter.png"
                                     alt="Лайф Тур Вояж. Оператор позитивного отдыха."/>
                            </a>
                        </div>

                        <div class="pull-left social-icon">
                            <a href="https://plus.google.com/u/0/b/102778400857945943850/102778400857945943850" target="_blank"
                               title="Лайф Тур Вояж. Оператор позитивного отдыха.">
                                <img src="<?= Yii::$app->homeUrl ?>images/social/google_plus.png"
                                     alt="Лайф Тур Вояж. Оператор позитивного отдыха."/>
                            </a>
                        </div>
                        <div class="pull-left social-icon">
                            <a href="http://www.ok.ru/group57545282158634" target="_blank" title="Одноклассники. Паломничество"
                               title='Лайф Тур Вояж. ПАЛОМНИЧЕСКИЙ РЕГИОН.ЦЕНТР "ТАМБОВСКИЙ ПАЛОМНИК"' >
                                <img src="<?= Yii::$app->homeUrl ?>images/social/ok.png"
                                     alt='Лайф Тур Вояж. ПАЛОМНИЧЕСКИЙ РЕГИОН.ЦЕНТР "ТАМБОВСКИЙ ПАЛОМНИК"'/>
                            </a>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <!-- Contacts -->
                        <p><strong>Лайф Тур Вояж</strong>. Оператор позитивного отдыха.</p>
                        <p><strong>Отдых в Тамбове.</strong><strong>Туры к морю.</strong><strong>Отдых на море</strong></p>
                        <p><strong>4(4752) 71-93-25</strong></p>
                    </div>
                </div>

            </div>


            
        </footer>

    </div>
    <?php $this->endBody() ?>
    <?= \yii\widgets\YandexMetrikaCounter::widget(
        [
            'counterId' => 37814910,
            'webvisor' => true,
            'trackLinks' => true,
            'type'=>'informer',
        ]
    ) ?>
</body>
</html>
<?php $this->endPage() ?>
