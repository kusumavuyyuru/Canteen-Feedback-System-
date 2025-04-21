<?php
header('Content-Type: application/json');

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "canteendb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Retrieve and sanitize the date parameter
$date = isset($_GET['date']) ? $_GET['date'] : '';
if (!$date) {
    die(json_encode(["error" => "No date provided."]));
}

// Prepare SQL statement to prevent SQL injection
$stmt = $conn->prepare("SELECT item1, item2, item3, item4, item5, item6, item7, item8 FROM canteenfeedbacksystem WHERE DATE(feedback_date) = ?");
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

// Initialize counters for each item and rating
$items = ['Idly', 'Sambar', 'Poori', 'Dosa', 'Curry', 'Chutney', 'FriedRice', 'Chapati'];
$ratings = ['Good' => 3, 'Average' => 2, 'Bad' => 1];
$data = [];

foreach ($items as $index => $item) {
    $data[$item] = ['Good' => 0, 'Average' => 0, 'Bad' => 0];
}

// Process each row and count ratings
while ($row = $result->fetch_assoc()) {
    foreach ($items as $index => $item) {
        $rating_value = $row['item' . ($index + 1)];
        if ($rating_value) {
            foreach ($ratings as $rating_name => $value) {
                if ((int)$rating_value === $value) {
                    $data[$item][$rating_name]++;
                    break;
                }
            }
        }
    }
}

$stmt->close();
$conn->close();

echo json_encode($data);
?>