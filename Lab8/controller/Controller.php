<?php
// Load model file
include_once(__DIR__ . '/../model/Model.php');

class Controller
{
  public $model;

  public function __construct()
  {
    // Init model
    $this->model = new Model();
  }

  public function invoke()
  {
    // Check if book ID exists
    if (isset($_GET['id'])) {
      // Get book by ID
      $book = $this->model->getBook((string)$_GET['id']);

      if ($book) {
        // Show single book view
        include __DIR__ . '/../view/viewbook.php';
      } else {
        // Handle missing book
        echo "Error: Book not found.";
      }
    } else {
      // No ID - show all books

      // Read search filters
      $search_title = $_GET['search_title'] ?? null;
      $search_author = $_GET['search_author'] ?? null;

      // Fetch filtered book list
      $books = $this->model->getBookList($search_title, $search_author);

      // Show book list view
      include __DIR__ . '/../view/booklist.php';
    }
  }
}
