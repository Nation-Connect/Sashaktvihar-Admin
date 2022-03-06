<?php
session_set_cookie_params(0);
session_start();
if (!isset($_SESSION["admin_id"]) || session_id() == '') {
    header("Location: login.php");
    exit();
}
include 'db.php';
if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $fathername = $_POST["father_name"];
    $dob = $_POST["dob"];
    $sex = $_POST["sex"];
    $email = $_POST["email"];
    $phone = $_POST["phone_no"];
    $pass = $_POST["password"];
    $concat_data = "SVEID";
    mysqli_set_charset($conn, 'utf8');
    $sql = "INSERT INTO employee(employee_id, name, father_name, dob, sex, email, phone_no, password, concat_data) VALUES('','$name','$fathername','$dob','$sex','$email','$phone','$pass','$concat_data')";
    $sqll = "UPDATE employee SET employee_id = concat( concat_data, id ) where email = '$email' AND phone_no ='$phone'";
    if (mysqli_query($conn, $sql)) {
        if (mysqli_query($conn, $sqll)) {
            header("Location: employee.php?status=success");
        } else {
            header("Location: employee.php?status=failed");
            // echo mysqli_error($conn);
        }
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
    <title>Sashaktvihar-Admin Panel</title>
    <script src="ckeditor/ckeditor.js"></script>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="assets/css/select2.min.css" rel="stylesheet">
    <link href="assets/css/checkbox3.min.css" rel="stylesheet">
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
    <div id="wrapper">
    <?php include 'header.php'; ?>
        <div id="page-wrapper">
            <div class="header">
                <h1 class="page-header">
                    Add Employee<small>add new employee</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="employee.php">Employee</a></li>
                    <li class="active">Add Employee</li>
                </ol>

            </div>
            <?php
            error_reporting(E_ALL ^ E_NOTICE);
            if ($_GET['status'] == "success") {
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
            } else if ($_GET['status'] == "failed") {
                echo '<div class="alert-box header">
                    <div class="alert alert-danger">
                    <div class="alert-message text-left">
                        <strong>Error!</strong> Something went wrong
                    </div>
                    </div>
                </div>';
            } else {
            }
            ?>
            <div class="header">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="card-title">
                                    <div class="title">Add Emloyee</div>
                                </div>
                            </div>
                            <form action="" method="POST">
                                <div class="panel-body">
                                    <div class="sub-title">Full Name</div>
                                    <div>
                                        <input type="text" name="name" class="form-control" placeholder="full name" required>
                                    </div><br>
                                    <div class="sub-title">Father's Name</div>
                                    <div>
                                        <input type="text" name="father_name" class="form-control" placeholder="father's name" required>
                                    </div><br>
                                    <div class="sub-title">Date of birth</div>
                                    <div>
                                        <input type="date" name="dob" class="form-control" placeholder="dob" required>
                                    </div><br>
                                    <div class="sub-title">Gender</div>
                                    <div>
                                        <div class="radio3 radio-check radio-success radio-inline">
                                            <input type="radio" id="radio4" name="sex" value="Male" checked="">
                                            <label for="radio4">
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio3 radio-check radio-success radio-inline">
                                            <input type="radio" id="radio5" name="sex" value="Female">
                                            <label for="radio5">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                    <div class="sub-title">Email</div>
                                    <div>
                                        <input type="email" name="email" class="form-control" placeholder="email" required>
                                    </div><br>
                                    <div class="sub-title">Mobile No.</div>
                                    <div>
                                        <input type="number" name="phone_no" class="form-control" placeholder="827XXXXXXX" required>
                                    </div><br>
                                    <div class="sub-title">Enter New Password</div>
                                    <div>
                                        <input type="text" name="password" class="form-control" placeholder="Example:name@123" required>
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
                <footer>
                    <p>All right reserved.</p>
                </footer>
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
        CKEDITOR.replace('editor1', {
            height: '300px'
        });

        CKEDITOR.replace('editor2', {
            height: '400px'
        });
    </script>

    <script>
        var old_count = 0;
        setInterval(function() {
            $.ajax({
                type: "POST",
                url: "notifynewjobreg.php",
                success: function(data) {
                    if (data > old_count) {
                        $(".not").show();
                        $(".notifydata").empty();
                        $(".notifydata").append(data);
                        old_count = data;
                    } else if (data == 0 || old_count == 0) {
                        old_count = data;
                        $(".not").hide();
                    }
                }
            });
        }, 1000);
    </script>
    <script>
        $(".notifyonclk").click(function(e) {
            $.ajax({
                url: "notifyupdtjobreg.php",
                data: {
                    id: ""
                },
                type: "POST",
                success: function(data) {

                },
                //on error
                error: function() {

                }
            });
        });
    </script>
</body>
</html>