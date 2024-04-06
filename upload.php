<?php
// Include database configuration
include 'config/database.php';

session_start();

// Check if the user is logged in and has the necessary role
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    // If the user is not logged in or is not an admin, redirect them to a different page
    header("Location: unauthorized.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get semester and subject from the form
    $semester = $_POST['semester'];
    $subject = $_POST['subject'];

    // File upload handling
    $file = $_FILES['file'];

    // File details
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileType = $file['type'];
    $fileSize = $file['size'];

    // Define upload directory
    $uploadDirectory = 'uploads/';

    // Move uploaded file to permanent location
    $filePath = $uploadDirectory . $fileName;
    move_uploaded_file($fileTmpName, $filePath);

    // Insert file details into the database
    $sql = "INSERT INTO resources (semester, subject, file_name, file_type, tmp_filepath, file_size) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssi", $semester, $subject, $fileName, $fileType, $filePath, $fileSize);
    $stmt->execute();
    $stmt->close();

    // Redirect to a success page or display a success message
    header("Location: upload_success.php");
    exit();
}
?>
    



<!DOCTYPE html>
<html>
<head>
    <title>Resource Management Project</title>
</head>
<body>

    <!-- The enctype is necessary for file uploads -->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="semester">Select Semester: </label>
        <select name="semester" id="semester">
            <option value="1">Semester 1</option>
            <option value="2">Semester 2</option>
            <option value="3">Semester 3</option>
            <option value="4">Semester 4</option>
            <option value="5">Semester 5</option>
            <option value="6">Semester 6</option>
            <option value="7">Semester 7</option>
            <option value="8">Semester 8</option>
        </select>
        <br><br>

        <label for="subject">Select Subject:</label>
        <select id="subject" name="subject">
            <option value="1">Subject 1</option>
            <option value="2">Subject 2</option>
            <option value="3">Subject 3</option>
            <option value="4">Subject 4</option>
            <option value="5">Subject 5</option>
            <option value="6">Subject 6</option>
            <option value="7">Subject 7</option>
            <option value="8">Subject 8</option>
        </select>
        <br><br>

        <input type="file" name="file">
        <button type="submit" name="submit">Upload</button>
    </form>
    <br>
    <a href="main.php">Navigate to Main Page</a>

</body>
</html>