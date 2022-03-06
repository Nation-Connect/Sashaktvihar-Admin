<?php
	     session_set_cookie_params(0);
	    session_start();
    if(!isset($_SESSION["admin_id"]) || session_id() == ''){ 
    header("Location: login.php");
    exit();
    } 
	    include 'db.php';
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta content="" name="description" />
    <meta content="apbiharpower" name="apbiharpower" />
    <title>Sashaktvihar-Admin Panel</title>
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
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css"> 
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
    <div id="wrapper">
    <?php include 'header.php'; ?>
        <div id="page-wrapper" >
		  <div class="header"> 
                        <h1 class="page-header">
                            Job Registration <small>Job Registration Details</small>
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="index.php">Home</a></li>
					  <li class="active">Job Registration</li>
					</ol> 
									
		</div>
		
            <div id="page-inner"> 
               <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
					<div class="board">
                        <div class="panel panel-primary">
						<div class="number">
							<h3>
							    <?php
										                    
                									    	$totalregistrationsql = "SELECT count(id) FROM registration";
                                                            $totalregistrationresult = $conn->query($totalregistrationsql);
                                                            $row = mysqli_fetch_array($totalregistrationresult);
                                                            $total = $row[0];
                                                            echo '<h3>'.$total.'</h3>';
                                                        ?>
								
								<small>Total</small>
							</h3> 
						</div>
						<div class="icon">
						   <i class="fa fa-calculator fa-5x red"></i>
						</div>
		 
                        </div>
						</div>
                    </div>
					
					       <div class="col-md-3 col-sm-12 col-xs-12">
					<div class="board">
                        <div class="panel panel-primary">
						<div class="number">
							<h3>
							    <?php
										                    
                									    	$totalregistrationsql = "SELECT count(id) FROM registration WHERE YEARWEEK(date) = YEARWEEK(NOW())";
                                                            $totalregistrationresult = $conn->query($totalregistrationsql);
                                                            $row = mysqli_fetch_array($totalregistrationresult);
                                                            $total = $row[0];
                                                            echo '<h3>'.$total.'</h3>';
                                                        ?>
								
								<small>Week</small>
							</h3> 
						</div>
						<div class="icon">
						   <i class="fa fa-calendar-o fa-5x blue"></i>
						</div>
		 
                        </div>
						</div>
                    </div>
					
					       <div class="col-md-3 col-sm-12 col-xs-12">
					<div class="board">
                        <div class="panel panel-primary">
						<div class="number">
							<h3>
								<?php
										                    
                									    	$totalregistrationsql = "SELECT count(id) FROM registration WHERE MONTH(date) = MONTH(NOW()) AND YEAR(date) = YEAR(NOW())";
                                                            $totalregistrationresult = $conn->query($totalregistrationsql);
                                                            $row = mysqli_fetch_array($totalregistrationresult);
                                                            $total = $row[0];
                                                            echo '<h3>'.$total.'</h3>';
                                                        ?>
								<small>Month</small>
							</h3> 
						</div>
						<div class="icon">
						   <i class="fa fa-calendar fa-5x green"></i>
						</div>
		 
                        </div>
						</div>
                    </div>
					
					       <div class="col-md-3 col-sm-12 col-xs-12">
					<div class="board">
                        <div class="panel panel-primary">
						<div class="number">
							<h3>
								<?php
										                    
                									    	$totalregistrationsql = "SELECT count(id) FROM registration WHERE YEAR(date) = YEAR(NOW())";
                                                            $totalregistrationresult = $conn->query($totalregistrationsql);
                                                            $row = mysqli_fetch_array($totalregistrationresult);
                                                            $total = $row[0];
                                                            echo '<h3>'.$total.'</h3>';
                                                        ?>
								<small>Year</small>
							</h3> 
						</div>
						<div class="icon">
						   <i class="fa fa-calendar-check-o fa-5x yellow"></i>
						</div>
		 
                        </div>
						</div>
                    </div>
				   
                </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Job Registration details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Registration ID</th>
                                            <th>Name</th>
                                            <th>Registration date & time</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										                    mysqli_set_charset($conn,'utf8');
                									    	$registrationsql = "SELECT * FROM registration ORDER BY id DESC";
                                                            $registrationresult = $conn->query($registrationsql);
                                                            
                                                            if ($registrationresult->num_rows > 0) {
                                                                // output data of each row
                                                                while($row = $registrationresult->fetch_assoc()) {
                                                                    echo '<tr class="gradeA"><td>'.$row["registration_id"].'</td><td>'.$row["firstname"].' '.$row["lastname"].'</td><td>'.$row["date"].'</td>
                                                                    <td class="text-center"><a target="_blank" href="pdf.php?id='.$row["registration_id"].'"><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View </button></a>
                                                                    &nbsp;&nbsp;&nbsp;<a target="_blank" href="pdfdownload.php?id='.$row["registration_id"].'"><button class="btn btn-info"><i class="fa fa-download" aria-hidden="true"></i> Download </button></a></td>';
                                                                }
                                                            } else {
                                                                //echo "<img src='img/nojob.png' style='display: block; width:30%; margin-left:auto; margin-right:auto;'>";
                                                                //echo "not found";
                                                            }
                                                            
                                                        ?>
                                                        
                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
            
                </div>
            </div>
                <!-- /. ROW  -->
        </div>
               <footer><p>All right reserved.</p>
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    <script>
        
       $('#dataTables-example').DataTable({
        "ordering": false
        });
        
       $(document).ready(function () {             
  $('.dataTables_filterinput[type="search"]').css(
     {'width':'450px','display':'inline-block'}
  );
});
 
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
