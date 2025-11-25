<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $posts app\models\Post[] */
/* @var $pagination yii\data\Pagination */

$this->title = 'Blog';
?>

<div class="blog-container">
    <h1 class="page-title">Latest Publications</h1>

    <?php if (empty($posts)): ?>
        <p style="text-align: center; color: #666;">No posts yet.</p>
    <?php else: ?>
        <?php foreach ($posts as $post) : ?>
            <div class="post-card">
                <h2 class="post-title"><?= Html::encode($post->title) ?></h2>
                <p class="post-text"><?= nl2br(Html::encode($post->content)) ?></p>

                <div class="post-meta">
                    <span class="post-author">Author: Admin</span>
                    <?php if ($post->published) : ?>
                        <span class="post-date"><?= Html::encode($post->published_at) ?></span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <?= LinkPager::widget([
            'pagination' => $pagination,
            'options' => ['class' => 'pagination'],
            'prevPageLabel' => '←',
            'nextPageLabel' => '→',
            'disableCurrentPageButton' => true,
        ]) ?>
    <?php endif; ?>
</div>