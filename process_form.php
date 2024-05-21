<?php
$pageTitle = "Resources";
include 'header.php';
?>

<?php
// process_form.php

include 'config/database.php';

// Retrieve selected semester and subject from the URL parameters
$selectedSemester = isset($_GET['semester']) ? $_GET['semester'] : '';
$selectedSubject = isset($_GET['subject']) ? $_GET['subject'] : '';

if (!empty($selectedSemester) && !empty($selectedSubject)) {
    // Query the database for resources based on the selected semester and subject
    $sql = "SELECT * FROM resources WHERE semester = ? AND subject = ? ORDER BY rating DESC"; // Modify this line
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
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Display Resources</title>
            <link href='https://fonts.googleapis.com/css?family=Barlow' rel='stylesheet'>
            <style>
                body {
                    background-color: #EEEEEE;
                    font-family: 'Barlow', sans-serif;
                    padding: 0px;
                    margin: 0px;
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

                .container li {
                    background-color: #FFF;
                    margin-bottom: 20px;
                    padding: 25px;
                    border-radius: 5px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }

                .container a{
                    padding-left: 700px;
                }

                a[target="_blank"]{
                    padding-left: 10px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <ul>
                    <?php foreach ($resources as $resource) { ?>
                        <li><?php echo $resource['file_name']; ?> - <?php echo $resource['file_type']; ?> - <?php echo $resource['file_size']; ?> - <?php echo $resource['rating']; ?>
                            <a href="<?php echo $resource['tmp_filepath']; ?>" download>Download</a> |
                            <a href="<?php echo $resource['tmp_filepath']; ?>" target="_blank">View Online</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "<script type='text/javascript'>
        window.onload = function () { alert('No resources available for Subject $selectedSubject in Semester $selectedSemester.'); }
        </script>";

    }
}
?>

<?php
include 'footer.php';
?>
