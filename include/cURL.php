<?php
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $apiURL,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $apiMethod,
    CURLOPT_SSL_VERIFYPEER => false, //Development
    CURLOPT_POSTFIELDS => $apiQuery,

    CURLOPT_HTTPHEADER => array(
        "Accept: application/json",
        "Content-Type: application/json"
    ),
));

$output = curl_exec($curl);
$curlResp = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

//Check cURL response
if($curlResp != 200) {
    exit("XX008 (" .$requestID. ")");
    //XX008 (N) cURL error
}

/*
200 Success (X)
*/
?>