<?php 
require_once("../bd.php");
if($_POST) {

    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $apellido = (isset($_POST["apellido"]) ? $_POST["apellido"] : "");
    $foto = (isset($_FILES["foto"]['name']) ? $_FILES["foto"]['name'] : "");
    $cv = (isset($_FILES["cv"]['name']) ? $_FILES["cv"]['name'] : "");
    $fechadeingreso = (isset($_POST["fechadeingreso"]) ? $_POST["fechadeingreso"] : "");

    $sentencia = $conexion->prepare("INSERT INTO `empleados`(`id`, `nombre`, `apellido`, `foto`, `cv`, `fecha de ingreso`) 
    VALUES (NULL, :nombre, :apellido, :foto, :cv, :fechadeingreso);");

    $sentencia->bindValue(":nombre", $nombre);
    $sentencia->bindValue(":apellido", $apellido);
    $sentencia->bindValue(":fechadeingreso", $fechadeingreso);
    
    $fecha_ = new DateTime();
    $nombreArchivo_foto = ($foto !='') ? $fecha_->getTimestamp() . "_" . $_FILES["foto"]['name'] : "";
    $nombreArchivo_foto_con_ruta = "../imgEmpleados/" . $nombreArchivo_foto;
    $tmp_foto = $_FILES["foto"]['tmp_name']; 
    if ($tmp_foto !=''){
    move_uploaded_file($tmp_foto, $nombreArchivo_foto_con_ruta);
    }
    $sentencia->bindValue(":foto", $nombreArchivo_foto_con_ruta);
    


  
    $nombreArchivo_cv = ($cv !='') ? $fecha_->getTimestamp() . "_" . $_FILES["cv"]['name'] : "";
    $nombreArchivo_cv_con_ruta = "../cv/" . $nombreArchivo_cv;
    $tmp_cv = $_FILES["cv"]['tmp_name']; 
    if ($tmp_cv !=''){
    move_uploaded_file($tmp_cv, $nombreArchivo_cv_con_ruta);
    }
    $sentencia->bindValue(":cv", $nombreArchivo_cv_con_ruta);
    $sentencia->execute();
  }


require_once("../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        Datos del empleado
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">

          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="">

          <label for="apellido" class="form-label">Apellido</label>
          <input type="text" class="form-control" name="apellido" id="apellido" aria-describedby="helpId" placeholder="">

          <label for="foto" class="form-label">Foto</label>
          <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="">

          <label for="cv" class="form-label">CV</label>
          <input type="file" class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="">

          
          <label for="fechadeingreso" class="form-label">Fecha de ingreso</label>
          <input type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="helpId" placeholder="">
          
        </div>
        <button type="submit" name="" id="" class="btn btn-primary" href="#" role="button">Agregar Registro</button>
        <a name="" id="" class="btn btn-danger" href="./index.php" role="button">Cancelar</a>   
    </form>
    
</div>




<?php require_once("../templates/footer.php");?>