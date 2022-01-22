<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "asignatura.php";

$namespace = "swInfoTotalAsignatura";
$server = new soap_server();
$server->soap_defencoding = 'UTF-8';
$server->decode_utf8 = false;
$server->configureWSDL("swInfoTotalAsignatura", $namespace);
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
        'htpp' => array('name' => 'htpp', 'type' => 'xsd:integer'),
        'htpt' => array('name' => 'htpt', 'type' => 'xsd:integer'),
        'hti' => array('name' => 'hti', 'type' => 'xsd:integer'),
        'semestre' => array('name' => 'semestre', 'type' => 'xsd:integer'),
    )
);

$server->register(
    "swInfoTotalAsignatura",
    array("codigo_asignatura" => "xsd:string"),
    array("return" => "tns:infoAsignatura"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la información de una asignatura de forma agrupada."
);

$server->service(file_get_contents("php://input"));
