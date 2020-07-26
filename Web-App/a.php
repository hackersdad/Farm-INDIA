<?php
include_once 'inc/db.inc.php';
$a=$conn->prepare('select csrf from Users where cookie=:cookie');
$b=$a->execute([':cookie'=>$_COOKIE['cookie']]);
$c=$a->fetch();
if($c['csrf']==$_POST['anti_csrf'])
{
  echo "a";
}
print_r($_POST);
/*include_once 'inc/db.inc.php';
$a=$conn->prepare('select * from products');
$b=$a->execute();
$c=$a->fetchAll();
foreach ($c as $key => $value)
{
  // code...
  echo "<img src='".$c[$key]['picture']."' >";
}
//print_r($c['2']);
//print_r($c['id']);
/*$servername = "localhost";
$username = "root";
$password = "";

try {
 $conn = new PDO("mysql:host=$servername;dbname=Farm_INDIA", $username, $password);
 // set the PDO error mode to exception
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 echo "Connected successfully";
} catch(PDOException $e) {
 echo "Connection failed: " . $e->getMessage();
}*/
?>
