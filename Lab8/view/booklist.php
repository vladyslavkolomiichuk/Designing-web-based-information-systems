<html>

<head>
  <title>Book List</title>
  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      background-color: #ffffff;
      color: #000000;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 900px;
      margin: auto;
    }

    h2 {
      color: #000000;
      border-bottom: 2px solid #000000;
      padding-bottom: 5px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
      background-color: #f5f5f5;
    }

    th,
    td {
      border: 1px solid #cccccc;
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #eeeeee;
    }

    img {
      max-width: 50px;
      border-radius: 4px;
    }

    a {
      color: #000000;
      text-decoration: underline;
    }

    a:hover {
      text-decoration: none;
    }

    .search-form {
      background-color: #f5f5f5;
      padding: 20px;
      border-radius: 8px;
      border: 1px solid #cccccc;
      display: flex;
      gap: 15px;
      align-items: center;
    }

    .search-form input[type="text"] {
      background-color: #ffffff;
      color: #000000;
      border: 1px solid #999999;
      padding: 8px 12px;
      border-radius: 4px;
      flex-grow: 1;
    }

    .search-form input[type="submit"],
    .btn-reset {
      background-color: #eeeeee;
      color: #000000;
      font-weight: bold;
      border: 1px solid #999999;
      padding: 9px 15px;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      font-size: 14px;
    }

    .btn-reset {
      background-color: #f5f5f5;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Search Books</h2>
    <div class="search-form">
      <!-- Search form -->
      <form action="index.php" method="GET" style="display: contents;">
        Title:
        <input type="text" name="search_title" value="<?php echo htmlspecialchars($_GET['search_title'] ?? '', ENT_QUOTES); ?>">
        Author:
        <input type="text" name="search_author" value="<?php echo htmlspecialchars($_GET['search_author'] ?? '', ENT_QUOTES); ?>">
        <input type="submit" value="Search">
      </form>
      <!-- Reset button -->
      <a href="index.php" class="btn-reset">Reset</a>
    </div>

    <h2>Book List</h2>
    <table>
      <thead>
        <tr>
          <th>Title</th>
          <th>Author</th>
          <th>Year</th>
          <th>Pages</th>
          <th>Cover</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // $books variable comes from Controller
        foreach ($books as $book) {
          echo '<tr>';
          // Link to book detail
          echo '<td><a href="index.php?id=' . $book->_id . '">' . htmlspecialchars($book->title) . '</a></td>';

          // Author info (merged in Model)
          $author_name = htmlspecialchars($book->author->first_name ?? '') . ' ' . htmlspecialchars($book->author->last_name ?? '');
          echo '<td>' . (trim($author_name) ?: 'N/A') . '</td>';

          // Book details
          echo '<td>' . htmlspecialchars($book->year ?? 'N/A') . '</td>';
          echo '<td>' . htmlspecialchars($book->pages ?? 'N/A') . '</td>';
          echo '<td>';
          // Display cover if exists
          if (!empty($book->cover)) {
            // Make sure you have 'public/images/' folder
            echo '<img src="images/' . htmlspecialchars($book->cover) . '" alt="Cover">';
          }
          echo '</td>';
          echo '</tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>