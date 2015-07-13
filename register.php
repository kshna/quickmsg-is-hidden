<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quick Msg</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="font/styles.css" />
<link rel="stylesheet" href="css/colorbox.css" />
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		$(".inline").colorbox({inline:true, width:"50%"});
		});
</script>
</head>
<body>
<div id="wrapper">
  <div class="login-box-home">
    <div class="line-two"><img src="images/line02.png" /></div>
    <div class="form-box">
      <h4>Enter your details:</h4>
      <div class="form">
        <form id="form_info" onsubmit="return false;">
        	<input type="hidden" name="fbid" id="fbid" value="<?=$_SESSION['fbid']?>">
        	<input type="hidden" name="mode" id="mode" value="user_update">
          <div class="form-group">
            <input name="name" type="text" class="form-control" id="name" placeholder="Name" data-rule-required="true" pattern="[A-Za-z\'\s]+" value="<?=$_SESSION['full_name']?>">
          </div>
          <div class="form-group">
            <input name="email" type="email" class="form-control" id="email" placeholder="E-mail"  data-rule-required="true" data-rule-email="true" data-msg-email="Please enter a valid email address" value="<?=$_SESSION['email']?>">
          </div>
          <div class="form-group">
            <input name="contact_number" type="number" class="form-control" id="contact_number" placeholder="Contact No."  data-rule-required="true" data-rule-number="true">
          </div>
          <div class="form-group">
            <input name="location" type="text" class="form-control" id="location" placeholder="Location" data-rule-required="true" pattern="[A-Za-z\s]+" value="<?=$_SESSION['location']?>">
          </div>
          <div class="submit-nut">
            <input type='submit' value='Submit' id="submit" class="btn-submit submit-form">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="height-70"></div>
  <div class="terms">Click here for the <a class='inline' href="#inline_content" style="color:#fff">Terms & Conditions</a></div>
</div>
<div id='fb-root'></div>
<script>
$(document).ready(function() {	

	window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '468021196697728',
	      xfbml      : true,
	      version    : 'v2.4'
	    });
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	});

	$.validator.addMethod("username_regex", function(value, element) {
		return this.optional(element) || /^[A-Za-z\'\s]+$/i.test(value);
	}, "Username must contain only letters.");

	$.validator.addMethod("number_regex", function(value, element) {
		return this.optional(element) || /^[0-9]{8,12}$/i.test(value);
	}, "Please enter a valid contact number.");

	$.validator.addMethod("location_regex", function(value, element) {
		return this.optional(element) || /^[A-Za-z\s]+$/i.test(value);
	}, "Location must contain only letters");

	$("#form_info").validate({
		rules: {
			"name": {
				required: true,
				username_regex: true,
			},
			"contact_number": {
				required: true,
				number_regex: true,
			},
			"location": {
				required: true,
				location_regex: true,
			},
		},
			
		messages: {
			email: {
				required: 'This field is required.'
			},
			name:{
				required: 'This field is required.'
			},
			location:{
				required: 'This field is required.'
			},
			contact_number:{
				required: 'This field is required.'
			}
		},
		submitHandler: function(form) {
			var data = $("#form_info").serializeArray();
			$.ajax({
				type: "POST",
				url: "update_details.php",
				async: true,
				data: data,
				success: function(result) {
					window.location.href='qmsg.php';						
				},
				error: function(text_status) {

				}
			});
		}
	});
});

</script>
</body>
</html>