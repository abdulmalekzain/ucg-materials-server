<?php
require("./sqlcon.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


// {
// 	"name": "mohammad Ahmed"
// }

if($request) {
    $sql = "INSERT INTO 
    `employees` 
    (`ID`, `Name`) 
    VALUES 
    (NULL, 
    '{$request->name}');";

    if(mysqli_query($connection,$sql)) {
        echo 1;
    }
}

?>