<?php
session_set_cookie_params(0);
session_start();
if (!isset($_SESSION["admin_id"]) || session_id() == '') {
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
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <link href="assets/css/select2.min.css" rel="stylesheet">
    <link href="assets/css/checkbox3.min.css" rel="stylesheet">

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
        <div id="page-wrapper">
            <div class="header">
                <h1 class="page-header">
                    Employee
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Employee</li>
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
        <strong>Success!</strong> Record Added/Updated successfully
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
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="board">
                            <div class="panel panel-primary">
                                <div class="number">
                                    <h3>
                                        <?php

                                        $totalregistrationsql = "SELECT count(id) FROM employee";
                                        $totalregistrationresult = $conn->query($totalregistrationsql);
                                        $row = mysqli_fetch_array($totalregistrationresult);
                                        $total = $row[0];
                                        echo '<h3>' . $total . '</h3>';
                                        ?>

                                        <small>Total Employee</small>
                                    </h3>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users fa-4x red"></i>
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
                                Generate Total Employee Report
                            </div>
                            <div class="panel-body">
                                <form target="_blank" action="reportpdf.php" method="POST">
                                    <div class="sub-title">Select Date</div>
                                    <div class="col-md-4">
                                        <div class="sub-title">From</div>
                                        <div>
                                            <input type="date" name="datefrom" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="sub-title">To</div>
                                        <div>
                                            <input type="date" name="dateto" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="sub-title">Generate</div>
                                        <div>
                                            <input type="Submit" class="btn btn-primary" name="submit" value="Generate Report">
                                        </div>
                                    </div>



                                </form>

                            </div>
                            <br><br>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Generate Individual Employee Report
                            </div>
                            <div class="panel-body">
                                <form target="_blank" action="indireport.php" method="POST">
                                    <div class="col-md-3">
                                        <div class="sub-title">Select Employee</div>
                                        <div>
                                            <select name="employeeidname" id="select-employee" class="form-control" required>
                                                <optgroup label="Employee Name (Employee Id)">
                                                    <option value="" disabled selected></option>
                                                    <?php

                                                    $sql = "SELECT * FROM employee";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        // output data of each row
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '<option value="' . $row["name"] . ' [' . $row["employee_id"] . ']' . '">' . $row["name"] . ' [' . $row["employee_id"] . ']' . '</option>';
                                                        }
                                                    } else {
                                                        //echo "<img src='img/nojob.png' style='display: block; width:30%; margin-left:auto; margin-right:auto;'>";
                                                        //echo "not found";
                                                    }

                                                    ?>


                                                </optgroup>
                                            </select>




                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="sub-title">From</div>
                                        <div>
                                            <input type="date" name="datefrom" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="sub-title">To</div>
                                        <div>
                                            <input type="date" name="dateto" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="sub-title">Generate</div>
                                        <div>
                                            <input type="Submit" class="btn btn-primary" name="submit" value="Generate Report">
                                        </div>
                                    </div>



                                </form>

                            </div>
                            <br><br>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading"><br>
                                <a href="addemployee.php"><button type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Employee</button></a><br><br><br>
                                Employee details
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Father's Name</th>
                                                <th>Email ID</th>
                                                <th>Mobile No.</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            mysqli_set_charset($conn, 'utf8');
                                            $registrationsql = "SELECT * FROM employee ORDER BY id DESC";
                                            $registrationresult = $conn->query($registrationsql);

                                            if ($registrationresult->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $registrationresult->fetch_assoc()) {
                                                    echo '<tr class="gradeA"><td>' . $row["employee_id"] . '</td><td>' . $row["name"] . '</td><td>' . $row["father_name"] . '</td><td>' . $row["email"] . '</td><td>' . $row["phone_no"] . '</td>
                                                                    <td><center><a href="editemployee.php?eid=' . $row["employee_id"] . '"><button class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i> Edit </button></a></center></td>';
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
    <footer>
        <p>All right reserved.</p>
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
            $(document).ready(function() {
                $('#dataTables-example').dataTable();
            });
        </script>
        <!-- Custom Js -->
        <script src="assets/js/custom-scripts.js"></script>
        <script>
            $('#dataTables-example').DataTable({
                "ordering": false
            });

            $(document).ready(function() {
                $('.dataTables_filterinput[type="search"]').css({
                    'width': '450px',
                    'display': 'inline-block'
                });
            });
        </script>
        <script src="assets/js/select2.full.min.js"></script>
        <script>
            $("#select-employee").select2({
                placeholder: "Select Employee",
                allowClear: true
            });
        </script>

        <!-- Custom Js -->
        <script src="assets/js/custom-scripts.js"></script>

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