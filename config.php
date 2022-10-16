<?php

require_once(__DIR__.'/Facebook/autoload.php');

define('APP_ID', '780011793094498');
define('APP_SECRET', 'a3d5eefda373b89a128886704fb84b26');
define('API_VERSION', 'v2.5');
define('FB_BASE_URL', 'http://localhost/fblogin');

define('BASE_URL', 'YOUR_WEBSITE_URL');

if(!session_id()){
    session_start();
}



$fb = new Facebook\Facebook([
 'app_id' => APP_ID,
 'app_secret' => APP_SECRET,
 'default_graph_version' => API_VERSION,
]);


// Get redirect login helper
$fb_helper = $fb->getRedirectLoginHelper();


// Try to get access token
try {
    if(isset($_SESSION['facebook_access_token']))
		{$accessToken = $_SESSION['facebook_access_token'];}
	else
		{$accessToken = $fb_helper->getAccessToken();}
} catch(FacebookesponseException $e) {

     echo 'Facebook API Error: ' . $e->getMessage();
      exit;
} catch(FacebookSDKException $e) {
    echo 'Facebook SDK Error: ' . $e->getMessage();
      exit;
}

?>