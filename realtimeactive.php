<?php 
    include 'db.php';
    
     // Load the Google API PHP Client Library.
    require_once __DIR__ . '/googleanayltic/vendor/autoload.php';
?>

<html>
    <head>
        <script>
        (function(w,d,s,g,js,fs){
          g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
          js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
          js.src='https://apis.google.com/js/platform.js';
          fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
        }(window,document,'script'));
</script>
    </head>
    <body>
        
    




<?php
                                    function initializerealAnalytics(){
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
                                    function get_realtime_active_user($analytics, $ga_internal_id){
                                      $optParams = array(
                                          'dimensions' => 'rt:medium');
                                      try {
                                        $results = $analytics->data_realtime->get(
                                            'ga:'.$ga_internal_id,
                                            'rt:activeUsers',
                                            $optParams);
                                        // Success. 
                                        $return = $results->totalsForAllResults['rt:activeUsers'];
                                        return $return;
                                      } catch (apiServiceException $e) {
                                        // Handle API service exceptions.
                                        $error = $e->getMessage();
                                      }
                                      
                                    }
                                    $ga_id='205042620';
                                    $rest = get_realtime_active_user($analytics,$ga_id);
                                    echo $rest;
                                    
                                    
                                    
                                    ?>
                                    
  </body>
</html>