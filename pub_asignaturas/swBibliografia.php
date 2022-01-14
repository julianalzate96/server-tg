<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "asignatura.php";

$namespace = "swBibliografia";
$server = new soap_server();
$server->configureWSDL("Bibliografía recomendada de una asignatura", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType(
    'infoBibliografia',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'id_bibliografia' => array('name' => 'codigo_asignatura', 'type' => 'xsd:string'),
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'autor' => array('name' => 'autor', 'type' => 'xsd:string'),
        'tiempo_publicacion' => array('name' => 'tiempo_publicacion', 'type' => 'xsd:string'),
        'edicion' => array('name' => 'edicion', 'type' => 'xsd:string'),
    )
);

$server->wsdl->addComplexType(
    'bibliografiaArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array(
            'ref' => 'SOAP-ENC:arrayType',
            'wsdl:arrayType' => 'tns:infoBibliografia[]'
        )
    ),
);

$server->register(
    "swBibliografia",
    array("codigo_asignatura" => "xsd:string"),
    array("return" => "tns:bibliografiaArray"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la bibliografía que se recomienda para el desarrollo de la asignatura."
);

$server->service(file_get_contents("php://input"));