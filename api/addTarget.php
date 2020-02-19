<?php
require("./sqlcon.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


// {
// 	"name": "fireworks"
// }

if($request) {
    $sql = "INSERT INTO 
    `targets` 
    (`ID`, `Name`) 
    VALUES 
    (NULL, 
    '{$request->name}');";

    if(mysqli_query($connection,$sql)) {
        echo 1;
    }
}

?>