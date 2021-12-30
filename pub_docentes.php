<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once 'vendor/autoload.php';
require_once "vendor/econea/nusoap/src/nusoap.php";
require "docentes.php";
$conn = require "db.php";


// Configuracion del Servicio Web
$namespace = "pub_docentes";
$server = new soap_server();
$server->configureWSDL("Docentes", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;


/* 
 * En esta parte se definen los esquemas de las respuestas de los servicios web, 
 * se define como clave, valor y el nombre que coloquemos sera la etiqueta XML
 * que tendra el atributo
 */
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

// Ene sta parte se registras las funciones que tendra el servicio web

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

