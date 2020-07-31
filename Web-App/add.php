<?php
include_once '/var/www/html/Farm-INDIA/Web-App/inc/db.inc.php';
$a=$conn->prepare('select * from Users where cookie=:cookie');
$c=$a->execute([':cookie'=>$_COOKIE['cookie']]);
$b=$a->fetch();
$csrf=$b['csrf'];
if($b['role']==4)
{
  include_once '/var/www/html/Farm-INDIA/Web-App/header.php';
  echo '<form action="upload.php" method="post" enctype="multipart/form-data" class = "signup">
  <span>Details of the Vegetable</span>
  <table>
    <tr>
      <td>
        <label for="title">Title</label>
      </td>
      <td>
        <input type="text" placeholder="name" name = "title">
      </td>
    </tr>
    <tr>
      <td><label for = "description">Description</label></td>
      <td><input type ="text" name="description" placeholder="Description"></td>
    </tr>
    <tr>
      <td><label for = "packages_available">Packages Available</label></td>
      <td><input type ="text" name="packages_available" placeholder="packages_available"></td>
    </tr>
    <tr>
      <td><label for = "least_package">Least Package (in kg)</label></td>
      <td><input type ="number" name="least_package" placeholder=00.00 step="0.01"></td>
    </tr>
    <tr>
      <td><label for = "Price">Price</label></td>
      <td><input type ="number" name="Price" ></td>
    </tr>
    <tr>
        <td>Select image to upload:</td>
        <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
    </tr>

    <tr>
      <td><input type="reset" value = "reset"></td>
      <td><input type="submit" value="Add the Vegetable" name="submit"></td>
    </tr>
    </table>
    <input type="hidden" name="anti_csrf" value="'.$csrf.'">
  </form>

';

}
else
{
  header("Location:http://localhost/Farm-INDIA/Web-App/index.php");
}
?>
