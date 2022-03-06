<?php

    session_start();
    if(isset($_SESSION["admin_id"])){ 
    header("Location: index.php");
    } 

    include 'db.php';
    
    if(isset($_POST['submit']))
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // $sql = "SELECT * FROM employee where email = '$email' AND password = '$password'";
        // $result = $conn->query($sql);
                                                                
        // if ($result->num_rows > 0) {
                                                                    
        //     while($row = $result->fetch_assoc()) {
        //         $_SESSION["employee_id"] = $row['employee_id'];
        //         header("Location: index.php");
        //     }
        // } else {
        //     echo '<script type="text/javascript">
        //           alert("Error. Please enter correct Username password.");
        // </script>';
                
        //     //echo "not found";
        // }
        
        if ($username == "admin" && $password == "ap@chandan") {
                                                                    
           
                 $_SESSION["admin_id"] = "admin";
                header("Location: index.php");
            
        } else {
            echo '<script type="text/javascript">
                   alert("Error. Please enter correct Username & password.");
        </script>';
                
            //echo "not found";
        }
    }

?>


<!DOCTYPE html>
<html>
<head>
	<title>Apbiharpower</title>
   <!--Made with love by Mutiullah Samim -->
 
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="assets/js/jquery-1.10.2.js"></script>
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					
					<span>Admin login</span>
					
				</div>
			</div>
			<div class="card-body">
				<form action="" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-users"></i></span>
						</div>
						<input type="text" name="username" id="email" class="form-control" placeholder="username" required>
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="password" required>
					</div>
					<p class="error" id="error" style="color:red;">Error. Please enter correct Username &amp; password.</p>
					<!--<div class="row align-items-center remember">-->
					<!--	<input type="checkbox">Remember Me-->
					<!--</div>-->
					<div class="form-group">
						<input type="submit" name="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<!--<div class="card-footer">-->
			<!--	<div class="d-flex justify-content-center">-->
			<!--		<a href="#">Forgot your password?</a>-->
			<!--	</div>-->
			<!--</div>-->
		</div>
	</div>
</div>
</body>
</html>