<?php
$q1=$_POST['item1'] ?? null;
$q2=$_POST['item2'] ?? null;
$q3=$_POST['item3'] ?? null;
$q4=$_POST['item4'] ?? null;
$q5=$_POST['item5'] ?? null;
$q6=$_POST['item6'] ?? null;
$q7=$_POST['item7'] ?? null;
$q8=$_POST['item8'] ?? null;
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

$sql = "INSERT INTO `canteenfeedbacksystem`(`item1`, `item2`, `item3`, `item4`, `item5`, `item6`, `item7`, `item8`, `feedback_date`, `feedback_time`) VALUES ('$q1','$q2','$q3','$q4','$q5','$q6','$q7','$q8','$dt','$ti')";
//$sql = "insert into canteenfeedbacksystem values('$q1','$q2','$q3','$q4','$q5','$q6','$q7','$q8','$dt','$ti')";
if($conn->query($sql) === TRUE) {
	echo "Feedback Added Sucessfully";
       //header("Location:thanks.html");
//       header("Location:serviceform.html");

}
else
{
echo "Error: ".$sql."<br>".$conn->error;
}
$sql_avg = "SELECT
AVG(item1) AS avg_item1,
AVG(item1) AS avg_item2,
AVG(item1) AS avg_item3,
AVG(item1) AS avg_item4,
AVG(item1) AS avg_item5,
AVG(item1) AS avg_item6,
AVG(item1) AS avg_item7,
AVG(item1) AS avg_item8
FROM canteenfeedbacksystem
WHERE feedback_date = '$date'";
$result = $conn->query($sql_avg);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$avg_item1 = $row['avg_item1'];
$avg_item2 = $row['avg_item2'];
$avg_item3 = $row['avg_item3'];
$avg_item4 = $row['avg_item4'];
$avg_item5 = $row['avg_item5'];
$avg_item6 = $row['avg_item6'];
$avg_item7 = $row['avg_item7'];
$avg_item8 = $row['avg_item8'];
$sql_insert_avg = "INSERT INTO daily_average_feedback (avg_item1, avg_item2, avg_item3, avg_item4, avg_item5, avg_item6, avg_item7, avg_item8,feedback_date)
VALUES ('$avg_item1','$avg_item2','$avg_item3','$avg_item4','$avg_item5','$avg_item6','$avg_item7','$avg_item8','$date')";
if ($conn->query($sql_insert_avg) === TRUE) {
echo "Daily average feedback stored successfully.";
       header("Location:serviceform.html");

} else { 
echo "Error: ".$sql_insert_avg. "<br>" .$conn->error;
}
}
$conn->close();
?>

