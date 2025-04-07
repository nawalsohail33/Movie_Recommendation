<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the username already exists
    //yeh query check kr rhi ha k jo username daala ha wo pehly sy to nhi use hua
    $checkUsername = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($checkUsername);

    if ($result->num_rows > 0) {
        // If username is taken, show an alert
        echo "<script>alert('Username is already taken. Please choose another one.');</script>";
    } else {
        // Proceed with registration if username is unique
        $sql = "INSERT INTO users (full_name, username, password) VALUES ('$full_name', '$username', '$password')";

        if ($conn->query($sql)) {
            // If registration is successful, show an alert
            echo "<script>alert('Registration successful! You can now log in.'); window.location.href = 'login.php';</script>";
        } else {
            // Show an error message if the query fails
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #000;  /* Set the background to black */
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            background: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            width: 500px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.7);
        }

        .register-container h1 {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 600;
            color: red;
        }

        .register-container input {
            width: 100%;
            padding: 14px;
            margin: 8px 0;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #555;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
        }

        .register-container button {
            width: 100%;
            padding: 14px;
            background: red;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .register-container button:hover {
            background: darkred;
        }

        .register-container a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
            display: inline-block;
        }

        .register-container a:hover {
            color: red;
        }

        .header {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.6);
        }

        .header .logo {
            font-size: 28px;
            font-weight: bold;
            color: red;
        }

        .header nav a {
            margin: 0 15px;
            text-decoration: none;
            color: white;
            font-size: 18px;
            transition: color 0.3s;
        }

        .header nav a:hover {
            color: red;
        }

        /* Success and Error Message Styling */
        .success-message, .error-message {
            background: rgba(0, 255, 0, 0.2);
            padding: 15px;
            margin-top: 20px;
            text-align: center;
            border-radius: 5px;
            font-size: 18px;
            color: #fff;
            font-weight: bold;
        }

        .success-message {
            background: rgba(0, 255, 0, 0.2);
        }

        .error-message {
            background: rgba(255, 0, 0, 0.2);
        }

        .success-message a, .error-message a {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }

        .success-message a:hover, .error-message a:hover {
            color: white;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div class="logo">NETFLIX</div>
        <nav>
            <a href="login.php">Sign In</a>
            <a href="signup.php">Sign Up</a>
        </nav>
    </div>

    <!-- Registration Form -->
    <div class="register-container">
        <h1>Create Account</h1>
        <form method="POST">
            <input type="text" name="full_name" placeholder="Full Name" required><br>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>
        <a href="index.php">Back to Home</a>
    </div>

</body>
</html>
