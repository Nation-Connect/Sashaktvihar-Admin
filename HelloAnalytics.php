<?php

require __DIR__ . '/googleanayltic/vendor/autoload.php';
function initializeAnalytics(){
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
$analytics = initializeAnalytics();
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
// $data = array();
// $ga_id_array = array('site1'=>'205042620');
// foreach($ga_id_array as $name => $ga_id){
//   $each_data = array();
//   $each_data['name'] = $name;
//   $each_data['num'] = get_realtime_active_user($analytics, $ga_id);
//   $data[] = $each_data;
// }
// $json = json_encode($data);
// echo $json;
// $obj = json_decode($json); 
  
// // Display the value of json object 
// echo $obj->name; 
$ga_id='205042620';
$rest = get_realtime_active_user($analytics,$ga_id);
echo $rest;
  
?>