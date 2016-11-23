<?php
session_start();
if(isset($_REQUEST['logout']))
{
	if($_REQUEST['logout']=='1')
	{
		session_unset();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>POSTIT LOGIN | welcome</title>
	<meta name="google-signin-client_id" content="994997772322-en7gops3mal5hg7jruijjfh43ev48v0c.apps.googleusercontent.com">
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script type="text/javascript" src="./js/jquery.js"></script>
	<script type="text/javascript" src="./js/jquery.leanModal.min.js"></script>
	<script type="text/javascript" src="./js/login.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/login.css">
</head>
<body>
<figure id="login">
	<div>
		<h2>
			POSTIT
		</h2>
		<p>Best Place for sharing Idea's</p>
	</div>
	<figcaption>
			<strong>Continue using</strong>
			<div class="g-signin2" data-onsuccess="onSignIn"></div>
			<a href="#loginmodal" id="modaltrigger"><button class="button"  style="vertical-align:middle;"><span style="color: white;">Mobile </span></button></a>
	</figcaption>
</figure>
  <div id="loginmodal" style="display:none;">
    <h1>User Login</h1>
    <form id="loginform" name="loginform" method="post">
      <label for="mob">mobile no.:</label>
      <input type="text" name="username" id="mob" class="txtfield" tabindex="1">
      
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" class="txtfield" tabindex="2">
      
      <div class="center">
      	<input type="submit" name="loginbtn" id="loginbtn" class="button hidemodal" value="Log In" tabindex="3">
      	<a href="./register.php"><p>NEW Registeration?</p></a>
      </div>
    </form>
  </div>
<script type="text/javascript">
	function onSignIn(googleUser) {
	  var profile = googleUser.getBasicProfile();
	  data={'name':profile.getName(),'photo':profile.getImageUrl(),
	  'token':googleUser.getAuthResponse().id_token};
	   verify(data);
	}
	function verify(data)
	{
		$.post("serverVerify.php",data,function(data){
			if(data.status==1)
			{
				window.location.replace("post.php");
			}
		});
	}
</script>
<!--
Signout code
-->
</body>
</html>