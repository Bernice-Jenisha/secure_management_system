<?php

include("../includes/db.php");
include("blockchain_helper.php");

function createBlock($section_id, $setter_id){

    global $conn;

    $result = mysqli_query($conn,
        "SELECT * FROM blockchain ORDER BY block_id DESC LIMIT 1");

    if(mysqli_num_rows($result)>0){

        $lastBlock = mysqli_fetch_assoc($result);
        $previous_hash = $lastBlock['current_hash'];

    }else{

        $previous_hash = "GENESIS_BLOCK";

    }

    $timestamp = date("Y-m-d H:i:s");

    $current_hash = generateBlockHash(
        $section_id,
        $previous_hash,
        $setter_id,
        $timestamp
    );

    mysqli_query($conn,

    "INSERT INTO blockchain
    (section_id,previous_hash,current_hash,setter_id,timestamp)

    VALUES

    ('$section_id',
     '$previous_hash',
     '$current_hash',
     '$setter_id',
     '$timestamp')"

    );

}

?>