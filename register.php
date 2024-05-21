<?php
include 'config/database.php';
$pageTitle = "Register";
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    // Check if email already exists
    $checkQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "Email already exists.";
        header('Location: login.php');
        exit();
    }

    // Insert user into database
    $insertQuery = "INSERT INTO users (user_name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ssss", $username, $email, $password, $role);
    if ($stmt->execute()) {
        echo '<script type="text/javascript">
        window.onload = function () { alert("User registered successfully."); }
        </script>';
        header('Location: login.php');
        exit();
    } else {
        echo "Error registering user: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href='https://fonts.googleapis.com/css?family=Barlow' rel='stylesheet'>
    <style>
        body {
            background-color: #EEEEEE;
            font-family: 'Barlow';
            margin: 0px;
            padding: 0px;
        }

        .box {
            background-color: #333;
            border-style: none;
            border-radius: 7.5px;
            width: 25%;
            color: #C73659;
            padding: 10px 30px 10px 30px;
            margin: 25px;
            font-size: 30px;
        }

        .inner-box {
            background-color: #333;
            padding: 5px;
        }

        input {
            width: 90%;
            padding: 15px;
            margin-bottom: 0px;
        }

        select {
            width: 100%;
            padding: 15px;
            margin-bottom: 0px;
        }

        button {
            padding: 10px 20px 10px 20px;
            background-color: #C73659;
            border-style: none;
            border-radius: 5px;
            color: #EEEEEE;
            margin-bottom: 10px;
        }

        button:hover {
            background-color: #b53250;
        }
    </style>
</head>
<body>
    <center>
        <div class="box">
            <h2>Register</h2>
            <div class="inner-box">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="text" id="username" name="username" placeholder="Username" required><br><br>
                    <input type="email" id="email" name="email" placeholder="Email" required><br><br>
                    <input type="password" id="password" name="password" placeholder="Password" required><br><br>
                    <select name="role" id="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select><br><br>
                    <button type="submit" name="register">Register</button>
                </form>
            </div>
        </div>
    </center>
</body>
</html>

<?php
include 'footer.php';
?>
