<?php include "./../../template/header.php"; ?>
<?php include "./../../etc/conexion.php"; ?>
<?php
//para insertar informacion
if ($_POST) {
  try {

    print_r($_POST);
    print_r($_FILES);

    //SE TOMAN LOS DATOS DEL METODO POST
    $primer_nombre = (isset($_POST["primer_nombre"]) ? $_POST["primer_nombre"] : "");
    $segundo_nombre = (isset($_POST["segundo_nombre"]) ? $_POST["segundo_nombre"] : "");
    $tercer_nombre = (isset($_POST["tercer_nombre"]) ? $_POST["tercer_nombre"] : "");
    $apellido_paterno = (isset($_POST["apellido_paterno"]) ? $_POST["apellido_paterno"] : "");
    $apellido_materno = (isset($_POST["apellido_materno"]) ? $_POST["apellido_materno"] : "");
    $apellido_casada = (isset($_POST["apellido_casada"]) ? $_POST["apellido_casada"] : "");

    $foto_perfil = (isset($_FILES["foto_perfil"]['name']) ? $_FILES["foto_perfil"]['name'] : "");
    $cv_empleado = (isset($_FILES["cv_empleado"]['name']) ? $_FILES["cv_empleado"]['name'] : "");

    $fecha_ingreso = (isset($_POST["fecha_ingreso"]) ? $_POST["fecha_ingreso"] : "");
    $telefono = (isset($_POST["telefono"]) ? $_POST["telefono"] : "");
    $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");
    $direccion = (isset($_POST["direccion"]) ? $_POST["direccion"] : "");
    $contacto_emergencia = (isset($_POST["contacto_emergencia"]) ? $_POST["contacto_emergencia"] : "");

    $id_parentesco = (isset($_POST["id_parentesco"]) ? $_POST["id_parentesco"] : "");
    $id_tipo_sangre = (isset($_POST["id_tipo_sangre"]) ? $_POST["id_tipo_sangre"] : "");
    $id_puesto_empleado = (isset($_POST["id_puesto_empleado"]) ? $_POST["id_puesto_empleado"] : "");
    $id_estado_empleado = (isset($_POST["id_estado_empleado"]) ? $_POST["id_estado_empleado"] : "");

    $fecha_foto = new DateTime();
    $timestamp = date('Y-m-d H:i:s');

    //se adjunta la foto_perfil
    if ($foto_perfil != '') {
      $nombreArchivo_foto = $fecha_foto->getTimestamp() . "_" . $_FILES['foto_perfil']['name'];
      $tmp_foto = $_FILES['foto_perfil']['tmp_name'];
      //validamos si todo esta bien
      if ($tmp_foto != '') {
        move_uploaded_file($tmp_foto, "./" . $nombreArchivo_foto);
        $foto_perfil = $nombreArchivo_foto;
      }
    }

    //se adjunta el cv
    if ($cv_empleado != '') {
      $nombreArchivo_cv = $fecha_foto->getTimestamp() . "_" . $_FILES['cv_empleado']['name'];
      $tmp_cv = $_FILES['cv_empleado']['tmp_name'];
      //validamos si todo esta bien
      if ($tmp_cv != '') {
        move_uploaded_file($tmp_cv, "./" . $nombreArchivo_cv);
        $cv_empleado = $nombreArchivo_cv;
      }
    }



    //SENTECIA SQL
    $sentencia = $conexion->prepare("INSERT INTO `tbl_empleados`
(`id_empleado`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `apellido_paterno`, `apellido_materno`, `apellido_casada`, `foto_perfil`, `cv_empleado`, `fecha_ingreso`, `telefono`, `correo`, `direccion`, `contacto_emergencia`, `id_parentesco`, `id_tipo_sangre`, `id_puesto_empleado`, `id_estado_empleado`) 
VALUES (NULL, :primer_nombre, :segundo_nombre, :tercer_nombre, :apellido_paterno, :apellido_materno, :apellido_casada, :foto_perfil, :cv_empleado, :fecha_ingreso, :telefono, :correo, :direccion, :contacto_emergencia, :id_parentesco, :id_tipo_sangre, :id_puesto_empleado, :id_estado_empleado);");

    //asignando los valores del metodo post, del formulario
    $sentencia->bindParam(":primer_nombre", $primer_nombre);
    $sentencia->bindParam(":segundo_nombre", $segundo_nombre);
    $sentencia->bindParam(":tercer_nombre", $tercer_nombre);
    $sentencia->bindParam(":apellido_paterno", $apellido_paterno);
    $sentencia->bindParam(":apellido_materno", $apellido_materno);
    $sentencia->bindParam(":apellido_casada", $apellido_casada);

    $sentencia->bindParam(":foto_perfil", $foto_perfil);
    $sentencia->bindParam(":cv_empleado", $cv_empleado);

    $sentencia->bindParam(":fecha_ingreso", $fecha_ingreso);
    $sentencia->bindParam(":telefono", $telefono);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":direccion", $direccion);
    $sentencia->bindParam(":contacto_emergencia", $contacto_emergencia);

    $sentencia->bindParam(":id_parentesco", $id_parentesco);
    $sentencia->bindParam(":id_tipo_sangre", $id_tipo_sangre);
    $sentencia->bindParam(":id_puesto_empleado", $id_puesto_empleado);
    $sentencia->bindParam(":id_estado_empleado", $id_estado_empleado);


    $sentencia->execute();
    header("Location: index.php");
  } catch (Exception $th) {
    //    echo $th->getMessage();
    $mesage_error = "Error al guardar la consulta, por favor contacte al administrador.";
    function_alert_error($mesage_error, $th->getMessage());
  }

}

//Parentescos
try {
  if (isset($conexion)) {
    $sentencia = $conexion->prepare("SELECT id_parentesco, nombre_parentesco FROM `tbl_parentescos`"); //CONSULTA SQL A LA TABLA PUESTOS
    $sentencia->execute(); //EJECUTO EL QUERY
    $lista_table_parentesco = $sentencia->fetchAll(PDO::FETCH_ASSOC); //CARGO EN UNA VARIABLE LISTA LOS DATOS
    function_alert_info($lista_table_parentesco);
  }
} catch (\Throwable $th) {
  $lista_table_parentesco = [];
  $mesage_error = "Error al ejecutar la consulta para parentescos, por favor contacte al administrador.";
  function_alert_error($mesage_error, $th->getMessage());
}

//Sangre
try {
  if (isset($conexion)) {
    $sentencia = $conexion->prepare("SELECT id_tipo_sangre, tipo_sangre FROM `tbl_tipos_sangres`"); //CONSULTA SQL A LA TABLA PUESTOS
    $sentencia->execute(); //EJECUTO EL QUERY
    $lista_table_sangre = $sentencia->fetchAll(PDO::FETCH_ASSOC); //CARGO EN UNA VARIABLE LISTA LOS DATOS
    function_alert_info($lista_table_sangre);
  }
} catch (\Throwable $th) {
  $lista_table_sangre = [];
  $mesage_error = "Error al ejecutar la consulta para tipos de sangre, por favor contacte al administrador.";
  function_alert_error($mesage_error, $th->getMessage());
}

//Estados empleados
try {
  if (isset($conexion)) {
    $sentencia = $conexion->prepare("SELECT id_estado_empleado, nombre_estado FROM `tbl_estados_empleados`"); //CONSULTA SQL A LA TABLA PUESTOS
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
    $sentencia = $conexion->prepare("SELECT id_puesto_empleado, nombre_puesto FROM `tbl_puestos_empleados`"); //CONSULTA SQL A LA TABLA PUESTOS
    $sentencia->execute(); //EJECUTO EL QUERY
    $lista_table_puesto = $sentencia->fetchAll(PDO::FETCH_ASSOC); //CARGO EN UNA VARIABLE LISTA LOS DATOS
    function_alert_info($lista_table_puesto);
  }
} catch (\Throwable $th) {
  $lista_table_puesto = [];
  $mesage_error = "Error al ejecutar la consulta para puestos de trabajo, por favor contacte al administrador.";
  function_alert_error($mesage_error, $th->getMessage());
}

?>
<br />
<div class="card">
  <div class="card-header">
    Datos del Empleado
  </div>
  <div class="card-body">
    <form action="crear.php" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="primer_nombre" class="form-label">Primer nombre</label>
          <input type="text" class="form-control" name="primer_nombre" id="primer_nombre" aria-describedby="helpId"
            placeholder="Primer nombre" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="segundo_nombre" class="form-label">Segundo nombre</label>
          <input type="text" class="form-control" name="segundo_nombre" id="segundo_nombre" aria-describedby="helpId"
            placeholder="Segundo nombre">
        </div>
        <div class="col-12 mb-3">
          <label for="tercer_nombre" class="form-label">Tercer nombre y adicionales</label>
          <input type="text" class="form-control" name="tercer_nombre" id="tercer_nombre" aria-describedby="helpId"
            placeholder="Tercer nombre">
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="apellido_paterno" class="form-label">Primer apellido</label>
          <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno"
            aria-describedby="helpId" placeholder="Primer apellido">
        </div>
        <div class="col-md-4 mb-3">
          <label for="apellido_materno" class="form-label">Segundo apellido</label>
          <input type="text" class="form-control" name="apellido_materno" id="apellido_materno"
            aria-describedby="helpId" placeholder="Segundo apellido">
        </div>
        <div class="col-md-4 mb-3">
          <label for="apellido_casada" class="form-label">Apellido de casada</label>
          <input type="text" class="form-control" name="apellido_casada" id="apellido_casada" aria-describedby="helpId"
            placeholder="Apellido de casada">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="foto_perfil" class="form-label">Foto:</label>
          <input type="file" class="form-control" name="foto_perfil" id="foto_perfil" aria-describedby="helpId"
            placeholder="foto_perfil">
        </div>
        <div class="col-md-6 mb-3">
          <label for="cv_empleado" class="form-label">CV(pdf):</label>
          <input type="file" class="form-control" name="cv_empleado" id="cv_empleado" aria-describedby="helpId"
            placeholder="cv_empleado">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="fecha_ingreso" class="form-label">Fecha de ingreso</label>
          <input type="date" class="form-control" name="fecha_ingreso" id="fecha_ingreso" aria-describedby="helpId"
            placeholder="Fecha de ingreso a la empresa" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="telefono" class="form-label">Telefono</label>
          <input type="number" class="form-control" name="telefono" id="telefono" aria-describedby="helpId"
            placeholder="Telefono" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="correo" class="form-label">Correo</label>
          <input type="email" class="form-control" name="correo" id="correo" aria-describedby="helpId"
            placeholder="Correo electronico">
        </div>
        <div class="col-md-6 mb-3">
          <label for="direccion" class="form-label">Direccion</label>
          <input type="text" class="form-control" name="direccion" id="direccion" aria-describedby="helpId"
            placeholder="Direccion domiciliar">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="contacto_emergencia" class="form-label">Contacto de emergencia</label>
          <input type="number" class="form-control" name="contacto_emergencia" id="contacto_emergencia"
            aria-describedby="helpId" placeholder="Telefono de contacto de emergencia">
        </div>
        <div class="col-md-6 mb-3">
          <label for="id_parentesco" class="form-label">Parentesco:</label>
          <select class="form-select form-select-sm" name="id_parentesco" id="id_parentesco" required>
            <!-- Ciclo for each para la tabla puestos -->
            <?php foreach ($lista_table_parentesco as $registro) { ?>
              <option value="<?= $registro['id_parentesco'] ?>"><?= $registro['nombre_parentesco'] ?>
              </option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="id_tipo_sangre" class="form-label">Tipo de sangre:</label>
          <select class="form-select form-select-sm" name="id_tipo_sangre" id="id_tipo_sangre" required>
            <!-- Ciclo for each para la tabla puestos -->
            <?php foreach ($lista_table_sangre as $registro) { ?>
              <option value="<?= $registro['id_tipo_sangre'] ?>"><?= $registro['tipo_sangre'] ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label for="id_estado_empleado" class="form-label">Estado:</label>
          <select class="form-select form-select-sm" name="id_estado_empleado" id="id_estado_empleado" required>
            <!-- Ciclo for each para la tabla puestos -->
            <?php foreach ($lista_table_estado as $registro) { ?>
              <option value="<?= $registro['id_estado_empleado'] ?>"><?= $registro['nombre_estado'] ?>
              </option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="id_puesto_empleado" class="form-label">Puesto:</label>
          <select class="form-select form-select-sm" name="id_puesto_empleado" id="id_puesto_empleado" required>
            <!-- Ciclo for each para la tabla puestos -->
            <?php foreach ($lista_table_puesto as $registro) { ?>
              <option value="<?= $registro['id_puesto_empleado'] ?>"><?= $registro['nombre_puesto'] ?>
              </option>
            <?php } ?>
          </select>
        </div>
      </div>

      <button type="submit" class="btn btn-success">Agregar registro</button>
      <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
  </div>
</div>

<?php include "./../../template/footer.php"; ?>