<?php
include 'db.php';

$sql = "UPDATE tenderregistration SET notify='read'";

if ($conn->query($sql) === TRUE) {
    //echo "Record updated successfully";
} else {
    //echo "Error updating record: " . $conn->error;
}
?>