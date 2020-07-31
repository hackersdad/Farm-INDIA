<?php
include 'header.php';
//include 'inc/login.php';
if(isset($_COOKIE['cookie']))
{
  header('Location:index.php');
  exit();
}
?>
<form action="inc/login.php" method="POST" class="signup">
  <h3 style="color:black">Log in!</h3>
  <table>
    <tr>
      <td>E-mail</td>
      <td><input type="email" name="E-mail" placeholder="E-mail" required></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type="password" name="pwd" placeholder="password"required></td>
    </tr>
    <tr>
      <td><button type="submit" name="login">Log in</button><br></td>
      <td><span style="color: black;font-size: 20px">Or <a href="Signup.php">Signup</a> </span></td>
    </tr>
  </table>
</form>
</header>
<?php include 'Footer.html'?>
