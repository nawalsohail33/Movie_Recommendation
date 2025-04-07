<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("You must log in to view this page. <a href='login.php'>Login here</a>");
}

// Fetch movie details based on movie ID from URL
if (isset($_GET['id'])) {
    $movie_id = $_GET['id'];
    $sql = "SELECT * FROM movies WHERE id = $movie_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } else {
        die("Movie not found.");
    }
} else {
    die("Invalid movie ID.");
}

// Handle form submission for ratings
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rating'])) {
    $user_id = $_SESSION['user_id'];
    $rating = $_POST['rating'];

    // Check if the user has already rated this movie
    $check_query = "SELECT * FROM user_ratings WHERE user_id = $user_id AND movie_id = $movie_id";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // Update existing rating
        $update_query = "UPDATE user_ratings SET rating = $rating WHERE user_id = $user_id AND movie_id = $movie_id";
        $conn->query($update_query);
        echo "<script>alert('Your rating has been updated!');</script>";
    } else {
        // Insert new rating
        $insert_query = "INSERT INTO user_ratings (user_id, movie_id, rating) VALUES ($user_id, $movie_id, $rating)";
        $conn->query($insert_query);
        echo "<script>alert('Thank you for rating the movie!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $movie['title']; ?> - Movie Details</title>
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

        /* Container for movie details */
        .movie-container {
            width: 100%;
            max-width: 1200px;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.7);
            text-align: center;
        }

        /* Movie Poster */
        .movie-poster {
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
            border-radius: 8px;
        }

        .movie-details {
            margin-top: 20px;
        }

        .movie-details h3 {
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .movie-details p {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .rating-form {
            margin-top: 30px;
        }

        label {
            font-size: 1.2rem;
        }

        input[type="number"] {
            padding: 5px;
            font-size: 1rem;
            width: 60px;
            margin-right: 10px;
            border: 1px solid #e50914;
            background-color: #141414;
            color: #fff;
        }

        button {
            padding: 10px 20px;
            background-color: #e50914;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
        }

        button:hover {
            background-color: #f40612;
        }

        .bottom-links {
            margin-top: 30px;
            text-align: center;
            font-size: 16px;
        }

        .bottom-links a {
            color: #fff;
            font-size: 14px;
            text-decoration: none;
        }

        .bottom-links a:hover {
            text-decoration: underline;
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
    </style>
</head>
<body>
    <div class="navigation-links">
        <a href="movies.php">Back to Movies</a> | 
        <a href="recommendation.php">View Recommended Movies</a> | 
        <a href="logout.php">Logout</a>
    </div>

    <div class="movie-container">
        <h1><?php echo $movie['title']; ?></h1>

       
        
        <div class="movie-details">
            <h3>Genre: <?php echo $movie['genre']; ?></h3>
            <p>Description: <?php echo $movie['description']; ?></p>
            <p>Current Rating: <?php echo $movie['rating']; ?>/10</p>
        </div>

        <!-- Rating Form -->
        <div class="rating-form">
            <form method="POST">
                <label for="rating">Your Rating (0-10): </label>
                <input type="number" name="rating" min="0" max="10" step="0.1" required>
                <button type="submit">Submit Rating</button>
            </form>
        </div>
    </div>

    <div class="bottom-links">
        <p>&copy; 2025 Movie Streaming, Inc. | All Rights Reserved.</p>
    </div>
</body>
</html>
