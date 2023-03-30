<?php

function function_alert($message, $error)
{
    str_replace("'", '"', $error);
    $js_code = 'console.error(' . json_encode($error, JSON_HEX_TAG) . ');';
    // Display the alert box 
    echo "<script> alert('$message'); </script>";
    echo '<script>' . $js_code . '</script>';
}

$servidor = "localhost"; //ip
$baseDatos = "logistic"; //dbname
$usuario = "root"; //user
$clave = ""; //password

//try to connection from database
try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $clave);
} catch (Exception $th) {
    //    echo $th->getMessage();
    $mesage_error = "Error al conectar con la base de datos, por favor contacte al administrador.";
    function_alert($mesage_error, $th->getMessage());
}
?>