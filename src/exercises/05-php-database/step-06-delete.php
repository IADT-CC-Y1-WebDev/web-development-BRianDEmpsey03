<?php
require_once __DIR__ . '/lib/config.php';
// =============================================================================
// Create PDO connection
// =============================================================================
try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
} 
catch (PDOException $e) {
    echo "<p class='error'>Connection failed: " . $e->getMessage() . "</p>";
    exit();
}
// =============================================================================
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 6: DELETE Operations - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-06-delete.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 6: DELETE Operations</h1>

        <h2>Task</h2>
        <p>Create a temporary book and then delete it.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>Insert a new temporary book</li>
            <li>Display the book's ID</li>
            <li>Delete the book using a prepared statement</li>
            <li>Verify the deletion by trying to fetch it again</li>
        </ol>

        <h3>Your Solution:</h3>
        <div class="output">
            <?php
            // 1. INSERT a temporary book
            $insertSql = "INSERT INTO books (title, author, year) VALUES (:title, :author, :year)";
            $insertStmt = $db->prepare($insertSql);
            $insertStmt->execute([
                ':title'  => 'Temporary Book',
                ':author' => 'Temp Author',
                ':year'   => 2024
            ]);

            // 2. Get the new ID
            $newId = $db->lastInsertId();

            // 3. Display the ID
            echo "<p>Created book with ID: " . $newId . "</p>";

            // 4. DELETE the book
            $deleteSql = "DELETE FROM books WHERE id = :id";
            $deleteStmt = $db->prepare($deleteSql);
            $deleteStmt->execute([':id' => $newId]);

            // 5. Check rowCount
            if ($deleteStmt->rowCount() > 0) {
                echo "<p>Book with ID " . $newId . " was deleted successfully.</p>";
            } else {
                echo "<p>No book was deleted.</p>";
            }

            // 6. Try to fetch the book again to verify deletion
            $fetchSql = "SELECT * FROM books WHERE id = :id";
            $fetchStmt = $db->prepare($fetchSql);
            $fetchStmt->execute([':id' => $newId]);
            $book = $fetchStmt->fetch();

            if ($book) {
                echo "<p>Book still exists (something went wrong).</p>";
            } else {
                echo "<p>Confirmed: book with ID " . $newId . " no longer exists in the database.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
