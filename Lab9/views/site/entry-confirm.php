<?php

use yii\helpers\Html;
?>

<h2>You entered:</h2>

<ul>
  <li><strong>Name:</strong> <?= Html::encode($model->name) ?></li>
  <li><strong>Email:</strong> <?= Html::encode($model->email) ?></li>
</ul>

<a href="<?= \yii\helpers\Url::to(['site/entry']) ?>">Back to form</a>