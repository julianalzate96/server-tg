<?php

include 'utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

 
if(isset($_GET["type"])){

    if($_GET["type"] == 'categories'){
            $result = buildResponseArray('SELECT * FROM CATEGORIA');
    }
    if($_GET["type"] == 'services'){
        $result = buildResponseArray('SELECT * FROM SERVICIO WHERE id_categoria='.$_GET["category"]);
    }
    echo json_encode($result);
}

?>
