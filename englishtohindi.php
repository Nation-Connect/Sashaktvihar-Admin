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
    <title>Sashaktvihar-Admin Panel</title>
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
                            English to Hindi
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="index.php">Home</a></li>
					  <li class="active">English to Hindi</li>
					  
					</ol> 
									
		</div>
		<div class="header"> 
            
             <div class="jobdata">
		       <b>Insert Characters&nbsp;&nbsp;</b>
                    		<button type="button" class='btn btn-light' id="purnviram" OnClick="myFunction1()" title="??????????????? ???????????????">&#2404;</button>
                    		<button type="button"  class='btn btn-light' id="deerghviram" OnClick="myFunction2()" title="??????????????? ???????????????">&#2405;</button>
                    		<button type="button" class='btn btn-light' id="laghav" OnClick="myFunction3()" title="???????????? ???????????????">&#2416;</button>
                    		<button type="button" class='btn btn-light' id="om" OnClick="myFunction5()" title="???">&#2384;</button><br><br>

		      <textarea id="english2hindi" name="data" style="width:100%;height:200px;padding:10px;" placeholder="Type in english then press space"></textarea>
		      
		      (Press Space to convert text english to hindi)
                        <p><span style="color:red;">Note:</span> Use <b>Ctrl+g</b> to toggle between English and Hindi</p>
                                                       
                                                        
                                                        
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
    
     <script>
       
    
    function myFunction1() {
    	document.getElementById("english2hindi").value+='???';
    }
    function myFunction2() {
    	document.getElementById("english2hindi").value+='???';
    }
    function myFunction3() {
    	document.getElementById("english2hindi").value+='???';
    }
    function myFunction5() {
    	document.getElementById("english2hindi").value+=' ??? ';
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
