<?php

// Demo site using Auth_BrowserID for authentication

require_once 'Auth/BrowserID.php';

$body = $email = NULL;
if (isset($_POST['assertion'])) {
    $verifier = new Auth_BrowserID('http://localhost:80');
    $result = $verifier->verifyAssertion($_POST['assertion'], 'local');

    if ($result->status === 'okay') {
        $body = "<p>Logged in as: " . $result->email . "</p>";
        $body .= '<p><a href="javascript:navigator.id.logout()">Logout</a></p>';
        $email = $result->email;
    } else {
        $body = "<p>Error: " . $result->reason . "</p>";
    }
    $body .= "<p><a href=\"demo.php\">Back to login page</a></p>";
} elseif (!empty($_GET['logout'])) {
    $body = "<p>You have logged out.</p>";
    $body .= "<p><a href=\"demo.php\">Back to login page</a></p>";
} else {
    $body = "<p><a href=\"javascript:navigator.id.request()\"><span>Sign-in with your email</span></a></p>";
}

?><!DOCTYPE html>
<html>
  <head><meta http-equiv="X-UA-Compatible" content="IE=Edge">
  </head>
  <body>
    <form id="login-form" method="POST">
      <input id="assertion-field" type="hidden" name="assertion" value="">
    </form>
    <?= $body ?>
    <script src="https://login.persona.org/include.js"></script>
    <script>
    navigator.id.watch({
        loggedInUser: <?= $email ? "'$email'" : 'null' ?>,
        onlogin: function (assertion) {
            var assertion_field = document.getElementById("assertion-field");
            assertion_field.value = assertion;
            var login_form = document.getElementById("login-form");
            login_form.submit();
        },
        onlogout: function () {
            window.location = '?logout=1';
        }
    });
    </script>
  </body>
</html>
