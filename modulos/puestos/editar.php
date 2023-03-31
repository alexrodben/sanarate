<?php include "./../../template/header.php"; ?>
<?php include "./../../etc/conexion.php"; ?>
<?php
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

    try {
        if (isset($conexion)) {
            $sentencia = $conexion->prepare("SELECT estado_puesto, nombre_puesto, estado_puesto FROM tbl_puestos_empleados WHERE estado_puesto=:id");
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

    $nombre_puesto = isset($registro['nombre_puesto']) ? $registro['nombre_puesto'] : "No se encontro el registro";
    $estado_puesto = isset($registro['estado_puesto']) ? $registro['estado_puesto'] : "No se encontro el registro";
    //print_r($registro);
}

//para editar informacion

if ($_POST) {

    print_r($_POST);

    //SE TOMAN LOS DATOS DEL METODO POST
    $txtID = (isset($_POST['txtID']) ? $_POST['txtID'] : "");
    $nombre_puesto = (isset($_POST["nombre_puesto"]) ? $_POST["nombre_puesto"] : "");
    $estado_puesto = (isset($_POST["estado_puesto"]) ? $_POST["estado_puesto"] : "");

    //SENTECIA SQL
    $sentencia = $conexion->prepare("UPDATE tbl_puestos_empleados SET nombre_puesto=:nombre_puesto, estado_puesto=:estado_puesto WHERE id_puesto_empleado=:id");

    //asignando los valores del metodo post, del formulario
    $sentencia->bindParam(":estado_puesto", $estado_puesto);
    $sentencia->bindParam(":nombre_puesto", $nombre_puesto);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("Location: index.php");
}

?>
</br>
<div class="card">
    <div class="card-header">
        Puestos
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" value="<?= $txtID; ?>" class="form-control" readonly name="txtID" id="txtID"
                    aria-describedby="helpId" placeholder="ID">
            </div>

            <div class=" mb-3">
                <label for="nombre_puesto" class="form-label">Nombre del puesto:</label>
                <input type="text" value="<?= $nombre_puesto; ?>" class="form-control" name="nombre_puesto"
                    id="nombre_puesto" aria-describedby="helpId" placeholder="Nombre del puesto">
            </div>

            <div class="mb-3">
                <label for="estado_puesto" class="form-label">Puesto:</label>
                <select class="form-select" value="<?= $estado_puesto; ?>" name="estado_puesto" id="estado_puesto"
                    required>
                    <option value="" disabled>Seleccione una opción</option>
                    <option value="1" <?= $estado_puesto == 1 ? "selected=selected" : ""; ?>>
                        Activo
                    </option>
                    <option value="0" <?= $estado_puesto == 0 ? "selected=selected" : ""; ?>>
                        Inactivo
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>



<?php include "./../../template/footer.php"; ?>