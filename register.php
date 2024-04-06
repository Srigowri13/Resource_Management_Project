<?php
include 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

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
    $insertQuery = "INSERT INTO users (user_name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
        echo "User registered successfully.";
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
<html>
<head>
    <title>Resource Management Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <form action="register.php" method="POST">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
        
                    <div class="mb-md-5 mt-md-4 pb-5">
        
                        <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                        <p class="text-white-50 mb-5">Please enter your username, email and password!</p>
                                
                        <div class="form-outline form-white mb-4">
                        <input type="text" id="username" class="form-control form-control-lg" name="username" required/>
                        <label class="form-label" for="username">Username</label>
                        </div>
        
                        <div class="form-outline form-white mb-4">
                        <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email" required/>
                        <label class="form-label" for="typeEmailX">Email</label>
                        </div>
        
                        <div class="form-outline form-white mb-4">
                        <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" required/>
                        <label class="form-label" for="typePasswordX">Password</label>
                        </div>
        
                        <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>
        
                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Register</button>
        
                        <div class="d-flex justify-content-center text-center mt-4 pt-1">
                        <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                        <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                        <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                        </div>
        
                    </div>
        
                    <div>
                        <p class="mb-0">Don't have an account? <a href="#" class="text-white-50 fw-bold">Sign Up</a>
                        </p>
                    </div>
        
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>
    </form>
</body>
</html>