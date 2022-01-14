<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "../pub_docentes/docentes.php";

$namespace = "swDocentes";
$server = new soap_server();
$server->configureWSDL("Docentes", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType(
    'infoDocente',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'nivel_academico' => array('name' => 'nivel_academico', 'type' => 'xsd:string'),
        'correo' => array('name' => 'correo', 'type' => 'xsd:string'),
        'tiempo_experiencia' => array('name' => 'tiempo_experiencia', 'type' => 'xsd:string'),
        'tiempo_poli' => array('name' => 'tiempo_poli', 'type' => 'xsd:string'),
    )
);

$server->register(
    "swDocentes",
    array("cedula" => "xsd:string"),
    array("return" => "tns:infoDocente"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve información relacionada a los docentes que hacen parte de los programas de APIT"
);

$server->service(file_get_contents("php://input"));
