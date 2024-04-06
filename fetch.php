<?php include 'config/database.php'; ?>

<?php 
    $sql = 'SELECT * FROM Users';
    $result = mysqli_query($conn, $sql);

    // Check if there are any users
    if (mysqli_num_rows($result) > 0) {
        // Fetch all users as an associative array
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Loop through each user and display their information
        foreach ($users as $user) {
            echo "<p>User ID: {$user['user_id']}</p>";
            echo "<p>Username: {$user['user_name']}</p>";
            echo "<p>Email: {$user['email']}</p>";
            echo "<hr>";
        }
    } else {
        // If there are no users in the database
        echo "<p>No users found.</p>";
    }
?>