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

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->title = $this->title ?? 'MedSystem';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100" data-bs-theme="dark">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .footer {
            background-color: #1a1a1a;
            border-top: 1px solid #333;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php
        NavBar::begin([
            'brandLabel' => 'MedSystem', // Icon and app name
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top border-bottom border-secondary'],
        ]);

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ms-auto'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Patients', 'url' => ['/patient/index']],
            ],
        ]);
        NavBar::end();
        ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container" style="padding-top: 80px;">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget([
                    'links' => $this->params['breadcrumbs'],
                    'options' => ['class' => 'breadcrumb bg-transparent p-0 mb-3'] // Transparent background for breadcrumbs
                ]) ?>
            <?php endif ?>

            <?= Alert::widget() ?>

            <?= $content ?>
        </div>
    </main>

    <footer id="footer" class="mt-auto py-3 text-muted">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    &copy; Medical System <?= date('Y') ?>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    Powered by Yii2 & MongoDB Atlas
                </div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>