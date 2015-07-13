<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quick Msg</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="font/styles.css" />
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery.validate.js"></script>
</head>
<body>
<div id="wrapper">
  <div class="height-50"></div>
  <div class="height-128"></div>
  <a href="javascript:void(1);" onclick="loginFb();"><div class="signin">sign in with fb</div></a>
  <div class="height-250"></div>
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
function loginFb(){
  FB.login(function(response){
        if (response.authResponse){
            token = response.authResponse.accessToken;
            FB.api('/me', function(response) 
            {
                console.log(response);
                var fbid=response.id;
                var location='';
                var full_name='';
                var email='';

                if(typeof response.first_name !== 'object' && typeof response.first_name !== 'undefined'){
                  full_name = response.first_name;
                }
                if(typeof response.last_name !== 'object' && typeof response.last_name !== 'undefined'){
                if(full_name !=''){
                  full_name +=' ';
                }
                  full_name += response.last_name;
                }
                if(typeof response.email !== 'object' && typeof response.email !== 'undefined'){
                  var email = response.email;
                }
                if(typeof response.location !== 'object' && typeof response.location !== 'undefined'){
                  var location = response.location;
                }
                $.ajax({
                    type: "POST",
                    url: "update_details.php",
                    async: true,
                    data: "mode=check&fbid="+fbid,
                    success: function(result) {
                      if(result=="success"){
                        window.location.href='qmsg.php';            
                      }else{
                            $.ajax({
                                type:"POST",
                                url:"ajax_process.php",
                                async: false,
                                data: "full_name="+ full_name + "&fbid=" + fbid +"&email="+ email +"&location="+ location,
                                success:function(data)
                                {
                                    if(data=='success'){
                                        window.location.href="register.php";
                                    }else{
                                        alert("Sorry, some error occured. Please try again later");
                                    }
                                },
                                error:function(data)
                                {
                                    
                                },
                            });  
                      }
                    },
                    error: function(text_status) {

                    }
                });           

            });
        }else{
           /* var cnf = confirm('You need to accept the permissions to access the app.');
            if(cnf == true)
            {
              fbAsyncInit();    
            }*/
        }
  }, {scope: 'user_about_me,public_profile,user_location'});
}
</script>
</body>
</html>
