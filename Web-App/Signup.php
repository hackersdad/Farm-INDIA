<?php
include_once 'header.php';

if($login<1)
{
  echo '<div class="signup">
        <form  action="createaccount.php" method="post" class="form">
          <table>
            <tr>
              <td> <label for="Full_Name">Full Name</label></td>
                <td><input type="text" name="Full_Name" placeholder="Full name" autofocus required></td>
            </tr>
            <tr>
              <td> <label for="age">Age</label></td>
              <td><input type="number" name="age" placeholder=00 required ></td>
            </tr>
            <tr>
              <td> <label for="gender">Gender</label></td>
              <td>
                <input type="radio" name="gender" value="M" checked>
                <label for="M">Male</label>
                <input type="radio" name="gender" value="F">
                <label for="F">Female</label>
                <input type="radio" name="gender" value="O">
                <label for="O">Other</label>
              </td>
            </tr>
            <tr>
              <td> <label for="email">email</label></td>
              <td> <input type="email" name="email" placeholder="Abc@xyz.fg" required></td>
            </tr>
            <tr>
              <td><label for="contact_number">Phone no</label></td>
              <td><input type="tel" name="contact_number" pattern="[0-9]{10}" placeholder="9876543210" required></td>
            </tr>
            <tr>
              <td><label for="postal_address">Address</label></td>
              <td><input type="text" name="postal_address" placeholder="Address" required></td>
            </tr>
            <tr>
              <td><label for="pin_code">Pin code :</label></td>
              <td><input type="number" name="pin_code" placeholder=123456 pattern = " [0-9]{6}"required></td>
            </tr>
            <tr>
              <td><p>You are a</p></td>
              <td>
                <input type="radio" name="role" value="1" checked><!-- 1 for farmer-->
                <label for="farmer">farmer</label>
                <input type="radio" name="role" value="2"><!-- 2 for trader-->
                <label for="trader">trader</label>
                <input type="radio" name="role" value="3"><!-- 3 for customer-->
                <label for="customer">Customer</label>
              </td>
            </tr>
            <tr>
              <td><label for="password">Password</label></td>
              <td><input type="password" name="password" placeholder="Password" required></td>
            </tr>
            <tr>
              <td><label for = "pwd_check">Confirm </label></td>
              <td><input type="password" name="pwd_check" placeholder="Retype your password" required></td>
            </tr>
            <tr>
              <td><input type="reset" ></td>
              <td><button type="submit" name="Signup" value="Signup">Register</button></td>
            </tr>
          </table>
        </form>
      </div>';
    include_once 'Footer.html';
}
else {
  // code...
  header("Location:index.php");
  exit();
}
?>
