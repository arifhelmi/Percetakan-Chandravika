<?php

$id_provinsi = $_POST['id_provinsi'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id_provinsi,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(  
    "key: 2b442c7008ceda5968bcffe840a0f3d2"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    // echo "<pre>"; print_r($err); echo "</pre>";
    echo "cURL Error #:" . $err;
} else {
    echo $response;
    // $kota = json_decode($response);
    // $result = array();
    // foreach ($kota->rajaongkir->results as $key => $pv){
    //     // echo"<option>test echo2</option>";
    //     echo"<option id=".$pv->province_id." value=".$pv->province_id.">".$pv->province."</option>";
    //     $result[] = 
    // }
    // echo $kota->rajaongkir->results;
    // echo "<pre>"; print_r($data); echo "</pre>";
}