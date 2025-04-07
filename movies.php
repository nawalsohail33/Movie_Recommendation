<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("You must log in to view this page. <a href='login.php'>Login here</a>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies - Netflix</title>
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
            min-height: 100vh;
            flex-direction: column;
        }

        /* Navigation bar styling */
        .navbar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .navbar a {
            color: #e50914;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #e50914;
            color: #fff;
        }

        h1 {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 20px;
            color: #e50914; /* Netflix's signature red */
        }

        /* Grid for displaying movies */
        .movie-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        .movie-item {
            position: relative;
            width: 100%;
            height: 200px;
            background-image: url('images.jpg'); /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            align-items: flex-end;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .movie-item:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.8);
        }

        .movie-item h3 {
            background: rgba(0, 0, 0, 0.7);
            color: #e50914;
            padding: 10px;
            margin: 0;
            text-align: center;
            width: 100%;
            font-size: 1.2rem;
        }
        h3,a{
          color: #e50914;
          text-decoration: none;
        }
        .movie-container {
            width: 90%;
            max-width: 1200px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 8px;
            margin-top: 20px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <h1>Available Movies</h1>
    <div class="navbar">
        <a href="index.php">Back to Home</a>
        <a href="recommendation.php">View Recommended Movies</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="movie-container">
        <div class="movie-grid">
            <?php
            // Display movies in grid format with clickable links
            $sql = "SELECT * FROM movies";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='movie-item' style='background-image: url(images.jpg);'>"; // Replace with movie-specific image if available
                    echo "<h3><a href='movie_details.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></h3>";
                    echo "</div>";
                }
            } else {
                echo "<p>No movies available.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
