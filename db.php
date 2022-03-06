<?php
$servername = "119.18.49.6";
$username = "gncfjqmy_admin";
$password = "Sugandh@123";
$db = "gncfjqmy_apbiharpower";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>