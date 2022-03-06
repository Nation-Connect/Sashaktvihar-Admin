<?php
session_set_cookie_params(0);
session_start();
if (!isset($_SESSION["admin_id"]) || session_id() == '') {
  header("Location: login.php");
  exit();
}
include 'db.php';
// Load the Google API PHP Client Library.
require_once __DIR__ . '/googleanayltic/vendor/autoload.php';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="" name="description" />
  <meta content="Sashaktvihar" name="Sashaktvihar" />
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

  <script>
    // (function(w, d, s, g, js, fs) {
    //   g = w.gapi || (w.gapi = {});
    //   g.analytics = {
    //     q: [],
    //     ready: function(f) {
    //       this.q.push(f);
    //     }
    //   };
    //   js = d.createElement(s);
    //   fs = d.getElementsByTagName(s)[0];
    //   js.src = 'https://apis.google.com/js/platform.js';
    //   fs.parentNode.insertBefore(js, fs);
    //   js.onload = function() {
    //     g.load('analytics');
    //   };
    // }(window, document, 'script'));
  </script>
</head>
<body>
  <div id="wrapper">
  <?php include 'header.php'; ?>

    <div id="page-wrapper">
      <div class="header">
        <h1 class="page-header">
          Dashboard <small>Welcome</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </div>
      <div id="page-inner">
        <!-- /. ROW  -->
        <div class="row">
          <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="board">
              <div class="panel panel-primary">
                <div class="number">
                  <h3>
                    <?php
                    $analytics = initializeAnalytics();
                    $profile = getFirstProfileId($analytics);
                    $results = gettodayResults($analytics, $profile);
                    //printResults($results);
                    function initializeAnalytics()
                    {
                      // Creates and returns the Analytics Reporting service object.

                      // Use the developers console and download your service account
                      // credentials in JSON format. Place them in this directory or
                      // change the key file location if necessary.
                      $KEY_FILE_LOCATION = __DIR__ . '/service-account-credentials.json';

                      // Create and configure a new client object.
                      $client = new Google_Client();
                      $client->setApplicationName("Hello Analytics Reporting");
                      $client->setAuthConfig($KEY_FILE_LOCATION);
                      $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
                      $analytics = new Google_Service_Analytics($client);

                      return $analytics;
                    }

                    function getFirstProfileId($analytics)
                    {
                      // Get the user's first view (profile) ID.

                      // Get the list of accounts for the authorized user.
                      $accounts = $analytics->management_accounts->listManagementAccounts();

                      if (count($accounts->getItems()) > 0) {
                        $items = $accounts->getItems();
                        $firstAccountId = $items[0]->getId();

                        // Get the list of properties for the authorized user.
                        $properties = $analytics->management_webproperties
                          ->listManagementWebproperties($firstAccountId);

                        if (count($properties->getItems()) > 0) {
                          $items = $properties->getItems();
                          $firstPropertyId = $items[0]->getId();

                          // Get the list of views (profiles) for the authorized user.
                          $profiles = $analytics->management_profiles
                            ->listManagementProfiles($firstAccountId, $firstPropertyId);

                          if (count($profiles->getItems()) > 0) {
                            $items = $profiles->getItems();

                            // Return the first view (profile) ID.
                            return $items[0]->getId();
                          } else {
                            throw new Exception('No views (profiles) found for this user.');
                          }
                        } else {
                          throw new Exception('No properties found for this user.');
                        }
                      } else {
                        throw new Exception('No accounts found for this user.');
                      }
                    }

                    function gettodayResults($analytics, $profileId)
                    {
                      // Calls the Core Reporting API and queries for the number of sessions
                      // for the last seven days.
                      return $analytics->data_ga->get(
                        'ga:' . $profileId,
                        'today',
                        'today',
                        'ga:users'
                      );
                    }

                    function printResults($results)
                    {
                      // Parses the response from the Core Reporting API and prints
                      // the profile name and total sessions.
                      if (count($results->getRows()) > 0) {

                        // Get the profile name.
                        $profileName = $results->getProfileInfo()->getProfileName();

                        // Get the entry for the first entry in the first row.
                        $rows = $results->getRows();
                        $sessions = $rows[0][0];

                        // Print the results.

                        print "<h3>$sessions</h3>";
                      } else {
                        print "<h3>0</h3>";
                      }
                    }


                    ?>

                    <small>Today's Visitor</small>
                  </h3>
                </div>
                <div class="icon">
                  <i class="fa fa-eye fa-5x red"></i>
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
                    $analytics = initializeweekAnalytics();
                    $profile = getweekFirstProfileId($analytics);
                    $results = getweekResults($analytics, $profile);
                    //printweekResults($results);
                    function initializeweekAnalytics()
                    {
                      // Creates and returns the Analytics Reporting service object.

                      // Use the developers console and download your service account
                      // credentials in JSON format. Place them in this directory or
                      // change the key file location if necessary.
                      $KEY_FILE_LOCATION = __DIR__ . '/service-account-credentials.json';

                      // Create and configure a new client object.
                      $client = new Google_Client();
                      $client->setApplicationName("Hello Analytics Reporting");
                      $client->setAuthConfig($KEY_FILE_LOCATION);
                      $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
                      $analytics = new Google_Service_Analytics($client);
                      return $analytics;
                    }

                    function getweekFirstProfileId($analytics)
                    {
                      // Get the user's first view (profile) ID.

                      // Get the list of accounts for the authorized user.
                      $accounts = $analytics->management_accounts->listManagementAccounts();

                      if (count($accounts->getItems()) > 0) {
                        $items = $accounts->getItems();
                        $firstAccountId = $items[0]->getId();

                        // Get the list of properties for the authorized user.
                        $properties = $analytics->management_webproperties
                          ->listManagementWebproperties($firstAccountId);

                        if (count($properties->getItems()) > 0) {
                          $items = $properties->getItems();
                          $firstPropertyId = $items[0]->getId();

                          // Get the list of views (profiles) for the authorized user.
                          $profiles = $analytics->management_profiles
                            ->listManagementProfiles($firstAccountId, $firstPropertyId);

                          if (count($profiles->getItems()) > 0) {
                            $items = $profiles->getItems();

                            // Return the first view (profile) ID.
                            return $items[0]->getId();
                          } else {
                            throw new Exception('No views (profiles) found for this user.');
                          }
                        } else {
                          throw new Exception('No properties found for this user.');
                        }
                      } else {
                        throw new Exception('No accounts found for this user.');
                      }
                    }

                    function getweekResults($analytics, $profileId)
                    {
                      // Calls the Core Reporting API and queries for the number of sessions
                      // for the last seven days.
                      return $analytics->data_ga->get(
                        'ga:' . $profileId,
                        '7daysAgo',
                        'today',
                        'ga:users'
                      );
                    }

                    function printweekResults($results)
                    {
                      // Parses the response from the Core Reporting API and prints
                      // the profile name and total sessions.
                      if (count($results->getRows()) > 0) {

                        // Get the profile name.
                        $profileName = $results->getProfileInfo()->getProfileName();

                        // Get the entry for the first entry in the first row.
                        $rows = $results->getRows();
                        $sessions = $rows[0][0];

                        // Print the results.

                        print "<h3>$sessions</h3>";
                      } else {
                        print "<h3>0</h3>";
                      }
                    }

                    ?>

                    <small>Last 7 days</small>
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
                    $analytics = initializemonthAnalytics();
                    $profile = getmonthFirstProfileId($analytics);
                    $results = getmonthResults($analytics, $profile);
                    //printmonthResults($results);

                    function initializemonthAnalytics()
                    {
                      // Creates and returns the Analytics Reporting service object.

                      // Use the developers console and download your service account
                      // credentials in JSON format. Place them in this directory or
                      // change the key file location if necessary.
                      $KEY_FILE_LOCATION = __DIR__ . '/service-account-credentials.json';

                      // Create and configure a new client object.
                      $client = new Google_Client();
                      $client->setApplicationName("Hello Analytics Reporting");
                      $client->setAuthConfig($KEY_FILE_LOCATION);
                      $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
                      $analytics = new Google_Service_Analytics($client);

                      return $analytics;
                    }

                    function getmonthFirstProfileId($analytics)
                    {
                      // Get the user's first view (profile) ID.

                      // Get the list of accounts for the authorized user.
                      $accounts = $analytics->management_accounts->listManagementAccounts();

                      if (count($accounts->getItems()) > 0) {
                        $items = $accounts->getItems();
                        $firstAccountId = $items[0]->getId();

                        // Get the list of properties for the authorized user.
                        $properties = $analytics->management_webproperties
                          ->listManagementWebproperties($firstAccountId);

                        if (count($properties->getItems()) > 0) {
                          $items = $properties->getItems();
                          $firstPropertyId = $items[0]->getId();

                          // Get the list of views (profiles) for the authorized user.
                          $profiles = $analytics->management_profiles
                            ->listManagementProfiles($firstAccountId, $firstPropertyId);

                          if (count($profiles->getItems()) > 0) {
                            $items = $profiles->getItems();

                            // Return the first view (profile) ID.
                            return $items[0]->getId();
                          } else {
                            throw new Exception('No views (profiles) found for this user.');
                          }
                        } else {
                          throw new Exception('No properties found for this user.');
                        }
                      } else {
                        throw new Exception('No accounts found for this user.');
                      }
                    }

                    function getmonthResults($analytics, $profileId)
                    {
                      // Calls the Core Reporting API and queries for the number of sessions
                      // for the last seven days.
                      $month = date("Y-m-01");
                      return $analytics->data_ga->get(
                        'ga:' . $profileId,
                        $month,
                        'today',
                        'ga:users'
                      );
                    }

                    function printmonthResults($results)
                    {
                      // Parses the response from the Core Reporting API and prints
                      // the profile name and total sessions.
                      if (count($results->getRows()) > 0) {

                        // Get the profile name.
                        $profileName = $results->getProfileInfo()->getProfileName();

                        // Get the entry for the first entry in the first row.
                        $rows = $results->getRows();
                        $sessions = $rows[0][0];

                        // Print the results.

                        print "<h3>$sessions</h3>";
                      } else {
                        print "<h3>0</h3>";
                      }
                    }

                    ?>
                    <small>This Month</small>
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
                    $analytics = initializeyearAnalytics();
                    $profile = getyearFirstProfileId($analytics);
                    $results = getyearResults($analytics, $profile);
                   // printyearResults($results);

                    function initializeyearAnalytics()
                    {
                      // Creates and returns the Analytics Reporting service object.

                      // Use the developers console and download your service account
                      // credentials in JSON format. Place them in this directory or
                      // change the key file location if necessary.
                      $KEY_FILE_LOCATION = __DIR__ . '/service-account-credentials.json';

                      // Create and configure a new client object.
                      $client = new Google_Client();
                      $client->setApplicationName("Hello Analytics Reporting");
                      $client->setAuthConfig($KEY_FILE_LOCATION);
                      $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
                      $analytics = new Google_Service_Analytics($client);

                      return $analytics;
                    }

                    function getyearFirstProfileId($analytics)
                    {
                      // Get the user's first view (profile) ID.

                      // Get the list of accounts for the authorized user.
                      $accounts = $analytics->management_accounts->listManagementAccounts();

                      if (count($accounts->getItems()) > 0) {
                        $items = $accounts->getItems();
                        $firstAccountId = $items[0]->getId();

                        // Get the list of properties for the authorized user.
                        $properties = $analytics->management_webproperties
                          ->listManagementWebproperties($firstAccountId);

                        if (count($properties->getItems()) > 0) {
                          $items = $properties->getItems();
                          $firstPropertyId = $items[0]->getId();

                          // Get the list of views (profiles) for the authorized user.
                          $profiles = $analytics->management_profiles
                            ->listManagementProfiles($firstAccountId, $firstPropertyId);

                          if (count($profiles->getItems()) > 0) {
                            $items = $profiles->getItems();

                            // Return the first view (profile) ID.
                            return $items[0]->getId();
                          } else {
                            throw new Exception('No views (profiles) found for this user.');
                          }
                        } else {
                          throw new Exception('No properties found for this user.');
                        }
                      } else {
                        throw new Exception('No accounts found for this user.');
                      }
                    }

                    function getyearResults($analytics, $profileId)
                    {
                      // Calls the Core Reporting API and queries for the number of sessions
                      // for the last seven days.
                      $year = date("Y-01-01");
                      return $analytics->data_ga->get(
                        'ga:' . $profileId,
                        $year,
                        'today',
                        'ga:users'
                      );
                    }

                    function printyearResults($results)
                    {
                      // Parses the response from the Core Reporting API and prints
                      // the profile name and total sessions.
                      if (count($results->getRows()) > 0) {

                        // Get the profile name.
                        $profileName = $results->getProfileInfo()->getProfileName();

                        // Get the entry for the first entry in the first row.
                        $rows = $results->getRows();
                        $sessions = $rows[0][0];

                        // Print the results.

                        print "<h3>$sessions</h3>";
                      } else {
                        print "<h3>0</h3>";
                      }
                    }

                    ?>
                    <small>This Year</small>
                  </h3>
                </div>
                <div class="icon">
                  <i class="fa fa-calendar-check-o fa-5x yellow"></i>
                </div>
              </div>
            </div>
          </div>
          <div id="embed-api-auth-container"></div>
          <div id="chart-container"></div>
          <div id="view-selector-container"></div>
        </div>
        <div class="row">
          <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div id="morris-area-chart">
                  <iframe width="100%" height="250px" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTw1SfNTR-IdC5IHLetksdk9tDAjjvopiqMUWQCy6N0imtRn0IiUEJDJcAY89x8i4SIF1kttFu7UsZ5/pubchart?oid=1018564876&amp;format=interactive"></iframe>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-default" style="height:285px;">
              <div class="panel-heading">
                Active Users
              </div>
              <div class="panel-body">
                <div id="activeuser" class="text-center">
                  <h4>Right Now</h4><br>

                  <?php
                  function initializerealAnalytics()
                  {
                    $KEY_FILE_LOCATION = __DIR__ . '/service-account-credentials.json';
                    // Create and configure a new client object.
                    $client = new Google_Client();
                    $client->setApplicationName("Hello Analytics Reporting");
                    $client->setAuthConfig($KEY_FILE_LOCATION);
                    $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
                    $analytics = new Google_Service_Analytics($client);
                    return $analytics;
                  }
                  $analytics = initializerealAnalytics();
                  function get_realtime_active_user($analytics, $ga_internal_id)
                  {
                    $optParams = array(
                      'dimensions' => 'rt:medium'
                    );
                    try {
                      $results = $analytics->data_realtime->get(
                        'ga:' . $ga_internal_id,
                        'rt:activeUsers',
                        $optParams
                      );
                      // Success. 
                      $return = $results->totalsForAllResults['rt:activeUsers'];
                      return $return;
                    } catch (apiServiceException $e) {
                      // Handle API service exceptions.
                      $error = $e->getMessage();
                    }
                  }
                  $ga_id = '205042620';
                  $rest = get_realtime_active_user($analytics, $ga_id);
                  //echo '<h1 style="font-size:50px;color:#067B22;"><b>' . $rest . '</b></h1><br>';
                  ?>
                  <div id="activeuser" class="text-center">
                  </div>
                  <h6>active users on site</h6><br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-xs-12">
            <div class="panel panel-default chartJs">
              <div class="panel-body">
                <iframe width="100%" height="371" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTw1SfNTR-IdC5IHLetksdk9tDAjjvopiqMUWQCy6N0imtRn0IiUEJDJcAY89x8i4SIF1kttFu7UsZ5/pubchart?oid=1733956131&amp;format=interactive"></iframe>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-xs-12">
            <div class="panel panel-default chartJs">
              <div class="panel-body">
                <iframe width="100%" height="371" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTw1SfNTR-IdC5IHLetksdk9tDAjjvopiqMUWQCy6N0imtRn0IiUEJDJcAY89x8i4SIF1kttFu7UsZ5/pubchart?oid=1313661717&amp;format=interactive"></iframe>
              </div>
            </div>
          </div>
        </div>
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
  <!-- Morris Chart Js -->
  <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
  <script src="assets/js/morris/morris.js"></script>
  <script src="assets/js/easypiechart.js"></script>
  <script src="assets/js/easypiechart-data.js"></script>
  <script src="assets/js/Lightweight-Chart/jquery.chart.js"></script>
  <!-- Custom Js -->
  <script src="assets/js/custom-scripts.js"></script>
  <!-- Chart Js -->
  <script type="text/javascript" src="assets/js/Chart.min.js"></script>
  <script type="text/javascript" src="assets/js/chartjs.js"></script>
  <!-- This demo uses the Chart.js graphing library and Moment.js to do date
     formatting and manipulation. -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
  <!-- Include the ViewSelector2 component script. -->
  <script src="/public/javascript/embed-api/components/view-selector2.js"></script>
  <!-- Include the DateRangeSelector component script. -->
  <script src="/public/javascript/embed-api/components/date-range-selector.js"></script>
  <!-- Include the ActiveUsers component script. -->
  <script src="/public/javascript/embed-api/components/active-users.js"></script>
  <!-- Include the CSS that styles the charts. -->
  <link rel="stylesheet" href="/public/css/chartjs-visualizations.css">
</body>
</html>