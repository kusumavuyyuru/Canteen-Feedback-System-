<?php
$q1=$_POST['services1'] ?? null;
$q2=$_POST['services2'] ?? null;
$q3=$_POST['services3'] ?? null;
$servername = "localhost";
$username = "root";
$password = "";
$db = "canteendb";
$conn = new mysqli($servername, $username, $password, $db);


if($conn->connect_error){
	die("connection failed: ".$conn->connect_error);
}
// Get current date and time
date_default_timezone_set('Asia/Kolkata');
$dt = date('Y-m-d H:i:s');
$ti = date("H:i:s");

$sql = "INSERT INTO `serviceform`(`services1`, `services2`, `services3`,`services_date`,`services_time`) VALUES ('$q1','$q2','$q3','$dt','$ti')";
//$sql = "insert into canteenfeedbacksystem values('$q1','$q2','$q3','$q4','$q5','$q6','$q7','$q8','$dt','$ti')";
if($conn->query($sql) === TRUE) {
	echo "Feedback Added Sucessfully";
       header("Location:thanks.html");
} else
{
echo "Error: ".$sql."<br>".$conn->error;
}
$conn->close();
?>
