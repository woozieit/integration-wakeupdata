<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://integration.wakeupdata.com/Url/Fetch/5521-9357-4646-7591-7957-6083'); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HEADER, 0); 
$data = curl_exec($ch); 
curl_close($ch); 


$row = str_getcsv($data, ";");  
$length = count($row);  

$conn = mysqli_connect("localhost", "root", "", "migel");

if ( !$conn ) {
    echo "Error: No se pudo conectar a MySQL. Error " . mysqli_connect_errno() . " : ". mysqli_connect_error() . PHP_EOL;
    die;
}

for ( $i = 1; $i < $length; $i++ ) {     

    $data = str_getcsv($row[$i], ","); 


    $insertSQL = "INSERT INTO products (code, name, category, brand, price, price_promotion, discount, ratio, link, image) VALUES 
        ('{$data[0]}', '{$data[1]}', '{$data[2]}', '{$data[3]}', '{$data[4]}', '{$data[5]}', '{$data[6]}', '{$data[7]}', '{$data[8]}', '{$data[9]}');";

    if (($result = mysqli_query($conn, $insertSQL)) === false) {
        die(mysqli_error($conn));
    }
    
    
}   