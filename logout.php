<?php
$pageTitle = "Logout";
include 'header.php';

    session_start();

    session_destroy();

    header('Location: login.php');
?>

<?php
include 'footer.php';
?>