<?php
$nim = $_GET['nim'];
$kode_mk = $_GET['kode_mk'];

$url='http://localhost:8080/v1/nilai/'.$nim.'/'.$kode_mk;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$result = json_decode($result, true);

curl_close($ch);

print("<br>");
print("<center><br>message :  {$result["message"]} "); 

echo "<br><a href=index.php> OK </a>";

header("Location: index.php");
exit();
?>