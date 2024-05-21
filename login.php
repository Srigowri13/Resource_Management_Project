<?php
include 'config/database.php';
$pageTitle = "Login";
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (validateUser($email, $password)) {
        session_start();
        $_SESSION['email'] = $email;

        // Query the database to get user's role
        $sql = "SELECT role FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $user_role = $row['role'];
            $_SESSION['user_role'] = $row['role'];
            // Redirect based on user role
            if ($user_role == 'admin') {
                header("Location: upload.php");
                exit();
            } else {
                header("Location: main.php");
                exit();
            }
        } else {
            // User data not found, handle error
            echo '<script type="text/javascript">
            window.onload = function () { alert("Error: User data not found."); }
            </script>';
            exit();
        }
    } else {
        echo '<script type="text/javascript">
        window.onload = function () { alert("Invalid email or password. Please try again."); }
        </script>';
    }
}

function validateUser($email, $password) {
    global $conn;

    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    
    // Prepare the connection
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ss", $email, $password);

        // Execute the statement
        if ($stmt->execute()) {
            // Get result
            $result = $stmt->get_result();

            // Check if user exists
            if ($result->num_rows === 1) {
                return true; // User found
            }
        } else {
            // Execution failed
            die("Execution failed: " . $stmt->error);
        }
    } else {
        // Preparation failed
        die("Preparation failed: " . $conn->error);
    }

    // User not found or password was incorrect
    return false;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href='https://fonts.googleapis.com/css?family=Barlow' rel='stylesheet'>
    <style>
        body{
            background-color: #EEEEEE;
            font-family: 'Barlow';
            padding: 0px;
            margin: 0px;
        }

        .box{
            background-color: #333;
            border-style: none;
            border-radius: 7.5px;
            width: 25%;
            color: #C73659;
            padding: 15px 30px 15px 30px;
            margin: 50px;
            font-size: 30px;
        }

        .inner-box{
            background-color: #333;
            padding: 30px;
        }

        input{
            width: 90%;
            padding: 15px;
            margin-bottom: 15px;
        }

        button{
            padding: 10px 20px 10px 20px;
            background-color: #C73659;
            border-style: none;
            border-radius: 5px;
            color: #EEEEEE;
        }

        button:hover {
            background-color: #b53250;
        }
    </style>
</head>
<body>
    <center>
        <div class="box">
            <h2>Login</h2>
            <div class="inner-box">
                <form action="login.php" method="post">
                    <input type="email" id="email" name="email" placeholder="Email" required><br><br>

                    <input type="password" id="password" name="password" placeholder="Password" required><br><br>

                    <button type="submit" name="login">Login</button>
                </form>
            </div>
        </div>
    </center>
</body>
</html>

<?php
include 'footer.php';
?>