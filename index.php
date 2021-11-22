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
    'urn:test#saludar',
    "rcp",
    "encoded",
    "recibe un nombre y regresa un saludo"
);

function saludar($name = "default"){
    return $name;
}

//$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
//$server->service($HTTP_RAW_POST_DATA);
$POST_DATA = file_get_contents("php://input");
print($POST_DATA);
$server->service($POST_DATA);
exit();

