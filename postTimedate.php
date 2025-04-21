<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$q1 = $_POST['item1'] ?? null;
$q2 = $_POST['item2'] ?? null;
$q3 = $_POST['item3'] ?? null;
$q4 = $_POST['item4'] ?? null;
$q5 = $_POST['item5'] ?? null;
$q6 = $_POST['item6'] ?? null;
$q7 = $_POST['item7'] ?? null;
$q8 = $_POST['item8'] ?? null;

// Database connection settings

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "canteendb";


// FIX: Use correct variable names here
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current date and time
date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d");
$time = date("H:i:s");

// Insert feedback into database
$sql = "INSERT INTO canteenfeedbacksystem (item1, item2, item3, item4, item5, item6, item7, item8, feedback_date, feedback_time) 
        VALUES ('$q1', '$q2', '$q3', '$q4', '$q5', '$q6', '$q7', '$q8', '$date', '$time')";

if ($conn->query($sql) === TRUE) {
    // Redirect to thank you page after successful insertion
    header("Location: ../thanks.html");
    exit(); // Ensure no further code is executed after the redirect
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
