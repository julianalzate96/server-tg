<?php
require '../utils.php';

function swDocentes($cedula){
    return buildResponse("SELECT cedula, nombre, nivel_academico, correo, tiempo_experiencia, tiempo_poli FROM DOCENTE WHERE cedula = $cedula");
}

function swDocentesAsignatura($codigo_asignatura){
    return buildResponseArray("SELECT D.cedula, D.nombre FROM DOCENTE D INNER JOIN ASIGNATURA A ON D.codigo_asignatura = A.codigo_asignatura WHERE D.codigo_asignatura = '$codigo_asignatura'");
}



