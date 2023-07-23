<?php
session_start();
if($_POST){
    require_once("./bd.php");
    $sentencia = $conexion->prepare("SELECT * 
    FROM `usuarios`
    WHERE usuario=:usuario
    AND password=:password");

    $sentencia->bindValue(":usuario", $_POST['usuario']);
    $sentencia->bindValue(":password", $_POST['password']);
    $sentencia->execute();
    $usuario=$sentencia->fetch(PDO::FETCH_LAZY);
    
    if($usuario) {
        $_SESSION['usuario']=$usuario['usuario'];
        $_SESSION['logueado']=true;
        header("Location:index.php");
    } else {
        $mensaje= "Error: usuario o contraseña incorrectos";
    }
}


?>
<br>
<main class="container">
    <div class="row">
        <div class="cool-m-4">
            <div class="card">
                <div class="card-header">
                    Ingresar
                </div>
                <div class="card-body">
                    <?php if(isset($mensaje)) { ?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      <strong>
                        <?php echo $mensaje ?>
                      </strong> 
                    </div>
                    <?php } ?>
                    <script>
                      var alertList = document.querySelectorAll('.alert');
                      alertList.forEach(function (alert) {
                        new bootstrap.Alert(alert)
                      })
                    </script>
                    
                    <form action="" method="post">
                        <div class="mb-3">
                          <label for="usuario" class="form-label">Usuario:</label>
                          <input type="text" class="form-control" name="usuario" id="usuario" 
                          aria-describedby="helpId" placeholder="Ingrese admin">
                      
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Contraseña:</label>
                          <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese admin">
                        </div>
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </form>
                    </div>
        </div>
    </div>
<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" 
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<?php require_once("./templates/footer.php")?>