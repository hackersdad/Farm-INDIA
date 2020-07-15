<?php include 'header.html'?>
<div class="signup">
  <form  action="createaccount.php" method="post">
    <div class="form">
      <label for="Full_Name">Full Name</label>&nbsp&nbsp
      <input type='text' name="Full_Name" placeholder="Full name">
    </div><br>
    <div class="form">
      <label for="UserName">User Name</label>&nbsp&nbsp
      <input type='text' name="UserName" placeholder="User name">
    </div><br>
    <div class="form">
      <label for="email">email</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <input type='email' name="email" placeholder="Abc@xyz.fg">
    </div><br>
    <div class="form">
      <label for="contact_number">Phone no</label>&nbsp&nbsp
      <input type='tel' name="contact_number" pattern="[0-9]{10}">
    </div><br>
    <div class="form">
      <label for="postal_address">Address</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <input type='text' name="postal_address" placeholder="Address">
    </div><br>
      <p>You are a &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp                  <br>
      <input type="radio" name="role" value="farmer">
      <label for="farmer">farmer</label><br>
      <input type="radio" name="role" value="trader">
      <label for="trader">trader</label><br>
      <input type="radio" name="role" value="customer">
      <label for="customer">Customer</label><br><br>
      </p>
      <div class="form">
      <label for="password">Password</label>&nbsp&nbsp
      <input type='password' name="password" placeholder="Password">
    </div><br>
    <div class="form">
      <label for = "pwd_check">Confirm </label>&nbsp&nbsp
      <input type='password' name="pwd_check" placeholder="Retype your password">
    </div><br>
    <div class="form">
      <input type="reset" >
      <button type="submit" name="Signup">Signup</button>
    </div>
  </form>
</div>
<?php include 'Footer.html' ?>
