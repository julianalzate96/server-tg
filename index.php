<?php

require_once "vendor/econea/nusoap/src/nusoap.php";

$namespace = "test";
$server = new soap_server();
$server->configureWSDL("testSOAP", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

$server->register(
    "saludar",
    array("name" => "xsd:string"),
    array("return" => "xsd:string"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "recibe un nombre y regresa un saludo."
);

function saludar($name){
    $saludo = "Hola ".$name;
    return $saludo;
}

$server->service(file_get_contents("php://input"));

