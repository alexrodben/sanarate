<?php
$url_host = "http://$_SERVER[HTTP_HOST]";
$url_folder = "sanarate/";
$url_base = $url_host . "/" . $url_folder;
$url_active = basename("http://$_SERVER[REQUEST_URI]");

$url_list = [
    array(
        "id" => 1,
        "active" => "empleados",
        "display" => "Empleados"
    ),
    array(
        "id" => 1,
        "active" => "puestos",
        "display" => "Puesto de empleados"
    ),
    array(
        "id" => 1,
        "active" => "usuarios",
        "display" => "Usuarios"
    ),
]


    ?>
<!doctype html>

<html lang="es">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <!-- Estilos css para hacer responsiva las paginas -->
    <link rel="stylesheet" href="<?php echo $url_base; ?>css/theme.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>css/footer.css">

</head>

<body>
    <?php
    //CONEXION 
    include_once("./../../conexion.php");
    ?>
    <header>
        <!-- place navbar here -->
    </header>
    <nav class="navbar navbar-expand bg-primary" data-bs-theme="dark">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo $url_base; ?>" aria-current="page">Sistema <span
                        class="visually-hidden">(current)</span></a>
            </li>
            <?php foreach ($url_list as $registro) { ?>
                <li class="nav-item">
                    <a class="nav-link <?= $url_active == $registro['active'] ? "active" : ""; ?> "
                        href="<?= $url_base; ?>modulos/<?= $registro['active']; ?>/">
                        <?= $registro['display']; ?>
                    </a>
                </li>

            <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>cerrar.php">Cerrar sesión</a>
            </li>
        </ul>
    </nav>
    <main class="container">
        </br>