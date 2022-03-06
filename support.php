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
    <link href="assets/css/select2.min.css" rel="stylesheet" >
	<link href="assets/css/checkbox3.min.css" rel="stylesheet" >
    
    <link rel="icon" href="assets/img/logo1.png" type="image/icon type">
    
    <!-- Google Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css"> 
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
</head>
<body>
    <div id="wrapper">
    <?php include 'header.php'; ?>
        
        
        <div id="page-wrapper" >
		  <div class="header"> 
                        <h1 class="page-header">
                            Support
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="index.php">Home</a></li>
					  <li class="active">Support</li>
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
        <strong>Success!</strong> Record Added/Updated successfully
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
            }else if($_GET['status'] == "delsuccess" )
            {
                            echo '<div class="alert-box header">
    <div class="alert alert-success">
      <div class="alert-icon text-center">
        <i class="fa fa-check-square  fa-3x" aria-hidden="true"></i>
      </div>
      <div class="alert-message text-center">
        <strong>Success!</strong> Record Deleted successfully
      </div>
    </div>
  </div>';
            }else
            {
               
            }
        
        
        ?>
            <div id="page-inner"> 
               <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
					<div class="board">
                        <div class="panel panel-primary">
						<div class="number">
							<h3>
							    <?php
										                    
                									    	$totalsupportsql = "SELECT count(id) FROM support";
                                                            $totalsupportresult = $conn->query($totalsupportsql);
                                                            $row = mysqli_fetch_array($totalsupportresult);
                                                            $total = $row[0];
                                                            echo '<h3>'.$total.'</h3>';
                                                        ?>
								
								<small>Total Support Branch</small>
							</h3> 
						</div>
						<div class="icon">
						   <i class="fa fa-support fa-4x red"></i>
						</div>
		 
                        </div>
						</div>
                    </div>
					
					   
				   
                </div>
                 
        
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading"
                        ><br>
                            <a href="addsupport.php"><button type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button></a><br><br><br>
                             Branch details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Profile Pic </th>
                                            <th>Name</th>
                                            <th>District </th>
                                            <th>Address</th>
                                            <th>Contact No.</th>
                                            <th>Calling Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										                    mysqli_set_charset($conn,'utf8');
                									    	$supportsql = "SELECT * FROM support ORDER BY id DESC";
                                                            $supportresult = $conn->query($supportsql);
                                                            
                                                            if ($supportresult->num_rows > 0) {
                                                                // output data of each row
                                                                while($row = $supportresult->fetch_assoc()) {
                                                                    echo '<tr class="gradeA">
                                                                    <td><center><img src="https://apbiharpower.in/'.$row["image"].'" width="50" height="50" style="border-radius:5px;"></center></td>
                                                                    <td>'.$row["name"].'</td><td>'.$row["dist"].'</td><td>'.substr_replace($row["address"], "...", 30).'</td><td>'.$row["contact_no"].'</td>
                                                                    <td>'.$row["calling_time"].'</td>
                                                                    <td><center><a href="editsupport.php?sid='.$row["id"].'"><button class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i> Edit </button></a>
                                                                    <button class="btn btn-danger" data-href="delsupport.php?id='.$row["id"].'" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </button><br></div></div></center></td>';
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
        
        
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3><b>Confirmation</b></h3><br>
            </div>
            <div class="modal-body">
               Are you sure want to delete this Record ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
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
    <script src="assets/js/select2.full.min.js"></script>
	<script>
$("#select-employee").select2( {
 placeholder: "Select Employee",
 allowClear: true
 } );
</script>
	
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
        
        <script>
            $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
        </script>
   
</body>
</html>
