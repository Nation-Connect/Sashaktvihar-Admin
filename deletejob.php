<?php
	include 'db.php';
	$id = $_GET["id"];
  
        $data = $_POST["data"];
        mysqli_set_charset($conn,'utf8');
        $sql = "UPDATE job SET status = 'deleted' WHERE id = $id";
        
        
         if (mysqli_query($conn, $sql)) {
           
                  header("Location: http://admin.sashaktvihar.in/job.php?status=success&id=$id");
             
         } else {
              header("Location: http://admin.sashaktvihar.in/job.php?status=failed&id=$id");
             //echo mysqli_error($conn);
             
             
         }

        
     
?>