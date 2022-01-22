<?php

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "plan_estudio.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$namespace = "swCantidadAsignaturas";
$server = new soap_server();
$server->soap_defencoding = 'UTF-8';
$server->decode_utf8 = false;
$server->configureWSDL("swCantidadAsignaturas", $namespace);
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
        'cantidad_asignaturas' => array('name' => 'cantidad_asignaturas', 'type' => 'xsd:integer'),
    )
);

$server->register(
    "swCantidadAsignaturas",
    array('codigo_plan_estudio' => 'xsd:string'),
    array("return" => "tns:infoPlanEstudio"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la cantidad de asignaturas con las que cuenta el plan de estudio"
);

$server->service(file_get_contents("php://input"));