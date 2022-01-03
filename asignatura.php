<?php

include "utils.php";

function swCreditosMateria($codigo_asignatura){
    return buildResponse("SELECT A.codigo_asignatura, A.nombre, A.total_creditos FROM ASIGNATURA A WHERE A.codigo_asignatura = '$codigo_asignatura'");
}

function swPreRequisitos($codigo_asignatura){
    return buildResponseArray("SELECT A.codigo_asignatura, A.nombre FROM DETALLE_PRE_REQUISITO DPR INNER JOIN ASIGNATURA A ON DPR.codigo_pre_requisito = A.codigo_asignatura WHERE DPR.codigo_asignatura = '$codigo_asignatura'");
}

function swCoRequisitos($codigo_asignatura){
    return buildResponseArray("SELECT A.codigo_asignatura, A.nombre FROM DETALLE_CO_REQUISITO DCR INNER JOIN ASIGNATURA A ON DCR.codigo_co_requisito = A.codigo_asignatura WHERE DCR.codigo_asignatura = '$codigo_asignatura'");
}

function swHTPP($codigo_asignatura){
    return buildResponse("SELECT A.codigo_asignatura, A.nombre, DA.htpp FROM ASIGNATURA A INNER JOIN DETALLE_ASIGNATURA DA ON DA.codigo_asignatura = A.codigo_asignatura WHERE A.codigo_asignatura = '$codigo_asignatura'");
}

function swHTI($codigo_asignatura){
    return buildResponse("SELECT A.codigo_asignatura, A.nombre, DA.hti FROM ASIGNATURA A INNER JOIN DETALLE_ASIGNATURA DA ON DA.codigo_asignatura = A.codigo_asignatura WHERE A.codigo_asignatura = '$codigo_asignatura'");
}

function swHTPT($codigo_asignatura){
    return buildResponse("SELECT A.codigo_asignatura, A.nombre, DA.htpt FROM ASIGNATURA A INNER JOIN DETALLE_ASIGNATURA DA ON DA.codigo_asignatura = A.codigo_asignatura WHERE A.codigo_asignatura = '$codigo_asignatura'");
}

function swInfoTotalAsignatura($codigo_asignatura){
    return buildResponse("SELECT A.codigo_asignatura, A.nombre, A.total_creditos, DA.htpt, DA.htpp, DA.hti, DA.semestre FROM ASIGNATURA A INNER JOIN DETALLE_ASIGNATURA DA ON DA.codigo_asignatura = A.codigo_asignatura WHERE A.codigo_asignatura = '$codigo_asignatura'");
}

function swBibliografia($codigo_asignatura){
    return buildResponseArray("SELECT B.id_bibliografia, B.nombre, B.autor, B.tiempo_publicacion, B.edicion FROM BIBLIOGRAFIA B INNER JOIN ASIGNATURA A ON A.codigo_asignatura = B.codigo_asignatura WHERE B.codigo_asignatura = '$codigo_asignatura'");
}