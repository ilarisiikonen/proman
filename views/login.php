<?php
$title = 'theTrackerApp';

require_once "../model/model.php";

login();

?>

<div class="welcome">
    <h1>Welcome to theTrackerAppp</h1>
</div>

<form action="login.php" method="post" >
  <label for="username">Username:</label>
  <input type="text" name="username" id="username">
  <br>
  <label for="password">Password:</label>
  <input type="password" name="password" id="password">
  <br>
  <br>
  <input class="button login" type="submit" value="Login">
</form>

<!-- <a class="button" href="../www.google.com">Forgot password?</a> -->
<?php
$content = ob_get_clean();
include '../views/layout.php';
?>