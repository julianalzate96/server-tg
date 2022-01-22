<?php

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "plan_estudio.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$namespace = "swAsignaturasSemestre";
$server = new soap_server();
$server->soap_defencoding = 'UTF-8';
$server->decode_utf8 = false;
$server->configureWSDL("swAsignaturasSemestre", $namespace);
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
    "swAsignaturasSemestre",
    array('codigo_plan_estudio' => 'xsd:string', 'semestre' => 'xsd:integer'),
    array("return" => "tns:asignaturaArray"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve las asignaturas asignadas para ser cursadas en un semestre en específico de un plan de estudio específico."
);

$server->service(file_get_contents("php://input"));
