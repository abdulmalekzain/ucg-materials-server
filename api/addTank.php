<?php
require("./sqlcon.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


// {
// 	"name": "new tank",
// 	"capacity": "3000",
// 	"remaining": "3000",
// 	"location": "behind workshop",
// 	"material": "1"
// }

if($request) {
    $sql = "INSERT INTO 
    `tanks` 
    (`ID`, `Name`, `Capacity`, `Remaining`,`Location`,`ContentsID`) 
    VALUES 
    (NULL, 
    '{$request->name}', 
    $request->capacity, 
    $request->remaining, 
    '{$request->location}',
    $request->material);";

    if(mysqli_query($connection,$sql)) {
        echo 1;
    }
}

?>