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
    <title>Apbiharpower-Admin Panel</title>
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
                    		<button type="button" class='btn btn-light' id="purnviram" OnClick="myFunction1()" title="पूर्ण विराम">&#2404;</button>
                    		<button type="button"  class='btn btn-light' id="deerghviram" OnClick="myFunction2()" title="दीर्घ विराम">&#2405;</button>
                    		<button type="button" class='btn btn-light' id="laghav" OnClick="myFunction3()" title="लाघव चिन्ह">&#2416;</button>
                    		<button type="button" class='btn btn-light' id="om" OnClick="myFunction5()" title="ॐ">&#2384;</button><br><br>

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
