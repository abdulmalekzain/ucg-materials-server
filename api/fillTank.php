<?php
require("./sqlcon.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


// {
//  "date": "2019/11/13",
//  "tank": 3,
//  "amount": 3000
// }

if($request) {

    $sqlTank="SELECT * FROM tanks WHERE `ID` = ".$request->tank;
    $result=mysqli_query($connection,$sqlTank);
    $item=mysqli_fetch_assoc($result);

    // var_dump($item);

    $newTotal = $item['Remaining'] + $request->amount;

    // if($item['Capacity'] < $newTotal) {
    //     echo "too muchh";
    // } else {
    //     echo $newTotal;
    // }

    $sql = "INSERT INTO 
    `tankLog` 
    (`ID`, `Date`, `TankID`, `Amount`) 
    VALUES 
    (NULL, 
    '{$request->date}',
    $request->tank,
    $request->amount);";

    if(mysqli_query($connection,$sql)) {
        $sqlUpdate = "UPDATE `tanks` SET `Remaining` = {$newTotal} WHERE `tanks`.`ID` = {$request->tank};";
        if(mysqli_query($connection,$sqlUpdate)) {
            echo 1;
        }
    } else {
        echo mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n";
        echo $sql;

    }
}

?>