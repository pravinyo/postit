<?php
$username="bp6am";
$password="bp6ampass";
$host="localhost";
$database="post";
$connection=mysqli_connect($host,$username,$password,$database);
if(mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>