<?php
require '../utils.php';

function swDocentes($cedula){
    $headers = getallheaders();
    $token = getenv("TOKEN");

    if(isset($headers["Authorization"])){
        if($headers["Authorization"] == $token){
            return buildResponse("SELECT cedula, nombre, nivel_academico, correo, tiempo_experiencia, tiempo_poli FROM DOCENTE WHERE cedula = $cedula"); 
        }else{
            return array('error' => 'error');
        }
    }else{
        return array('error' => 'error');
    }
}

function swDocentesAsignatura($codigo_asignatura){
    return buildResponseArray("SELECT D.cedula, D.nombre FROM DOCENTE D INNER JOIN ASIGNATURA A ON D.codigo_asignatura = A.codigo_asignatura WHERE D.codigo_asignatura = '$codigo_asignatura'");
}



