<?php 
require_once("../../bd.php");
if ($_POST) {
    
    $producto = (isset($_POST["producto"]) ? $_POST["producto"] : "");
    $precio = (isset($_POST["precio"]) ? $_POST["precio"] : "");
    $stock = (isset($_POST["stock"]) ? $_POST["stock"] : "");
    $foto = (isset($_FILES["foto"]['name']) ? $_FILES["foto"]['name'] : "");
    $fechadeingreso = (isset($_POST["fechadeingreso"]) ? $_POST["fechadeingreso"] : "");

    $sentencia = $conexion->prepare("INSERT INTO `cotillon`(`id`, `producto`, `precio`, `stock`, `foto`, `fecha de ingreso`) 
    VALUES (NULL, :producto, :precio, :stock, :foto, :fechadeingreso)");

    $sentencia->bindValue(":producto", $producto);
    $sentencia->bindValue(":precio", $precio);
    $sentencia->bindValue(":stock", $stock);
    $sentencia->bindValue(":fechadeingreso", $fechadeingreso);
    $fecha_ = new DateTime();
    $nombreArchivo_foto = ($foto !='') ? $fecha_->getTimestamp() . "_" . $_FILES["foto"]['name'] : "";
    $nombreArchivo_foto_con_ruta = "../../imgCotillon/" . $nombreArchivo_foto;
    $tmp_foto = $_FILES["foto"]['tmp_name']; 
    if ($tmp_foto !=''){
      move_uploaded_file($tmp_foto, $nombreArchivo_foto_con_ruta);
    }   
    $sentencia->bindValue(":foto", $nombreArchivo_foto_con_ruta);
    $sentencia->execute();
    header("Location:index.php?mensaje=Producto creado correctamente");
}
require_once("../../templates/header.php"); 
?>

<div class="card">
    <div class="card-header">
        Datos del producto
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">

          <label for="producto" class="form-label">Producto</label>
          <input type="text" class="form-control" name="producto" id="producto" aria-describedby="helpId" placeholder="">

          <label for="foto" class="form-label">Foto</label>
          <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="">

          <label for="stock" class="form-label">Stock</label>
          <input type="text" class="form-control" name="stock" id="stock" aria-describedby="helpId" placeholder="">
         
          <label for="precio" class="form-label">Precio $</label>
          <input type="text" class="form-control" name="precio" id="precio" aria-describedby="helpId" placeholder="">

          
          <label for="fechadeingreso" class="form-label">Fecha de ingreso</label>
          <input type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="helpId" placeholder="">
          
        </div>
        <button type="submit" name="" id="" class="btn btn-primary" href="#" role="button">Agregar Registro</button>
        <a name="" id="" class="btn btn-danger" href="./index.php" role="button">Cancelar</a>   
    </form>
    
</div>
<?php require_once("../../templates/footer.php"); ?>