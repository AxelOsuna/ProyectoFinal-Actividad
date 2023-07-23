<?php 
require_once("../bd.php");
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET ['txtID'])) ? $_GET ['txtID']:"";

    $sentencia = $conexion->prepare("SELECT * FROM `empleados` WHERE id = :id");
    $sentencia->bindValue(":id",$txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    
    $nombre=$registro['nombre'];
    $apellido=$registro['apellido'];
    $foto=$registro['foto'];
    $cv=$registro['cv'];
    $fechadeingreso=$registro['fecha de ingreso'];
}
if ($_POST) {
    $txtID = (isset($_POST["txtID"]) ? $_POST["txtID"] : "");
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $apellido = (isset($_POST["apellido"]) ? $_POST["apellido"] : "");
    $foto = (isset($_FILES["foto"]['name']) ? $_FILES["foto"]['name'] : "");
    $cv = (isset($_FILES["cv"]['name']) ? $_FILES["cv"]['name'] : "");
    $fechadeingreso = (isset($_POST["fechadeingreso"]) ? $_POST["fechadeingreso"] : "");

    $fecha_ = new DateTime();
    $nombreArchivo_foto = ($foto !='') ? $fecha_->getTimestamp() . "_" . $_FILES["foto"]['name'] : "";
    $nombreArchivo_foto_con_ruta = "../imgEmpleados/" . $nombreArchivo_foto;
    $tmp_foto = $_FILES["foto"]['tmp_name']; 
    if ($tmp_foto !=''){
    move_uploaded_file($tmp_foto, $nombreArchivo_foto_con_ruta);
    }
    
    
    $nombreArchivo_cv = ($cv !='') ? $fecha_->getTimestamp() . "_" . $_FILES["cv"]['name'] : "";
    $nombreArchivo_cv_con_ruta = "../cv/" . $nombreArchivo_cv;
    $tmp_cv = $_FILES["cv"]['tmp_name']; 
    if ($tmp_cv !=''){
    move_uploaded_file($tmp_cv, $nombreArchivo_cv_con_ruta);
    }

    $sentencia->execute();


    $sentencia = $conexion->prepare("UPDATE `empleados` 
    SET `nombre`=:nombre, `apellido`=:apellido, `fecha de ingreso`=:fechadeingreso WHERE id=:id");

    $sentencia->bindValue(":id", $txtID);
    $sentencia->bindValue(":nombre", $nombre);
    $sentencia->bindValue(":apellido", $apellido);
    $sentencia->bindValue(":fechadeingreso", $fechadeingreso);
    $sentencia->execute();

    $fecha_ = new DateTime();
    $nombreArchivo_foto = ($foto !='') ? $fecha_->getTimestamp() . "_" . $_FILES["foto"]['name'] : "";
    $nombreArchivo_foto_con_ruta = "../imgEmpleados/" . $nombreArchivo_foto;
    $tmp_foto = $_FILES["foto"]['tmp_name']; 
    if ($tmp_foto !=''){
    move_uploaded_file($tmp_foto, $nombreArchivo_foto_con_ruta);
    $sentencia = $conexion->prepare("UPDATE `empleados` 
    SET `foto`=:foto 
    WHERE id=:id");
    $sentencia->bindValue(":foto", $nombreArchivo_foto_con_ruta);
    $sentencia->bindValue(":id", $txtID);
    $sentencia->execute();
    }
    
    
    $nombreArchivo_cv = ($cv !='') ? $fecha_->getTimestamp() . "_" . $_FILES["cv"]['name'] : "";
    $nombreArchivo_cv_con_ruta = "../cv/" . $nombreArchivo_cv;
    $tmp_cv = $_FILES["cv"]['tmp_name']; 
    if ($tmp_cv !=''){
    move_uploaded_file($tmp_cv, $nombreArchivo_cv_con_ruta);
    
    $sentencia = $conexion->prepare("UPDATE `empleados` 
    SET `cv`=:cv  
    WHERE id=:id");
    
    $sentencia->bindValue(":cv", $nombreArchivo_cv_con_ruta);
    $sentencia->bindValue(":id", $txtID);
    $sentencia->execute();

    } 
     header("Location:index.php?mensaje=Empleado editado correctamente");   
}

require_once("../templates/header.php"); 
?>
    <div class="card">
    <div class="card-header">
        <h1>Datos del empleado</h1>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">

        <label for="txtID" class="form-label">ID</label>
          <input type="text"
          value="<?php echo $txtID;?>" 
          class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="" readonly>


          <label for="nombre" class="form-label">Nombre</label>
          <input type="text"
          value="<?php echo $nombre;?>"  
          class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="">

          
          <label for="apellido" class="form-label">Apellido</label>
          <input type="text" 
          value="<?php echo $apellido;?>" 
          class="form-control" name="apellido" id="apellido" aria-describedby="helpId" placeholder="">


          <label for="foto" class="form-label">Foto</label>
          <input type="file" 
          value="<?php echo $foto;?>" 
          class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="">

          <label for="cv" class="form-label">CV</label>
          <input type="file" 
          value="<?php echo $cv;?>" 
          class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="">
         
          
          <label for="fechadeingreso" class="form-label">Fecha de ingreso</label>
          <input type="date" 
          value="<?php echo $fechadeingreso;?>" 
          class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="helpId" placeholder="">
          
        </div>
        <button type="submit" name="" id="" class="btn btn-primary" href="#" role="button">Agregar Registro</button>
        <a name="" id="" class="btn btn-danger" href="./index.php" role="button">Cancelar</a>   
    </form>
<?php require_once("../templates/footer.php"); ?>