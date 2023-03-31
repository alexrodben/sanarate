<?php include "./../../template/header.php"; ?>
<?php include "./../../etc/conexion.php"; ?>

<?php
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
    try {
        if (isset($conexion)) {

            $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id_usuario=:id");
            $sentencia->bindParam(':id', $txtID);
            $sentencia->execute();

            $registro = $sentencia->fetch(PDO::FETCH_LAZY);
        }
        $message = "";
    } catch (\Throwable $th) {
        $registro = [];
        $message = "No se ha encontrado el registro solicitado";
        $mesage_error = "Error al ejecutar la consulta para puestos de trabajo, por favor contacte al administrador.";
        function_alert_error($mesage_error, $th->getMessage());
    }


    $correo = isset($registro['correo']) ? $registro['correo'] : "No se encontro el registro";
    $username = isset($registro['username']) ? $registro['username'] : "No se encontro el registro";
    $password = isset($registro['password']) ? $registro['password'] : "No se encontro el registro";
    $fullname = isset($registro['fullname']) ? $registro['fullname'] : "No se encontro el registro";
    $id_rol_usuario = isset($registro['id_rol_usuario']) ? $registro['id_rol_usuario'] : "No se encontro el registro";
    $id_estado_usuario = isset($registro['id_estado_usuario']) ? $registro['id_estado_usuario'] : "No se encontro el registro";
    //print_r($registro);
}

//para editar informacion

if ($_POST) {

    print_r($_POST);

    //SE TOMAN LOS DATOS DEL METODO POST
    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
    $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");
    $username = (isset($_POST["username"]) ? $_POST["username"] : "");
    $password = (isset($_POST["password"]) ? $_POST["password"] : "");
    $fullname = (isset($_POST["fullname"]) ? $_POST["fullname"] : "");
    $id_rol_usuario = (isset($_POST["id_rol_usuario"]) ? $_POST["id_rol_usuario"] : "");
    $id_estado_usuario = (isset($_POST["id_estado_usuario"]) ? $_POST["id_estado_usuario"] : "");

    //SENTECIA SQL
    $sentencia = $conexion->prepare("UPDATE `tbl_usuarios` SET username=:username, password=:password, correo=:correo, fullname=:fullname, id_rol_usuario=:id_rol_usuario, id_estado_usuario=:id_estado_usuario WHERE id_usuario=:id");

    //asignando los valores del metodo post, del formulario
    $sentencia->bindParam(":id_estado_usuario", $id_estado_usuario);
    $sentencia->bindParam(":id_rol_usuario", $id_rol_usuario);
    $sentencia->bindParam(":username", $username);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":fullname", $fullname);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("Location: index.php");
}

//Estados empleados
try {
    if (isset($conexion)) {
        $sentencia = $conexion->prepare("SELECT id_estado_usuario, nombre_estado FROM `tbl_estados_usuarios`"); //CONSULTA SQL A LA TABLA PUESTOS
        $sentencia->execute(); //EJECUTO EL QUERY
        $lista_table_estado = $sentencia->fetchAll(PDO::FETCH_ASSOC); //CARGO EN UNA VARIABLE LISTA LOS DATOS
        function_alert_info($lista_table_estado);
    }
} catch (\Throwable $th) {
    $lista_table_estado = [];
    $mesage_error = "Error al ejecutar la consulta para estados de empleado, por favor contacte al administrador.";
    function_alert_error($mesage_error, $th->getMessage());
}

//Puestos
try {
    if (isset($conexion)) {
        $sentencia = $conexion->prepare("SELECT id_rol_usuario, nombre_rol FROM `tbl_roles_usuarios`"); //CONSULTA SQL A LA TABLA PUESTOS
        $sentencia->execute(); //EJECUTO EL QUERY
        $lista_table_roles = $sentencia->fetchAll(PDO::FETCH_ASSOC); //CARGO EN UNA VARIABLE LISTA LOS DATOS
        function_alert_info($lista_table_roles);
    }
} catch (\Throwable $th) {
    $lista_table_roles = [];
    $mesage_error = "Error al ejecutar la consulta para puestos de trabajo, por favor contacte al administrador.";
    function_alert_error($mesage_error, $th->getMessage());
}



?>

</br>
<div class="card">
    <div class="card-header">
        Datos del Usuarios
    </div>
    <div class="card-body">
        <form action="" method="post">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" value="<?= $txtID; ?>" class="form-control" disabled name="txtID" id="txtID"
                    aria-describedby="helpId" placeholder="ID">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">Nombre del usuario:</label>
                    <input type="text" value="<?= $username; ?>" class="form-control" name="username" id="username"
                        aria-describedby="helpId" placeholder="Nombre del usuario">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" value="<?= $password; ?>" class="form-control" name="password" id="password"
                        aria-describedby="helpId" placeholder="Password del username">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fullname" class="form-label">Nombre Personal:</label>
                    <input type="text" value="<?= $fullname; ?>" class="form-control" name="fullname" id="fullname"
                        aria-describedby="helpId" placeholder="Escriba su correo">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="correo" class="form-label">Correo:</label>
                    <input type="text" value="<?= $correo; ?>" class="form-control" name="correo" id="correo"
                        aria-describedby="helpId" placeholder="Escriba su correo">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_rol_usuario" class="form-label">Rol de usuario:</label>
                    <select class="form-select form-select-sm" value="<?= $id_rol_usuario; ?>" name="id_rol_usuario"
                        id="id_rol_usuario" required>
                        <option value="" disabled>Seleccione una opción</option>
                        <!-- Ciclo for each para la tabla puestos -->
                        <?php foreach ($lista_table_roles as $registro) { ?>
                            <?php $select = $registro['id_rol_usuario'] == $id_rol_usuario ? "selected=selected" : ""; ?>
                            <option value="<?= $registro['id_rol_usuario'] ?>" <?= $select ?>>
                                <?= $registro['nombre_rol'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="id_estado_usuario" class="form-label">Estado:</label>
                    <select class="form-select form-select-sm" value="<?= $id_estado_usuario; ?>"
                        name="id_estado_usuario" id="id_estado_usuario" required>
                        <option value="" disabled>Seleccione una opción</option>
                        <!-- Ciclo for each para la tabla puestos -->
                        <?php foreach ($lista_table_estado as $registro) { ?>
                            <?php $select = $registro['id_estado_usuario'] == $id_estado_usuario ? "selected=selected" : ""; ?>
                            <option value="<?= $registro['id_estado_usuario'] ?>" <?= $select ?>>
                                <?= $registro['nombre_estado'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php include "./../../template/footer.php"; ?>