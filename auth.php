<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");

$token = getenv("TOKEN");

if(isset($_POST["email"])){
    $domain = "@elpoli.edu.co";

    if(strpos($_POST["email"], $domain) !== false){
        echo json_encode($token);
    } else{
        echo json_encode(false);
    }
}else{
    echo json_encode(false);
}