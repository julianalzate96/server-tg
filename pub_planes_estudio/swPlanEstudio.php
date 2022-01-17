<?php

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "plan_estudio.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$namespace = "swPlanEstudio";
$server = new soap_server();
$server->configureWSDL("swPlanEstudio", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType(
    'infoAsignatura',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'codigo_asignatura' => array('name' => 'codigo_asignatura', 'type' => 'xsd:string'),
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
    )
);

$server->wsdl->addComplexType(
    'asignaturaArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array(
            'ref' => 'SOAP-ENC:arrayType',
            'wsdl:arrayType' => 'tns:infoAsignatura[]'
        )
    ),
);

$server->register(
    "swPlanEstudio",
    array('codigo_plan_estudio' => 'xsd:string'),
    array("return" => "tns:asignaturaArray"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve las asignaturas que componen un plan de estudio."
);

$server->service(file_get_contents("php://input"));
