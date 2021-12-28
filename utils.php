<?php

$conn = require "db.php";


function buildResponseArray ($query){
    global $conn;

    $array = [];
    
    $result = $conn->query($query);

    while($row = mysqli_fetch_assoc($result)){
        array_push($array, $row);
    }
    
    return $array;
}