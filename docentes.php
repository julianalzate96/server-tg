<?php

$conn = require "db.php";

function swDocentes($cedula){
    global $conn;
    
    $result = $conn->query("SELECT cedula, nombre, nivel_academico, correo, tiempo_experiencia, tiempo_poli FROM DOCENTE WHERE cedula = $cedula");

    $row = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    return $row;
}



