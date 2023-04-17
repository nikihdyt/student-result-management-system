<?php
$nim = $_GET['nim'];
$kode_mk = $_GET['kode_mk'];
$nilai = $_GET['nilai'];

$url='http://localhost:8080/v1/nilai/'.$nim.'/'.$kode_mk;
$ch = curl_init($url);

$jsonData = array(
    'nilai' =>  floatval($nilai),
);

//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

$result = curl_exec($ch);
$result = json_decode($result, true);
curl_close($ch);

print("<center><br>status :  {$result["message"]} "); 
echo "<br><a href=index.php> OK </a>";

header("Location: index.php");
exit();
?>

 