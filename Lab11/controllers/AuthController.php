<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\SignupForm;

class AuthController extends Controller
{
  /**
   * Login action.
   *
   * @return string
   */
  public function actionLogin()
  {
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    }

    $model->password = '';
    return $this->render('login', [
      'model' => $model,
    ]);
  }

  /**
   * Signup action.
   *
   * @return string
   */
  public function actionSignup()
  {
    $model = new SignupForm();

    if ($model->load(Yii::$app->request->post())) {
      if ($user = $model->signup()) {
        if (Yii::$app->getUser()->login($user)) {
          return $this->goHome();
        }
      }
    }

    return $this->render('signup', [
      'model' => $model,
    ]);
  }

  /**
   * Logout action.
   *
   * @return string
   */
  public function actionLogout()
  {
    Yii::$app->user->logout();
    return $this->goHome();
  }
}
