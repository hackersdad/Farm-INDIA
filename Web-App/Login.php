<?php
include 'header.html';
include 'inc/login.php';
$a = Login::isloggedin();
echo "a = ",$a;
?>
