<?php
session_start();
include './auth.php';
if(isset($_REQUEST['token']))
{
	$mToken = $_REQUEST['token'];
	$_SESSION['name']=$_REQUEST['name'];
	$_SESSION['photo']=$_REQUEST['photo'];
	$userinfo = 'https://www.googleapis.com/oauth2/v1/tokeninfo?id_token=' . $mToken;
	$json = file_get_contents($userinfo);
	$userInfoArray = json_decode($json,true);

	$_SESSION['email'] = $userInfoArray['email'];
	$_SESSION['user_id']= $userInfoArray['user_id'];
	$tokenAudience = $userInfoArray['audience'];
	$tokenIssuer = $userInfoArray['issuer'];   
	$isVerified=$userInfoArray['email_verified']; 
	$data['audience']=$tokenAudience;
	$audience="994997772322-en7gops3mal5hg7jruijjfh43ev48v0c.apps.googleusercontent.com";
	if($tokenAudience==$audience)
		$data['status']=$isVerified;
	$_SESSION['auth']=1;

}
elseif (isset($_REQUEST['num']) && isset($_REQUEST['pass'])) {
	# code...
	$number=$_REQUEST['num'];
	$pass=$_REQUEST['pass'];
	include './database.php';
	$query="select pass from mobile where num=$number limit 1";
	$authorid=mysqli_query($connection,$query);
	$result=mysqli_fetch_array($authorid);
	if($result['pass']==$pass)
	{
		$data['status']=1;
		$index='temp_code_verification_' . $number;
		$_SESSION[$index]=getToken(7);
		include './way2sms/sendsms.php';
		$response=send($number,$_SESSION[$index]);
		if($response)
			$data['code']=$index;
	}
}
elseif (isset($_REQUEST['code']) && isset($_REQUEST['id'])) {
	# code...
	foreach ($_SESSION as $key => $value) {
		# code...
		if($key==$_REQUEST['id'] && $value==$_REQUEST['code'])
		{
			$data['status']=1;
			$_SESSION['auth']=1;
		}
	}
}
	header('Content-Type: application/json');
	echo json_encode($data);
?>