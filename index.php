<?php
session_start();

if (isset($_SESSION["token"]) && isset($_SESSION["name"])) {
    header("Location: /sanarate/modulos/home/index.php");
} else {
    header("Location: /sanarate/security/login.php");
}

if (isset($_COOKIE["token"]) && isset($_COOKIE["name"])) {
    header("Location: /sanarate/modulos/home/index.php");
} else {
    header("Location: /sanarate/security/login.php");
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security</title>
</head>

<body>

</body>

</html>