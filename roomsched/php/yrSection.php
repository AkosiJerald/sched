<?php
session_start(); // Start the session at the beginning

header('Content-Type: application/json');

include 'conn.php';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
     
    $user_id = $_SESSION['user_id'];

    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("SELECT yr, section FROM yr_section WHERE user_id = ?");
    $stmt->bind_param("i", $user_id); // Assuming user_id is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $yr = $row['yr'];
            $section = $row['section'];
            
            if (!isset($data[$yr])) {
                $data[$yr] = [];
            }
            $data[$yr][] = $section;
        }
    }

    echo json_encode($data);
        
} else {
    echo json_encode(['error' => 'User not authenticated']);
    exit;
}

$stmt->close();
$conn->close();
?>
