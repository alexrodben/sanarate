<?php include "./../../template/header.php"; ?>
<?php include "./../../etc/conexion.php"; ?>
<?php
//para insertar informacion
if ($_POST) {
    print_r($_POST);

    //SE TOMAN LOS DATOS DEL METODO POST
    $nombre_puesto = (isset($_POST["nombre_puesto"]) ? $_POST["nombre_puesto"] : "");
    $estado_puesto = (isset($_POST["estado_puesto"]) ? $_POST["estado_puesto"] : "");

    //SENTECIA SQL
    $sentencia = $conexion->prepare("INSERT INTO tbl_puestos_empleados (id_puesto_empleado, nombre_puesto, estado_puesto) 
    VALUES (null, :nombre_puesto, :estado_puesto)");
    print_r($sentencia);

    //asignando los valores del metodo post, del formulario
    $sentencia->bindParam(":nombre_puesto", $nombre_puesto);
    $sentencia->bindParam(":estado_puesto", $estado_puesto);
    $sentencia->execute();
    header("Location: index.php");

}

//imprimo la lista
//print_r($lista_table_puesto);

?>

</br>
<div class="card">
    <div class="card-header">
        Puestos
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre_puesto" class="form-label">Nombre del puesto:</label>
                <input type="text" class="form-control" name="nombre_puesto" id="nombre_puesto" aria-describedby="helpId"
                    placeholder="Nombre del puesto">
            </div>
            <div class="mb-3">
                <label for="estado_puesto" class="form-label">Puesto:</label>
                <select class="form-select" value="<?= $estado_puesto; ?>" name="estado_puesto" id="estado_puesto"
                    required>
                    <option value="" disabled>Seleccione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>


            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php include "./../../template/footer.php"; ?>