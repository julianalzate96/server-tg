<?php

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "plan_estudio.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$namespace = "swCreditosTotalesPlanDeEstudios";
$server = new soap_server();
$server->configureWSDL("Creditos Totales del Plan de Estudios", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType(
    'infoPlanEstudio',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'codigo_plan_estudio' => array('name' => 'codigo_plan_estudio', 'type' => 'xsd:string'),
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'total_creditos' => array('name' => 'total_creditos', 'type' => 'xsd:integer'),
    )
);

$server->register(
    "swCreditosTotalesSemestre",
    array('codigo_plan_estudio' => 'xsd:string', 'semestre' => 'xsd:integer'),
    array("return" => "tns:infoPlanEstudio"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la cantidad de créditos que se pueden coger por parte de un estudiante en un plan de estudio específico"
);

$server->service(file_get_contents("php://input"));
