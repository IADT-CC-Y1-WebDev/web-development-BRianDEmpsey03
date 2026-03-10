<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

try {
    // Initialize form data and errors
    $data = [];
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'id' => $_POST['id'] ?? null,
        'title' => $_POST['title'] ?? null,
        'author' => $_POST['author'] ?? null,
        'publisher_id' => $_POST['publisher_id'] ?? null,
        'year' => $_POST['year'] ?? null,
        'isbn' => $_POST['isbn'] ?? null,
        'description' => $_POST['description'] ?? null,
        'cover' => $_FILES['cover'] ?? null,
        'format_ids' => $_POST['format_ids'] ?? []
    ];

    // Validation rules – cover is optional
    $rules = [
        'title' => 'required|notempty|min:3|max:255',
        'author' => 'required|notempty|min:3|max:255',
        'publisher_id' => 'required|integer',
        'year' => 'required|integer|minvalue:1900|maxvalue:2026',
        'isbn' => 'required|notempty|length:13',
        'description' => 'required|notempty',
        'cover' => 'file|image|mimes:jpg,jpeg,png|max_file_size:2097152',
        'format_ids' => 'required|array'
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }

    // Find existing book
    $book = Book::findById($data['id']);
    if (!$book) {
        throw new Exception('Book not found.');
    }

    // Verify publisher exists
    $publisher = Publisher::findById($data['publisher_id']);
    if (!$publisher) {
        throw new Exception('Selected publisher does not exist.');
    }

    // Verify formats exist
    foreach ($data['format_ids'] as $formatId) {
        if (!Format::findById($formatId)) {
            throw new Exception('One or more selected formats do not exist.');
        }
    }

    
    $coverFilename = null;
    $uploader = new ImageUpload();
    if ($uploader->hasFile('cover')) {
        // Delete old image
        $uploader->deleteImage($book->cover_filename);
        // Save new image
        $coverFilename = $uploader->process($_FILES['cover']);
        if (!$coverFilename) {
            throw new Exception('Failed to process and save the image.');
        }
    }

    // Update book fields
    $book->title = $data['title'];
    $book->author = $data['author'];
    $book->publisher_id = $data['publisher_id'];
    $book->year = $data['year'];
    $book->isbn = $data['isbn'];
    $book->description = $data['description'];
    if ($coverFilename) {
        $book->cover_filename = $coverFilename;
    }

    // Save book
    $book->save();

    // Update format associations
    BookFormat::deleteByBook($book->id);
    foreach ($data['format_ids'] as $formatId) {
        BookFormat::create($book->id, $formatId);
    }

    
    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Book updated successfully.');
    redirect('book_view.php?id=' . $book->id);

} catch (Exception $e) {
    
    if ($coverFilename) {
        $uploader->deleteImage($coverFilename);
    }

    setFlashMessage('error', 'Error: ' . $e->getMessage());
    setFormData($data);
    setFormErrors($errors);

    // Redirect
    if (isset($data['id']) && $data['id']) {
        redirect('book_edit.php?id=' . $data['id']);
    } else {
        redirect('index.php');
    }
}
?>