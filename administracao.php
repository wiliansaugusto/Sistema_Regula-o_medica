<?php
session_start();

if($_SESSION[id]!=6){                
    $_SESSION[loginErro] = "Você não tem premissão para acessar! <br> Refaça o seu login";
    header("Location: index.php");
  }

 
  ?>
<!DOCTYPE html>
<head> 
<title>Serviços Administrativos</title> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<link rel="stylesheet" href="../css/estilo.css">
<!-- BOOTSTRAP -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="../jquery/jquery.min.js"></script>
<script>
function openForm(popup,myPopup,features) {
window.open(popup,myPopup,features);
}
</script>
</head> 
<body>
<nav class="navbar navbar-inverse " style="color: white;">
                <div class="container">
                    <h1 class="nav navbar-nav navbar-left"> 
                    <?php
                        echo("Olá: ".$_SESSION['usuario']);
                        ?></h1>
                       <h1 class="nav navbar-nav navbar-right"> SAMU 192</h1>
                    </div>
                </nav>
                        <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                    <hr>                 
                <h1>Serviços Administrativo</h1>

<div class="container jumbotron">
<form method="POST" action="montarPlantao.php" onSubmit="openForm('about:blank','popup',  top=70')" target="popup" >
<button class="btn btn-primary btn-lg btn-block" name="alt_plantao">Plantão</button>
</form>
</div>

    <div class="container jumbotron">
    <form method="POST" action="cadastro.php" onSubmit="openForm('about:blank','popup',  top=70')" target="popup" >
    <button class="btn btn-primary btn-lg btn-block" name="cadastroProfissionais">Profissionais</button>
    </form>
    </div>
 
 <div class="container jumbotron">
 <form method="POST" action="cadastroViaturas.php" onSubmit="openForm('about:blank','popup',  top=70')" target="popup" >
 <button class="btn btn-primary btn-lg btn-block" name="btn_vtr">Viaturas</button>
 </form>
 </div>
 
 <div class="container jumbotron">
 <form method="POST" action="pesquisaocorrencia.php" onSubmit="openForm('about:blank','popup',  top=70')" target="popup" >
 <button class="btn btn-primary btn-lg btn-block" name="btn_pesquisar">Pesquisar Ocorrências</button>
 </form>
 </div>
 
  </div>     
      
            </div>

         </div>
    </div>
</div>

<!-- INÍCIO DO RODAPÉ -->
<?php require_once "footer.php"; ?>

<!-- FIM DO RODAPÉ -->
</body>
</html>
