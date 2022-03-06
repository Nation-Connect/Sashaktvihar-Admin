<?php 
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[1];
?>
<nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><strong>Sashakt Vihar</strong></a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user"
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
                        <a class="<?php if ($first_part=="") {echo "active-menu"; }?>" href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a class="<?php if ($first_part=="employee.php") {echo "active-menu"; }?>" href="employee.php"><i class="fa fa-user" aria-hidden="true"></i>Employee</a>
                    </li>
                    <li>
                        <a class="<?php if ($first_part=="consumerregist.php") {echo "active-menu"; }?>" href="consumerregist.php"><i class="fa fa-users" aria-hidden="true"></i>Consumer Registration</a>
                    </li>
                    <li>
                        <a class="<?php if ($first_part=="registration.php") {echo "active-menu"; }?>" href="registration.php" class="notifyonclk"><i class="fa fa-user-circle" aria-hidden="true"></i>Job Registration &nbsp;&nbsp;<span class="glyphicon not"><mark class="big swing"><span class="notifydata"></span></mark></span></a>
                    </li>
                    <li>
                        <a class="<?php if ($first_part=="gallery.php") {echo "active-menu"; }?>" href="gallery.php"><i class="fa fa-file-image-o" aria-hidden="true"></i>Gallery</a>
                    </li>
                    <li>
                        <a class="<?php if ($first_part=="textslider.php") {echo "active-menu"; }?>" href="textslider.php"><i class="fa fa-sliders" aria-hidden="true"></i>Text Slider</a>
                    </li>
                    <li>
                        <a class="<?php if ($first_part=="notice.php") {echo "active-menu"; }?>" href="notice.php"><i class="fa fa-comment-o" aria-hidden="true"></i>Notice</a>
                    </li>
                    <li>
                        <a class="<?php if ($first_part=="support.php") {echo "active-menu"; }?>" href="support.php"><i class="fa fa-info-circle" aria-hidden="true"></i>Support</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap"></i> ONLINE APPLICATION <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="<?php if ($first_part=="job.php") {echo "active-menu"; }?>" href="job.php">Job</a>
                            </li>
                            <li>
                                <a class="<?php if ($first_part=="tender.php") {echo "active-menu"; }?>" href="tender.php">Tender</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->