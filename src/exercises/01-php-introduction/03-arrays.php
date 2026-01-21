<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/03-arrays.php">View Example &rarr;</a>
    </div>

    <h1>Arrays Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Favorite Movies</h2>
    <p>
        <strong>Task:</strong> 
        Create an indexed array with 5 of your favorite movies. Use a for 
        loop to display each movie with its position (e.g., "Movie 1: 
        The Matrix").
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $movies = ['null','Shawshank redemption', 'Mulholland Drive', 'goodfellas', 'live at the Rose Bowl', 'The Doors'];
        echo "<ul>";
        for ($i = 1; $i < count($movies); $i++) {
        echo "<li>Movie $i: $movies[$i]</li>";
        }
        echo "</ul>";
        
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Student Record</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array for a student with keys: name, studentId, 
        course, and grade. Display this information in a formatted sentence.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $student = [
            "name" => "William Miller",
            "studentId" => "10572498",
            "course" => "Computing",
            "grade" => "B-"
        ];

        $text = "{$student['name']}'s student ID is {$student['studentId']}" .
        " and his course is {$student['course']}. He got a {$student['grade']}.";

        print("<p>$text</p>");
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Country Capitals</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array with at least 5 countries as keys and their 
        capitals as values. Use foreach to display each country and capital 
        in the format "The capital of [country] is [capital]."
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $countries = [
            "Ireland" => "Dublin",
            "England" => "London",
            "Spain" => "Madrid",
            "China" => "Beijing",
            "France" => "Paris"
        ];

        echo "<ul>";
        foreach ($countries as $country => $capital){
            echo "<li>$capital is the capital of $country";
        }
        echo "</ul>";
        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Menu Categories</h2>
    <p>
        <strong>Task:</strong> 
        Create a nested array representing a restaurant menu with at least 
        2 categories (e.g., "Starters", "Main Course"). Each category should 
        have at least 3 items with prices. Display the menu in an organized 
        format.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        
        $menu = [
            'starters'=>[
                'wings' => "£10.99",
                'soup' => "£8.99",
                'bread' => "£7.99",
                'prawns' => "£15.99",
                'potatoes' => "£14.99"
            ],
            'mains'=>[
                'steak' => "£40.00",
                'pasta' => "£25.00",
                'sausage' => "£16.00",
                'turkey ass' => "£1000.00"
            ],
            'deserts'=>[
                'ice cream' => "£5.00",
                'truffles' => "£8.99",
                'brownie' => "£10.99"
        
            ]
         ];

         foreach ($menu as $section => $items){
            echo "<p>" . ucfirst($section) . " menu:</p>";
            echo "<ul>";
            foreach ($items as $key => $value) {
                echo "<li>$key\t($value)</li>";
            }
            echo "</ul>";
         }

        ?>
    </div>

</body>
</html>
