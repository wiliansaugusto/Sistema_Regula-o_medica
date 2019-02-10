<?php
session_start();
if($_SESSION['id']!=2){                
               $_SESSION['loginErro'] = "Você não tem premissão para acessar! <br> Refaça o seu login";
               header("Location: index.php");
             }

include("conexao.php"); // caminho do seu arquivo de conexão ao banco de dados

$enviar;
$id_ocorrencia= $_POST['id_ocorrencia'];
$tp_ocorrencia=$_POST['tpOcorrencia'];
$nr_telefone =$_POST['nr_telefone'];
$nm_solicitante= $_POST['nm_solicitante'];
$tp_solicitante= $_POST['tp_solicitante'];
$queixa= $_POST['queixa'];
$vl_idade= $_POST['vl_idade'];
$med_uso=$_POST['med_uso'];
$prioridade= $_POST['prioridade'];
$diagnostico = $_POST['diagnostico'];
$enviarSAV=$_POST['enviarSAV'];
$enviarSBV=$_POST['enviarSBV'];
$naoEnviar=$_POST['naoEnviar'];
$formPopup=$_POST['formPopup'];
$nmMedico =$_SESSION['usuario'];
$mysqli = new mysqli("localhost:8889","root","root" ,"id7124820_samu"); 


if(isset ($enviarSAV)){
    $enviar=$enviarSAV;
} elseif(isset($enviarSBV)){
    $enviar=$enviarSBV;
}

if(isset($diagnostico)){
    $diagnostico=$queixa;
    echo $diagnostico;

}else{
    $diagnostico;
    echo $diagnostico;

}

if(($enviar) && ($prioridade!="Prioridade")){


  $sql="UPDATE tb_ocorrencia SET nm_medico_reg ='$nmMedico', triagem = 1,
  tp_vtr_solicitado = '$enviar',time_triagem_medica=CURRENT_TIME ,prioridade='$prioridade',
   diagnostico='$diagnostico',med_uso='$med_uso' where id_ocorrencia= $id_ocorrencia ";
  $con= $mysqli->query($sql) or die($mysqli->error);
  echo "<script>alert('Chamado triado com sucesso');</script>";
 // echo("<script>window.location.href='index.php'</script>");
  echo "<script>window.close();</script>";

  
            
             } elseif ($naoEnviar){
               $prioridade ="orientacao";
               $sql="UPDATE tb_ocorrencia SET nm_medico_reg ='$nmMedico', triagem = 3,
               prioridade='$prioridade', diagnostico='$diagnostico',med_uso='$med_uso' where id_ocorrencia= $id_ocorrencia ";
               $con= $mysqli->query($sql) or die($mysqli->error);
               echo "<script>alert('Chamado triado com sucesso');</script>";
              // echo("<script>window.location.href='index.php'</script>");
               echo "<script>window.close();</script>";

             
      
     }

if(($enviar) && ($prioridade == "Prioridade")){
  
    echo "<script>alert('Por Favor Preencher a prioridade')</script>";
  
}

?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SAMU 192 - Salvando Vidas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script>
    function validar(){
    location.href("popup.php")
    }
    </script>

</head>
<body>
<?php require_once "navbar.php"; ?>

<table class="table">
<form method="POST" name="formPopup" onSubmit="validar()" >
    <thead>
    <tr>
      <th scope="col">Nr de Orderm</th>
      <th scope="col">Ocorrência</th>
      <th scope="col">Telefone</th>
      <th scope="col">Nome Solicitante</th>
      <th scope="col">Solicitante</th>
      <th scope="col">Idade</th>
     
    </tr>
    </thead>
    <tbody>
    <tr>
      <td><input type="hidden" name="id_ocorrencia" value="<?php echo $id_ocorrencia ?>"><?php echo $id_ocorrencia; ?></td>
      <td><input type="hidden" name="tpOcorrencia" value="<?php echo $tp_ocorrencia; ?>"><?php echo $tp_ocorrencia; ?></td>
      <td><input type="hidden" name="nr_telefone" value="<?php echo $nr_telefone; ?>"><?php echo $nr_telefone; ?></td>
      <td><input type="hidden" name="nm_solicitante" value="<?php echo $nm_solicitante; ?>"><?php echo $nm_solicitante; ?></td>
      <td><input type="hidden" name="tp_solicitante" value="<?php echo $tp_solicitante; ?>"><?php echo $tp_solicitante; ?></td>
      <td><input type="hidden" name="vl_idade" value="<?php echo $vl_idade; ?>"><?php echo $vl_idade; ?></td>
    </tr>
    </tbody>
    <thead>
    <tr>
    <th scope="col">Queixas</th>
    <th colspan="3" scope="col">Relatorio Médico</th>
    <th colspan="2" scope="col">Medicações em uso</th>
    
    </tr>
    </thead>
    <tbody>

    <tr>
    <td><input type="hidden" name="queixa" value="<?php echo $queixa; ?>"><?php echo $queixa; ?></td>
    <td colspan="3"><textarea class="form-control"  col="150" rows="10" autofocus name="diagnostico" placeholder="<?php echo $queixa; ?>" value="<?php echo $diagnostico; ?>"></textarea></td>
    <td colspan="2"><textarea class="form-control" col="150" rows="10" name="med_uso"  placeholder="Medicações de uso" value="<?php echo $med_uso; ?>"></textarea> </td>
    
    </tr>
    
    </tbody>
<thead>
    <tr>
    <th scope="col">Prioridade </th>
    <th colspan="3" scope="col">Enviar Ambulancia</th>
    <th colspan="2" scope="col">Finalizar como Orientação médica</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td> <select class="custom-select" name="prioridade">
<option type="hidden" >Prioridade</option>
<option value="alta">Alta</option>
<option value="media">Média</option>
<option value="baixa">Baixa</option>
</select></td>

    <td colspan="3"><button input type="submit" value="Vtr Avançada"  name="enviarSAV" class="btnEnviar btn btn-danger btn-lg">Suporte Avançado</button> 
    <button input type="submit" value="Vtr Basica"  name="enviarSBV" class="btnEnviar btn btn-warning btn-lg ">Suporte Básico</button>  </td>
    <td colspan="2"><button input type="submit" value="oMedica" name="naoEnviar" class="btnEnviar btn btn-primary">Finalizar como Orientação Médica</button>  </td>
    </tr>

    </tbody>
    </form>
    </table>

    <?php require_once "footer.php"; ?>
     
</body>
</html>
