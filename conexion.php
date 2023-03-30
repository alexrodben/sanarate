<?php

function function_alert_error($message, $error)
{
    str_replace("'", '"', $error);
    $js_code = 'console.error(' . json_encode($error, JSON_HEX_TAG) . ');';
    // Display the alert box 
    echo "<script> alert('$message'); </script>";
    echo '<script>' . $js_code . '</script>';
}

function function_alert_info($message)
{
    $js_code = 'console.info(' . json_encode($message, JSON_HEX_TAG) . ');';
    // Display the alert box 
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
    function_alert_error($mesage_error, $th->getMessage());
}
?>