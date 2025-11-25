<?php

namespace tests\unit\models;

use app\models\Post;

class PostTest extends \Codeception\Test\Unit
{
  /**
   * @var \UnitTester
   */
  protected $tester;

  protected function _before()
  {
    Post::deleteAll(['title' => 'Test Unit Post']); // Cleanup before test
  }

  protected function _after()
  {
    Post::deleteAll(['title' => 'Test Unit Post']); // Cleanup after test
  }

  public function testValidation()
  {
    $post = new Post();

    $this->assertFalse($post->validate(), 'Model should be invalid without data');

    $this->assertArrayHasKey('title', $post->getErrors(), 'Title error expected');
    $this->assertArrayHasKey('content', $post->getErrors(), 'Content error expected');
  }

  public function testSave()
  {
    $post = new Post();
    $post->title = 'Test Unit Post';
    $post->content = 'This is a test content for unit testing.';
    $post->published = true;
    $post->published_at = date('Y-m-d H:i:s');

    $this->assertTrue($post->save(), 'Post should save successfully');

    $savedPost = Post::find()->where(['title' => 'Test Unit Post'])->one();
    $this->assertNotNull($savedPost, 'Post should be found in DB');
    $this->assertEquals('Test Unit Post', $savedPost->title);
  }
}
