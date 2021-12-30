<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once 'vendor/autoload.php';
require_once "vendor/econea/nusoap/src/nusoap.php";
require "plan_estudio.php";

// Configuracion del Servicio Web
$namespace = "pub_plan_estudio";
$server = new soap_server();
$server->configureWSDL("Plan de Estudio", $namespace);
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
        'total_creditos' => array('name' => 'total_creditos', 'type' => 'xsd:integer'),
        'tope_creditos' => array('name' => 'tope_creditos', 'type' => 'xsd:integer'),
        'cantidad_materias' => array('name' => 'cantidad_materias', 'type' => 'xsd:integer'),
    )
);

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
    )
);

$server->wsdl->addComplexType(
    'asignaturaArray',
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

// Ene sta parte se registras las funciones que tendra el servicio web

$server->register(
    "swTitulos",
    array(),
    array("return" => "tns:planEstudioArray"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve los títulos de los programas de APIT por los cuales un estudiante puede optar en el PCJIC."
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

$server->register(
    "swPlanEstudio",
    array('codigo_plan_estudio' => 'xsd:string'),
    array("return" => "tns:asignaturaArray"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve las asignaturas que componen un plan de estudio."
);

$server->register(
    "swAsignaturasSemestre",
    array('codigo_plan_estudio' => 'xsd:string', 'semestre' => 'xsd:integer'),
    array("return" => "tns:asignaturaArray"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve las asignaturas asignadas para ser cursadas en un semestre en específico de un plan de estudio específico."
);

$server->register(
    "swCreditosTotalesPlanDeEstudios",
    array('codigo_plan_estudio' => 'xsd:string'),
    array("return" => "tns:infoPlanEstudio"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la cantidad de créditos totales del plan de estudio"
);

$server->register(
    "swCreditosTotalesSemestre",
    array('codigo_plan_estudio' => 'xsd:string', 'semestre' => 'xsd:integer'),
    array("return" => "tns:infoPlanEstudio"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la cantidad de créditos que se pueden coger por parte de un estudiante en un plan de estudio específico"
);

$server->register(
    "swTopeCreditos",
    array('codigo_plan_estudio' => 'xsd:string'),
    array("return" => "tns:infoPlanEstudio"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la cantidad de créditos que se deben alcanzar para desbloquear trabajo de grado"
);

$server->register(
    "swCantidadMaterias",
    array('codigo_plan_estudio' => 'xsd:string'),
    array("return" => "tns:infoPlanEstudio"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Devuelve la cantidad de materias con las que cuenta el plan de estudio"
);

$server->service(file_get_contents("php://input"));

