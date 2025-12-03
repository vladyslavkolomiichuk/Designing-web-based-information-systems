<?php

use yii\helpers\Html;

// Page title with patient name
$this->title = 'Edit: ' . $model->name;
?>
<div class="patient-update">
  <h1><?= Html::encode($this->title) ?></h1>

  <!-- Render form partial -->
  <?= $this->render('_form', ['model' => $model]) ?>
</div>