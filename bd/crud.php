<?php

// CRUD diseñado para realizar las consultas, los nuevos registros, las actualizaciones
// y la eliminacion de los productos en la Base de Datos.

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);         // JSON formato necesario para acceder a los datos decodificados

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
                                                                      // Filas de la tabla para mostrar los datos
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$referencia = (isset($_POST['referencia'])) ? $_POST['referencia'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$moneda = (isset($_POST['moneda'])) ? $_POST['moneda'] : '';
$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '';


switch($opcion){

    case 1:                                                           // Caso de añadir un nuevo producto
        $consulta = "INSERT INTO productos (descripcion, referencia, moneda, precio, cantidad) VALUES('$descripcion', '$referencia', '$moneda', '$precio', '$cantidad') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;

    case 2:                                                           // Caso de actualizacion de un producto
        $consulta = "UPDATE productos SET descripcion='$descripcion', referencia='$referencia', moneda='$moneda', precio='$precio', cantidad='$cantidad'  WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 3:                                                           // Caso de eliminar un producto
        $consulta = "DELETE FROM productos WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;

    case 4:                                                           // Caso de consulta de los productos desde la Base de Datos
        $consulta = "SELECT id, descripcion, referencia, moneda, precio, cantidad FROM productos";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);                     // Se muestran los datos del JSON
$conexion = NULL;
