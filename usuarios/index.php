<?php 
require_once("../bd.php");
if(isset($_GET["txtID"])) { //logica para eliminar un user
    //recolectar datos del metodo GET
    $txtID = (isset($_GET["txtID"]) ? $_GET["txtID"] : "");
    //preparar la eliminacion de los datos
    $sentencia = $conexion->prepare("DELETE FROM `usuarios` WHERE `id`=:id");
    //Asignamos los valores que vienen del metodo GET a la consulta
    $sentencia->bindValue(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}
    $sentencia = $conexion->prepare("SELECT * FROM `usuarios`");
    $sentencia->execute();
    $usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<?php require_once("../templates/header.php") ?>
<h1>Usuarios</h1>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="./crear.php" role="button">Agregar registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre del usuario</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Correo</th>
                <th scope="col">Acciones</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $registro) { ?>
            <tr class="">
                <td scope="row">
                    <?php echo $registro ['id']; ?>
                </td>
                <td>
                    <?php echo $registro ['usuario']; ?>
                </td>
                <td>
                    <?php echo $registro ['password']; ?>
                </td>
                <td>
                    <?php echo $registro ['correo']; ?>
                </td>
                <td>
                <a name="" id="" class="btn btn-success"
                 href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                    <a name="" id="" class="btn btn-danger" 
                    href="index.php?txtID=<?php echo $registro['id']; ?> " role="button">Eliminar</a>
                
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


</div>



<?php require_once('../templates/footer.php') ?>