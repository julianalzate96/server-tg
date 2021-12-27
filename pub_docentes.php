<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");

require_once 'vendor/autoload.php';
require_once "vendor/econea/nusoap/src/nusoap.php";
require "docentes.php";
$conn = require "db.php";


$namespace = "pub_docentes";
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
        'nivel_academico' => array('name' => 'nivelEducativo', 'type' => 'xsd:string'),
        'correo' => array('name' => 'correo', 'type' => 'xsd:string'),
        'tiempo_experiencia' => array('name' => 'tiempoExperiencia', 'type' => 'xsd:string'),
        'tiempo_poli' => array('name' => 'tiempoPoli', 'type' => 'xsd:string'),
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

