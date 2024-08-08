<?php
header('Content-Type: application/json');

include 'conn.php';

// Retrieve the POST data
$postData = file_get_contents("php://input");
$data = json_decode($postData, true);

if (!$data) {
    echo json_encode(["error" => "Invalid JSON"]);
    exit;
}

$roomNumber = $data['roomNumber'];
$day = $data['day'];
$startTime = $data['startTime'];
$endTime = $data['endTime'];

// Prepare the SQL query
$sql = "SELECT COUNT(*) AS count FROM weeklysched WHERE roomNumber = ? AND day = ? AND (startTime < ? AND endTime > ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["error" => "Failed to prepare statement: " . $conn->error]);
    exit;
}

$stmt->bind_param("ssss", $roomNumber, $day, $endTime, $startTime);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$available = $row['count'] == 0; // Available if count is 0

echo json_encode(["available" => $available]);

$stmt->close();
$conn->close();
?>
