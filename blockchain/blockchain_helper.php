<?php

function generateBlockHash($section_id, $previous_hash, $setter_id, $timestamp){

    $data = $section_id .
            $previous_hash .
            $setter_id .
            $timestamp;

    return hash("sha256",$data);
}

?>