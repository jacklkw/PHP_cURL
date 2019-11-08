<?php  
/*  
 *  PHP POST Video Data Blob By cURL with CURLFile
 *  ChildOfCode (jlkw2013[A]gmail.com)
 *  9 November 2019
 */
// When receive POST data 
if(isset($_POST["postData"]))  
{
    $uploadDir = 'uploadsFolder/';
    $uploadFile = $uploadDir . basename($_FILES['video']['name']);

    //Save the Video on Server
    if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadFile))
    {
        // Header part
        $headerData = array(
            "authorization: Bearer LoginNameAndPasswordCode",
            "cache-control: no-cache",
            "content-type: multipart/form-data;"
        );

        // Post Video
        $videoData = array(
            'name' => 'video',
            'filename' => $_FILES['video']['name'],
            'video' => new CURLFile($uploadFile, $_FILES['video']['type'], $uploadFile)
        );  

        // Execute remote upload
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://Target_End_Point');
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SAFE_UPLOAD, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $videoData);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headerData);
        $response = curl_exec($curl);
        $errNo = curl_errno($curl);
        $errStr = curl_error($curl);
        curl_close($curl);
        echo "</br>  error_Code :: ".$errNo;
        echo "</br> error_Msg :: ".$errStr;
        echo '</br>  server_response :: '.$response;
        // unlink($uploadFile);  //Delete upload file if you don't need it keep on the server or don't save it on begin
        return;
    }
    else
    {
        echo "upload error!\n";
        return;
    }
}

echo "Post error";  
return;

?>