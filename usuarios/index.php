<?php 
require_once("../bd.php");
if(isset($_GET["txtID"])) { 
    $txtID = (isset($_GET["txtID"]) ? $_GET["txtID"] : "");
    $sentencia = $conexion->prepare("DELETE FROM `usuarios` WHERE `id`=:id");
    $sentencia->bindValue(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php?mensaje=Registro eliminado");
}
    $sentencia = $conexion->prepare("SELECT * FROM `usuarios`");
    $sentencia->execute();
    $usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    

require_once("../templates/header.php"); 
if (isset($_GET["mensaje"])) { ?>
    <script>
    Swal.fire({
    icon: "success",
    title: "<?php echo $_GET['mensaje']; ?>"
});
</script>
<?php } ?>
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
                <?php echo str_repeat('*', strlen($registro['password'])); ?>
                </td>
                <td>
                    <?php echo $registro ['correo']; ?>
                </td>
                <td>
                <a name="" id="" class="btn btn-primary"
                 href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                 <a name="" id="" class="btn btn-danger" 
                        href="javascript:borrar(<?php echo $registro['id']; ?>)" role="button">Eliminar</a>
                
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
function borrar(id) {
    Swal.fire({
        title: 'Desea borrar el empleado?',
        text: "No vas a poder recuperarlo si lo borras!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrarlo!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "index.php?txtID=" + id;
        }
    })
}
</script>


<?php require_once('../templates/footer.php') ?>