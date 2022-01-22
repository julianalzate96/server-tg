<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "docentes.php";

$namespace = "swDocentesAsignatura";
$server = new soap_server();
$server->soap_defencoding = 'UTF-8';
$server->decode_utf8 = false;
$server->configureWSDL("swDocentesAsignatura", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType(
   'infoDocente',
   'complexType',
   'struct',
   'all',
   '',
   array(
       'cedula' => array('name' => 'cedula', 'type' => 'xsd:string'),
       'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
   )
);

$server->wsdl->addComplexType(
   'docentesArray',
   'complexType',
   'array',
   '',
   'SOAP-ENC:Array',
   array(),
   array(
       array(
           'ref' => 'SOAP-ENC:arrayType',
           'wsdl:arrayType' => 'tns:infoDocente[]'
       )
   ),
);

$server->register(
    "swDocentesAsignatura",
    array("codigo_asignatura" => "xsd:string"),
    array("return" => "tns:docentesArray"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve información relacionada a los docentes que hacen parte de los programas de APIT"
);

$server->service(file_get_contents("php://input"));