<?php
session_start();
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

  <meta name="RATING" content="RTA-5042-1996-1400-1577-RTA" /></head>

  <body>
 
     <div class="masthead">
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
      <source src="assets/mp4/bg.mp4" type="video/mp4">
    </video>

    <div class="imgpos">
    <form class="form-signin" method="POST" action="valida.php">
     <div class="container h-100">
        <div class="row h-100">
          <div class="col-12 my-auto">
            <div class=" text-white py-5 py-md-0">
            <h3 class="mb-3 form-signin-heading">Sistema de Regulação Médica</h3>
            <p>Por gentileza faça o seu login</p>
            <p class="text-center fonte_erro text-danger">
					    </p>
            <label for="inputText" class="">Nome de Usuario:</label>
            <input type="text" name="login" id="inputText" class="form-control" placeholder="insira o seu nome de Usuario" required autofocus>
            <label for="inputPassword" class="">Senha:</label>
            <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="insira a sua senha" required>
              </form><br>
              <button class="btn btn-lg btn-danger btn-block round" type="submit">Acessar</button>
        <a href="trocarSenha.php"style="color:white;">Trocar Senha</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
         
    <!-- Bootstrap core JavaScript -->
    <script src="jquery/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/samu.min.js"></script>
   
</body>
</html>