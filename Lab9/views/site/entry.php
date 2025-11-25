<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = "User Form";
?>

<h2>Enter your information</h2>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput(['placeholder' => 'Enter name']) ?>

<?= $form->field($model, 'email')->textInput(['placeholder' => 'Enter email']) ?>

<div>
  <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>