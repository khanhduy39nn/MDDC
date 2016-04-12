<html>
<head>
  </head>
<body>
<div class="g-signin22222" data-onsuccess="onSignIn">hâhha</div>
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
