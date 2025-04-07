<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: movies.php');
        } else {
            echo "<script>alert('Incorrect password.');</script>";
        }
    } else {
        echo "<script>alert('No user found with that username.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix - Login</title>
   <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Helvetica Neue', sans-serif;
    background-color: #141414;
    background-image: url('https://assets.nflxext.com/ffe/siteui/vlv3/4e88f249-5187-488b-a8c1-0988bcff9f26.jpg'); /* Netflix background image */
    background-size: cover;
    background-position: center center;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
}

.login-container {
    background-color: rgba(0, 0, 0, 0.75);
    padding: 40px 50px;
    border-radius: 8px;
    width: 100%;
    max-width: 420px;
    text-align: center;
}

.login-form h1 {
    font-size: 3rem;
    margin-bottom: 20px;
    color: #fff;
}

.login-form input {
    width: 100%;
    padding: 15px;
    margin: 10px 0;
    background-color: rgba(109, 109, 109, 0.8);
    border: 1px solid #333;
    color: #fff;
    font-size: 16px;
    border-radius: 5px;
}

.login-form button {
    width: 100%;
    padding: 15px;
    background-color: #e50914;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    margin-top: 15px;
}

.login-form button:hover {
    background-color: #f40612;
}

.bottom-links a {
    color: #fff;
    font-size: 14px;
    text-decoration: none;
    display: block;
    margin-top: 15px;
}

.bottom-links a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .login-container {
        padding: 30px 40px;
        max-width: 350px;
    }
}

    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h1>Sign In</h1>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit">Sign In</button>
            </form>
            <div class="bottom-links">
                <a href="register.php">New to Netflix? Sign up now.</a><br>
                <a href="#">Need help?</a>
            </div>
        </div>
    </div>
</body>
</html>
