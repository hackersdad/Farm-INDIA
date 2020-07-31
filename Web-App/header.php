<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Farm-INDIA: An initiative bringing transprency and values in our lives</title>
    <link rel="stylesheet" href="css/master.css">
  </head>
  <body>
    <nav>

      <div class="contents">
        <span >Logo</span>
        <a href="/Farm-INDIA/Web-App/index.php">Home</a>
        <a href="/Farm-INDIA/Web-App/About_us.php">About us</a>
        <?php
        //echo $_COOKIE['cookie'];
          if (isset($_COOKIE['cookie']))
          {
            // code...
            echo "<a href='/Farm-INDIA/Web-App/Logout.php'>Logout</a>";
          }
          else
          {
            // code...
            echo '<a href="/Farm-INDIA/Web-App/Login.php">Login</a>';
          }
        ?>
<!--onclick=cart()-->
        <span >
          <a href="cart.php">
          <img src="/Farm-INDIA/Web-App/images/cart.png" alt="cart" height="40px">

          <span class="cart-items"><?php include_once 'inc/db.inc.php';
          $a=$conn->prepare('select id from Users where cookie=:cookie');
          $b=$a->execute([':cookie'=>$_COOKIE['cookie']]);
          $c=$a->fetch();
          $id=$c['id'];
          $a=$conn->prepare('select count(item) from cart where user=:user');
          $b=$a->execute([':user'=>$id]);
          $c=$a->fetch();
          echo $c['count(item)']; ?></span></a>
        </span>
        </div>
    </nav>
    <header style="background: url(/Farm-INDIA/Web-App/images/pumpkin.jpg) center/cover no-repeat"><!--  Image by Sabrina Ripke from Pixabay  -->
