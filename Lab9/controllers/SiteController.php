<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\EntryForm;
use Yii;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(['entry']); // Redirect to entry form
    }

    public function actionEntry()
    {
        $model = new EntryForm(); // Create form model

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->render('entry-confirm', ['model' => $model]); // Show confirmation
        }

        return $this->render('entry', ['model' => $model]); // Show form
    }
}
