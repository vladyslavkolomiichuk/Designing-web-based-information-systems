<?php

use MongoDB\BSON\ObjectId;
use MongoDB\Exception\InvalidArgumentException;

class Model
{
  private $booksCollection;
  private $authorsCollection;

  public function __construct()
  {
    // DB connection setup
    $connectionString = "";
    $dbName = "lab8_php";

    $booksCollectionName = "books";
    $authorsCollectionName = "authors";

    try {
      // Connect to MongoDB
      $client = new MongoDB\Client($connectionString);
      $db = $client->$dbName;
      $this->booksCollection = $db->$booksCollectionName;
      $this->authorsCollection = $db->$authorsCollectionName;
    } catch (Exception $e) {
      // Connection error
      die("Error connecting to MongoDB: " . $e->getMessage());
    }
  }

  // Get list of books with authors
  public function getBookList($search_title = null, $search_author = null)
  {
    // Init empty filter
    $bookFilter = new stdClass();
    $authorIds = [];

    // Filter by author
    if (!empty($search_author)) {
      $author_regex = ['$regex' => $search_author, '$options' => 'i'];
      $authorFilter = [
        '$or' => [
          ['first_name' => $author_regex],
          ['last_name' => $author_regex]
        ]
      ];

      // Find authors
      $cursor = $this->authorsCollection->find($authorFilter, ['projection' => ['_id' => 1]]);
      foreach ($cursor as $author) {
        $authorIds[] = $author->_id;
      }

      // Return empty if no authors
      if (empty($authorIds)) {
        return [];
      }

      // Filter by author IDs
      $bookFilter->author_id = ['$in' => $authorIds];
    }

    // Filter by title
    if (!empty($search_title)) {
      $bookFilter->title = ['$regex' => $search_title, '$options' => 'i'];
    }

    // Build aggregation pipeline
    $pipeline = [
      ['$match' => $bookFilter],
      [
        '$lookup' => [
          'from' => 'authors',
          'localField' => 'author_id',
          'foreignField' => '_id',
          'as' => 'author'
        ]
      ],
      [
        '$unwind' => [
          'path' => '$author',
          'preserveNullAndEmptyArrays' => true
        ]
      ]
    ];

    // Execute aggregation
    $cursor = $this->booksCollection->aggregate($pipeline);
    return $cursor->toArray();
  }

  // Get single book by ID
  public function getBook($id_string)
  {
    try {
      // Convert string to ObjectId
      $objectId = new ObjectId($id_string);

      // Aggregation pipeline for one book
      $pipeline = [
        ['$match' => ['_id' => $objectId]],
        [
          '$lookup' => [
            'from' => 'authors',
            'localField' => 'author_id',
            'foreignField' => '_id',
            'as' => 'author'
          ]
        ],
        [
          '$unwind' => [
            'path' => '$author',
            'preserveNullAndEmptyArrays' => true
          ]
        ]
      ];

      // Run aggregation
      $cursor = $this->booksCollection->aggregate($pipeline);
      $result = $cursor->toArray();

      // Return first result or null
      return $result[0] ?? null;
    } catch (InvalidArgumentException $e) {
      // Invalid ID
      return null;
    }
  }
}
