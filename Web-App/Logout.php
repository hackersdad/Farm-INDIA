<?php
include_once 'inc/db.inc.php';
$a=$conn->prepare('select csrf from Users where cookie = :cookie');
$b=$a->execute([':cookie'=>$_COOKIE['cookie']]);
$c=$a->fetch();
$csrf=$c['csrf'];
include_once 'header.php';
if(isset($_COOKIE['cookie']))
{
  echo "<div class = 'form signup'>
  <p > Are you sure to<b> logout?</b></p><br>
  <form action='inc/logout.php' method='POST'>
    <input type='submit' name='yes' value='Yes'>
    <input type='submit' name='no' value='No'>
    <input type='hidden' name='anti_csrf' value='".$csrf."'>
  </form></div>";
}
else
{
  header('Location:index.php');
  exit();
}
?>
