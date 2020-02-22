<?php
require("./sqlcon.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


// {
    // Name: [null, Validators.required],
    // Location: [null, Validators.required],
    // Capacity: [null, Validators.required],
    // Remaining: [null, Validators.required],
    // ContentID: [null, Validators.required],
    // Img: [null]
// }

if($request) {
    $sql = "INSERT INTO 
    `tanks` 
    (`ID`, `Name`, `Capacity`, `Remaining`,`Location`,`ContentsID`, `Img`) 
    VALUES 
    (NULL, 
    '{$request->Name}', 
    $request->Capacity, 
    $request->Remaining, 
    '{$request->Location}',
    $request->ContentID,
    '{$request->Img}');";

    if(mysqli_query($connection,$sql)) {
        echo 1;
    }
}

?>