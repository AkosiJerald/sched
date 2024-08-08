<?php
    $conn  = new mysqli('localhost', 'root', '', 'scheduler');
    if ($conn->connect_error)
        die("failed". $conn->connect_error);
   
?>