<?php
include 'db.php';

$sql = "UPDATE registration SET notify='read'";

if (mysqli_query($conn, $sql)) {
    //echo "Record updated successfully";
} else {
    //echo "Error updating record: " . $conn->error;
}
?>