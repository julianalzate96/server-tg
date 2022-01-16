<?php
require '../utils.php';

function swSemillero($nombre_semillero){
    return buildResponse("SELECT SI.facultad, S.ciudad as sede, SI.nombre, G.nombre as grupo_investigacion, D.nombre as docente, SI.objetivo, SI.programa_academico FROM SEMILLERO_INVESTIGACION SI INNER JOIN SEDE S ON SI.id_sede = s.id_sede INNER JOIN GRUPO_INVESTIGACION G ON SI.id_grupo_investigacion = G.id_grupo_investigacion INNER JOIN DOCENTE D ON SI.coordinador = D.cedula WHERE SI.nombre = '$nombre_semillero'");
}

function swGrupo($nombre_grupo){
    return buildResponse("SELECT G.codigo_minciencias, G.nombre, D.nombre as director, G.correo, G.categoria  FROM GRUPO_INVESTIGACION G INNER JOIN DOCENTE D ON G.director = D.cedula WHERE G.nombre = '$nombre_grupo'");
}

function swSemilleroGrupo($nombre_grupo){
    return buildResponseArray("SELECT SI.nombre, D.nombre as coordinador,  S.ciudad as sede  FROM SEMILLERO_INVESTIGACION SI INNER JOIN DOCENTE D ON SI.coordinador = D.cedula INNER JOIN SEDE S ON SI.id_sede = S.id_sede INNER JOIN GRUPO_INVESTIGACION G ON SI.id_grupo_investigacion = G.id_grupo_investigacion WHERE G.nombre = '$nombre_grupo'");
}