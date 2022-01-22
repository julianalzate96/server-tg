<?php

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "plan_estudio.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$namespace = "swTitulosSede";
$server = new soap_server();
$server->soap_defencoding = 'UTF-8';
$server->decode_utf8 = false;
$server->configureWSDL("swTitulosSede", $namespace);
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

$server->wsdl->addComplexType(
    'planEstudioArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array(
            'ref' => 'SOAP-ENC:arrayType',
            'wsdl:arrayType' => 'tns:infoPlanEstudio[]'
        )
    ),
);

$server->register(
    "swTitulosSede",
    array('ciudad' => 'xsd:string'),
    array("return" => "tns:planEstudioArray"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve los títulos de los programas de APIT por los cuales un estudiante puede optar en el PCJIC filtrado por una sede en específico"
);
$server->service(file_get_contents("php://input"));