<?php
require('./DAL/DAL.php');
$bd = new DAL();

$datos = $bd->Select('SELECT * FROM productos');
?>

<!DOCTYPE html>
<html lang="es-CO">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LISTADO DE PRODUCTOS</title>
</head>

<body>
    <h1>Listado de productos registrados</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>NOMBRE</th>
                <th>CANTIDAD</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $html = '';
                foreach ($datos as $dato){
                    $html .= '<tr>
                    <td>'.$dato['id'].'</td>
                    <td>'.$dato['nombre'].'</td>
                    <td>'.$dato['cantidad'].'</td>
                    </tr>';
                }
                echo $html;
            ?>
        </tbody>
    </table>
</body>

</html>