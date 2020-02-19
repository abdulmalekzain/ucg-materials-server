<?php
require("./sqlcon.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


// {
//     "amount": 200,
//     "empID": 1,
//     "date": "2019-12-15",
//     "material": 1,
//     "targetID": 1,
//     "tank": 1
//    }

if($request) {

    $sqlTank="SELECT * FROM tanks WHERE `ID` = ".$request->tank;
    $result=mysqli_query($connection,$sqlTank);
    $tank=mysqli_fetch_assoc($result);

    // var_dump($item);

    if($tank['Capacity'] < $request->amount) {
        echo "not enough in tank";
    } else {
        $newRemaining = $tank['Remaining'] - $request->amount;

        $sql = "INSERT INTO 
        `log` 
        (`ID`, `Amount`, `RecipientID`, `Date`, `MaterialID`, `TargetID`, `TankID`) 
        VALUES 
        (NULL, 
        $request->amount,
        $request->empID,
        '{$request->date}',
        $request->material,
        $request->targetID,
        $request->tank);";
    
        if(mysqli_query($connection,$sql)) {
            $sqlUpdate = "UPDATE `tanks` SET `Remaining` = {$newRemaining} WHERE `tanks`.`ID` = {$request->tank};";
            if(mysqli_query($connection,$sqlUpdate)) {
                echo 1;
            }
        } else {
            echo mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n";
            echo $sql;
    
        }
    



    }






   }

?>