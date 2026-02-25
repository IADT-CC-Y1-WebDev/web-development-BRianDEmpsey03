<?php
// =============================================================================
// Exercise 8-10: Book Active Record Class
//
// TODO: Implement this class following the Active Record pattern.
//
// The class should represent the 'books' table with these columns:
// - id (INT, auto-increment primary key)
// - title (VARCHAR)
// - author (VARCHAR)
// - publisher_id (INT, foreign key to publishers table)
// - year (INT)
// - isbn (VARCHAR)
// - description (TEXT)
// - cover_filename (VARCHAR)
//
// Required methods:
// - __construct($data = []) - Hydrate object from data array
// - findAll() - Static method returning all books
// - findById($id) - Static method returning single book or null
// - findByPublisher($publisherId) - Static method returning books by publisher
// - save() - Instance method to INSERT or UPDATE
// - delete() - Instance method to DELETE
// - toArray() - Instance method to convert to array
// =============================================================================
class Book
{
    // public properties for each database column
    public $id;
    public $title;
    public $author;
    public $publisher_id;
    public $year;
    public $isbn;
    public $description;
    public $cover_filename;

    // private $db property for database connection
    private $db;

    // =========================================================================
    // Exercise 8: Book Class Basics
    // =========================================================================
    public function __construct($data = [])
    {


        // TODO: Get database connection from DB singleton
        $this->db = DB::getInstance()->getConnection();
        // TODO: If $data is not empty, populate properties using null coalescing operator
        if(!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->title = $data['title'] ?? null;
            $this->author = $data['author'] ?? null;
            $this->publisher_id = $data['publisher_id'] ?? null;
            $this->year = $data['year'] ?? null;
            $this->isbn = $data['isbn'] ?? null;
            $this->description = $data['description'] ?? null;
            $this->cover_filename = $data['cover_filename'] ?? null;
        }
    }

    

    // =========================================================================
    // Exercise 9: Finder Methods
    // =========================================================================
    public static function findAll()
    {
    $db = DB::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT * FROM books ORDER BY title");
    $stmt->execute();

    $books = [];
    while ($row = $stmt->fetch()) {
        $books[] = new Book($row);
    }

    return $books;
    }

    // Usage:
    // $games = Book::findAll();
    // foreach ($books as $book) {
    //     echo $book->title;
    // }

    // =========================================================================
    // Exercise 9: Finder Methods
    // =========================================================================
    public static function findById($id)
    {
    $db = DB::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
    $stmt->execute(['id' => $id]);

    $row = $stmt->fetch();
    if ($row) {
        return new Book($row);
    }

    return null;  // Return null if not found
    }

    // Usage:
    // $book = Book::findById(1);
    // if ($book) {
    //     echo $book->title;
    // } else {
    //     echo "Book not found";
    // }

    // =========================================================================
    // Exercise 9: Finder Methods
    // =========================================================================
    public static function findByPublisher($publisherId)
    {
    $db = DB::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT * FROM books WHERE publisher_id = :publisher_id ORDER BY title");
    $stmt->execute(['publisher_id' => $publisherId]);

    $books = [];
    while ($row = $stmt->fetch()) {
        $books[] = new Book($row);
    }

    return $books;
    }

    // =========================================================================
    // Exercise 10: Complete Active Record
    // =========================================================================
    public function save()
    {
    if ($this->id) {
        // Update existing record
        $stmt = $this->db->prepare("
            UPDATE books
            SET title = :title,
                author = :author,
                publisher_id = :publisher_id,
                year = :year,
                isbn = :isbn,
                description = :description,
                cover_filename = :cover_filename
            WHERE id = :id
        ");


        $params = [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'publisher_id' => $this->publisher_id,
            'year' => $this->year,
            'isbn' => $this->isbn,
            'description' = $this->description,
            'cover_filename' = $this->cover_filename
        ];
        } else {
            // Insert new record
            $stmt = $this->db->prepare("
                INSERT INTO books (title, author, publisher_id, year, isbn, description, cover_filename)
                VALUES (:title, :author, :publisher_id, :year, :isbn, :description, :cover_filename)
            ");

            $params = [
            'title' => $this->title,
            'author' => $this->author,
            'publisher_id' => $this->publisher_id,
            'year' => $this->year,
            'isbn' => $this->isbn,
            'description' = $this->description,
            'cover_filename' = $this->cover_filename
        ];
        }

        $status = $stmt->execute($params);

        if (!$status || $stmt->rowCount() !== 1) {
            throw new Exception("Failed to save book.");
        }

        // Set ID for new records
        if ($this->id === null) {
            $this->id = $this->db->lastInsertId();
        }
    }

    // =========================================================================
    // Exercise 10: Complete Active Record
    // =========================================================================
    public function delete()
    {
    if (!$this->id) {
        return false;  // Can't delete unsaved game
    }

    $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
    return $stmt->execute(['id' => $this->id]);
    }


    // =========================================================================
    // Exercise 8: Book Class Basics
    // =========================================================================
    public function toArray()
    {
        return[
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'publisher_id' => $this->publisher_id,
            'year' => $this->year,
            'isbn' => $this->isbn,
            'description' = $this->description,
            'cover_filename' = $this->cover_filename
        ]
    }
}
