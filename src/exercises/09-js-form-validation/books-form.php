<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add a Book</title>
  <style>
    .error { color: red; font-size: 0.9em; }
    .error-summary { border: 1px solid red; padding: 10px; margin-bottom: 15px; color: red; }
    label { display: block; margin-top: 10px; }
  </style>
</head>
<body>

  <h1>Add a Book</h1>

  <div id="error_summary_top" class="error-summary" style="display:none" role="alert"></div>

  <form id="book_form" novalidate>

    <label for="title">Title</label>
    <input type="text" id="title" name="title" />
    <span id="title_error" class="error"></span>

    <label for="author">Author</label>
    <input type="text" id="author" name="author" />
    <span id="author_error" class="error"></span>

    <label for="year">Year</label>
    <input type="number" id="year" name="year" />
    <span id="year_error" class="error"></span>

    <label for="isbn">ISBN</label>
    <input type="text" id="isbn" name="isbn" />
    <span id="isbn_error" class="error"></span>

    <label for="description">Description</label>
    <textarea id="description" name="description"></textarea>
    <span id="description_error" class="error"></span>

    <br /><br />
    <button type="button" id="submit_btn">Submit</button>

  </form>

  <script src="books-form.js"></script>
</body>
</html>