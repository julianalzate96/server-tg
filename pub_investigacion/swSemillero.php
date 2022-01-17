<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "investigacion.php";

$namespace = "swSemillero";
$server = new soap_server();
$server->configureWSDL("swSemillero", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType(
    'infoSemillero',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'facultad' => array('name' => 'facultad', 'type' => 'xsd:string'),
        'sede' => array('name' => 'sede', 'type' => 'xsd:string'),
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'grupo_investigacion' => array('name' => 'grupo_investigacion', 'type' => 'xsd:string'),
        'coordinador' => array('name' => 'coordinador', 'type' => 'xsd:string'),
        'objetivo' => array('name' => 'objetivo', 'type' => 'xsd:string'),
        'programa_academico' => array('name' => 'programa_academico', 'type' => 'xsd:string'),
    )
 );

$server->register(
    "swSemillero",
    array("nombre" => "xsd:string"),
    array("return" => "tns:infoSemillero"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la información correspondiente a un semillero de investigación."
);

$server->service(file_get_contents("php://input"));
