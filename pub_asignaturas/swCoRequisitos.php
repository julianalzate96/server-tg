<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "asignatura.php";

$namespace = "swCoRequisitos";
$server = new soap_server();
$server->configureWSDL("Co-Requisitos de una asignatura", $namespace);
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
    'asignaturasArray',
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
    "swCoRequisitos",
    array("codigo_asignatura" => "xsd:string"),
    array("return" => "tns:asignaturasArray"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "devuelve los co-requisitos de una materia en específico"
);

$server->service(file_get_contents("php://input"));
