<?php

require '../utils.php';

function swTitulos(){
    return buildResponseArray("SELECT codigo_plan_estudio, nombre, perfil_profesional, titulo FROM PLAN_ESTUDIO");
}

function swTitulosSede($ciudad){
    return buildResponseArray("SELECT PE.codigo_plan_estudio, PE.nombre, PE.perfil_profesional, PE.titulo FROM PLAN_ESTUDIO PE INNER JOIN SEDE S ON PE.id_sede = S.id_sede WHERE S.ciudad = '$ciudad'");
}

function swPlanEstudio($codigo_plan_estudio){
    return buildResponseArray("SELECT A.codigo_asignatura, A.nombre FROM DETALLE_ASIGNATURA DA INNER JOIN ASIGNATURA A ON DA.codigo_asignatura = A.codigo_asignatura WHERE DA.codigo_plan_estudio = '$codigo_plan_estudio'");
}

function swAsignaturasSemestre($codigo_plan_estudio, $semestre){
    return buildResponseArray("SELECT A.codigo_asignatura, A.nombre FROM DETALLE_ASIGNATURA DA INNER JOIN ASIGNATURA A ON DA.codigo_asignatura = A.codigo_asignatura WHERE DA.codigo_plan_estudio = '$codigo_plan_estudio' AND DA.semestre = $semestre");
}

function swCreditosTotalesPlanDeEstudios($codigo_plan_estudio){
    return buildResponse("SELECT PE.codigo_plan_estudio, PE.nombre, SUM(A.total_creditos) AS total_creditos FROM DETALLE_ASIGNATURA DA INNER JOIN ASIGNATURA A ON DA.codigo_asignatura = A.codigo_asignatura INNER JOIN PLAN_ESTUDIO PE ON PE.codigo_plan_estudio = DA.codigo_plan_estudio WHERE DA.codigo_plan_estudio = '$codigo_plan_estudio'");
}

function swCreditosTotalesSemestre($codigo_plan_estudio, $semestre){
    return buildResponse("SELECT PE.codigo_plan_estudio, PE.nombre, SUM(A.total_creditos) AS total_creditos FROM DETALLE_ASIGNATURA DA INNER JOIN ASIGNATURA A ON DA.codigo_asignatura = A.codigo_asignatura INNER JOIN PLAN_ESTUDIO PE ON PE.codigo_plan_estudio = DA.codigo_plan_estudio WHERE DA.codigo_plan_estudio = '$codigo_plan_estudio' AND DA.semestre = $semestre");
}

function swTopeCreditos($codigo_plan_estudio){
    return buildResponse("SELECT codigo_plan_estudio, nombre, tope_creditos FROM PLAN_ESTUDIO WHERE codigo_plan_estudio = '$codigo_plan_estudio'");
}

function swCantidadMaterias($codigo_plan_estudio){
    return buildResponse("SELECT PE.codigo_plan_estudio, PE.nombre, COUNT(PE.codigo_plan_estudio) AS cantidad_materias FROM DETALLE_ASIGNATURA DA INNER JOIN PLAN_ESTUDIO PE ON DA.codigo_plan_estudio = PE.codigo_plan_estudio WHERE DA.codigo_plan_estudio = '$codigo_plan_estudio'");
}