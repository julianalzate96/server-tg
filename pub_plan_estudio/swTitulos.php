<?php

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "plan_estudio.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$namespace = "sw_titulos";
$server = new soap_server();
$server->configureWSDL("Titulos", $namespace);
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
        'perfil_profesional' => array('name' => 'perfil_profesional', 'type' => 'xsd:string'),
        'titulo' => array('name' => 'titulo', 'type' => 'xsd:string'),
    )
);

$server->register(
    "swTitulos",
    array(),
    array("return" => "tns:planEstudioArray"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve los títulos de los programas de APIT por los cuales un estudiante puede optar en el PCJIC."
);

$server->service(file_get_contents("php://input"));