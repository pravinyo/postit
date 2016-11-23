<?php
$username="your database username";
$password="your password";
$host="host url";
$database="your database number";
$connection=mysqli_connect($host,$username,$password,$database);
if(mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
