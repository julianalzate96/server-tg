<?php

require_once "../vendor/econea/nusoap/src/nusoap.php";
require "plan_estudio.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$namespace = "swAsignaturasSemestre";
$server = new soap_server();
$server->configureWSDL("Asignaturas por semestre", $namespace);
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
        'cantidad_materias' => array('name' => 'cantidad_materias', 'type' => 'xsd:integer'),
    )
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