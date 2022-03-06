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
    <meta content="sashaktvihar" name="sashaktvihar" />
    <title>Sashaktvihar-Gallery</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
</head>
<body>
    <div id="wrapper">
    <?php include 'header.php'; ?>
        <div id="page-wrapper">
		  <div class="header"> 
                        <h1 class="page-header">
                            Gallery <small>Manage Gallery</small>
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="index.php">Home</a></li>
					  <li class="active">Gallery</li>
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
        <strong>Success!</strong> Image uploaded successfully
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
            }else if($_GET['status'] == "already" )
            {
                            echo '<div class="alert-box header">
    <div class="alert alert-danger">
      
      <div class="alert-message text-left">
        <strong>Error!</strong> File name already exists.
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
        <strong>Success!</strong> Image Deleted successfully
      </div>
    </div>
  </div>';
            }else
            {
               
            }
        
        
        ?>
        
		<div class="header"> 
            
             <div class="textsliderdata">
                 <div class="row photos">
								    
								    <div class="col-12 item">
								        <button type="button" data-toggle="modal" data-target="#addimg" class="btn btn-primary" style="margin-left:10px;"><i class="fa fa-plus" aria-hidden="true"></i> Add Image</button><br><br>
								        
		                                    <?php
										                    
                									    	$slidersql = "SELECT * FROM gallery ORDER BY id DESC";
                                                            $slideresult = $conn->query($slidersql);
                                                            
                                                            if ($slideresult->num_rows > 0) {
                                                                // output data of each row
                                                                while($row = $slideresult->fetch_assoc()) {
                                                                    
                                                                    echo '<div class="gallery-item">
                                                                          <div><a href="https://sashaktvihar.com/img/gallery/'.$row["link"].'"data-lightbox="photos"><img class="img-fluid galimg" src="https://sashaktvihar.in/img/gallery/'.$row["link"].'" style="padding:5px;" alt="sashaktvihar.in"/></a></div><div style="float:right;padding:5px 5px;">
                                                                         <button class="btn btn-danger" data-href="delimg.php?id='.$row["id"].'" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </button><br></div></div>';
                                                                          
                                                                   
                                                                }
                                                            } else {
                                                                //echo "<img src='img/nojob.png' style='display: block; width:30%; margin-left:auto; margin-right:auto;'>";
                                                                //echo "not found";
                                                            }
                                                            
                                                        ?>
                </div>
                </div>
		       </div>
        </div><br>
        
  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3><b>Confirmation</b></h3><br>
            </div>
            <div class="modal-body">
               Are you sure want to delete this Image ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="addimg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3><b>Select Image</b></h3><br>
            </div>
            <div class="modal-body">
               <form action="addimg.php" method="POST" enctype="multipart/form-data">
                   <input type="file" name="uploadImage" id="" accept="image/*" required>
                   
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-success btn-ok">Upload</button>
                
            </div>
            </form>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
     <script>
          
  $(document).ready(function() {
    $('a[data-confirm]').click(function(ev) {
        var href = $(this).attr('href');

        if (!$('#dataConfirmModal').length) {
            $('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Please Confirm</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button><a class="btn btn-primary" id="dataConfirmOK">OK</a></div></div>');
        } 
        $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
        $('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show:true});
        return false;
    });
});

$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

/*POST

// Bind click to OK button within popup
$('#confirm-delete').on('click', '.btn-ok', function(e) {

  var $modalDiv = $(e.delegateTarget);
  var id = $(this).data('recordId');

  $modalDiv.addClass('loading');
  $.post('/api/record/' + id).then(function() {
     $modalDiv.modal('hide').removeClass('loading');
  });
});

// Bind to modal opening to set necessary data properties to be used to make request
$('#confirm-delete').on('show.bs.modal', function(e) {
  var data = $(e.relatedTarget).data();
  $('.title', this).text(data.recordTitle);
  $('.btn-ok', this).data('recordId', data.recordId);
});

//OLD



*/
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
