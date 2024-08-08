<?php
include 'conn.php'; // Ensure this file contains your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Escape user input to prevent SQL injection (basic sanitization)
        $username = $conn->real_escape_string($username);

        // Direct SQL query to get user details
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($query);

        if ($result === false) {
            die("Query failed: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verify the password
            if ($password === $row['password']) { // This assumes passwords are stored in plain text
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $username;
                $_SESSION['type'] = $row['type']; // Store user type in session

                // Redirect based on user type
                if (strtolower($row['type']) === 'admin') {
                    header('Location: ../html/adminhome.html');
                } else {
                    header('Location: home.php');
                }
                exit();
            } else {
                echo "<script>alert('Invalid password'); window.location.href='../index.html';</script>";
            }
        } else {
            echo "<script>alert('No user found'); window.location.href='../index.html';</script>";
        }
    } else {
        echo "<script>alert('Username and password are required'); window.location.href='../index.html';</script>";
    }
}

// Close the connection
$conn->close();
?>
