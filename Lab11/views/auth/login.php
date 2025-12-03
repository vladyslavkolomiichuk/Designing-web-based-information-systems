<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="site-login">
      <h1><?= Html::encode($this->title) ?></h1>
      <p>Please fill out the following fields to login:</p>
      <hr>

      <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

      <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username']) ?>

      <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>

      <?= $form->field($model, 'rememberMe')->checkbox() ?>

      <div class="form-group mt-4">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
      </div>

      <?php ActiveForm::end(); ?>

      <p class="mt-3 text-center">Don't have an account? <?= Html::a('Sign up', ['auth/signup']) ?></p>
    </div>
  </div>
</div>