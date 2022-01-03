<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once 'vendor/autoload.php';
require_once "vendor/econea/nusoap/src/nusoap.php";
require "asignatura.php";
$conn = require "db.php";


// Configuracion del Servicio Web
$namespace = "pub_asignaturas";
$server = new soap_server();
$server->configureWSDL("Asignaturas", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;


/* 
 * En esta parte se definen los esquemas de las respuestas de los servicios web, 
 * se define como clave, valor y el nombre que coloquemos sera la etiqueta XML
 * que tendra el atributo
 */
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
    'asignaturasArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array(
            'ref' => 'SOAP-ENC:arrayType',
            'wsdl:arrayType' => 'tns:infoAsignatura[]'
        )
    ),
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

// En esta parte se registras las funciones que tendra el servicio web

$server->register(
    "swCreditosMateria",
    array("codigo_asignatura" => "xsd:string"),
    array("return" => "tns:infoAsignatura"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la cantidad de créditos que tiene una asignatura"
);

$server->register(
    "swPreRequisitos",
    array("codigo_asignatura" => "xsd:string"),
    array("return" => "tns:asignaturasArray"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve los pre - requisitos de una materia en específico"
);

$server->register(
    "swCoRequisitos",
    array("codigo_asignatura" => "xsd:string"),
    array("return" => "tns:asignaturasArray"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "devuelve los co - requisitos de una materia en específico"
);

$server->register(
    "swHTPP",
    array("codigo_asignatura" => "xsd:string"),
    array("return" => "tns:infoAsignatura"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la cantidad de horas que una materia en específico tiene de trabajo presencial práctico."
);

$server->register(
    "swHTPT",
    array("codigo_asignatura" => "xsd:string"),
    array("return" => "tns:infoAsignatura"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la cantidad de horas que una materia en específico tiene de trabajo presencial teórico."
);

$server->register(
    "swHTI",
    array("codigo_asignatura" => "xsd:string"),
    array("return" => "tns:infoAsignatura"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la cantidad de horas que una materia en específico tiene de trabajo independiente."
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

