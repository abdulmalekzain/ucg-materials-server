<?php
require("./sqlcon.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


// {
// 	"name": "kerosine",
// 	"unit": "Liter",
//  "price": 2323
// }

if($request) {
    $sql = "INSERT INTO 
    `materials` 
    (`ID`, `Name`, `Unit`, `Price`) 
    VALUES 
    (NULL, 
    '{$request->name}', 
    '{$request->unit}',
    '{$request->price}');";
    if(mysqli_query($connection,$sql)) {
        echo 1;
    }
}

?>