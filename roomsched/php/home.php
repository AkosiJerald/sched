<?php
session_start(); // Start the session

include '../php/nav.php'; // Include the navigation file
include '../php/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Homepage</title>
        <link href="../bootstrap-4.0.0-dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
<body>
<div class="">
<?php

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $user_id); // Use "i" if user_id is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user details
        $row = $result->fetch_assoc();
        
        // Display user information
        echo "<h1>User Information</h1>";
        echo "<p><strong>Username:</strong> " . htmlspecialchars($row['username']) . "</p>";
      
    } else {
        echo "<p>No user found with this ID.</p>";
    }

    $stmt->close();
} else {
    echo "<p>User ID is not set in the session.</p>";
}?>
</div>
</body>
</html>