<?php

include 'config/database.php';

// Define semesters and subjects
$semesters = array('Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6', 'Semester 7', 'Semester 8');
$subjects = array('Sub1', 'Sub2', 'Sub3', 'Sub4', 'Sub5', 'Sub6', 'Sub7', 'Sub8');

// Retrieve selected semester and subject from the request (using ternary operator)
$selectedSemester = isset($_GET['semester']) ? $_GET['semester'] : '';
$selectedSubject = isset($_GET['subject']) ? $_GET['subject'] : '';

if (!empty($selectedSemester) && !empty($selectedSubject)) {
    $sql = "SELECT * FROM resources WHERE semester = ? AND subject = ? ORDER BY rating DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $selectedSemester, $selectedSubject);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize an empty array to store the fetched resources
    $resources = [];

    // Loop through the query results and store the resources in the array
    while ($row = $result->fetch_assoc()) {
        $resources[] = $row;
    }
}

// Display dropdown menu to select semester
echo "<form action='main.php' method='GET'>";
echo "<label for='semester'>Select Semester:</label>";
echo "<select name='semester' id='semester' onchange='this.form.submit()'>";
echo "<option value=''>Select Semester</option>";
foreach ($semesters as $index => $semester) {
    // Increment the index by 1 to display semesters starting from 1
    $semesterNumber = $index + 1;
    $selected = ($semesterNumber == $selectedSemester) ? 'selected' : '';
    echo "<option value='$semesterNumber' $selected>$semester</option>";
}
echo "</select>";
echo "</form>";

echo '<h2><a href="logout.php">Logout</a>';

// After selecting semester, display dropdown menu for displaying the subjects for that semester
if (!empty($selectedSemester)) {
    echo "<br>";
    echo "<form action='main.php' method='GET'>";
    echo "<input type='hidden' name='semester' value='$selectedSemester'>";
    echo "<label for='subject'>Select Subject:</label>";
    echo "<select name='subject' id='subject'>";
    echo "<option value=''>Select Subject</option>";
    foreach ($subjects as $index => $subject) {
        // Increment the index by 1 to match the database format
        $subjectNumber = $index + 1;
        $selected = ($subjectNumber == $selectedSubject) ? 'selected' : '';
        echo "<option value='$subjectNumber' $selected>$subject</option>";
    }
    echo "</select>";
    echo "<input type='submit' value='Show Resources'>";
    echo "</form>";
}

// Fetch and display resources for the selected semester and subject
if (!empty($selectedSemester) && !empty($selectedSubject)) {
    // Check if resources are fetched
    if (count($resources) > 0) {
        // Resources are available for the selected semester and subject
        // Display the resources on the frontend
        echo "<h3>Resources for Subject $selectedSubject in $selectedSemester:</h3>";
        echo "<ul>";
        foreach ($resources as $resource) {
            // Output the resources
            echo "<li>" . $resource['file_name'] . ' - ' . $resource['file_type'] . ' - ' . $resource['file_size'] . ' - ' . $resource['rating'] .
            " <a href='" . $resource['tmp_filepath'] . "' download>Download</a> | " .
            " <a href='" . $resource['tmp_filepath'] . "' target='_blank'>View Online</a></li>";
        }
        echo "</ul>";
    } else {
        // No resources found for the selected semester and subject
        echo "No resources available for Subject $selectedSubject yet.";
    }
}
?>
