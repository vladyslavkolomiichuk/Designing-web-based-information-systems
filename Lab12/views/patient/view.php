<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// Page title with patient name
$this->title = $model->name;
?>
<div class="patient-view">
  <h1><?= Html::encode($this->title) ?></h1>

  <p>
    <!-- Edit button -->
    <?= Html::a('Edit', ['update', '_id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>

    <!-- Delete button with confirmation -->
    <?= Html::a('Delete', ['delete', '_id' => (string)$model->_id], [
      'class' => 'btn btn-danger',
      'data' => [
        'confirm' => 'Are you sure?',
        'method' => 'post',
      ],
    ]) ?>
  </p>

  <div class="row">
    <div class="col-md-4">
      <?php if ($model->photo): ?>
        <!-- Show patient photo -->
        <?= Html::img($model->photo, ['class' => 'img-fluid rounded', 'style' => 'max-width:100%']) ?>
      <?php else: ?>
        <!-- No photo alert -->
        <div class="alert alert-warning">No photo available</div>
      <?php endif; ?>
    </div>

    <div class="col-md-8">
      <!-- Patient details -->
      <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-striped table-bordered table-dark'],
        'attributes' => [
          '_id',
          'name',
          'diagnosis',
          'birth_date',
        ],
      ]) ?>
    </div>
  </div>
</div>