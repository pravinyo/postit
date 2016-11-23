$(function(){
  $('#loginform').submit(function(e){
  	var num=$('#mob').val();
  	var pass=$('#password').val();
  	data={'num':num,'pass':pass};
  	$.post("serverVerify.php",data,function(data){
			if(data.status==1)
			{
					var check="<label for=\"code\">Enter Verification code:</label><input type=\"text\" name=\"code\"id=\"code\""+
  					"class=\"txtfield\" tabindex=1>"+"<button class=\"button\" id=\"codeBox\">Verify</button>";
  					$('#loginmodal').html('');
  					$('#loginmodal').append(check);
  					userid=data.code;
  					if (typeof(Storage) !== "undefined") {
				    // Store
				    localStorage.setItem("id",userid);
					} else {
				    document.getElementById("result").innerHTML = "Sorry, your browser does not support Web Storage...";
				}
			}
		});
    return false;
  });

    $('#modaltrigger').leanModal({ top: 110, overlay: 0.45, closeButton: "" });
    $(document).on('click','#codeBox',function(){
    	var code="";
    	$('input#code').each(function(){
    		 code = $(this).val();
    	});
    	data={'code':code,'id':localStorage.getItem("id")};
    	$.post("serverVerify.php",data,function(data){
    		if(data.status==1)
    		{
    			window.location.replace("post.php?id="+userid);
    		}
    	});
		
	});
});
