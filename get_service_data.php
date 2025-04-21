<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "canteendb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$date = isset($_GET['date']) ? $_GET['date'] : '';
if (!$date) {
    die(json_encode(["error" => "No date provided."]));
}

$stmt = $conn->prepare("SELECT services1, services2, services3 FROM serviceform WHERE DATE(services_date) = ?");
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

// Service labels
$services = ['Behaviour of Staff', 'Food Quality', 'Service'];
$ratings = ['Good' => 3, 'Average' => 2, 'Bad' => 1];
$data = [];

foreach ($services as $service) {
    $data[$service] = ['Good' => 0, 'Average' => 0, 'Bad' => 0];
}

while ($row = $result->fetch_assoc()) {
    foreach (range(1, 3) as $index) {
        $rating = $row['services' . $index];
        foreach ($ratings as $label => $value) {
            if ((int)$rating === $value) {
                $data[$services[$index - 1]][$label]++;
                break;
            }
        }
    }
}

$stmt->close();
$conn->close();

echo json_encode($data);
?>
