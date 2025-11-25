<?php

use app\models\Post;

class PostCest
{
  public function _before(\FunctionalTester $I)
  {
    $post = new Post();                // Create test post
    $post->title = 'Functional Test Post';
    $post->content = 'Content visible on page';
    $post->published = true;
    $post->published_at = '2023-11-22 12:00:00';
    $post->save();                     // Save to DB
  }

  public function _after(\FunctionalTester $I)
  {
    Post::deleteAll(['title' => 'Functional Test Post']); // Cleanup
  }

  public function openIndexPage(\FunctionalTester $I)
  {
    $I->amOnPage('/index.php?r=post/index'); // Open posts page

    $I->see('Latest Publications', 'h1');    // Check header

    $I->see('Functional Test Post');         // Test post visible
    $I->see('Content visible on page');
  }

  public function ensureUnpublishedPostsAreHidden(\FunctionalTester $I)
  {
    $draft = new Post();     // Create draft post
    $draft->title = 'Hidden Draft Post';
    $draft->content = 'Should not be seen';
    $draft->published = false;
    $draft->save();

    $I->amOnPage('/index.php?r=post/index'); // Refresh page

    $I->dontSee('Hidden Draft Post');        // Draft should be hidden

    $draft->delete();                        // Cleanup
  }
}
