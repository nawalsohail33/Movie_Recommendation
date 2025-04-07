<?php
// Include database connection
include 'db.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must log in to view recommendations. <a href='login.php'>Login here</a>");
}

$user_id = $_SESSION['user_id'];

// Step 1: Get genres of movies rated 8 or higher by the user
//wo genre select kr k de ga movies table sy aur is m join ki query use kr rhy hain to check user ratings
//against movies to which user has given a rating of more than 8
$sql = "SELECT DISTINCT m.genre 
        FROM movies m 
        JOIN user_ratings ur ON m.id = ur.movie_id 
        WHERE ur.user_id = $user_id AND ur.rating >= 8";

$result = $conn->query($sql);

$genres = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $genres[] = $row['genre'];
    }
}

// Step 2: Get movies from these genres, excluding movies the user has already rated
if (!empty($genres)) {
    //jo hmy us query sy genre mil rha ha usko aik list m daal rhy hain shayad
    $genre_list = "'" . implode("','", $genres) . "'";
    //is query sy jo genre list m movies hain unko display krwa rhy hain but limit bhi lgai ha k recommended
    //movies sirf 10
    $sql = "SELECT * FROM movies 
            WHERE genre IN ($genre_list) 
            AND id NOT IN (SELECT movie_id FROM user_ratings WHERE user_id = $user_id) 
            LIMIT 10";

    $movies_result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended Movies</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #141414;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
        }

        h1 {
            font-size: 3rem;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Navigation links at the top */
        .navigation-links {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        .navigation-links a {
            color: #e50914;
            text-decoration: none;
            margin: 0 10px;
            font-size: 16px;
        }

        .navigation-links a:hover {
            text-decoration: underline;
        }

        /* Container for recommended movies */
        .recommended-movies {
            width: 100%;
            max-width: 1200px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        /* Movie item style */
        .movie-item {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.8);
        }

        .movie-item h3 {
            font-size: 1.5rem;
            color: #fff;
            margin-bottom: 10px;
        }

        .movie-item p {
            font-size: 1rem;
            color: #bbb;
        }

        .movie-item a {
            color: #e50914;
            text-decoration: none;
            font-size: 1.2rem;
            margin-top: 10px;
            display: block;
            font-weight: bold;
        }

        .movie-item a:hover {
            text-decoration: underline;
        }

        /* Message container */
        .message {
            text-align: center;
            font-size: 1.2rem;
            color: #fff;
        }

        .message a {
            color: #e50914;
        }
    </style>
</head>
<body>
    <!-- Navigation Links -->
    <div class="navigation-links">
        <a href="movies.php">Back to Movies</a> | 
        <a href="index.php">Home</a> | 
        <a href="logout.php">Logout</a>
    </div>

    <h1>Recommended Movies</h1>

    <?php
    // Display the genres
    if (!empty($genres)) {
        echo "<p>Recommended based on your favorite genres: " . implode(", ", $genres) . "</p>";
    } else {
        echo "<p class='message'>You haven't rated any movies yet! Please rate some movies to get recommendations. <a href='movies.php'>Rate Movies</a></p>";
    }

    // Display recommended movies
    if (isset($movies_result) && $movies_result->num_rows > 0) {
        echo "<div class='recommended-movies'>";
        while ($movie = $movies_result->fetch_assoc()) {
            echo "<div class='movie-item'>";
            echo "<h3>" . htmlspecialchars($movie['title']) . "</h3>";
            echo "<p>" . htmlspecialchars($movie['genre']) . "</p>";
            echo "<p>" . htmlspecialchars($movie['description']) . "</p>";
            echo "<a href='movie_details.php?id=" . $movie['id'] . "'>View Details</a>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        if (!empty($genres)) {
            echo "<p class='message'>No recommendations available. Try rating more movies!</p>";
        }
    }
    ?>
</body>
</html>
