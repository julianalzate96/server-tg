<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");

$token = getenv("TOKEN");

if(isset($_GET["email"])){
    $domain = "@poli.edu.co";
    
    if(strpos($_GET["email"], $domain) !== false){
        echo json_encode($token);
    } else{
        echo json_encode(false);
    }
}