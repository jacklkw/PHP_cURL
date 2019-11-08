<?php
/*  
 *  PHP GET JSON data By cURL
 *  ChildOfCode (jlkw2013[A]gmail.com)
 *  9 November 2019
 */
if(isset($_POST["GetData"]))  
{
    $GetData = json_decode($_POST["GetData"]);
    $ClientId = $GetData->ClientId;
    $Record = $GetData->Record;

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://Endpoint_Target/".$ClientId."/TheEvents/".$Record,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "authorization: Basic The_Password==",
        "cache-control: no-cache",
        "content-type: application/json"
    ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    echo $response;
    return;
}

echo "Request Error\n";  
return;


?>