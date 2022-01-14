<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "asignatura.php";

$namespace = "swCreditosMateria";
$server = new soap_server();
$server->configureWSDL("Créditos de una materia", $namespace);
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
        'total_creditos' => array('name' => 'total_creditos', 'type' => 'xsd:integer'),
    )
);

$server->register(
    "swCreditosMateria",
    array("codigo_asignatura" => "xsd:string"),
    array("return" => "tns:infoAsignatura"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la cantidad de créditos que tiene una asignatura"
);

$server->service(file_get_contents("php://input"));
