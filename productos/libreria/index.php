<?php 
require_once("../../bd.php");
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET ['txtID'])) ? $_GET ['txtID']:"";
    $sentencia = $conexion->prepare("SELECT foto FROM `libreria` WHERE `id`=:id");
    $sentencia->bindValue(":id", $txtID);
    $sentencia->execute();
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);
    if (isset($registro_recuperado["foto"]) && $registro_recuperado["foto"] !="" ) {
        if(file_exists("../../imgLibreria/" . $registro_recuperado["foto"])) {
            unlink("../../imgLibreria/" . $registro_recuperado["foto"]);
        }
    }
    $sentencia = $conexion->prepare("DELETE FROM `libreria` WHERE id = :id");
    $sentencia->bindValue(":id",$txtID);
    $sentencia->execute();
    
    header("Location:index.php?mensaje=Registro eliminado");
}

$sentencia = $conexion->prepare("SELECT * FROM `libreria`");
$sentencia->execute();
$libreria = $sentencia->fetchAll(PDO::FETCH_ASSOC);
require_once("../../templates/header.php");
if(isset($_GET['mensaje'])) { ?>

    <script>
        Swal.fire({
            icon: "success",
            title: "<?php echo $_GET['mensaje']; ?>"
        });
    </script>

<?php } ?>
<div class="card">
    <div class="card-header">
       <h1>Lista de articulos de libreria</h1>
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar producto</a>
    
    
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Precio $</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($libreria as $registro) { ?>
                    <tr class="">
                        <td scope="row"><?php echo $registro ['id']; ?></td>
                        <td><?php echo $registro ['producto']; ?></td>
                        <td><img width="50" src="<?php echo $registro ['foto']; ?>"
                            class="img-fluid rounded" alt="" />
                        <td><?php echo $registro ['stock']; ?></td>
                        <td><?php echo $registro ['precio']; ?></td>
                        <td><?php echo $registro ['fecha de ingreso']; ?></td>
                        <td>
                        <a name="btneditar" id="btneditar" class="btn btn-primary" 
                        href="editar.php?txtID=<?php echo $registro ['id']; ?>" role="button">Editar</a>
                        <a name="" id="" class="btn btn-danger" 
                        href="javascript:borrar(<?php echo $registro['id']; ?>);" role="button">Borrar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function borrar(id){
        Swal.fire({
  title: 'Esta seguro que desea eliminar?',
  text: "No se puede revertir",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, borrarlo'
}).then((result) => {
  if (result.isConfirmed) {
    window.location="index.php?txtID="+id;
  }
})
</script>

<?php require_once("../../templates/footer.php"); ?>