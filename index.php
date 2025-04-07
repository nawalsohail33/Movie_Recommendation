<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix - Movie Recommendations</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url("file:///C:/Users/Home/OneDrive/Desktop/DATABASE/CUST-Islamabad-13-1024x683.jpg");
            font-family: Arial, sans-serif;
            background: #000;
            color: #fff;
            overflow-x: hidden;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background: rgba(0, 0, 0, 0.8);
            position: fixed;
            width: 100%;
            z-index: 1000;
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

        /* Hero Section */
        .hero {
            height: 100vh;
            background: url('https://via.placeholder.com/1920x1080') no-repeat center center/cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 50px;
        }

        .hero h1 {
            font-size: 64px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 20px;
            max-width: 600px;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .hero .btn {
            display: inline-block;
            background: red;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .hero .btn:hover {
            background: darkred;
        }

        /* Button Section */
        .btn-section {
            text-align: center;
            padding: 20px;
        }

        .btn-section a {
            display: inline-block;
            background: red;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .btn-section a:hover {
            background: darkred;
        }
        /* Button Styling */
.auth-buttons {
    display: flex;
    gap: 15px;
}

.auth-btn {
    background: red;
    color: white;
    padding: 8px 20px;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}

.auth-btn:hover {
    background: darkred;
}

.register-btn {
    background: green; /* Register button with a different color */
}

.register-btn:hover {
    background: darkgreen;
}

    </style>
</head>
<body>
    <div class="header">
        <div class="logo">NETFLIX</div>
        
        <a href="register.php" class="auth-btn">SIGN UP</a>
    </div>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Welcome to Netflix</h1>
        <p>Your favorite movies and TV shows are just a click away. Discover endless entertainment!</p>
        <a href="login.php" class="btn">Login</a>
    </div>

   
</body>
</html>
