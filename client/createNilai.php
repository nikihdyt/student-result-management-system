<?php

if(isset($_POST['submit']))
{    
$nim = $_POST['nim'];
$kode_mk = $_POST['kode_mk'];
$nilai = floatval($_POST['nilai']);

$url='http://localhost:8080/v1/nilai';
$ch = curl_init($url);

$jsonData = array(  
    'nim' =>  $nim,
    'kode_mk' =>  $kode_mk,
    'nilai' =>  $nilai,
);

//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_POST, true);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

//Execute the request
$result = curl_exec($ch);
$result = json_decode($result, true);

curl_close($ch);

print("message :  {$result["message"]} "); 
echo "<br><a href=index.php> OK </a>";

header("Location: index.php");
exit();
}
?>