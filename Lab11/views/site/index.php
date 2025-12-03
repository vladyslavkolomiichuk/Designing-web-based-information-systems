<?php

/** @var yii\web\View $this */

$this->title = 'Home';
?>
<div class="site-index text-center">
    <div class="jumbotron bg-transparent mt-5 mb-5">
        <h1 class="display-4 text-white">Welcome!</h1>

        <?php if (Yii::$app->user->isGuest): ?>
            <p>
                <a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['auth/login']) ?>">Login</a>
                <a class="btn btn-lg btn-primary" href="<?= \yii\helpers\Url::to(['auth/signup']) ?>">Sign Up</a>
            </p>
        <?php else: ?>
            <p class="text-success">You are currently logged in as <strong><?= Yii::$app->user->identity->username ?></strong></p>
        <?php endif; ?>
    </div>
</div>