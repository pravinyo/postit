<?php
session_start();
error_reporting(0);
if($_SESSION['auth']!=1)
{
	echo "please login";
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Share new Idea here!
	</title>
	<link rel="stylesheet" type="text/css" href="./css/post.css">
	<meta name="google-signin-client_id" content="994997772322-en7gops3mal5hg7jruijjfh43ev48v0c.apps.googleusercontent.com">
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script type="text/javascript" src="./js/jquery.js"></script>
	<script type="text/javascript" src="./js/script.js"></script>
	<script type="text/javascript">
			function googleTranslateElementInit() {
			  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
			}
	</script>
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</head>
<body>

<main>
	<section>
		<h2 id="header">
			Share new Idea here !
		</h2>        
</section>
<section>
	<div class="translator fly" id="google_translate_element"></div>
	<a href="./index.php?logout=1" id="logout">Logout</a>
</section>
<section>
	<details id="det-button">
		<summary>
			create Post +
		</summary>
		<article id="data">
				<h1>
					Start posting..
				</h1>
				<input type="hidden" name="name" id="name" value="<?php echo $_SESSION['email'] ?>" />
				<input type="text" name="title" id="title" placeholder="Title of your post"/>
				<textarea cols="20" placeholder="start typing.." id="content"></textarea>
				<button id="submit">Post</button>
		</article>
	</details>
	<!--
//language

	-->
	<div id="posts">
		
	</div>
	<div id="snackbar">Your post will be displayed ASAP</div>
</section>
</main>
</body>
</html>