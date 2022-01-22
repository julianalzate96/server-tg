<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "investigacion.php";

$namespace = "swGrupo";
$server = new soap_server();
$server->soap_defencoding = 'UTF-8';
$server->decode_utf8 = false;
$server->configureWSDL("swGrupo", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType(
    'infoGrupo',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'codigo_minciencias' => array('name' => 'codigo_minciencias', 'type' => 'xsd:string'),
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'director' => array('name' => 'director', 'type' => 'xsd:string'),
        'correo' => array('name' => 'correo', 'type' => 'xsd:string'),
        'categoria' => array('name' => 'categoria', 'type' => 'xsd:string'),
    )
 );

$server->register(
    "swGrupo",
    array("nombre" => "xsd:string"),
    array("return" => "tns:infoGrupo"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la información correspondiente a un grupo de investigación."
);

$server->service(file_get_contents("php://input"));
