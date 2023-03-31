<!-- REQUIERO LA CONEXION A LA BASE DE DATOS -->
<?php include "./../../template/header.php"; ?>
<?php include "./../../etc/conexion.php"; ?>
<?php
//validamos, y enviamos parametros por el metodo get, para borrar
if (isset($_GET['txtID'])) {

    //if ternario
    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

    //$id=$_GET['txtID'];
    $sentencia = $conexion->prepare("DELETE FROM `tbl_puestos_empleados` WHERE `id_puesto_empleado` = :id");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    header("Location: index.php");

}

$lista_table_puesto = [];
try {
    if (isset($conexion)) {
        //CONSULTA SQL A LA TABLA PUESTOS
        $sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos_empleados`");
        //EJECUTO EL QUERY
        $sentencia->execute();
        //CARGO EN UNA VARIABLE LISTA LOS DATOS
        $lista_table_puesto = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        function_alert_info($lista_table_puesto);
    }
    //imprimo la lista
} catch (\Throwable $th) {
    echo $th->getMessage();
}

?>
<h2 class="text-center">
    <b> Puestos de empleados </b>
</h2>
</br>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-success" href="crear.php" role="button">Agregar registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del Puesto</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ciclo for each -->
                    <?php foreach ($lista_table_puesto as $registro) { ?>
                        <tr class="">
                            <td scope="row">
                                <?= $registro['id_puesto_empleado'] ?>
                            </td>
                            <td>
                                <?= $registro['nombre_puesto'] ?>
                            </td>
                            <td>
                                <?= $registro['estado_puesto'] == 1 ? "Activo" : "Inactivo"; ?>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="editar.php?txtID=<?= $registro['id_puesto_empleado']; ?>"
                                    role="button">Editar</a>

                                <a class="btn btn-sm btn-danger" href="index.php?txtID=<?= $registro['id_puesto_empleado']; ?>"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este puesto?')"
                                    role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted">
        Módulo de Puestos
    </div>
</div>

<?php include "../../template/footer.php"; ?>