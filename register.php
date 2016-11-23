<?php
session_start();
$header="
<!DOCTYPE html>
<html>
<head>
	<title>New User || Regestartion</title>
</head>
<body>
<form action=? method=\"post\">
	<h2>
	USER REGISTRATION PORTAL
	</h2>";
$trailor="	<input type=\"submit\" name=\"submit\">
</form>
</body>
</html>";
$data="<label>
		Name:
		<input type=\"text\" name=\"name\" maxlength=\"50\" />
	</label>
	<label>
		Mobile Number:
		<input type=\"text\" name=\"mob\" maxlength=\"10\" placeholder=\"10 digit Number\" />
	</label>
	<label>
		Password:
		<input type=\"Password\" name=\"pass\"/>
	</label>";
$ver="<label>
<input type=\"text\" name=\"code\"/>
</label>";
if (isset($_POST['code'])) {
	# code...
	if($_POST['code']==$_SESSION['code'])
	{
		include 'database.php';
		$query="insert into mobile(Name,num,pass) values('" . $_SESSION['name'] . "','" . $_SESSION['mob'] . "','" . $_SESSION['pass'] . "')";
		$result=mysqli_query($connection,$query);
		echo "successfully registered";
		exit();
	}
	else
	{
		echo "invalid code";
	}
}
elseif(isset($_POST['submit']))
{
	include './auth.php';
	include 'your sms gateway script';
	$_SESSION['code']=getToken(7);
	$_SESSION['name']=$_POST['name'];
	$_SESSION['mob']=$_POST['mob'];
	$_SESSION['pass']=$_POST['pass'];
	// send the code to user's phone
	send($_SESSION['mob'],$_SESSION['code']);
	echo $header;
	echo "<h4>Enter the verification code</h4>";
	echo $ver;
	echo $trailor;
}
else{
	echo $header;
	echo $data;
	echo $trailor;
}
?>
