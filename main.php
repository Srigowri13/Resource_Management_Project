<?php
$pageTitle = "Main";
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Barlow' rel='stylesheet'>
    <title>Select Semester and Subject</title>
    <style>
        body {
            background-color: #EEEEEE;
            font-family: 'Barlow', sans-serif;
            margin: 0px;
            padding: 0px;
        }

        .box {
            background-color: #333;
            border-style: none;
            border-radius: 7.5px;
            width: 25%;
            color: #C73659;
            padding: 15px 30px 15px 30px;
            margin: 50px;
            font-size: 30px;
        }

        .inner-box {
            background-color: #333;
            padding: 30px;
        }

        .box h2 {
            font-size: 30px;
            margin-bottom: 20px;
            text-align: center;
            color: #C73659;
        }

        select,
        input[type="submit"] {
            width: 90%;
            padding: 15px;
            margin-bottom: 15px;
            border: none;
            box-sizing: border-box;
            background-color: white;
            color: #333;
            cursor: pointer;
        }

        input[type="submit"] {
            background-color: #C73659;
            color: #EEEEEE;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            padding: 10px 20px 10px 20px;
            border-style: none;
            width: 50%;
        }

        input[type="submit"]:hover {
            background-color: #b53250;
        }

        select {
            color: #333;
            font-size: 16px;
        }

        option {
            background-color: white;
            color: #333;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <center>
        <div class="box">
            <h2>Select Semester and Subject</h2>
            <div class="inner-box">
                <form action="process_form.php" method="GET">
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
                    <br><br>
                    <select id="subjectSelect" name="subject">
                        <option value="">Select Subject</option>
                    </select>
                    <br><br>
                    <center>
                        <input type="submit" value="Show Resources">
                    </center>
                </form>
            </div>
        </div>
    </center>

    <script>
        function populateSubjects() {
            var selectedSemester = document.getElementById("semesterSelect").value;
            var subjectSelect = document.getElementById("subjectSelect");
            subjectSelect.innerHTML = "";
            var defaultOption = document.createElement("option");
            defaultOption.text = "Select Subject";
            defaultOption.value = "";
            subjectSelect.add(defaultOption);
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

        function addSubjectOption(value, text) {
            var option = document.createElement("option");
            option.value = value;
            option.text = text;
            document.getElementById("subjectSelect").add(option);
        }
    </script>
</body>
</html>

<?php
include 'footer.php';
?>
