<?php

use yii\helpers\Html;

// Page title
$this->title = 'New Patient';
?>
<div class="patient-create">
  <h1><?= Html::encode($this->title) ?></h1>

  <!-- Render form partial -->
  <?= $this->render('_form', ['model' => $model]) ?>
</div>