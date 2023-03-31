<?php
ob_start();
$url_host = "http://$_SERVER[HTTP_HOST]";
$REQUEST_URI = $_SERVER['REQUEST_URI'];
$baseName = basename($REQUEST_URI);
$str_replace = str_replace($baseName, "", $REQUEST_URI);

$url_list = [
    array(
        "url" => "/sanarate/modulos/home/",
        "display" => "Inicio"
    ),
    array(
        "url" => "/sanarate/modulos/empleados/",
        "display" => "Empleados"
    ),
    array(
        "url" => "/sanarate/modulos/puestos/",
        "display" => "Puesto de empleados"
    ),
    array(
        "url" => "/sanarate/modulos/usuarios/",
        "display" => "Usuarios"
    ),
]
    ?>
<!doctype html>

<html lang="es">

<head>
    <title>Holiii...!!!!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <!-- Estilos css para hacer responsiva las paginas -->
    <link rel="stylesheet" href="<?php echo $url_host; ?>/sanarate/css/theme.css">
    <link rel="stylesheet" href="<?php echo $url_host; ?>/sanarate/css/footer.css">

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <nav class="navbar navbar-expand bg-primary" data-bs-theme="dark">
        <ul class="nav navbar-nav">
            <?php foreach ($url_list as $registro) { ?>
                <?php $url_active = $str_replace == $registro['url'] ? "active" : ""; ?>
                <li class="nav-item">
                    <a class="nav-link <?= $url_active; ?> " href="<?= $url_host; ?><?= $registro['url']; ?>index.php">
                        <?= $registro['display']; ?>
                    </a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link active" href="<?= $url_host; ?>/sanarate/security/logout.php">
                    Cerrar sesion
                </a>
            </li>
        </ul>
    </nav>
    <main class="container">
        </br>