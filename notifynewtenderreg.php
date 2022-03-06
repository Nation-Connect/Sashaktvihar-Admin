<?php
include 'db.php';

$sql = "SELECT count(*) as count FROM tenderregistration where notify='unread'";
$qry = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($qry);
echo $row['count'];
?>