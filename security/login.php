<!doctype html>

<html lang="es">

<head>
    <title>Security - Log in </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <meta name="theme-color" content="#712cf9">

    <!-- Estilos css para hacer responsiva las paginas -->
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }
    </style>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>


</head>

<body class="text-center">
    <main class="container">
        <main class="form-signin w-100 m-auto">
            <?php include "./../etc/conexion.php"; ?>
            <?php
            //para insertar informacion
            if ($_POST) {
                try {
                    if (isset($conexion)) {
                        $username = (isset($_POST['username']) ? $_POST['username'] : "");
                        $password = (isset($_POST['password']) ? $_POST['password'] : "");
                        $remember = (isset($_POST['remember']) ? $_POST['remember'] : "");

                        // para ello trabajamos con la subconsulta
                        $sqlQuery = "SELECT id_usuario, fullname FROM `tbl_usuarios` WHERE `username`=:username AND `password`=:password;";
                        $sentencia = $conexion->prepare($sqlQuery);
                        $sentencia->bindParam(':username', $username);
                        $sentencia->bindParam(':password', $password);
                        //EJECUTO EL QUERY
                        $sentencia->execute();
                        //CARGO EN UNA VARIABLE LISTA LOS DATOS
                        $data = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                        //Nums rows
                        if (count($data) > 0) {
                            $token = bin2hex(random_bytes(16));
                            $name = $data[0]["fullname"];
                            function_alert_info($data);

                            session_start();
                            $_SESSION["token"] = $token;
                            $_SESSION["name"] = $name;
                            if ($remember == "on") {
                                setcookie("token", $token, time() + 3600, "/", "", 0);
                                setcookie("name", $name, time() + 3600, "/", "", 0);
                            }
                            header("Location: /sanarate/modulos/home/index.php");
                        } else {
                            $mesage_error = "Credenciales incorrectas, intente de nuevo.";
                            function_alert_error($mesage_error, $mesage_error);
                        }
                    }
                } catch (Exception $th) {
                    // echo $th->getMessage();
                    $mesage_error = "Credenciales incorrectas, intente de nuevo.";
                    function_alert_error($mesage_error, $th->getMessage());
                }

            }
            ?>

            <form action="login.php" method="post">
                <img class="mb-4"
                    src="https://w7.pngwing.com/pngs/505/761/png-transparent-login-computer-icons-avatar-icon-monochrome-black-silhouette.png"
                    alt="" width="100" height="100">
                <h1 class="h3 mb-3 fw-normal">Iniciar sesion</h1>

                <div class="form-floating">
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="name@example.com">
                    <label for="username">Usuario</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="password">
                    <label for="password">Contraseña</label>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" id="remember" name="remember" value="on"> Recordarme
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Iniciar</button>
                <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
            </form>
        </main>



        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js"
            integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i"
            crossorigin="anonymous"></script>
    </main>

</body>

</html>