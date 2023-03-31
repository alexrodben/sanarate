<?php include "./../../template/header.php"; ?>
<?php include "./../../etc/conexion.php"; ?>

<?php
//validamos, y enviamos parametros por el metodo get, para borrar
if (isset($_GET['txtID'])) {

    //if ternario
    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

    //todo: Primero
    /* Getting the foto and cv from the tbl_empleados table where the id_empleado is equal to the id. */
    $sentencia = $conexion->prepare("SELECT foto_perfil, cv_empleado FROM `tbl_empleados` WHERE `id_empleado` = :id");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);

    //print_r($registro_recuperad);

    //todo: Segundo
    /* Checking if the file exists and if it does, it deletes it. */
    if (isset($registro_recuperado["foto_perfil"]) && $registro_recuperado["foto_perfil"] != "") {
        if (file_exists("./profiles/") . $registro_recuperado["foto_perfil"]) {
            unlink("./profiles/" . $registro_recuperado["foto_perfil"]);
        }
    }

    /* Checking if the file exists and if it does, it deletes it. */
    if (isset($registro_recuperado["cv_empleado"]) && $registro_recuperado["cv_empleado"] != "") {
        if (file_exists("./documents/") . $registro_recuperado["cv_empleado"]) {
            unlink("./documents/" . $registro_recuperado["cv_empleado"]);
        }
    }

    //todo: Tercero
    //$id=$_GET['txtID'];

    /* Deleting the record from the database. */
    $sentencia = $conexion->prepare("DELETE FROM `tbl_empleados` WHERE `id_empleado` = :id");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    header("Location: index.php");
}

$lista_table_empleados = [];
try {
    if (isset($conexion)) {
        // Consulta para obtener los datos de la tabla empleados y el puesto
        // para ello trabajamos con la subconsulta
        $sqlQuery = "SELECT *, (SELECT nombre_puesto FROM tbl_puestos_empleados WHERE tbl_puestos_empleados.id_puesto_empleado=tbl_empleados.id_puesto_empleado limit 1) as puesto FROM `tbl_empleados`";
        $sentencia = $conexion->prepare($sqlQuery);
        //EJECUTO EL QUERY
        $sentencia->execute();
        //CARGO EN UNA VARIABLE LISTA LOS DATOS
        $lista_table_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        function_alert_info($lista_table_empleados);
    }
} catch (\Throwable $th) {
    echo $th->getMessage();
}

//imprimo la lista
//print_r($lista_table_puesto);

?>
<h2 class="text-center">
    <b> Empleados </b>
</h2>
</br>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-success" href="crear.php" role="button">Agregar registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de Ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ciclo for each -->
                    <?php foreach ($lista_table_empleados as $registro) { ?>
                        <tr class="">
                            <td scope="row">
                                <?= $registro['id_empleado']; ?>
                            </td>
                            <td scope="row">
                                <?= $registro['primer_nombre']; ?>
                                <?= $registro['segundo_nombre']; ?>
                                <?= $registro['apellido_paterno']; ?>
                                <?= $registro['apellido_materno']; ?>
                                <?= $registro["apellido_casada"] == null ? "" : $registro["apellido_casada"] ?>
                            </td>
                            <td>
                                <img width="50" src="<?= $registro['foto_perfil'] ?>" class="img-fluid rounded" alt="" />
                            </td>
                            <td scope="row">
                                <?= $registro['cv_empleado'] ?>
                            </td>
                            <td scope="row">
                                <?= $registro['puesto'] ?>
                            </td>
                            <td scope="row">
                                <?= $registro['fecha_ingreso'] ?>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="editar.php?txtID=<?= $registro['id_empleado']; ?>"
                                    role="button">Editar</a>

                                <a class="btn btn-sm btn-danger" href="index.php?txtID=<?= $registro['id_empleado']; ?>"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar al empleado?')"
                                    role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted">
        Módulo de Empleados
    </div>
</div>

<?php include "../../template/footer.php"; ?>