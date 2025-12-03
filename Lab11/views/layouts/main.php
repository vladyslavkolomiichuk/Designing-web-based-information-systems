<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

// Register assets (CSS/JS)
AppAsset::register($this);

// Register CSRF meta tags for security
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->title = $this->title ?? 'Lab 11';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100" data-bs-theme="dark">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php
        // Initialize Navbar
        NavBar::begin([
            'brandLabel' => 'Lab 11',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark fixed-top'],
        ]);

        // Define menu items
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
        ];

        // Logic for Guest vs Authenticated User
        if (Yii::$app->user->isGuest) {
            // If Guest: Show Signup and Login
            $menuItems[] = ['label' => 'Sign Up', 'url' => ['/auth/signup']];
            $menuItems[] = ['label' => 'Login', 'url' => ['/auth/login']];
        } else {
            // If Authenticated: Show Username and Logout button
            $menuItems[] = '<li class="nav-item">'
                . Html::beginForm(['/auth/logout'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'nav-link btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ms-auto'], // ms-auto pushes items to the right
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>

            <?= Alert::widget() ?>

            <?= $content ?>
        </div>
    </main>

    <footer id="footer" class="mt-auto py-3 bg-dark">
        <div class="container">
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start">&copy; My Project <?= date('Y') ?></div>
                <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>