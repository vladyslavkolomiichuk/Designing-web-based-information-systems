<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Post;

class PostController extends Controller
{
  public function actionIndex()
  {
    $query = Post::find()->where(['published' => true]); // Only published posts

    $pagination = new Pagination([
      'defaultPageSize' => 5,          // Posts per page
      'totalCount' => $query->count(), // Total items
    ]);

    $posts = $query->orderBy(['published_at' => SORT_DESC]) // Latest first
      ->offset($pagination->offset)
      ->limit($pagination->limit)
      ->all();

    return $this->render('index', [
      'posts' => $posts,         // Post list
      'pagination' => $pagination, // Pagination object
    ]);
  }
}
