<?php
$pageTitle = "Main";
include 'header.php';
?>

<?php
// process_form.php

include 'config/database.php';
// Retrieve selected semester and subject from the URL parameters
$selectedSemester = isset($_GET['semester']) ? $_GET['semester'] : '';
$selectedSubject = isset($_GET['subject']) ? $_GET['subject'] : '';
echo "$selectedSemester .''. $selectedSubject";

if (!empty($selectedSemester) && !empty($selectedSubject)) {
    // Query the database for resources based on the selected semester and subject
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

    // Display the fetched resources
    if (count($resources) > 0) {
        echo "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <link href='https://fonts.googleapis.com/css?family=Barlow' rel='stylesheet'>
            <title>Display Resources</title>
            <style>
                body {
                    background-color: #EEEEEE;
                    font-family: 'Barlow', sans-serif;
                    margin: 0px;
                    padding: 0px;
                }

                .container {
                    width: 80%;
                    margin: auto;
                    padding-top: 50px;
                }

                h3 {
                    color: #C73659;
                }

                ul {
                    list-style-type: none;
                    padding: 0;
                }

                li {
                    background-color: #FFF;
                    margin-bottom: 20px;
                    padding: 15px;
                    border-radius: 5px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }

                a {
                    text-decoration: none;
                    color: #333;
                    margin-left: 10px;
                }

                a:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <div class=\"container\">
                <h3>Resources for Subject $selectedSubject in $selectedSemester:</h3>
                <ul>";
        foreach ($resources as $resource) {
            echo "<li>" . $resource['file_name'] . ' - ' . $resource['file_type'] . ' - ' . $resource['file_size'] . ' - ' . $resource['rating'] .
                " <a href='" . $resource['tmp_filepath'] . "' download>Download</a> | " .
                " <a href='" . $resource['tmp_filepath'] . "' target='_blank'>View Online</a></li>";
        }
        echo "</ul>
            </div>
        </body>
        </html>";
    } else {
        echo "No resources available for Subject $selectedSubject in Semester $selectedSemester.";
    }
}
?>

<?php
include 'footer.php';
?>