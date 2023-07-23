<?php 
require_once("../../bd.php");
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET ['txtID'])) ? $_GET ['txtID']:"";

    $sentencia = $conexion->prepare("SELECT * FROM `libreria` WHERE id = :id");
    $sentencia->bindValue(":id",$txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    
    $producto=$registro['producto'];
    $foto=$registro['foto'];
    $precio=$registro['precio'];
    $stock=$registro['stock'];
    $fechadeingreso=$registro['fecha de ingreso'];
}
if ($_POST) {
    $txtID = (isset($_POST["txtID"]) ? $_POST["txtID"] : "");
    $producto = (isset($_POST["producto"]) ? $_POST["producto"] : "");
    $precio = (isset($_POST["precio"]) ? $_POST["precio"] : "");
    $stock = (isset($_POST["stock"]) ? $_POST["stock"] : "");
    $foto = (isset($_FILES["foto"]['name']) ? $_FILES["foto"]['name'] : "");
    $fechadeingreso = (isset($_POST["fechadeingreso"]) ? $_POST["fechadeingreso"] : "");

    $fecha_ = new DateTime();
    $nombreArchivo_foto = ($foto !='') ? $fecha_->getTimestamp() . "_" . $_FILES["foto"]['name'] : "";
    $nombreArchivo_foto_con_ruta = "../../imgLibreria/" . $nombreArchivo_foto;
    $tmp_foto = $_FILES["foto"]['tmp_name']; 
    if ($tmp_foto !=''){
    move_uploaded_file($tmp_foto, $nombreArchivo_foto_con_ruta);
    }   
    $sentencia = $conexion->prepare("UPDATE `libreria` 
    SET `producto`=:producto, `precio`=:precio, `stock`=:stock, `fecha de ingreso`=:fechadeingreso WHERE id=:id");

    $sentencia->bindValue(":id", $txtID);
    $sentencia->bindValue(":producto", $producto);
    $sentencia->bindValue(":precio", $precio);
    $sentencia->bindValue(":stock", $stock);
    $sentencia->bindValue(":fechadeingreso", $fechadeingreso);
    $sentencia->execute();

    $fecha_ = new DateTime();
    $nombreArchivo_foto = ($foto !='') ? $fecha_->getTimestamp() . "_" . $_FILES["foto"]['name'] : "";
    $nombreArchivo_foto_con_ruta = "../../imgLibreria/" . $nombreArchivo_foto;
    $tmp_foto = $_FILES["foto"]['tmp_name']; 
    if ($tmp_foto !=''){
    move_uploaded_file($tmp_foto, $nombreArchivo_foto_con_ruta);
    

    $sentencia = $conexion->prepare("UPDATE `libreria` 
    SET `foto`=:foto 
    WHERE id=:id");
    $sentencia->bindValue(":foto", $nombreArchivo_foto_con_ruta);
    $sentencia->bindValue(":id", $txtID);
    $sentencia->execute();
    }
    header("Location:index.php?mensaje=Producto editado correctamente"); 
} 

require_once("../../templates/header.php"); 
?>
    <div class="card">
    <div class="card-header">
        <h1>Datos del producto</h1>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">

        <label for="txtID" class="form-label">ID</label>
          <input type="text"
          value="<?php echo $txtID;?>" 
          class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="" readonly>


          <label for="producto" class="form-label">Producto</label>
          <input type="text"
          value="<?php echo $producto;?>"  
          class="form-control" name="producto" id="producto" aria-describedby="helpId" placeholder="">

          <label for="foto" class="form-label">Foto</label>
          <input type="file" 
          value="<?php echo $foto;?>" 
          class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="">

          <label for="stock" class="form-label">Stock</label>
          <input type="text" 
          value="<?php echo $stock;?>" 
          class="form-control" name="stock" id="stock" aria-describedby="helpId" placeholder="">
         
          <label for="precio" class="form-label">Precio $</label>
          <input type="text" 
          value="<?php echo $precio;?>" 
          class="form-control" name="precio" id="precio" aria-describedby="helpId" placeholder="">

          
          <label for="fechadeingreso" class="form-label">Fecha de ingreso</label>
          <input type="date" 
          value="<?php echo $fechadeingreso;?>" 
          class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="helpId" placeholder="">
          
        </div>
        <button type="submit" name="" id="" class="btn btn-primary" href="#" role="button">Agregar Registro</button>
        <a name="" id="" class="btn btn-danger" href="./index.php" role="button">Cancelar</a>   
    </form>
<?php require_once("../../templates/footer.php"); ?>