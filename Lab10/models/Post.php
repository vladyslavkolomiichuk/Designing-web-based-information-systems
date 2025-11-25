<?php

namespace app\models;

use yii\mongodb\ActiveRecord;

class Post extends ActiveRecord
{
  public static function collectionName()
  {
    return 'posts'; // MongoDB collection name
  }

  public function attributes()
  {
    return [
      '_id',        // Document ID
      'title',      // Post title
      'content',    // Post text
      'published',  // Published flag
      'published_at', // Publish date
    ];
  }

  public function rules()
  {
    return [
      [['title', 'content'], 'required'], // Required fields
      [['title', 'content', 'published_at'], 'string'], // Strings
      [['published'], 'boolean'], // Boolean flag
    ];
  }
}
