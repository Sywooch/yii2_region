<?php
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


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
    <div class="container-fluid" style="position: relative;">
        <div class="animation">
            <img class="logo-element heder-bg" src="<?= Yii::$app->homeUrl ?>images/tr.gif"/>
        </div>
        <div class="container">
            <header>

                <div class="logo col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div style="float:left;">
                    <a href="<?= Yii::$app->homeUrl ?>"><img class="logo-element" alt="Лайф Тур Вояж"
                                                             src="<?= Yii::$app->homeUrl ?>images/logo.png"/>
                    </a>
                    </div>


                </div>
                <div class="pull-right col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <p class="h1">
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
                                <?= \common\models\Organization::findOne(['active'=>1])->phone ?>
                            </span>
                        </strong>
                    </p>
                </div>
                <div class="clear"></div>
            </header>
        </div>
    </div>
    <div class="wrap bg-content">
        <?php
        NavBar::begin([
            'brandLabel' => 'Лайф Тур Вояж',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-default ',
            ],
        ]);
        ?>
        <div class="banner-currency" style="float: right; margin: 4px 20px;">
            <table cellpadding="0" cellspacing="0"
                   style="border-collapse: inherit; border-collapse: inherit;background-color: #ffffff; border-radius: 0px ; border: 1px solid #145FCF; width: 110px;text-shadow: none;font-family: Helvetica, Arial, sans-serif ;line-height: 1.5">
                <tbody>
                <tr>
                    <td rowspan="3" style="font-size:13px; color: #207E95;text-align:center" id="curentData">
                        Курсы на <?= date('d.m.Y') ?>
                    </td>
                </tr>
                <?php
                $model = \common\models\KursTypeCurrency::find()->active()->asArray()->all();
                foreach ($model as $typeCurrency){
                    //Получаем текущий курс валюты
                    $currency = \common\models\KursCurrency::findOne([
                        'active'=>1,
                        'kurs_type_currency_id'=>$typeCurrency['id']
                    ]);
                    ?>
                    <tr>
                        <td style="vertical-align: middle; /*padding: 0 0 7px 0;*/">
                            <table cellpadding="0" cellspacing="0"
                                   style="border-collapse: initial;width: inherit;margin: 0 auto; font-size: 13px; border-bottom: 1px dotted rgb(130, 148, 130)">
                                <tr>
                                    <td style="padding: 0 10px; ">
                                        <p
                                                style="text-decoration: none; color: inherit;  font-weight: bold; margin: 0;" title="<?= $typeCurrency['name'] ?>">
                                            <?= $typeCurrency['tcode'] ?></p></td>
                                    <td style="  padding: 0 12px 0 0px;color: #000000; " id="<?= $typeCurrency['tcode'] ?>_td"><?= number_format($currency->skurs,2,',', ' ') ?></td>

                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php
                }
                ?>

                </tbody>

            </table>
        </div>
        <?php
        //\bupy7\pages\models\Page::;
        $menuItems = [
            ['label' => 'Офисы продаж', 'url' => ['/pages/pay_points']],
            ['label' => 'Способы оплаты', 'url' => ['/pages/payment_methods']],
            ['label' => 'Контакты', 'url' => ['/site/contact']],
            ['label' => 'Частным лицам', 'url' => ['/pages/individual']],
            ['label' => 'Турагентствам', 'url' => ['/pages/touragent']],

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
                'class' => 'navbar navbar-default',
            ],
        ]);
        $menuItems = [
            ['label' => 'Автобусные туры', 'url' => ['/hotels?tour_type_name=Автобусные туры'], 'options' => ['class' => 'menu_autobus']],
            ['label' => 'Школьные туры', 'url' => ['/pages/skolnye-tury'], 'options' => ['class' => 'menu_schkola']],
            ['label' => 'Пляжный отдых', 'url' => ['/hotels'], 'options' => ['class' => 'menu_plyag']],
            ['label' => 'Горнолыжные туры', 'url' => ['/hotels?tour_type_name=Горнолыжные туры'], 'options' => ['class' => 'menu_gory']],
            ['label' => 'Экскурсионные туры', 'url' => ['/pages/ekskursionnye-tury'], 'options' => ['class' => 'menu_russia']],
            ['label' => 'Отдых за границей', 'url' => ['/hotels?tour_type_name=Отдых за границей'], 'options' => ['class' => 'menu_zarubeg']],
            ['label' => 'Горящие туры', 'url' => ['/hotels?tour_type_name=Горящие туры'], 'options' => ['class' => 'menu_goryaschie']],
            ['label' => 'Паломнические поездки', 'url' => ['/pages/palomniceskie-poezdki'], 'options' => ['class' => 'menu_hram']],
            ['label' => 'Круизы', 'url' => ['/hotels?tour_type_name=Круизы'], 'options' => ['class' => 'menu_kruiz']],
            ['label' => 'Автобусные билеты', 'url' => ['/pages/prodaza-avtobusnyh-biletov'], 'options' => ['class' => 'menu_ticket']],

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
            <div class="row" style="background-color: white; padding: 5px 10px;">
                <?= $content ?>
            </div>
            <div class="row">
                <p>&nbsp;</p>
            </div>

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
                            <img src="<?= Yii::$app->homeUrl ?>images/social/google_plus.png"
                                 alt="Лайф Тур Вояж. Оператор позитивного отдыха"/>
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
                        <a href="https://www.facebook.com/%D0%9B%D0%B0%D0%B9%D1%84-%D1%82%D1%83%D1%80-%D0%92%D0%BE%D1%8F%D0%B6-363799927290130/"
                           target="_blank"
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
                        <a href="https://plus.google.com/u/0/b/102778400857945943850/102778400857945943850"
                           target="_blank"
                           title="Лайф Тур Вояж. Оператор позитивного отдыха.">
                            <img src="<?= Yii::$app->homeUrl ?>images/social/google_plus.png"
                                 alt="Лайф Тур Вояж. Оператор позитивного отдыха."/>
                        </a>
                    </div>
                    <div class="pull-left social-icon">
                        <a href="http://www.ok.ru/group57545282158634" target="_blank"
                           title="Одноклассники. Паломничество"
                           title='Лайф Тур Вояж. ПАЛОМНИЧЕСКИЙ РЕГИОН.ЦЕНТР "ТАМБОВСКИЙ ПАЛОМНИК"'>
                            <img src="<?= Yii::$app->homeUrl ?>images/social/ok.png"
                                 alt='Лайф Тур Вояж. ПАЛОМНИЧЕСКИЙ РЕГИОН.ЦЕНТР "ТАМБОВСКИЙ ПАЛОМНИК"'/>
                        </a>
                    </div>

                </div>
                <div class="col-lg-4">
                    <!-- Contacts -->
                    <p><strong>Лайф Тур Вояж</strong>. Оператор позитивного отдыха.</p>
                    <p><strong>Отдых в Тамбове.</strong><strong>Туры к морю.</strong><strong>Отдых на море</strong></p>
                    <p><strong>8(4752) 71-93-25</strong></p>
                </div>
            </div>

        </div>


    </footer>

</div>
<?php $this->endBody() ?>
<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=37814910&amp;from=informer"
   target="_blank" rel="nofollow"><img
            src="https://informer.yandex.ru/informer/37814910/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
            style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика"
            title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)"
            onclick="try{Ya.Metrika.informer({i:this,id:37814910,lang:'ru'});return false}catch(e){}"/></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function () {
            try {
                w.yaCounter37814910 = new Ya.Metrika({
                    id: 37814910,
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true,
                    webvisor: true
                });
            } catch (e) {
            }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () {
                n.parentNode.insertBefore(s, n);
            };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else {
            f();
        }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/37814910" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function(){ var widget_id = 'u32JAJzQMK';var d=document;var w=window;function l(){
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->
</body>
</html>
<?php $this->endPage() ?>
