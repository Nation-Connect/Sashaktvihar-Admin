<?php
	    session_set_cookie_params(0);
	    session_start();
    if(!isset($_SESSION["admin_id"]) || session_id() == ''){ 
    header("Location: login.php");
    exit();
    } 
    if (empty($_GET['cid'])) {
	        header("Location: index.php"); 
            exit();
	    }
	    
	    include 'db.php';
	    
	    
	    $id = $_GET["cid"];
        
    if(isset($_POST['submit']))
    {	
        
        $name = $_POST["name"];
        $fathername = $_POST["father_name"];
        $mothername = $_POST["mother_name"];
        $dob = $_POST["dob"];
        $sex = $_POST["sex"];
        $plan = $_POST["plan"];
        $vill = $_POST["vill"];
        $wardno = $_POST["ward_no"];
        $post = $_POST["post"];
        $blockname = $_POST["block_name"];
        $distname = $_POST["dist_name"];
        $state = $_POST["state"];
        $pincode = $_POST["pincode"];
        $email = $_POST["email"];
        $phoneno = $_POST["phone_no"];
        $secphoneno = $_POST["secphone_no"];
        $aadharno = $_POST["aadhar_no"];
        $landmark = $_POST["landmark"];
        
        date_default_timezone_set("Asia/Calcutta");
        $concat_data = "APCID".date("ymd");
        
        date_default_timezone_set("Asia/Calcutta");
        $date = date("Y-m-d h:i:s");
        
        // mysqli_set_charset($conn,'utf8');
        
        $sql = "UPDATE consumer_registration SET name = '$name', father_name = '$fathername', mother_name='$mothername', sex= '$sex', dob= '$dob', plan= '$plan', vill= '$vill', ward_no= '$wardno', post= '$post', block_name= '$blockname', district_name= '$distname', state= '$state', pincode= '$pincode', mobile_no= '$phoneno', secmob_no= '$secphoneno', email= '$email', aadhar_no= '$aadharno', land_mark= '$landmark' where consumer_id = '$id'";
        
         if (mysqli_query($conn, $sql)) {
          
                  
                  header("Location: consumerregist.php?status=success");
            
             
         } else {
              header("Location: consumerregist.php?status=failed");
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
    <title>Apbiharpower-Employee Panel</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    
    <link rel="icon" href="assets/img/logo1.png" type="image/icon type">
    
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css"> 
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                <a class="navbar-brand" href="index.html"><strong>Apbiharpower</strong></a>
				
		
            </div>

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
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
                        <a class="active-menu" href="consumerregist.php"><i class="fa fa-users" aria-hidden="true"></i>Consumer Registration</a>
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
        <div id="page-wrapper" >
		  <div class="header"> 
                        <h1 class="page-header">
                            Edit Consumer <small>edit consumer Details</small>
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="index.php">Home</a></li>
					  <li class ="active">Edit Consumer</a></li>
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
		                                                    $id = $_GET["cid"];
										                    mysqli_set_charset($conn,'utf8');
                									    	$sql = "SELECT * FROM consumer_registration where consumer_id = '$id'";
                                                            $result = $conn->query($sql);
                                                            
                                                            if ($result->num_rows > 0) {
                                                                // output data of each row
                                                                while($row = $result->fetch_assoc()) {
                                                                    $name = $row['name'];
                                                                    $fathername = $row["father_name"];
                                                                    $mothername = $row["mother_name"];
                                                                    $dob = $row["dob"];
                                                                    $sex = $row["sex"];
                                                                    $plan = $row["plan"];
                                                                    $vill = $row["vill"];
                                                                    $wardno = $row["ward_no"];
                                                                    $post = $row["post"];
                                                                    $blockname = $row["block_name"];
                                                                    $distname = $row["district_name"];
                                                                    $state = $row["state"];
                                                                    $pincode = $row["pincode"];
                                                                    $email = $row["email"];
                                                                    $phoneno = $row["mobile_no"];
                                                                    $secphoneno = $row["secmob_no"];
                                                                    $aadharno = $row["aadhar_no"];
                                                                    $landmark = $row["land_mark"];
                                                                     
                                                                    
                                                                    
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
                                        <div class="title">Add Consumer Details</div>
                                    </div>
                                </div>
                                <form action="" method = "POST" enctype="multipart/form-data">
                                <div class="panel-body">
                                    
                                    <div class="sub-title">Consumer Name</div>
                                    <div>
                                        <input type="text" name="name" class="form-control" placeholder="full name" value="<?php echo $name;?>" required>
                                    </div><br>
                                    
                                    <div class="sub-title">Father's Name</div>
                                    <div>
                                    <input type="text" name="father_name" class="form-control" placeholder="father's name" value="<?php echo $fathername;?>" required>
                                    </div><br>
                                    
                                    <div class="sub-title">Mother's Name</div>
                                    <div>
                                    <input type="text" name="mother_name" class="form-control" placeholder="mother's name" value="<?php echo $mothername;?>" required>
                                    </div><br>
                                    
                                    <div class="sub-title">Date of birth</div>
                                    <div>
                                    <input type="date" name="dob" class="form-control" placeholder="dob" value="<?php echo $dob;?>" required>
                                    </div><br>
                                    
                                    <div class="sub-title">Gender</div>
                                        <div>
                                          <div class="radio3 radio-check radio-success radio-inline">
                                            <input type="radio" id="radio4" name="sex" <?php if($sex == "Male") { echo "checked"; }?> value="Male">
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
                                        </div><br>
                                        
                                    <div class="sub-title">Select Plan</div>
                                    <div>
                                        <select name="plan" class="selectbox" required>
                                            <optgroup label="Choose Plan">
                                                <option <?php if($plan == "Rs 300 (Six Months)") { echo 'selected="selected"'; }?> value="Rs 300 (Six Months)">Rs 300 (Six Months)</option>
                                                <option <?php if($plan == "Rs 500 (One Year)") { echo 'selected="selected"'; }?> value="Rs 500 (One Year)">Rs 500 (One Year)</option>
                                            </optgroup>
                                        </select>
                                    </div><br>
                                    
                                    <div class="sub-title">Permanent Address:-</div>
                                    <div class="sub-title">Village</div>
                                    <div>
                                    <input type="text" name="vill" class="form-control" placeholder="village" value="<?php echo $vill;?>" required>
                                    </div><br>
                                    
                                    <div class="sub-title">Tola/Ward No.</div>
                                    <div>
                                    <input type="text" name="ward_no" class="form-control" placeholder="ward no" value="<?php echo $wardno;?>" required>
                                    </div><br>
                                    
                                    <div class="sub-title">Post</div>
                                    <div>
                                    <input type="text" name="post" class="form-control" placeholder="post office" value="<?php echo $post;?>" required>
                                    </div><br>
                                    <div class="sub-title">Block Name</div>
                                    <div>
                                    <input type="text" name="block_name" class="form-control" placeholder="block name" value="<?php echo $blockname;?>" required>
                                    </div><br>
                                    
                                     <div class="sub-title">District Name</div>
                                    <div>
                                    <input type="text" name="dist_name" class="form-control" placeholder="district name" value="<?php echo $distname;?>" required>
                                    </div><br>
                                    
                                    <div class="sub-title">State</div>
                                    <div>
                                        <select name="state" class="selectbox" required>
                                            <optgroup label="Select State">
                                                <option value="Bihar">Bihar</option>
                                            </optgroup>
                                        </select>
                                    </div><br>
                                    
                                     <div class="sub-title">Pincode</div>
                                    <div>
                                    <input type="text" name="pincode" class="form-control" placeholder="pincode" value="<?php echo $pincode;?>" required>
                                    </div><br>
                                     
                                    
                                    <div class="sub-title">Email (Optional)</div>
                                    <div>
                                    <input type="email" name="email" class="form-control" placeholder="email" value="<?php echo $email;?>">
                                    </div><br>
                                    
                                    <div class="sub-title">Mobile No.</div>
                                    <div>
                                    <input type="number" name="phone_no" class="form-control" placeholder="827XXXXXXX" value="<?php echo $phoneno;?>" required>
                                    </div><br>
                                    
                                    <div class="sub-title">Secondary Mobile No. (Optional)</div>
                                    <div>
                                    <input type="number" name="secphone_no" class="form-control" placeholder="834XXXXXXX" value="<?php echo $secphoneno;?>">
                                    </div><br>
                                    
                                  <div class="sub-title">Aadhaar Number</div>
                                    <div>
                                    <input type="number" name="aadhar_no" class="form-control" placeholder="aadhaar number" value="<?php echo $aadharno;?>" required>
                                    </div><br>
                                    
                                    <div class="sub-title">Landmark (Optional)</div>
                                    <div>
                                    <input type="text" name="landmark" class="form-control" placeholder="Landmark (Ex: oppt. of axis bank)" value="<?php echo $landmark;?>">
                                    </div><br>
                                    <!--<div class="form-group">-->
                                    <!--        <label for="imageUpload">Upload Image</label>-->
                                    <!--        <input type="file" name="imag" accept="image/*" id="imageUpload" onchange="Filevalidation()">-->
                                    <!--        <p style="margin-top:-5px;">(max-size:- 1Mb)</p>-->
                                            
                                    <!--    </div>-->
                                        
                                                
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
