<html>
<head>
  <meta name="google-signin-client_id" content="92245724825-ffi0rdk5ub18nouvpoi94l3vra9lntr3.apps.googleusercontent.com">
</head>
<body>
<div class="g-signin2" data-onsuccess="onSignIn">hâhha</div>
  <script>
  function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail());
  }

  </script>

  <script src="https://apis.google.com/js/platform.js?" async defer></script>
</body>
</html>
