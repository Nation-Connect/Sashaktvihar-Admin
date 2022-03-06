<?php
	     session_set_cookie_params(0);
	    session_start();
    if(!isset($_SESSION["admin_id"]) || session_id() == ''){ 
    header("Location: login.php");
    exit();
    } 
	    include 'db.php';
	    
	    $id = $_GET["id"];
    if(isset($_POST['submit']))
    {	
        
        $title = $_POST["title"];
        $shortdesc = $_POST["shortdesc"];
        
        mysqli_set_charset($conn,'utf8');
        $sql = "UPDATE tender SET title = '$title',short_desc = '$shortdesc' WHERE id = $id";
        
        
         if (mysqli_query($conn, $sql)) {
           
                  header("Location: http://admin.apbiharpower.in/tenderedit.php?status=success&id=$id");
             
         } else {
              header("Location: http://admin.apbiharpower.in/tenderedit.php?status=failed&id=$id");
             //echo mysqli_error($conn);
             
             
         }

        
     
} 
	?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta content="" name="description" />
    <meta content="apbiharpower" name="apbiharpower" />
    <title>Sashaktvihar-Admin Panel</title>
    
    	<script src="ckeditor/ckeditor.js"></script>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/select2.min.css" rel="stylesheet" >
	<link href="assets/css/checkbox3.min.css" rel="stylesheet" >
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>



</head>
<body>
    <div id="wrapper">
    <?php include 'header.php'; ?>
        <div id="page-wrapper">
		  <div class="header"> 
                        <h1 class="page-header">
                            Tender Edit<small>Manage Tender</small>
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="index.php">Home</a></li>
					  <li><a href="tender.php">Tender Details</a></li>
					  <li class="active">Data</li>
					</ol> 
									
		</div>
			<?php
        error_reporting(E_ALL ^ E_NOTICE);  
            if($_GET['status'] == "success" )
            {
                            echo '<div class="alert-box header">
    <div class="alert alert-success">
      <div class="alert-icon text-center">
        <i class="fa fa-check-square  fa-3x" aria-hidden="true"></i>
      </div>
      <div class="alert-message text-center">
        <strong>Success!</strong> Record Updated sucessfully
      </div>
    </div>
  </div>';
            }else if($_GET['status'] == "failed" )
            {
                            echo '<div class="alert-box header">
    <div class="alert alert-danger">
      
      <div class="alert-message text-left">
        <strong>Error!</strong> Something went wrong
      </div>
    </div>
  </div>';
            }else
            {
               
            }
        
        
        ?>
        
		       
		       <?php
		                                                    $id = $_GET["id"];
										                    mysqli_set_charset($conn,'utf8');
                									    	$sql = "SELECT * FROM tender where id = $id";
                                                            $result = $conn->query($sql);
                                                            
                                                            if ($result->num_rows > 0) {
                                                                // output data of each row
                                                                while($row = $result->fetch_assoc()) {
                                                                     $title = $row["title"];
                                                                     $shortdesc = $row["short_desc"];
                                                                     
                                                                        }
                                                            } else {
                                                                //echo "<img src='img/nojob.png' style='display: block; width:30%; margin-left:auto; margin-right:auto;'>";
                                                                //echo "not found";
                                                            }
                                                            
                                                        ?>
                                                        
                                                        
                                                        
		      
        <div class="header"> 
        <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="card-title">
                                        <div class="title">Edit Job Details</div>
                                    </div>
                                </div>
                                <form action="" method = "POST">
                                <div class="panel-body">
                                    
                                    <div class="sub-title">Title</div>
                                    <div>
                                        <input type="text" name="title" class="form-control" placeholder="Job Title" value="<?php echo $title; ?>">
                                    </div><br>
                                    
                                    <div class="sub-title">Short Description</div>
                                    <div>
                                    <textarea name="shortdesc" id="editor1" rows="10" cols="80"><?php echo $shortdesc; ?></textarea>
                                    </div><br>
                                      
                                        
                                     
                                    <p><a target="_blank" href="englishtohindi.php"><button type="button" class="btn btn-info">Click Here</button></a> to convert English to Hindi</p><br><br><br>
                                    <center>
                                    <input type="Submit" class="btn btn-primary" name="submit" value="Update"><br><br>
                                    </center>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
        </div>
        
        
        
	
            <div id="page-inner"> 
				 <footer><p>All right reserved.</p></footer>
				</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
   <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1', {height: '300px'} );
                 CKEDITOR.replace( 'editor2', {height: '400px'});
                 
            </script>
            
            <script>
            var old_count = 0;
            setInterval(function(){    
                $.ajax({
                    type : "POST",
                    url : "notifynewjobreg.php",
                    success : function(data){
                        
                        if (data > old_count) {
                            $(".not").show();
                            $(".notifydata").empty();
                            $(".notifydata").append(data);
                            old_count = data;
                        }else if(data==0 || old_count==0){
                            old_count = data;
                            $(".not").hide();
                        }
                        
                        
                    }
                });
            },1000);
        </script>
        
        <script>
            $(".notifyonclk").click(function (e) {
                 $.ajax({
                url: "notifyupdtjobreg.php",
                data: {id : ""},
                type: "POST",
                success: function(data){
                    
                },
            //on error
            error: function(){
                    
            }
        });
            });
        </script>
    
 
</body>
</html>
