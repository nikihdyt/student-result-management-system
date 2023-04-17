<?php

$nim = $_GET['nim'];
echo $nim;

$url='http://localhost:8080/v1/nilai?nim='.$nim;
echo $url;
$ch = curl_init($url);


curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//pastikan mengirim dengan method POST
curl_setopt($ch, CURLOPT_POST, true);

//Execute the request
$result = curl_exec($ch);
$result = json_decode($result, true);
print_r($result);

// curl_close($ch);

//var_dump($result);
// tampilkan return statusnya, apakah sukses atau tidak
print("<br>");
echo "<br>sampe sini sabii<br>";
// print("message :  {$result["message"]} "); 
print $result["message"]; 
echo "<br><a href=index.php> OK </a>";


header("Location: index.php");
exit();
?>