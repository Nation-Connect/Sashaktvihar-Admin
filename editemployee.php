<?php
	      session_set_cookie_params(0);
	    session_start();
    if(!isset($_SESSION["admin_id"]) || session_id() == ''){ 
    header("Location: login.php");
    exit();
    } 
	    include 'db.php';
	    $eid = $_GET["eid"];
    if(isset($_POST['submit']))
    {	
         $eid = $_GET["eid"];
        $name = $_POST["name"];
        $fathername = $_POST["father_name"];
        $dob = $_POST["dob"];
        $sex = $_POST["sex"];
        $email = $_POST["email"];
        $phone = $_POST["phone_no"];
        $pass = $_POST["password"];
        
        mysqli_set_charset($conn,'utf8');
        
        $sql = "UPDATE employee SET name = '$name', father_name = '$fathername', dob = '$dob', sex = '$sex', email = '$email', phone_no = '$phone', password = '$pass' where employee_id = '$eid'";
        
         if (mysqli_query($conn, $sql)) {
           
                  header("Location: employee.php?status=success");
                
             
         } else {
              header("Location: employee.php?status=failed");
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
                        <a class="active-menu" href="employee.php"><i class="fa fa-user" aria-hidden="true"></i>Employee</a>
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
                        <a href="support.php"><i class="fa fa-info-circle" aria-hidden="true"></i>Support</a>
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
                            Edit Employee<small>edit emloyee details</small>
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="index.php">Home</a></li>
					  <li><a href="employee.php">Employee</a></li>
					  <li class="active">Edit Employee</li>
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
        <strong>Success!</strong> Record Added/Updated sucessfully
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
		                                                    $eid = $_GET["eid"];
										                    mysqli_set_charset($conn,'utf8');
                									    	$sql = "SELECT * FROM employee where employee_id = '$eid'";
                                                            $result = $conn->query($sql);
                                                            
                                                            if ($result->num_rows > 0) {
                                                                // output data of each row
                                                                while($row = $result->fetch_assoc()) {
                                                                    $name = $row["name"];
                                                                    $fathername = $row["father_name"];
                                                                    $dob = $row["dob"];
                                                                    $sex = $row["sex"];
                                                                    $email = $row["email"];
                                                                    $phone = $row["phone_no"];
                                                                    $pass = $row["password"];
                                                                     
                                                                    
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
                                        <div class="title">Edit Emloyee</div>
                                    </div>
                                </div>
                                <form action="" method = "POST">
                                <div class="panel-body">
                                    
                                    <div class="sub-title">Full Name</div>
                                    <div>
                                        <input type="text" name="name" class="form-control" placeholder="full name" value="<?php echo $name;?>" required>
                                    </div><br>
                                    
                                    <div class="sub-title">Father's Name</div>
                                    <div>
                                    <input type="text" name="father_name" class="form-control" placeholder="father's name" value="<?php echo $fathername;?>" required>
                                    </div><br>
                                    
                                    <div class="sub-title">Date of birth</div>
                                    <div>
                                    <input type="date" name="dob" class="form-control" placeholder="dob" value="<?php echo $dob;?>" required>
                                    </div><br>
                                    
                                    <div class="sub-title">Gender</div>
                                        <div>
                                          <div class="radio3 radio-check radio-success radio-inline">
                                            <input type="radio" id="radio4" name="sex" <?php if($sex == "Male") { echo "checked"; }?> value="Male" checked="">
                                            <label for="radio4">
                                              Male
                                            </label>
                                          </div>
                                          <div class="radio3 radio-check radio-success radio-inline">
                                            <input type="radio" id="radio5" name="sex" <?php if($sex == "Female") { echo "checked"; }?> value="Female">
                                            <label for="radio5">
                                              Female
                                            </label>
                                          </div>
                                        </div>
                                        
                                            <div class="sub-title">Email</div>
                                    <div>
                                    <input type="email" name="email" class="form-control" placeholder="email"value="<?php echo $email;?>"  required>
                                    </div><br>
                                    
                                            <div class="sub-title">Mobile No.</div>
                                    <div>
                                    <input type="number" name="phone_no" class="form-control" placeholder="827XXXXXXX" value="<?php echo $phone;?>" required>
                                    </div><br>
                                    
                                  <div class="sub-title">Enter New Password</div>
                                    <div>
                                    <input type="text" name="password" class="form-control" placeholder="Example:name@123" value="<?php echo $pass;?>" required>
                                    </div><br>
                                                
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
