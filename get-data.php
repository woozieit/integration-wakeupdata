<?php

$DBhost = "localhost";
$DBuser = "root";
$DBpass = "";
$DBname = "migel";
 
try{
  
  $DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
  $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOException $ex){
  
  die($ex->getMessage());
}

$query = "SELECT * FROM products";
 
$stmt = $DBcon->prepare($query);
$stmt->execute();

$userData = array();

while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  
      $userData[] = $row;
 
}

echo json_encode($userData);
