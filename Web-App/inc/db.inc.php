<?php
class DB{
  private static function connect(){
  $pdo=new PDO("mysql:host=localhost;dbname=Farm_INDIA",root);/*pgsql:host='ec2-52-207-25-133.compute-1.amazonaws.com';port=5432;dbname='d7prq652o97jjn';user='cgpqpsawcpzgay';password=23284d6d265e195693fbfd3fda99033c88d9f9b118cd2ca6cbf3b80fbafe8285*/
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }
  public static function query($query,$params=array()){
    $stmt=self::connect()->prepare($query);
    $stmt->execute($params);
    if(explode(' ',$query)[0]=='select'){
      $data=$stmt->fetchAll();
      return $data;
    }
  }
}
?>
