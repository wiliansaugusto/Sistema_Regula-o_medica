<?php
session_start();
if($_SESSION[id]!=2){                
               $_SESSION[loginErro] = "Você não tem premissão para acessar! <br> Refaça o seu login";
               header("Location: index.php");
             }


include("conexao.php"); // caminho do seu arquivo de conexão ao banco de dados
$mysqli = new mysqli("localhost:8889","root","root" ,"id7124820_samu"); 
$consulta= "SELECT id_ocorrencia,tp_solicitante, nm_solicitante, nr_telefone, vl_idade,queixa, tp_ocorrencia frOM tb_ocorrencia WHERE triagem = 0";
$con= $mysqli->query($consulta) or die($mysqli->error);
$i =0;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <META HTTP-EQUIV=Refresh CONTENT=5;>
  <title>SAMU 192 - Salvando Vidas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
  <script type="text/javascript">
  setInterval(teste,3000);
  function teste(){
    
  }
function openForm(popup,myPopup,features) {
window.open(popup,myPopup,features);
}
</script>
</head>
<body>
<?php require_once "navbar.php"; ?>

                        <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                    <hr>              
                <h1>Regulação Médica - Chamados a regular</h1>
                                        <hr>
<div class="container interno">
  <table class="table table-striped" >
   <thead > 
    <tr class="table-warning">
      <th scope="col">Nr de Ordem</td>
      <th scoper="col">Ocorrência</th>
      <th scoper="col">Telefone</th>
      <th scoper="col">Nome do Solicitante</th>
      <th scoper="col">Tipo do Solicitante</th>
      <th scoper="col">Queixa</th>
      <th scoper="col">Idade</th>
      <th scoper="col">Realizar triagem</th>
    </tr>
    </thead>
    <?php while($dado= $con->fetch_array()) { ?>
   <tbody>
    <tr scope="row">
    <form method="POST" action="popup.php" name="<?$i?>" target="popup" onSubmit="openForm('about:blank','popup')">
      <td><input type="hidden"name="id_ocorrencia" value="<?php echo $dado['id_ocorrencia']; ?>"><?php echo $dado['id_ocorrencia']; ?></td>
      <td><input type="hidden" name="tpOcorrencia" value="<?php echo $dado['tp_ocorrencia']; ?>"><?php echo $dado['tp_ocorrencia']; ?></td>
      <td><input type="hidden" name="nr_telefone" value="<?php echo $dado['nr_telefone']; ?>"><?php echo $dado['nr_telefone']; ?></td>
      <td><input type="hidden" name="nm_solicitante" value="<?php echo $dado['nm_solicitante']; ?>"><?php echo $dado['nm_solicitante']; ?></td>
      <td><input type="hidden" name="tp_solicitante" value="<?php echo $dado['tp_solicitante']; ?>"><?php echo $dado['tp_solicitante']; ?></td>
      <td><input type="hidden" name="queixa" value="<?php echo $dado['queixa']; ?>"><?php echo $dado['queixa']; ?></td>
      <td><input type="hidden" name="vl_idade" value="<?php echo $dado['vl_idade']; ?>"><?php echo $dado['vl_idade']; ?></td>
      <td><input class="btn-primary" type="submit" value="Enviar"></td>
    </tr>
    </tbody>
    </form>
    <?php 
    $i++;
    } ?>
  </table>
  </div>
  </div>
         </div>
    </div>
</div>
<br>
<br>
<!-- INÍCIO DO RODAPÉ -->
<?php require_once "footer.php"; ?>
<!-- FIM DO RODAPÉ -->
</body>
</html>
