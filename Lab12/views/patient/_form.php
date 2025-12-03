<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
?>

<div class="patient-form">
  <?php // Multipart required for file upload 
  ?>
  <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

  <?= $form->field($model, 'name')->textInput() ?>

  <?= $form->field($model, 'birth_date')->textInput(['type' => 'date']) ?>

  <?= $form->field($model, 'diagnosis')->textarea(['rows' => 3]) ?>

  <?= $form->field($model, 'imageFile')->fileInput() ?>

  <div class="form-group mt-3">
    <!-- Submit button -->
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>
</div>