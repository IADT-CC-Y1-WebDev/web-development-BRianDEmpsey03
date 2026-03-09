<?php
try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    
    $data = [
        'title' => $_POST['title'] ?? null,
        'author' => $_POST['author'] ?? null,
        'publisher_id' => $_POST['publisher_id'] ?? null,
        'year' => $_POST['year'] ?? null,
        'isbn' => $_POST['isbn'] ?? null,
        'description' => $_POST['description'] ?? null,
        'cover' => $_FILES['cover'] ?? null,
        'format_ids' => $_POST['format_ids'] ?? []
                 
    ];

    
    $rules = [
        'title' => 'required|notempty|min:3|max:255',
        'author' => 'required|notempty|min:3|max:255',
        'publisher_id' => 'required|integer',
        'year' => 'required|integer|minvalue:1900|maxvalue:2026',
        'isbn' => 'required|notempty|length:13',
        'description' => 'required|notempty',
        'cover' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:2097152', 
        'format_ids' => 'required|array'
    ];

    
    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }

    
    $uploader = new ImageUpload();
    $coverFilename = $uploader->process($data['cover']);

    
    $book = new Book();
    $book->title = $data['title'];
    $book->author = $data['author'];
    $book->publisher_id = $data['publisher_id'];
    $book->year = $data['year'];
    $book->isbn = $data['isbn'];
    $book->description = $data['description'];
    $book->cover_filename = $coverFilename;

   
    $book->save();

   
    foreach ($data['format_ids'] as $formatId) {
        $book->addFormat($formatId);
    }

    
    setFlashMessage('success', 'Book created successfully!');
    redirect('book_create.php');

} catch (Exception $e) {
    
    setFormErrors($errors ?? []);
    setFormData($data);
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('book_create.php');
}
?>