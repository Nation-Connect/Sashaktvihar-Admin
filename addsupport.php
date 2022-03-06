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
        
        $name = $_POST["name"];
        $distname = $_POST["dist_name"];
        $contactno = $_POST["contact_no"];
        $callingtime = $_POST["calling_time"];
        $address = $_POST["address"];
        $map = $_POST["map"];
        //$profileimage = $_POST["profile_image"];
        
        $filename = $_FILES["profile_image"]["name"];
        $tempname = $_FILES["profile_image"]["tmp_name"];   
        $folder = "../img/team/support/".time().$filename;
        $foldername = "img/team/support/".time().$filename;
        
        if (move_uploaded_file($tempname, $folder))  {
             mysqli_set_charset($conn,'utf8');
        $sql = "INSERT INTO support(dist, image, name, address, contact_no, calling_time, map) VALUES('$distname','$foldername','$name','$address','$contactno','$callingtime','$map')";
        
         if (mysqli_query($conn, $sql)) {
            
                  header("Location: support.php?status=success");
             
             
         } else {
              header("Location: support.php?status=failed");
             //echo mysqli_error($conn);
             
             
         }
        }else{
            header("Location: support.php?status=failed");
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
    <title>Apbiharpower-Admin Panel</title>
    
    	<script src="ckeditor/ckeditor.js"></script>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="assets/css/select2.min.css" rel="stylesheet" >
	<link href="assets/css/checkbox3.min.css" rel="stylesheet" >
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    
    <link rel="icon" href="assets/img/logo1.png" type="image/icon type">
     <!-- Google Fonts-->
   <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>



</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><strong>Apbiharpower</strong></a>
				
            </div>

            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                     <li>
                        <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="employee.php"><i class="fa fa-user" aria-hidden="true"></i>Employee</a>
                    </li>
                    <li>
                        <a href="consumerregist.php"><i class="fa fa-users" aria-hidden="true"></i>Consumer Registration</a>
                    </li>
                     <li>
                        <a href="registration.php" class="notifyonclk"><i class="fa fa-user-circle" aria-hidden="true"></i>Job Registration &nbsp;&nbsp;<span class="glyphicon not"><mark class="big swing"><span class="notifydata"></span></mark></span></a>
                    </li>
                    <li>
                        <a href="gallery.php"><i class="fa fa-file-image-o" aria-hidden="true"></i>Gallery</a>
                    </li>
                     <li>
                        <a href="textslider.php"><i class="fa fa-sliders" aria-hidden="true"></i>Text Slider</a>
                    </li>
                    <li>
                        <a href="notice.php"><i class="fa fa-comment-o" aria-hidden="true"></i>Notice</a>
                    </li>
                    <li>
                        <a class="active-menu" href="support.php"><i class="fa fa-info-circle" aria-hidden="true"></i>Support</a>
                    </li>
					 <li>
                        <a href="#"><i class="fa fa-sitemap"></i> ONLINE APPLICATION <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="job.php">Job</a>
                            </li>
                            <li>
                                <a href="tender.php">Tender</a>
                            </li>
							</ul>
						</li>	
							
                    
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
		  <div class="header"> 
                        <h1 class="page-header">
                            Add Support<small>add new support branch</small>
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="index.php">Home</a></li>
					  <li><a href="support.php">Support</a></li>
					  <li class="active">Add Support</li>
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
        <strong>Success!</strong> Record Added sucessfully
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
                                                        
                                                        
                                                        
		      
        <div class="header"> 
        <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="card-title">
                                        <div class="title">Add Support Branch</div>
                                    </div>
                                </div>
                                <form action="" method = "POST" enctype="multipart/form-data">
                                <div class="panel-body">
                                    
                                    <div class="sub-title">Full Name (Manager/Employee name)</div>
                                    <div>
                                        <input type="text" name="name" class="form-control" placeholder="full name" required>
                                    </div><br>
                                    
                                    <div class="sub-title">District Name</div>
                                    <div>
                                    <input type="text" name="dist_name" class="form-control" placeholder=" district name" required>
                                    </div><br>
                                    
                                    
                                    <div class="sub-title">Contact No.</div>
                                    <div>
                                        <input type="number" name="contact_no" class="form-control" placeholder="827XXXXXXX">
                                    </div><br>
                                    
                                    <div class="sub-title">Calling Time</div>
                                    <div>
                                        <input type="text" name="calling_time" class="form-control" placeholder="9am to 6pm">
                                    </div><br>
                                    
                                    <div class="sub-title">Address</div>
                                    <div>
                                        <textarea name="address" class="form-control" rows=4 placeholder="Write full address..." required></textarea>
                                    </div><br>
                                    
                                    <div class="sub-title">Map (<a href="https://www.google.com/maps" target="_blank">Go to map</a>)</div>
                                    <div>
                                        <textarea name="map" class="form-control" rows=6 placeholder='Example: <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115132.86107235146!2d85.07300191831742!3d25.608175570492524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f29937c52d4f05%3A0x831a0e05f607b270!2sPatna%2C%20Bihar!5e0!3m2!1sen!2sin!4v1584817262831!5m2!1sen!2sin" width="100%" height="220" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>' required></textarea>
                                    </div><br>
                                    
                                    <div class="sub-title">Profile Image</div>
                                    <div>
                                    <input type="file" name="profile_image" class="form-control" accept="image/*" required>
                                    </div><br>
                                                
                                        <center>
                                    <input type="Submit" class="btn btn-primary" name="submit" value="Submit"><br><br>
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
