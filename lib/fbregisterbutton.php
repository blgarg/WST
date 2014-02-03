   <div id="fb-root"></div>
    <script>
	  
	  window.fbAsyncInit = function() {
        FB.init({appId: '172091782856668', status: true, cookie: true,
                 xfbml: true});
      };
      (function(){
        var e = document.createElement('script');
        e.type = 'text/javascript';
        e.src = document.location.protocol +
          '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
	</script>
 
 <span style="margin-left:30px;"><fb:login-button perms="email,user_birthday,user_about_me,user_hometown,manage_pages,read_stream,offline_access" onlogin="registerFaceBookUser()">
         Register Via Facebook
      </fb:login-button></span>