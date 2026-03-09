<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

try {
    $books = Book::findAll();
    
}
catch (PDOException $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/index.php');
}

$publishers = [
    ['id' => 1, 'name' => 'Penguin Random House'],
    ['id' => 2, 'name' => 'HarperCollins'],
    ['id' => 3, 'name' => 'Simon & Schuster'],
    ['id' => 4, 'name' => 'Hachette Book Group'],
    ['id' => 5, 'name' => 'Macmillan Publishers'],
    ['id' => 6, 'name' => 'Scholastic Corporation'],
    ['id' => 7, 'name' => 'O\'Reilly Media']
];

$formats = [
    ['id' => 1, 'name' => 'Hardcover'],
    ['id' => 2, 'name' => 'Paperback'],
    ['id' => 3, 'name' => 'Ebook'],
    ['id' => 4, 'name' => 'Audiobook']
];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>View Book</title>
    </head>
    <body>
        <div class="container"> 
            <div class="width-12">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>
            <div class="width-12">
                <h1>Create Book</h1>
            </div>
            <div class="width-12"> 
                <form action="book_store.php" method="POST" enctype="multipart/form-data" novlidate>

                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="<?= old('title') ?>" required>
                        <?php if (error('title')): ?>
                            <p class="error"><?= error('title') ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="author">Author:</label>
                        <input type="text" id="author" name="author" value="<?= old('author') ?>" required>
                        <?php if (error('author')): ?>
                            <p class="error"><?= error('author') ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="publisher_id">Publisher:</label>
                        <select id="publisher_id" name="publisher_id" required>
                            <option value="">-- Select Publisher --</option>
                            <?php foreach ($publishers as $publisher): ?>
                                <option value="<?= $publisher['id'] ?>" 
                                    <?= chosen('publisher_id', $publisher['id']) ? 'selected' : '' ?>>
                                    <?= h($publisher['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (error('publisher_id')): ?>
                            <p class="error"><?= error('publisher_id') ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="year">Year:</label>
                        <input type="number" id="year" name="year" min="1900" max="2026" value="<?= old('year') ?>" required>
                        <?php if (error('year')): ?>
                            <p class="error"><?= error('year') ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="isbn">ISBN:</label>
                        <input type="text" id="isbn" name="isbn" value="<?= old('isbn') ?>" maxlength="13" required>
                        <?php if (error('isbn')): ?>
                            <p class="error"><?= error('isbn') ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" required><?= old('description') ?></textarea>
                        <?php if (error('description')): ?>
                            <p class="error"><?= error('description') ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="cover">Cover:</label>
                        <input type="file" id="cover" name="cover" accept="image/*" required>
                        <?php if (error('cover')): ?>
                            <p class="error"><?= error('cover') ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Formats:</label>
                        <?php foreach ($formats as $format): ?>
                            <label>
                                <input type="checkbox"
                                    name="format_ids[]"
                                    value="<?= $format['id'] ?>"
                                    <?= chosen('format_ids', $format['id']) ? 'checked' : '' ?>>
                                <?= h($format['name']) ?>
                            </label>
                        <?php endforeach; ?>
                        <?php if (error('format_ids')): ?>
                            <p class="error"><?= error('format_ids') ?></p>
                        <?php endif; ?>
                    </div>

                    <button type="submit">Create Book</button>
                </form>
            </div>
        </div>
<?php

clearFormData();
clearFormErrors();
?>