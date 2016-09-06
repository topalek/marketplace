<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Menu;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
<!--    --><?php //require (__DIR__.'/_header.php'); ?>
    <?phpgit
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
/*    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'категории', 'url' => ['/category/index']],
            ['label' => 'сопоставление', 'url' => ['/category/compare']],
            ['label' => 'сопоставление', 'url' => ['/category/compare']],
            ['label' => 'сопоставление', 'url' => ['/category/compare']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);*/
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['site/index']],
            // 'Products' menu item will be selected as long as the route is 'product/index'
            ['label' => 'Category', 'url' => ['#'],
                'items' => [
                    ['label' => 'All categories', 'url' => ['category/index']],
                    ['label' => 'Create', 'url' => ['category/create']],
                    ['label' => 'Compare', 'url' => ['category/compare']],
                    ['label' => 'Import', 'url' => ['category/import']],
                    ['label' => 'Test', 'url' => ['category/test']],
                ]
            ],
            ['label' => 'Brand', 'url' => ['#'],
                'items' => [
                    ['label' => 'All categories', 'url' => ['brand/index']],
                    ['label' => 'Create', 'url' => ['brand/create']],
                    ['label' => 'Compare', 'url' => ['brand/compare']],
//                    ['label' => 'Import', 'url' => ['brand/import']],
                ]
            ], // 'Products' menu item will be selected as long as the route is 'product/index'
            ['label' => 'Shop', 'url' => ['#'],
                'items' => [
                    ['label' => 'All shops', 'url' => ['shop/index']],
                    ['label' => 'Create', 'url' => ['shop/create']],
                    ['label' => 'test', 'url' => ['shop/test']],
                ]
            ],
            ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
        ],
    ]);
    /*echo Menu::widget([
        'items' => [
            // Important: you need to specify url as 'controller/action',
            // not just as 'controller' even if default action is used.
            ['label' => 'Home', 'url' => ['site/index']],
            // 'Products' menu item will be selected as long as the route is 'product/index'
            ['label' => 'Category', 'url' => ['category/index'], 'items' => [
                ['label' => 'Create', 'url' => ['category/create']],
                ['label' => 'Update', 'url' => ['category/update']],
                ['label' => 'Compare', 'url' => ['category/compare']],
            ]],
            ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
        ],
    ]);*/
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
