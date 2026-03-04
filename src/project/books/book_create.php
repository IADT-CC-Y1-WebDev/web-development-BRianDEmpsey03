<form action="book_store.php" method="POST">

    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
    </div>

    <div class="form-group">
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>
    </div>

    <div class="form-group">
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" min="0" max="<?= date('Y') ?>" required>
    </div>

    <div class="form-group">
        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" required>
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
    </div>

    <button type="submit">Create Book</button>
</form>