<?php

 
require_once 'config.php';

$permissions = ['email']; //optional

if (isset($accessToken))
{
	if (!isset($_SESSION['facebook_access_token'])) 
	{
		//get short-lived access token
		$_SESSION['facebook_access_token'] = (string) $accessToken;
		
		//OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();
		
		//Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
		
		//setting default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	} 
	else 
	{
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}
	
	
	//redirect the user to the index page if it has $_GET['code']
	if (isset($_GET['code'])) 
	{
		header('Location: ./');
	}
	
	
	try {
		$fb_response = $fb->get('/me?fields=name,first_name,last_name,email');
		$fb_response_picture = $fb->get('/me/picture?redirect=false&height=200');
		
		$fb_user = $fb_response->getGraphUser();
		$picture = $fb_response_picture->getGraphUser();
		
		$_SESSION['fb_user_id'] = $fb_user->getProperty('id');
		$_SESSION['fb_user_name'] = $fb_user->getProperty('name');
		$_SESSION['fb_user_email'] = $fb_user->getProperty('email');
		$_SESSION['fb_user_pic'] = $picture['url'];
		
		
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		echo 'Facebook API Error: ' . $e->getMessage();
		session_destroy();
		// redirecting user back to app login page
		header("Location: ./");
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		echo 'Facebook SDK Error: ' . $e->getMessage();
		exit;
	}
} 
else 
{	
	// replace your website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and you used
	$fb_login_url = $fb_helper->getLoginUrl('http://localhost/patient/', $permissions);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login with Facebook</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <link href="<?php echo BASE_URL; ?>css/style.css" rel="stylesheet">
  
</head>
<body>

<div class="page-header text-center">
  <h1>Physician login</h1>
</div>



<?php if(isset($_SESSION['fb_user_id'])): ?>
     <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	  <a class="navbar-brand" href="<?php echo BASE_URL; ?>">HOME</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		<span class="navbar-toggler-icon"></span>
	  </button>
	 <div class="collapse navbar-collapse" id="collapsibleNavbar">
		<ul class="navbar-nav">
		 <li class="nav-item">
			
		

			<a class="nav-link" href="logout.php">Logout</a>
		  </li>    
		</ul>
	  </div>  
	</nav>

	<div class="container" style="margin-top:30px">
	  <div class="row">
		<div class="col-sm-2">
		  
		  
		</div>
		<div class="col-sm-2"></div>
		<div class="col-sm-8">


		  <h3>User Info</h3>
		  <ul class="nav nav-pills flex-column">
			<li class="nav-item">
			  <a class="nav-link" >Facebook ID: <?php echo  $_SESSION['fb_user_id']; ?></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link">Full Name: <?php echo $_SESSION['fb_user_name']; ?></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link">Email: <?php echo $_SESSION['fb_user_email']; ?></a>
			
			  <li style="color:blue;""text-align:center;" >Patient Information</h1>
   <li style="text-align:left;">
   
   Patient Activity Report<br><br><br>
   Data : 1 <a href="data1.csv" download="Patientdata1.csv">
         <button type="button">Download</button></a><br><br>
   Data : 2<a href="data2.csv" download="Patientdata2.csv">
         <button type="button">Download</button></a><br><br>
   Data : 3<a href="data3.csv" download="Patientdata3.csv">
         <button type="button">Download</button></a></br><br>
   Data : 4<a href="data4.csv" download="Patientdata4.csv">
         <button type="button">Download</button></a></br><br>
   Data : 5<a href="data5.csv" download="Patientdata5.csv">
         <button type="button">Download</button></a><br><br>
   Data : 6
<a href="data6.csv" download="Patientdata6.csv">
         <button type="button">Download</button></a>
			
			
			</li>
		  </ul>
		  
		</div>
	  </div>
	</div>
</body>
</html>

<?php else: ?>
 
	<div class="login-form">
		<form action="" method="post">
			<h2 class="text-center">Sign in</h2>		
			<div class="text-center social-btn">
				<a style="center" href="<?php echo $fb_login_url;?>" class="btn btn-primary btn-block"><i class="fa fa-facebook"></i> Sign in with <b>Facebook</b></a>
			</div>
			
			</div>
		
<?php endif ?>