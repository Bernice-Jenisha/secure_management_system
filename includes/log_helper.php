<?php

function addLog($conn,$user_id,$action,$status){

    $ip = $_SERVER['REMOTE_ADDR'];

    mysqli_query($conn,
    "INSERT INTO audit_logs(user_id,action,status,ip_address)
    VALUES(
    '$user_id',
    '$action',
    '$status',
    '$ip'
    )");

}

?>