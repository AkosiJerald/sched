<?php
header('Content-Type: application/json');

// Start the session
session_start();

// Include your database connection
include 'conn.php';

// Initialize response
$subjects = [];

// Check if the user is logged in and session variables are set
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Make sure $section and $yr are defined
    if (isset($_GET['section']) && isset($_GET['yr'])) {
        $section = $_GET['section'];
        $yr = $_GET['yr'];

        // Prepare SQL statement
        $sql = "SELECT SUBJECT.subject_code, SUBJECT.subject_name
                FROM SUBJECT
                JOIN yr_section ON SUBJECT.user_id = yr_section.user_id
                WHERE yr_section.section = ? AND yr_section.yr = ? AND SUBJECT.user_id = ?";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo json_encode(["error" => "Failed to prepare statement: " . $conn->error]);
            exit;
        }

        $stmt->bind_param('ssi', $section, $yr, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch data
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $subjects[] = $row['subject_code'] . ' ' . $row['subject_name'];
            }
        } else {
            echo json_encode(["error" => "Failed to execute query"]);
            exit;
        }
        
        $stmt->close();
    } else {
        echo json_encode(["error" => "Missing section or year parameters"]);
        exit;
    }
} else {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$conn->close();

// Return results as JSON
echo json_encode($subjects);
?>
