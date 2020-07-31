<?php
include_once 'inc/db.inc.php';
$a=$conn->prepare('select * from Users where cookie=:cookie');
$b=$a->execute([':cookie'=>$_COOKIE['cookie']]);
$c=$a->fetch();
$id= $c['id'];
$csrf=$c['csrf'];
$user_name=$c['name'];
$user_email=$c['email'];
$user_contact_number=$c['contact_number'];
$user_postal_address=$c['postal_address'];
if(isset($_POST["checkout"]))
{
  if($_POST['anti-csrf']!=$csrf)
  {
    header('Location:index.php?error=invalidRequest');
    exit();
  }
  $a=$conn->prepare('update Users set csrf=:csrf where id=:id');
  $b=$a->execute([':csrf'=>bin2hex(random_bytes(16)),':id'=>$id]);
  if($_POST['payment']==1)
  {
    header('Location:payment.php');
  }
  else
  {
    $item=array();
    $quantity=array();
    $a=$conn->prepare('select item,quantity from cart where user =:user');
    $b=$a->execute([':user'=>$id]);
    $title=array();
    $price=array();
    for($i=0;$row=$a->fetch();$i++)
    {
      array_push($item,$row['item']);
      array_push($quantity,$row['quantity']);
      $c=$conn->prepare('select title,price from products where id=:id');
      $d=$c->execute([':id'=>$row['item']]);
      $e=$c->fetch();
      array_push($title,$e['title']);
      array_push($price,$e['price']);
    }
    try{
    $a=$conn->prepare('insert into invoice (shipping_name,contact_number,shipping_address,pin_code,type_of_payment,items,quantity,user) values(:shipping_name,:contact_number,:shipping_address,:pin_code,:type_of_payement,:items,:quantity,:user)');
    $b=$a->execute([':shipping_name'=>$_POST['name'],':contact_number'=>$_POST['contact_number'],':shipping_address'=>$_POST['address_1']." ".$_POST['address_2']." ".$_POST['address_3'],':pin_code'=>$_POST['pin_code'],':type_of_payement'=>$_POST['payment'],
    ':items'=>implode(" ",$item),':quantity'=>implode(" ",$quantity),':user'=>$id]);
    $a=$conn->prepare('delete from cart where user=:id');
    $b=$a->execute([':id'=>$id]);
    $a=$conn->prepare('select max(id) from invoice where user=:id');
    $b=$a->execute([':id'=>$id]);
    $c=$a->fetch();
    $invoice_no=$c['max(id)'];
  }
  catch(Exception $e)
  {
    echo $e;
  }
    require('fpdf.php');
    class PDF extends FPDF
    {
      // Page header
      function Header()
      {
        // Logo
        //$this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Times','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(40,10,'Farm-INDIA',1,0,'C');
        // Line break
        $this->Ln(20);
      }

      // Page footer
      function Footer()
      {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Times','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      }
    }

    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->Cell(40,5,'Invoice number:',0,0,'L');
    $pdf->Cell(40,5,$invoice_no,0,1,'L');
    $pdf->Cell(40,5,'Billing Address :',0,0);
    $pdf->Cell(40,5,$user_name,0,0);
    $pdf->Cell(40,5,'Shipping Address :',0,0);
    $pdf->Cell(40,5,$_POST['name'],0,1);
    $pdf->Cell(40,5);
    $pdf->Cell(40,5,$user_postal_address,0,0);
    $pdf->Cell(40,5);
    $pdf->Cell(40,5,$_POST['address_1']."".$_POST['address_2']."".$_POST['address_3'],0,1);
    $pdf->Cell(40,5,'Contact number');
    $pdf->Cell(40,5,$user_contact_number,0,0);
    $pdf->Cell(40,5,'Contact number');
    $pdf->Cell(40,5,$_POST['contact_number'],0,1);
    $pdf->Cell(80,5);
    $pdf->Cell(40,5,'Pin code :');
    $pdf->Cell(40,5,$_POST['pin_code'],0,1);
    $pdf->Ln(10);
    $pdf->SetFont('Times','B');
    $pdf->Cell(30,5,'Order Details',0,1);
    $pdf->Ln(5);
    $pdf->Cell(30,5,'Item no',1,0,'C');
    $pdf->Cell(50,5,'Title',1,0,'C');
    $pdf->Cell(30,5,'Quantity (in kg)',1,0,'C');
    $pdf->Cell(30,5,'Price/kg ',1,0,'C');
    $pdf->Cell(30,5,'Total',1,1,'C');
    $t=0;
    for ($i=0; $i <sizeof($item); $i++)
    {
      // code...
      $pdf->Cell(30,5,$i+1,1,0,'C');
      $pdf->Cell(50,5,$title[$i],1,0,'C');
      $pdf->Cell(30,5,$quantity[$i],1,0,'C');
      $pdf->Cell(30,5,$price[$i],1,0,'C');
      $pdf->Cell(30,5,$quantity[$i]*$price[$i],1,1,'C');
      $t+=$quantity[$i]*$price[$i];
    }
    $pdf->Ln(5);
    $pdf->Cell(140,5,'CGST',0,0,'R');
    $pdf->Cell(30,5,'round($t)',0,1,'C');
    $pdf->Ln(3);
    $pdf->Cell(140,5,'SGST',0,0,'R');
    $pdf->Cell(30,5,'round($t)',0,1,'C');
    $pdf->Ln(3);
    $pdf->Cell(140,5,'IGST',0,0,'R');
    $pdf->Cell(30,5,'round($t)',0,1,'C');
    $pdf->Ln(3);
    $pdf->Cell(140,5,'Grand Total (round off)',0,0,'R');
    $pdf->Cell(30,5,round($t),0,1,'C');

    $pdf->Output();
  }
}
else
{
  // code...
  header('Location:index.php');
  exit();
}
?>
