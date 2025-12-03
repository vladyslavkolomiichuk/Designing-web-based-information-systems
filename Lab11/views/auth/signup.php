<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */
/* @var $model app\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Sign Up';
?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="site-signup">
      <h1><?= Html::encode($this->title) ?></h1>
      <p>Please fill out the following fields to signup:</p>
      <hr>

      <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

      <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username']) ?>

      <?= $form->field($model, 'email')->textInput(['placeholder' => 'email@example.com']) ?>

      <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>

      <div class="form-group mt-4">
        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
      </div>

      <?php ActiveForm::end(); ?>

      <p class="mt-3 text-center">Already have an account? <?= Html::a('Login', ['auth/login']) ?></p>
    </div>
  </div>
</div>