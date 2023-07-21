<?php
require_once("../bd.php");
if($_POST) {
    $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
    $password = (isset($_POST["password"]) ? $_POST["password"] : "");
    $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");
    //prepararla insercion de los datos
    $sentencia = $conexion->prepare ("INSERT INTO `usuarios`(`id`, `usuario`, `password`, `correo`) 
                                      VALUES (NULL, :usuario, :password, :correo);");
    
    //Asignamos los valores que vienen del metodo post
    $sentencia->bindValue(":usuario", $usuario);
    $sentencia->bindValue(":password",$password);
    $sentencia->bindValue(":correo", $correo);
    $sentencia->execute();
    header("Location:index.php");
    //si algo no funciona, utilizar la supervaribale print_r($__POST)

}


require_once("../templates/header.php"); 
?>
<div class="card">
    <div class="card-header">
      Usuarios
    </div>
    <div class="card-body">
        <form action="" method="post">
        <div class="mb-3">
          <label for="usuario" class="form-label">Nombre del usuario</label>
          <input type="text"
            class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="">
            <div class="mb-3">
              <label for=password class="form-label">Password</label>
              <input type="password" class="form-control" name=password id=password placeholder="">

              <div class="mb-3">
                <label for=correo class="form-label">Correo</label>
                <input type="correo" class="form-control" name=correo id=correo aria-describedby="emailHelpId" placeholder="abc@mail.com">
                
              </div>
            </div>


        </div>
        <button type="submit" name="" id="" class="btn btn-primary" href="#" role="button">Agregar Registro</button>
        <a name="" id="" class="btn btn-danger" href="./index.php" role="button">Cancelar</a>   

        </form>
       
    
</div>
<?php include_once('../templates/footer.php') ?> 