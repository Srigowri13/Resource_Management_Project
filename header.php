<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resource Management System</title>
    <link href='https://fonts.googleapis.com/css?family=Barlow' rel='stylesheet'>
    <style>
        body {
            font-family: 'Barlow';
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 10px;
            text-align: center;
            display: flex;
            align-items: center;
        }

        .logo {
            margin-left: 5px;
            margin-right: 20px;
        }

        .logo img {
            width: 65px; /* Adjust as needed */
            height: auto;
        }

        h1 {
            margin-right: 700px;
            font-size: 30px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }    
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Company Logo">
        </div>
        <h1>Resource Management System</h1>
        <nav>
            <ul>
                <li><a href="main.php">Home</a></li>
                <li><a href="upload.php">Upload Resources</a></li>
                <li><a href="main.php">View Resources</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>
