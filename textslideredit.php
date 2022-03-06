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
        
        $data = $_POST["data"];
        mysqli_set_charset($conn,'utf8');
        $sql = "UPDATE textslider SET data = '$data' WHERE id = $id";
        
        
         if (mysqli_query($conn, $sql)) {
           
                  header("Location: textslideredit.php?status=success&id=$id");
             
         } else {
              header("Location: textslideredit.php?status=failed&id=$id");
             //echo mysqli_error($conn);
             
             
         }

        
     
} 
	?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta content="" name="description" />
    <meta content="sashaktvihar" name="sashaktvihar" />
    <title>Sashaktvihar-Text Slider</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   
   
  <script type="text/javascript" src="https://www.google.com/jsapi">
    </script>

    <script type="text/javascript">
      google.load("elements", "1", {
            packages: "transliteration"
          });
 
      function onLoad() {
        var options = {
            sourceLanguage:
                google.elements.transliteration.LanguageCode.ENGLISH,
            destinationLanguage:
                [google.elements.transliteration.LanguageCode.HINDI],
            shortcutKey: 'ctrl+g',
            transliterationEnabled: true
        };
        var control =
            new google.elements.transliteration.TransliterationControl(options);
        control.makeTransliteratable(['english2hindi']);
        control.c.qc.t13n.c[3].c.d.keyup[0].ia.F.p = 'https://www.google.com';
      }
      google.setOnLoadCallback(onLoad);
      
    </script>
    

</head>
<body>
    <div id="wrapper">
    <?php include 'header.php'; ?>
        <div id="page-wrapper">
		  <div class="header"> 
                        <h1 class="page-header">
                            Text Slider <small>Edit Slider</small>
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="index.php">Home</a></li>
					  <li><a href="textslider.php">Text Slider</a></li>
					  <li class="active">Text Slider Edit</li>
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

		<div class="header"> 
            <h2 class="page-header">
                Edit Slider
            </h2>
             <div class="textsliderdata">
                 
                                                        
                 <form action="" method = "POST">
                     <b>Insert Characters&nbsp;&nbsp;</b>
                    		<button type="button" class='btn btn-light' id="purnviram" OnClick="myFunction1()" title="पूर्ण विराम">&#2404;</button>
                    		<button type="button"  class='btn btn-light' id="deerghviram" OnClick="myFunction2()" title="दीर्घ विराम">&#2405;</button>
                    		<button type="button" class='btn btn-light' id="laghav" OnClick="myFunction3()" title="लाघव चिन्ह">&#2416;</button>
                    		<button type="button" class='btn btn-light' id="om" OnClick="myFunction5()" title="ॐ">&#2384;</button><br><br>
                     <?php
										                    $id = $_GET["id"];
										                    mysqli_set_charset($conn,'utf8');
                									    	$slidersql = "SELECT * FROM textslider where id = $id";
                                                            $slideresult = $conn->query($slidersql);
                                                            
                                                            if ($slideresult->num_rows > 0) {
                                                                // output data of each row
                                                                while($row = $slideresult->fetch_assoc()) {
                                                                    //echo '<p style="font-size:16px;">'.$row["data"].'<br><br><a href="textslideredit.php?id=1"><button class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </button></a>';
                                                                    
                                                                    echo '<textarea id="english2hindi" name="data" style="width:100%;height:200px;padding:10px;">'.$row["data"].'</textarea>';
                                                                    
                                                                }
                                                            } else {
                                                                //echo "<img src='img/nojob.png' style='display: block; width:30%; margin-left:auto; margin-right:auto;'>";
                                                                //echo "not found";
                                                            }
                                                            
                     ?>
                      
                        (Press Space to convert text english to hindi)
                        <p><span style="color:red;">Note:</span> Use <b>Ctrl+g</b> to toggle between English and Hindi</p>
                     <input type="submit" name="submit" value="Update" class="btn btn-primary">
                     
                 </form>
		        
		       </div>
        </div><br>
        
      
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
    <script src="assets/js/speechtotext.js"></script>
    
    <script>
       
    
    function myFunction1() {
    	document.getElementById("english2hindi").value+='।';
    }
    function myFunction2() {
    	document.getElementById("english2hindi").value+='॥';
    }
    function myFunction3() {
    	document.getElementById("english2hindi").value+='॰';
    }
    function myFunction5() {
    	document.getElementById("english2hindi").value+=' ॐ ';
    }
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
