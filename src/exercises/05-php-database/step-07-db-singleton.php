<?php
require_once __DIR__ . '/lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 7: Database Singleton - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-07-db-singleton.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 7: Database Singleton Class</h1>

        <h2>Task</h2>
        <p>Use the DB singleton class to get database connections.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>Get a connection using <code>DB::getInstance()->getConnection()</code></li>
            <li>Execute a simple query to count books</li>
            <li>Prove it's a singleton by getting the instance twice and comparing</li>
        </ol>

        <h3>Your Solution:</h3>
        <div class="output">
            <?php
            // 1. Get connection via singleton
            $db = DB::getInstance()->getConnection();

            // 2. Execute count query
            $stmt = $db->prepare("SELECT COUNT(*) as total FROM books");
            $stmt->execute();
            $row = $stmt->fetch();

            // 3. Display the count
            echo "<p>Total books in database: " . $row['total'] . "</p>";

            // 4. Get the instance twice and compare
            $instanceOne = DB::getInstance();
            $instanceTwo = DB::getInstance();

            // 5. Check if they are the same instance
            if ($instanceOne === $instanceTwo) {
                echo "<p>Same instance: YES — singleton is working correctly.</p>";
            } else {
                echo "<p>Same instance: NO — something is wrong.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
