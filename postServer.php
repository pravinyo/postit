<?php
session_start();

include './database.php';
if(isset($_GET['author']))
{
	//insert the post content
	$title=$_GET['title'];
	$author=$_GET['author'];
	$content=$_GET['content'];
	$result= "select aid from authors where email='" . $author . "' limit 1";
	$authorid=mysqli_query($connection,$result);
	$id=mysqli_fetch_array($authorid);
	if(count($id)>1)
	{
		$query="insert into posts(title,author,content) values ('" . $title . "','" . $id['aid'] . "','" . $content . "')";
		$insert=mysqli_query($connection,$query);
	}
	else
	{
		//register new author automatically
		$query="insert into authors(name,email,photo) values('" . $_SESSION['name'] ."','". $_SESSION['email'] ."','". $_SESSION['photo']. "')";
		$insert=mysqli_query($connection,$query);
		$result= "select aid from authors where email='" . $author . "' limit 1";
		$authorid=mysqli_query($connection,$result);
		$id=mysqli_fetch_array($authorid);
		$query="insert into posts(title,author,content) values ('" . $title . "','" . $id['aid'] . "','" . $content . "')";
		$insert=mysqli_query($connection,$query);
	}
}
	$query="select title,name,content,photo from posts inner join authors on author=aid";
	$result=mysqli_query($connection,$query);
	$i=0;
	while ($row=mysqli_fetch_array($result)) {
		# code...
		$data[$i]['title']=$row['title'];
		$data[$i]['name']=$row['name'];
		$data[$i]['content']=$row['content'];
		$data[$i]['photo']=$row['photo'];
		$i++;
	}
	header('content-type:application/json');
	echo json_encode($data);
?>