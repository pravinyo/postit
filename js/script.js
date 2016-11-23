$(document).ready(function(){
	var title,content,author;
	fetch();
	$('#submit').click(function(){
		var title=$('#title').val();
		$('#title').val("");
		var author=$('#name').val();
		var content=$('#content').val();
		$('#content').val("");
		var dataString={"author":author,"title":title,"content":content};
		toast();

		fetch(dataString);
	});
	function toast() {
	    var x = document.getElementById("snackbar")
	    x.className = "show";
	    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}
	function fetch(dataString)
	{
		$.ajax({
			type:'GET',
			url:'postServer.php',
			data:dataString,
			datatype:"json",
			success:function(data){
				var block="";
				for (var i = data.length - 1; i >= 0; i--) {
					if(data[i].photo==null || data[i].photo=="") data[i].photo="./images/nopicture.png";
					block+="<div class=\"post\"><div><img class=\"backup_picture\" src=\""+data[i].photo+
					"\"><h3>"+data[i].title+"</h3>"+
					"</div><div><i> by "+data[i].name+"..</i><p>"+data[i].content+"</p></div></div>";
				}
				$('#posts').html('');
				$('#posts').append(block);

			}
		});
	}
	$('#signout').click(function(){
		var auth2 = gapi.auth2.getAuthInstance();
    	auth2.signOut().then(function () {
      	console.log('User signed out.');
      });
    });
});