<?php
	      session_set_cookie_params(0);
	    session_start();
    if(!isset($_SESSION["admin_id"]) || session_id() == ''){ 
    header("Location: login.php");
    exit();
    } 
	    include 'db.php';
	
        $id = $_GET["id"];
        $ImageSavefolder = "../img/gallery/";


        $selectsql = "select * from gallery where id = '$id'";
        $delsql = "DELETE FROM gallery where id = '$id'";
       
        $slideresult = $conn->query($selectsql);
            if ($slideresult->num_rows > 0) {
                // output data of each row
                while($row = $slideresult->fetch_assoc()) {
                    $imgpath = $row["link"];
                    unlink($ImageSavefolder.$imgpath);
                    
                    $slideresults = $conn->query($delsql);
                    if ($slideresults->num_rows > 0) {
                        // output data of each row
                        while($row = $slideresults->fetch_assoc()) {
                           
                            header("Location: gallery.php?status=delsuccess");
                        }
                       } else {
                            header("Location: gallery.php?status=failed");
                            //echo mysqli_error($conn);
                       }
            
                    header("Location: gallery.php?status=delsuccess");
                }
               } else {
                    header("Location: gallery.php?status=failed");
                    //echo mysqli_error($conn);
            }
                 
?>