<?php
	      session_set_cookie_params(0);
	    session_start();
    if(!isset($_SESSION["admin_id"]) || session_id() == ''){ 
    header("Location: login.php");
    exit();
    } 
	    include 'db.php';
	    
    if(isset($_POST['submit']))
    {	
        $id = $_GET["id"];
        $ImageSavefolder = "../img/gallery/";

       

        
        
        $sql = "INSERT INTO gallery(link) VALUES('".$_FILES['uploadImage']['name']."')";
        
        if (!file_exists("../img/gallery/".$_FILES['uploadImage']['name']))  
        { 
            move_uploaded_file($_FILES["uploadImage"]["tmp_name"] , "$ImageSavefolder".$_FILES["uploadImage"]["name"]);
            if (mysqli_query($conn, $sql)) {
           
                  
                  header("Location: gallery.php?status=success");
               
             
         } else {
              header("Location: gallery.php?status=failed");
             //echo mysqli_error($conn);
             
             
         }
         
        } 
        else 
        { 
            header("Location: gallery.php?status=already");
        } 
         

        
     
} 
	?>