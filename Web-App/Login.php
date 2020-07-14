<?php
include 'header.html';
//include 'inc/login.php';
?>
<form action="inc/login.php" method="POST" id="login">
  <h3 style="color:black">Log in!</h3>
  <span style="color: black;font-size: 20px"> Fill Username or email and password</span><br>
  <input type="text" name="userName" placeholder="Username"><br>
  <input type="email" name="E-mail" placeholder="E-mail"><br>
  <input type="password" name="pwd" placeholder="password"><br>
  <button type="submit" name="login">Log in</button><br>
  <span style="color: black;font-size: 20px">Or <a href="Signup.php">Signup</a> </span>
</form>
</header>
<?php include 'Footer.html'?>
