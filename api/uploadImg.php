<?php
require("./sqlcon.php");

$upload_dir = '../img/';
$server_url = 'http://localhost';

if($_FILES['img'])
{
    $img_name = $_FILES["img"]["name"];
    $img_tmp_name = $_FILES["img"]["tmp_name"];
    $error = $_FILES["img"]["error"];
    if($error > 0){
        $response = array(
            "status" => "error",
            "error" => true,
            "message" => "Error uploading the file!"
        );
        echo json_encode($response);
    }else 
    {
        $random_name = rand(1000,1000000)."-".$img_name;
        $db_name = strtolower($random_name);
        $upload_name = $upload_dir.strtolower($random_name);
        $upload_name = preg_replace('/\s+/', '-', $upload_name);
        // var_dump($upload_name);
        if(move_uploaded_file($img_tmp_name , $upload_name)) {
            echo json_encode($db_name);
            // $response = array(
            //     "status" => "success",
            //     "error" => false,
            //     "message" => "File uploaded successfully",
            //     "url" => $server_url."/".$upload_name
            //   );
        }else
        {
            $response = array(
                "status" => "error",
                "error" => true,
                "message" => "Error uploading the file!"
            );
            echo json_encode($response);
        }
    }



    

}else{
    $response = array(
        "status" => "error",
        "error" => true,
        "message" => "No file was sent!"
    );
    echo json_encode($response);
}



?>