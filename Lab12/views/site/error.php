<?php

use yii\helpers\Html;

// Page title (error name)
$this->title = $name;
?>
<div class="site-error text-center">
    <h1 class="text-danger"><?= Html::encode($this->title) ?></h1>

    <!-- Error message -->
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <!-- Additional info -->
    <p>An error occurred while processing your request.</p>

    <!-- Link back to home -->
    <p><?= Html::a('Return to Home', ['site/index'], ['class' => 'btn btn-primary']) ?></p>
</div>