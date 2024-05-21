<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css?family=Barlow' rel='stylesheet'>
    <style>
        body {
            background-color: #EEEEEE;
            font-family: 'Barlow';
            margin: 0px;
            padding: 0px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background-color: #333;
            border-style: none;
            border-radius: 7.5px;
            width: 40%;
            color: #C73659;
            padding: 30px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #FFFFFF;
            margin-bottom: 20px;
        }

        a {
            color: #C73659;
            text-decoration: none;
            font-size: 18px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>You are not authorized to view this page</h1>
        <br>
        <a href="main.php">Navigate to Main Page</a>
    </div>
</body>
</html>

<?php
include 'footer.php';
?>