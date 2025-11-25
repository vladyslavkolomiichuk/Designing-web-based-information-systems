<?php

use yii\helpers\Html;

$this->registerCssFile('@web/css/post.css', ['depends' => [\yii\web\YiiAsset::class]]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="container">
        <?= $content ?>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>