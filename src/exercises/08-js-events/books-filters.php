<?php
$books = [
  ["title" => "The Great Gatsby",    "author" => "F. Scott Fitzgerald", "year" => 1925],
  ["title" => "1984",                "author" => "George Orwell",        "year" => 1949],
  ["title" => "To Kill a Mockingbird","author" => "Harper Lee",          "year" => 1960],
  ["title" => "Harry Potter",        "author" => "J.K. Rowling",         "year" => 1997],
  ["title" => "The Road",            "author" => "Cormac McCarthy",      "year" => 2006],
  ["title" => "Twilight",            "author" => "Stephenie Meyer",      "year" => 2005],
  ["title" => "Moby Dick",           "author" => "Herman Melville",      "year" => 1851],
  ["title" => "The Hunger Games",    "author" => "Suzanne Collins",      "year" => 2008],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Books Filter</title>
</head>
<body>

  <h1>Books</h1>

  <form id="filter-form">
    <input type="text" name="title_filter" placeholder="Search by title" />

    <select name="year_filter">
      <option value="all">All years</option>
      <option value="before2000">Before 2000</option>
      <option value="from2000">2000 and later</option>
    </select>

    <button type="button" id="apply-btn">Apply Filters</button>
    <button type="button" id="clear-btn">Clear Filters</button>
  </form>

  <div id="book-list">
    <?php foreach ($books as $book): ?>
      <div class="book-card"
           data-title="<?= htmlspecialchars($book['title']) ?>"
           data-author="<?= htmlspecialchars($book['author']) ?>"
           data-year="<?= $book['year'] ?>">
        <h3><?= htmlspecialchars($book['title']) ?></h3>
        <p><?= htmlspecialchars($book['author']) ?></p>
        <p><?= $book['year'] ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <script src="books-filters.js"></script>
</body>
</html>