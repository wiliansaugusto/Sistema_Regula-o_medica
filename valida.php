<?php
session_start();
include_once("conexao.php");


    $usuario = mysqli_real_escape_string($conn, $_POST['login']); //prevenir sql injection
    $senha=mysqli_real_escape_string($conn, $_POST['senha']);    
    

    $sql="SELECT nm_usuario,ds_senha,tp_profissional from tb_profissional where nm_usuario = '$usuario' && ds_senha = $senha";
    $result = mysqli_query($conn,$sql);
    $resultado = mysqli_fetch_assoc($result);    
    $_SESSION['usuario'] = $resultado['nm_usuario'];
    $_SESSION['id'] = $resultado['tp_profissional'];
    

    if(!$resultado){
        $_SESSION['loginErro'] = "Usuário ou Senha Inválido";
         header("Location: index.php");
        
    }elseif($resultado['tp_profissional']==2){
        header("Location: medico.php");
    
 }elseif ($resultado['tp_profissional']==6) {
    header("Location: administracao.php");
 }


?>
<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SAMU 192 - Salvando Vidas</title>
    

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/samu.css" rel="stylesheet">

  </head>

  <body>
 
     <div class="masthead">
        <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source src="assets/mp4/bg.mp4" type="video/mp4">
    </video>

    <div class="imgpos">
     <div class="container ">
        <div class="row h-100">
          <div class="col-12 my-auto">
            <div class=" text-white py-5 py-md-0">
                <div class="container">
                <div class="col-12 my-auto">
        <h2>Olá <?php echo($_SESSION["usuario"])?> , sejá bem Vindo </h2>
        <h2>Clique nos botões abaixo para redirecionar a pagina que deseja </h2><br>

<button onclick="javascript: location.href='atendente1.php';" value="TARM">TARM</button><br><br>
<button onclick="javascript: location.href='radiooperador.php';" value="Radio Operador">RADIO Operação</button>
                     </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    <div>     
    <!-- Bootstrap core JavaScript -->
    <script src="jquery/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/samu.min.js"></script>
   
    

  </body>

</html>
