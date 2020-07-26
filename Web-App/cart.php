<?php
include_once 'inc/db.inc.php';
if(isset($_COOKIE['cookie']))
{
  $a=$conn->prepare('select id,csrf from Users where cookie=:cookie');
  $b=$a->execute([':cookie'=>$_COOKIE['cookie']]);
  $c=$a->fetch();
  $id=$c['id'];
  $csrf=$c['csrf'];
  if($_POST['anti_csrf']==$csrf)
  {
    $a=$conn->prepare('update Users set csrf=:csrf where id=:id');
    $b=$a->execute([':csrf'=>bin2hex(random_bytes(16)),':id'=>$id]);
  if(isset($_POST['increase']))
  {
    $a=$conn->prepare('select quantity from cart where item=:item');
    $b=$a->execute([':item'=>$_POST['item']]);
    $c=$a->fetch();
    $q=$c['quantity'];
    $q+=$_POST['least'];
    $a=$conn->prepare('update cart set quantity = :quantity where item=:item');
    $b=$a->execute([':quantity'=>$q,':item'=>$_POST['item']]);
  }
  if(isset($_POST['decrease']))
  {
    $a=$conn->prepare('select quantity from cart where item=:item');
    $b=$a->execute([':item'=>$_POST['item']]);
    $c=$a->fetch();
    $q=$c['quantity'];
    if($q>$_POST['least'])
    {
    $q-=$_POST['least'];
    $a=$conn->prepare('update cart set quantity = :quantity where item=:item');
    $b=$a->execute([':quantity'=>$q,':item'=>$_POST['item']]);
    }
  }
  if(isset($_POST['reset']))
  {
    $a=$conn->prepare('delete from cart where user = :user');
    $b=$a->execute([':user'=>$id]);
  }
  if(isset($_POST['remove']))
  {
    $a=$conn->prepare('delete from cart where user=:user and item=:item');
    $b=$a->execute([':user'=>$id,':item'=>$_POST['item']]);
  }
}
  include_once 'header.php';
  $a=$conn->prepare('select item,quantity from cart where user=:user');
  $b=$a->execute([':user'=>$id]);
  $c=$a->fetchAll();
  if(!$c)
  {
    echo "
    <div class='banner'>
      <h3>Cart is Empty, to continue shopping please visit <a href ='index.php#purchase' >here</a></h3>
    </div>
    ";
  }
  else
  {
    // code...

  echo "<div class='banner'>
  <h3>Your Cart</h3><hr>
  <table class='signup' style='border: 1px solid black'>
    <tr>
      <th>Product</th>
      <th>Title</th>
      <th>Description</th>
      <th>Packages Available</th>
      <th>Price / kg</th>
      <th>Quantity(in kg)</th>
      <th>Total Price</th>
      <th>Want to Remove?</th>
    </tr>
    ";
  $total=0;
  foreach ($c as $key => $value)
  {
    // code...
    echo "<tr>
            <td>";
    $d=$conn->prepare('select * from products where id = :id');
    $e=$d->execute([':id'=>$c[$key]['item']]);
    $f=$d->fetch();
    echo"<img src='".$f['picture']."' height=200px width=200px></td>
          <td>".$f['title']."</td>
          <td>".$f['description']."</td>
          <td>".$f['packages_available']."</td>
          <td> &#8377 ".$f['price']."</td>
          <td>
            <form action = 'cart.php' method='POST'>
            <input type = 'hidden' name='item' value='".$f['id']."'>
            <input type='hidden' name='least' value='".$f['least_package']."'>
            <button type='submit' name='increase'>increase</button>".$c[$key]['quantity'];
            if($c[$key]['quantity']>$f['least_package'])
            {
              echo "<button type='submit' name='decrease'>decrease</button>";
            }
            echo"</form>
          </td>
          <td>".$f['price']*$c[$key]['quantity']."</td>
          <td>
            <form action='cart.php' method='POST'>
            <input type='hidden' name='item' value='".$f['id']."'>
            <input type='hidden' name='anti_csrf' value='".$csrf."'>
            <button type='submit' name='remove'>Remove</button>
            </form>
          </td></tr>";
          $total+=$f['price']*$c[$key]['quantity'];
  }
  echo "<tr>
    <td></td><td></td><td></td>
    <td>Grand Total = &#8377 ".$total."</td>
  </tr>
  <tr>
    <td></td><td></td><td></td>
    <td>
    <form action='cart.php' method='POST'>
    <input type='hidden' name='anti_csrf' value='".$csrf."'>
    <button type='submit' name='reset'>Reset</button>
    </form>
    </td>
  </tr>
  </table>";
  echo "<div >
    <h3>To continue shopping please visit <a href ='index.php#purchase' >here</a></h3>
  </div>
  <h4> Proceed to <a href='checkout.php'>check out</a></h4>";
}
}
else
{
  // code...
  header('Location:Login.php?error=loginfirst');
  exit();
}
?>
