<?php
include_once 'inc/db.inc.php';
if(isset($_POST['Signup']))
{
  $name=htmlspecialchars($_POST['Full_Name'],ENT_QUOTES,"utf-8");
  $email=htmlspecialchars($_POST['email'],ENT_QUOTES,"utf-8");
  $pwd=htmlspecialchars($_POST['password'],ENT_QUOTES,"utf-8");
  $repwd=htmlspecialchars($_POST['pwd_check'],ENT_QUOTES,"utf-8");
  $contact_number=htmlspecialchars($_POST['contact_number'],ENT_QUOTES,"utf-8");
  $postal_address=htmlspecialchars($_POST['postal_address'],ENT_QUOTES,"utf-8");
  $pin_code=htmlspecialchars($_POST['pin_code'],ENT_QUOTES,"utf-8");
  $role=htmlspecialchars($_POST['role'],ENT_QUOTES,"utf-8");
  $age=htmlspecialchars($_POST['age'],ENT_QUOTES,"utf-8");
  $gender=htmlspecialchars($_POST['gender'],ENT_QUOTES,"utf-8");
  if(empty($name))
  {
    header("Location:Signup.php?error=emptyname");
    exit();
  }
  if(empty($pwd))
  {
    header("Location:Signup.php?error=emptypassword");
    exit();
  }
  if(empty($email))
  {
    header("Location:Signup.php?error=emptyemail");
    exit();
  }
  if(empty($repwd))
  {
    header("Location:Signup.php?error=emptyrepwd");
    exit();
  }
  if(empty($contact_number))
  {
    header("Location:Signup.php?error=emptycontact_number");
    exit();
  }
  if(empty($postal_address))
  {
    header("Location:Signup.php?error=emptypostal_address");
    exit();
  }
  if(empty($pin_code))
  {
    header("Location:Signup.php?error=emptypincode");
    exit();
  }
  if(empty($role))
  {
    header("Location:Signup.php?error=emptyrole");
    exit();
  }
  if(empty($age))
  {
    header("Location:Signup.php?error=emptyage");
    exit();
  }
  if(empty($gender))
  {
    header("Location:Signup.php?error=emptygender");
    exit();
  }
  elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
  {
    header("Location:Signup.php?error=invalid_email");
    exit();
  }
  elseif($pwd!=$repwd)
  {
    header("Location:Signup.php?error=passwordmismatch");
    exit();
  }
  else
  {
    if($age<18)
    {
      header("Location:Signup.php?error=Notallowedforagelessthan18");
      exit();
    }
    $a=$conn->prepare('select * from Users where email = :email');
    $b=$a->execute([':email'=>$email]);
    $row=$a->rowCount();
    if($row>0)
    {
      header("Location:Signup.php?error=emailalreadyregistered");
      exit();
    }
    $a=$conn->prepare('select * from Users where contact_number = :contact_number');
    $b=$a->execute([':contact_number'=>$contact_number]);
    $row=$a->rowCount();
    if($row>0)
    {
      header("Location:Signup.php?error=contactnumberalreadyregistered");
      exit();
    }
    $pwd=password_hash($pwd,PASSWORD_DEFAULT);
    $a= $conn->prepare('insert into Users (name,password,email,postal_address,contact_number,role,age,gender,pin_code) values (:name,:password,:email,:postal_address,:contact_number,:role,:age,:gender,:pin_code)');

    $b=$a->execute([':name'=>$name,':password'=>$pwd,':email'=>$email,':postal_address'=>$postal_address,':contact_number'=>$contact_number,":role"=>$role,":age"=>$age,":gender"=>$gender,":pin_code"=>$pin_code]);

    header("Location:index.php?signup=success");
  }
}
else{
  header("Location:Signup.php");
}
?>
