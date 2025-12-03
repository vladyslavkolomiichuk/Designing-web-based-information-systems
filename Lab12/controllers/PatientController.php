<?php

namespace app\controllers;

use app\models\Patient;
use app\models\PatientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use Yii;

class PatientController extends Controller
{
  // List patients (Read)
  public function actionIndex()
  {
    $searchModel = new PatientSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  // View single patient (Read)
  public function actionView($_id)
  {
    return $this->render('view', [
      'model' => $this->findModel($_id),
    ]);
  }

  // Create patient (Create)
  public function actionCreate()
  {
    $model = new Patient();

    if ($this->request->isPost) {
      if ($model->load($this->request->post())) {

        // 1. Get uploaded file instance
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        // 2. Validate model and uploaded file in tmp
        if ($model->validate()) {

          // 3. If validation passed - upload permanent file
          if ($model->imageFile) {
            $model->upload();
          }

          // 4. Save without validation (because file already moved)
          $model->save(false);

          return $this->redirect(['view', '_id' => (string)$model->_id]);
        }
      }
    }

    return $this->render('create', [
      'model' => $model,
    ]);
  }

  // Update patient (Update)
  public function actionUpdate($_id)
  {
    $model = $this->findModel($_id);

    if ($this->request->isPost && $model->load($this->request->post())) {

      // Get new uploaded image
      $newImage = UploadedFile::getInstance($model, 'imageFile');

      // Validate model data
      if ($model->validate()) {

        // If new image exists, update it
        if ($newImage) {
          $model->imageFile = $newImage;
          $model->upload();
        }

        // Save without validation
        $model->save(false);

        return $this->redirect(['view', '_id' => (string)$model->_id]);
      }
    }

    return $this->render('update', [
      'model' => $model,
    ]);
  }

  // Delete patient (Delete)
  public function actionDelete($_id)
  {
    $this->findModel($_id)->delete();
    return $this->redirect(['index']);
  }

  // Find model by ID
  protected function findModel($id)
  {
    if (($model = Patient::findOne($id)) !== null) {
      return $model;
    }

    // Not found message (EN)
    throw new NotFoundHttpException('Patient not found.');
  }
}
