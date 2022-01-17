<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "investigacion.php";

$namespace = "swSemilleroGrupo";
$server = new soap_server();
$server->configureWSDL("swSemilleroGrupo", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType(
    'infoSemillero',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'coordinador' => array('name' => 'coordinador', 'type' => 'xsd:string'),
        'sede' => array('name' => 'sede', 'type' => 'xsd:string'),
    )
 );

 $server->wsdl->addComplexType(
    'semilleroArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array(
            'ref' => 'SOAP-ENC:arrayType',
            'wsdl:arrayType' => 'tns:infoSemillero[]'
        )
    ),
 );

$server->register(
    "swSemilleroGrupo",
    array("nombre" => "xsd:string"),
    array("return" => "tns:semilleroArray"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la lista de los semilleros de investigación correspondientes a un grupo."
);

$server->service(file_get_contents("php://input"));
