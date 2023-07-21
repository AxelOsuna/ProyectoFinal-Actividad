<?php 
require_once("../bd.php");
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID']: "";
    $sentencia = $conexion->prepare("DELETE FROM `empleados` WHERE `id` =:id");
    $sentencia->bindValue("id", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}



$sentencia = $conexion->prepare("SELECT * FROM `empleados`");
$sentencia->execute();
$empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

require_once("../templates/header.php"); 
?>

Lista de empleados
<div class="card">
    <div class="card-header">
       <h1>Empleados</h1>
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar empleado</a>
    
    
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Cv</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($empleados as $registro) { ?>
                    <tr class="">
                        <td scope="row"><?php echo $registro ['id']; ?></td>
                        <td><?php echo $registro ['nombre']; ?></td>
                        <td><?php echo $registro ['apellido']; ?></td>
                        <td><img width="50" src="<?php echo $registro ['foto']; ?>"
                            class="img-fluid rounded" alt="" />
                        </td>
                        <td>
                            <a href="<?php echo $registro ['cv']; ?>"> Cv </a>
                        </td>

                        <td><?php echo $registro ['fecha de ingreso']; ?></td>
                        <td>
                            <a name="btneditar" id="btneditar" class="btn btn-primary" href="editar.php?txtID=<?php echo $registro ['id']; ?>" role="button">Editar</a>
                            <a name="btnborrar" id="btnborrar" class="btn btn-danger" href="index.php?txtID=<?php echo $registro ['id']; ?>" role="button">Borrar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
            

    </div>
</div>

<?php require_once("../templates/footer.php"); ?>




