<?php
// Include database configuration
include 'config/database.php';
$pageTitle = "Upload";
include 'header.php';

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
    $filePath = $uploadDirectory . basename($fileName);
    move_uploaded_file($fileTmpName, $filePath);

    // Insert file details into the database
    $sql = "INSERT INTO resources (semester, subject, file_name, file_type, tmp_filepath, file_size) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssi", $semester, $subject, $fileName, $fileType, $filePath, $fileSize);
    $stmt->execute();
    $stmt->close();

    // Redirect to a success page or display a success message
    // Redirect to a success page or display a success message
    echo '<script type="text/javascript">window.onload = function () { alert("File was uploaded successfully."); setTimeout(function(){ window.location.href = "upload.php"; }, 100); }</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Resource</title>
    <link href='https://fonts.googleapis.com/css?family=Barlow' rel='stylesheet'>
    <style>
        body {
            background-color: #EEEEEE;
            font-family: 'Barlow', sans-serif;
            padding: 0;
            margin: 0;
        }

        .container {
            width: 35%;
            margin: auto;
            padding-top: 50px;
        }

        .form-box {
            background-color: #333;
            border-radius: 7.5px;
            padding: 30px;
            color: #C73659;
        }

        h2 {
            font-size: 30px;
            margin-bottom: 20px;
            text-align: center;
            color: #C73659;
        }

        label {
            display: block;
            margin: 15px 0 5px;
            color: #FFF;
        }

        select,
        input[type="file"],
        button[type="submit"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: white;
            color: #333;
            cursor: pointer;
        }

        button[type="submit"] {
            background-color: #C73659;
            color: #EEEEEE;
            font-size: 16px;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #b53250;
        }
    </style>
    <script>
        function populateSubjects() {
            var semesterSelect = document.getElementById('semesterSelect');
            var subjectSelect = document.getElementById('subject');
            var selectedSemester = semesterSelect.value;

            // Clear the current options
            subjectSelect.innerHTML = '';

            function addSubjectOption(value, text) {
                var option = document.createElement('option');
                option.value = value;
                option.text = text;
                subjectSelect.add(option);
            }

            if (selectedSemester === "1") {
                addSubjectOption("math1", "Engineering Mathematics-I");
                addSubjectOption("chem", "Engineering Chemistry");
                addSubjectOption("mech1", "Engineering Mechanics");
                addSubjectOption("ec", "Elements of Electronics Engineering");
                addSubjectOption("cad", "Engineering Graphics and Design");
                addSubjectOption("chemlab", "Engineering Chemistry Laboratory");
                addSubjectOption("inn", "Innovation Studies");
                addSubjectOption("eng", "Functional English");
            } else if (selectedSemester === "2") {
                addSubjectOption("math2", "Engineering Mathematics-II");
                addSubjectOption("phy", "Engineering Physics");
                addSubjectOption("mech2", "Elements of Mechanical Engineering");
                addSubjectOption("eee", "Elements of Electrical Engineering");
                addSubjectOption("prog", "Introduction to Programming");
                addSubjectOption("phylab", "Engineering Physics Laboratory");
                addSubjectOption("proglab", "Computational Programming Lab");
                addSubjectOption("kan", "Kannada");
            } else if (selectedSemester === "3") {
                addSubjectOption("math3", "Engineering Mathematics-III");
                addSubjectOption("ds", "Data Structures");
                addSubjectOption("java", "Object Oriented Programming using JAVA");
                addSubjectOption("dsd", "Digital System Design");
                addSubjectOption("co", "Computer Organization");
                addSubjectOption("dms", "Discrete Mathematical Structures");
                addSubjectOption("hu", "Universal Human Values");
                addSubjectOption("dslab", "Data Structure Lab");
                addSubjectOption("dsdlab", "Digital System Design Lab");
                addSubjectOption("javalab", "Object Oriented Programming using JAVA Lab");
            } else if (selectedSemester === "4") {
                addSubjectOption("math4", "Linear Algebra");
                addSubjectOption("os", "Operating Systems");
                addSubjectOption("daa", "Design and Analysis of Algorithm");
                addSubjectOption("dc", "Data Communication");
                addSubjectOption("se", "Software Engineering");
                addSubjectOption("toc", "Theory of Computation");
                addSubjectOption("oslab", "Operating Systems Lab");
                addSubjectOption("daalab", "Design and Analysis of Algorithm Lab");
                addSubjectOption("ev", "Environmental Studies");
            } else if (selectedSemester === "5") {
                addSubjectOption("dbms", "Database Management Systems");
                addSubjectOption("cn", "Computer Networks");
                addSubjectOption("poc", "Principles of Compilers");
                addSubjectOption("ai", "Artificial Intelligence");
                addSubjectOption("crypt", "Cryptography and Network Security");
                addSubjectOption("dbmslab", "Database Management Systems Laboratory");
                addSubjectOption("cnlab", "Computer Networks Laboratory");
            } else if (selectedSemester === "6") {
                addSubjectOption("ml", "Machine Learning");
                addSubjectOption("web", "Web Technology");
                addSubjectOption("iot", "Internet of Things");
                addSubjectOption("cc", "Cloud Computing");
                addSubjectOption("acs", "Automative Cyber Security");
                addSubjectOption("cyber", "Cyber Security");
                addSubjectOption("mllab", "Machine Learning Laboratory");
                addSubjectOption("weblab", "Web Technology Laboratory");
                addSubjectOption("iotlab", "Internet of Things Practical");
                addSubjectOption("con", "Constitution of India and Professional Ethics");
            } else if (selectedSemester === "7") {
                addSubjectOption("spm", "Software Project Management");
                addSubjectOption("dla", "Deep Learning Architecture");
                addSubjectOption("ca", "Computer Architecture");
                addSubjectOption("robo", "Robotics");
                addSubjectOption("nlp", "Natural Language Processing");
                addSubjectOption("bct", "Blockchain Technology");
                addSubjectOption("bda", "Big Data Analytics");
            } else if (selectedSemester === "8") {
                addSubjectOption("psc", "Principles of Soft Computing");
                addSubjectOption("twm", "Text and Web Mining");
                addSubjectOption("erp", "Enterprise Resource Planning");
                addSubjectOption("gt", "Game Theory");
                addSubjectOption("var", "Visualization and Augmented Reality");
                addSubjectOption("hpc", "High Performance Computing");
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Upload Resource</h2>
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <label for="semesterSelect">Select Semester:</label>
                <select id="semesterSelect" name="semester" onchange="populateSubjects()">
                    <option value="">Select Semester</option>
                    <option value="1">C Cycle</option>
                    <option value="2">P Cycle</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                </select>

                <label for="subject">Select Subject:</label>
                <select id="subject" name="subject">
                    <option value="">Select Subject</option>
                </select>

                <label for="file">Upload File:</label>
                <input type="file" name="file" id="file" required>

                <button type="submit" name="submit">Upload</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
include 'footer.php';
?>