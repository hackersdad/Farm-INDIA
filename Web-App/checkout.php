<?php
include_once 'inc/db.inc.php';
$a=$conn->prepare('select * from Users where cookie=:cookie');
$b=$a->execute([':cookie'=>$_COOKIE['cookie']]);
$c=$a->fetch();
$id = $c['id'];
$csrf=$c['csrf'];
$name = $c['name'];
$pin_code=$c['pin_code'];
$contact_number=$c['contact_number'];
$postal_address=$c['postal_address'];
$a=$conn->prepare('select count(item) from cart where user=:id');
$b=$a->execute([':id'=>$id]);
$c=$a->fetch();
if(isset($_COOKIE['cookie']))
{
  if($c['count(item)']>0)
  {
    include_once 'header.php';
  }
  else {
    header('Location:index.php?error=emptycart');
    exit();
  }
}
else
{
  // code...
  header("Location:index.php?error=emptycart");
  exit();
}
?>
<div class="signup">
  <h2>Shipping details</h2>
  <form action="invoice.php" method="post">
    <table>
      <tr>
        <td>
          <label for="name">Name</label>
        </td>
        <td>
          <input type="text" name="name" value="<?php echo $name ?>" required>
        </td>
      </tr>
      <tr>
        <td>
          <label for="address_1">Address line 1</label>
        </td>
        <td>
          <input type="text" name="address_1" value="<?php echo $postal_address; ?>" required>
        </td>
      </tr>
      <tr>
        <td>
          <label for="address_2">Address line 2</label>
        </td>
        <td>
          <input type="text" name="address_2" placeholder="Address line 2">
        </td>
      </tr>
      <tr>
        <td>
          <label for="address_3">Address line 3</label>
        </td>
        <td>
          <input type="text" name="address_3" placeholder="Address line 3">
        </td>
      </tr>
      <tr>
        <td>
          <label for="pin_code">Pin code</label>
        </td>
        <td>
          <input type="text" name="pin_code" pattern="[0-9]{6}" value="<?php echo $pin_code; ?>" required>
        </td>
      </tr>
      <tr>
        <td>
          <label for="contact_number">Contact Number</label>
        </td>
        <td>
          <input type="tel" name="contact_number" value="<?php echo $contact_number ?>" required>
        </td>
      </tr>
      <tr>
        <td>
          <label for="payment">Mode of Payment</label>
        </td>
        <td>
          <input type="radio" name="payment" value="1"><!--1 for online payment-->
          <label for="F">Online Payment</label>
          <input type="radio" name="payment" value="2" checked><!--2 for pay on delivery-->
          <label for="O">Pay on delivery</label>
        </td>
      </tr>
      <tr>
        <td>
          <input type="reset" name="reset" value="reset">
        </td>
        <td>
          <input type="hidden" name="anti-csrf" value="<?php echo $csrf ?>">
          <button type="submit" name="checkout">Proceed to pay</button>
        </td>
      </tr>
    </table>
  </form>
</div>
