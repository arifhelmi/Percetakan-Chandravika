<?php

$id_kota_asal = 154; // Jakarta Timur
$id_kota_tujuan = $_POST['id_kota_tujuan'];
// $id_kota_tujuan = 88;
$berat_paket = $_POST['berat_paket'];
// $berat_paket = 1000;
$kurir = "jne";

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "origin=". $id_kota_asal ."&destination=". $id_kota_tujuan ."&weight=". $berat_paket ."&courier=".$kurir."",
//   CURLOPT_POSTFIELDS => "origin=501&destination=114&weight=1700&courier=jne",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
    "key: 2b442c7008ceda5968bcffe840a0f3d2"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}