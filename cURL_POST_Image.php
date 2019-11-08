<?php
/*  
 *  PHP POST Image with JSON data By cURL
 *  ChildOfCode (jlkw2013[A]gmail.com)
 *  9 November 2019
 */

if(isset($_POST["postData"]))  
{
    $ImagesData = $_POST["postImageData"]; // Get Image Data (Base64)
    $userData = json_decode($_POST["postData"]);
    $EventId = $userData->EventId;
    $UserId = $userData->UserId;
    $MimeType = $userData->Set[0]->MimeType;
    $GroupID = $userData->Set[0]->GroupID;

    $headerData = array(
        "authorization: Basic The_Password==",
        "cache-control: no-cache",
        "content-type: application/json;"
    );

    $ImageData = '
    {
        "EventId": "'.$EventId.'",
        "UserId": "'.$UserId.'",
        "Image": '.$ImagesData.'
        "Set": [
            {
                "MimeType": "'.$MimeType.'",
                "GroupID": "'.$GroupID.'",
            }
        ]
    }';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://Target_EndPoint/');
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SAFE_UPLOAD, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $ImageData);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headerData);
    $response = curl_exec($curl);
    $errNo = curl_errno($curl);
    $errStr = curl_error($curl);
    curl_close($curl);
    echo $response;
    return;

}

?>