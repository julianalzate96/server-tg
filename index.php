<?php

include 'utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

$services = array();

$word = "";

if(isset($_GET["word"])){
    $word = $_GET["word"];
}

$services = buildResponseArray("SELECT S.nombre, S.descripcion, S.wsdl FROM SERVICIO S WHERE nombre LIKE '%".$word."%' OR descripcion LIKE '%".$word."%'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>UDDI</title>
</head>

<body>
    <div class="container">
        <h4 class="mt-5 mb-2">Buscar Servicios</h4>
        <form class="d-flex col-4 mb-5" action="." method="get">
            <input class="form-control me-5" type="text" name="word" value="<?php echo $word?>" placeholder="Ingrese una palabra clave" required />
            <button class="btn btn-primary" type="submit">BUSCAR</button>
        </form>
        <section>
            <?php if(count($services) > 0) {?>
                <span>Servicios encontrados: <?php echo count($services) ?></span>
            <table class="table table-striped">
                <thead>
                    <tr class="table-warning">
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">WSDL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $key => $value){ ?>
                        <tr>
                            <td><?php echo $value["nombre"] ?></td>
                            <td><?php echo $value["descripcion"] ?></td>
                            <td><a href="<?php echo $value["wsdl"] ?>"><?php echo $value["wsdl"] ?></a></td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
            <?php }else{ ?>
                <h5>No se escontraron servicios relacionados con esa palabra clave.</h5>
            <?php } ?>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>