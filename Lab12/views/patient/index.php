<?php

use app\models\Patient;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

// Page title
$this->title = 'Patients';
?>
<div class="patient-index">
  <h1><?= Html::encode($this->title) ?></h1>

  <p>
    <!-- Add new patient button -->
    <?= Html::a('Add Patient', ['create'], ['class' => 'btn btn-success']) ?>
  </p>

  <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => ['class' => 'table table-bordered table-dark table-hover'],
    'columns' => [
      ['class' => 'yii\grid\SerialColumn'],

      'name',
      'diagnosis',
      'birth_date',

      [
        'attribute' => 'photo',
        'format' => 'raw',
        'value' => function ($model) {
          // Show image thumbnail or fallback text
          return $model->photo
            ? Html::img($model->photo, ['width' => 50])
            : 'No photo';
        }
      ],

      [
        'class' => ActionColumn::class,
        // Create route using model _id
        'urlCreator' => function ($action, Patient $model) {
          return Url::toRoute([$action, '_id' => (string)$model->_id]);
        }
      ],
    ],
  ]); ?>
</div>