<?php
header('Content-Type: application/json');

include 'conn.php';


$room = $_GET['room'] ?? '';

if (!$room) {
    echo json_encode(["success" => false, "message" => "Room parameter missing"]);
    $conn->close();
    exit;
}


$sql = "SELECT subject, day, startTime, endTime FROM weeklysched WHERE roomNumber = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Preparation failed: " . $conn->error]);
    $conn->close();
    exit;
}

$stmt->bind_param("s", $room);
$stmt->execute();
$result = $stmt->get_result();

$schedule = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $schedule[] = $row;
    }
}

echo json_encode(["success" => true, "schedule" => $schedule]);

$stmt->close();
$conn->close();
?>
