<fb:login-button autologoutlink="true" scope="user_likes friends_likes friends_about_me friends_activities friends_birthday friends_photos friends_status friends_interests friends_education_history friends_hometown friends_relationships friends_religion_politics friends_website friends_work_history friends_relationship_details friends_location friends_religion_politics"></fb:login-button>
<div id="fb-root"></div>
<script type="text/javascript">
      window.fbAsyncInit = function() {
        FB.init({
          appId: '<?php echo $facebook->getAppID() ?>',
          cookie: true,
          xfbml: true,
          oauth: true
        });
        FB.Event.subscribe('auth.login', function(response) {
            window.location.reload();
            //window.location = '<?php echo url_for("init/friends")?>'
        });
        FB.Event.subscribe('auth.logout', function(response) {
          window.location = '<?php echo url_for("init/index")?>';
        });
      };
      (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol +
          '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
      }());
</script>