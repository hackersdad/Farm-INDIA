<?php
$id=0;
if(isset($_COOKIE['cookie']))
{
$d=$conn->prepare('select * from Users where cookie=:cookie');
$e=$d->execute([':cookie'=>$_COOKIE['cookie']]);
$f=$d->fetch();
$id=$f['id'];
$csrf=$f['csrf'];
if($f['role']==4)
{
  echo "<div class='banner'>Hi ".$f['name']."<br>
  <a href='add.php'>add</a></div>";
}
else {
  echo'<div class="banner">
    <h1 class="banner-title">Fresh Vegetable collection</h1>
    <button class="banner-btn" onclick="document.getElementById("purchase").scrollIntoView()">Shop Now</button>
  </div>

';
}
}
else {
  // code...
  echo'<div class="banner">
    <h1 class="banner-title">Fresh Vegetable collection</h1>
    <button class="banner-btn" onclick="document.getElementById("purchase").scrollIntoView()">Shop Now</button>
  </div>

';
}
?>
</header>
<!-- products -->
<section class="products" id="purchase">
  <div class="section-title">
    <h2>Our products</h2>
  </div>
  <div class="products-center">
  <?php
    if(isset($_POST['add']))
    {
      if($id==0)
      {
        header('Location:Login.php?error=loginfirst');
        exit();
      }
      if($csrf==$_POST['anti_csrf'])
      {
        $a=$conn->prepare('select count(id) from products');
        $b=$a->execute();
        $c=$a->fetch();
        if((0<$_POST['add'])&&(($_POST['add']<$c['count(id)'])||($_POST['add']==$c['count(id)'])))
        {
          $a=$conn->prepare('select least_package from products where id=:id');
          $b=$a->execute([':id'=>$_POST['add']]);
          $c=$a->fetch();
          $a=$conn->prepare('insert into cart values(:user,:item,:quantity)');
          $b=$a->execute([':user'=>$id,':item'=>$_POST['add'],':quantity'=>$c['least_package']]);
          header("Location:cart.php");
        }
      }
    }
    $a = $conn->prepare('select * from products');
    $b = $a->execute();
    $c = $a->fetchAll();
    $d=$conn->prepare('select item from cart where user=:user');
    $e=$d->execute([':user'=>$id]);
    $f=$d->fetch();
    foreach ($c as $key => $value) {
      // code...
      echo '<!-- single product -->
    <article class="product">
      <div class="img-container">
        <img src="'.$c[$key]["picture"].'" alt="product" class="product-img" height = "300px" width = "200px">';
        if(in_array($c[$key]['id'],$f))
        {
          echo '<button class="bag-btn">
            <span>already in bag<img src="images/cart.png" alt="cart" height="25px" width="25px"></span>
          </button>';
        }
        else
        {
          echo'<form action="index.php" method="POST">
          <input type="hidden" name="anti_csrf" value="'.$csrf.'">
          <button class="bag-btn" type = "submit" name="add" value="'.$c[$key]['id'].'">
            <span>add to bag<img src="images/cart.png" alt="cart" height="25px" width="25px"></span>
          </button>
          </form>';
        }
      echo '
      </div>
      <h3>'.$c[$key]['title'].'</h3>
      <h3>'.$c[$key]['description'].'</h3>
      <h4> &#8377 '.$c[$key]['price'].'/kg</h4>
    </article>
    <!-- end of single product -->
    ';
  }
?>
  </div>
   </section>
   <!-- end of products -->
