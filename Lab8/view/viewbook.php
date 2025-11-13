<html>

<head>
  <title><?php echo htmlspecialchars($book->title); ?></title>
  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      background-color: #ffffff;
      color: #000000;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 800px;
      margin: auto;
      background-color: #f5f5f5;
      padding: 30px;
      border-radius: 8px;
      border: 1px solid #cccccc;
    }

    img {
      max-width: 300px;
      border-radius: 8px;
      border: 1px solid #cccccc;
      float: right;
      margin-left: 20px;
      margin-bottom: 20px;
    }

    h1 {
      color: #000000;
      margin-top: 0;
      border-bottom: 2px solid #000000;
      padding-bottom: 10px;
    }

    p {
      line-height: 1.6;
      font-size: 16px;
    }

    strong {
      color: #000000;
      font-weight: bold;
    }

    .back-link {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 15px;
      background-color: #eeeeee;
      color: #000000;
      text-decoration: none;
      border-radius: 4px;
      font-weight: bold;
      border: 1px solid #999999;
    }

    .back-link:hover {
      background-color: #dddddd;
    }
  </style>
</head>

<body>
  <div class="container">
    <?php
    // $book variable comes from Controller
    if (!empty($book->cover)) {
      // Display book cover
      echo '<img src="images/' . htmlspecialchars($book->cover) . '" alt="Cover for ' . htmlspecialchars($book->title) . '">';
    }

    // Book title
    echo '<h1>' . htmlspecialchars($book->title) . '</h1>';

    // Author info (merged in Model)
    $author_name = htmlspecialchars($book->author->first_name ?? '') . ' ' . htmlspecialchars($book->author->last_name ?? '');
    $author_country = htmlspecialchars($book->author->country ?? 'Unknown');

    // Display book details
    echo '<p><strong>Author:</strong> ' . (trim($author_name) ?: 'N/A') . '</p>';
    echo '<p><strong>Country:</strong> ' . $author_country . '</p>';
    echo '<p><strong>Year:</strong> ' . htmlspecialchars($book->year ?? 'N/A') . '</p>';
    echo '<p><strong>Pages:</strong> ' . htmlspecialchars($book->pages ?? 'N/A') . '</p>';
    echo '<p><strong>Description:</strong><br/>' . nl2br(htmlspecialchars($book->description ?? '')) . '</p>';
    ?>

    <!-- Back to list -->
    <div style="clear: both;"></div>
    <a href="index.php" class="back-link">&larr; Back to list</a>
  </div>
</body>

</html>