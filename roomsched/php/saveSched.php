<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

include 'conn.php';

// Get the POST data
$postData = file_get_contents("php://input");
$schedule = json_decode($postData, true);

if (!$schedule) {
    die(json_encode(["message" => "Invalid JSON"]));
}
// Prepare the statement
$stmt = $conn->prepare("INSERT INTO weeklysched (subject, day, startTime, endTime, roomNumber) VALUES (?, ?, ?, ?, ?)");

if (!$stmt) {
    die(json_encode(["message" => "Preparation failed: " . $conn->error]));
}

foreach ($schedule as $entry) {
    $subject = $entry['subject'];
    $day = $entry['day'];
    $startTime = $entry['startTime'];
    $endTime = $entry['endTime'];
    $roomNumber = $entry['roomNumber'];

    $stmt->bind_param("sssss", $subject, $day, $startTime, $endTime, $roomNumber);
    
    if (!$stmt->execute()) {
        echo json_encode(["message" => "Error saving schedule: " . $stmt->error]);
        $stmt->close();
        $conn->close();
        exit;
    }
}

echo json_encode(["message" => "Schedule saved successfully!"]);

$stmt->close();
$conn->close();
?>
