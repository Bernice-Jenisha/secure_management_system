<?php

include("../includes/db.php");
include("blockchain_helper.php");
include("../includes/log_helper.php");

$result = mysqli_query($conn,
"SELECT * FROM blockchain ORDER BY block_id ASC");

$previous = "GENESIS_BLOCK";

$valid = true;

while($block = mysqli_fetch_assoc($result)){

    $generated = generateBlockHash(

        $block['section_id'],

        $previous,

        $block['setter_id'],

        $block['timestamp']

    );

    if($generated != $block['current_hash']){

        $valid = false;
        break;
    }

    $previous = $block['current_hash'];

}

if($valid){
    addLog(
$conn,
$_SESSION['user_id'],
"Blockchain Verification",
"Success"
);
    echo " Blockchain Integrity Verified!";
}else{
    addLog(
$conn,
$_SESSION['user_id'],
"Blockchain Verification",
"Tampering Detected"
);
    echo " Blockchain Has Been Tampered!";
}

?>