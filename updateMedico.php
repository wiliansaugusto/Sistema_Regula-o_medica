<?php
session_start();
include('conexao.php');

$i=$_POST['i'];
if ( $_POST['triagem'] != null){
    regularChamado();

   }else{
       echo ("<p>não conectado passou nulo</p>");
   }

function regularChamado(){
    
    $nmMedico =$_SESSION['usuario'];
    $sat=$_POST['sat'];
    $triagem = $_POST['triagem'];
    $paAlta= $_POST['paAlta'];
    $paBaixa =$_POST['paBaixa'];
    $dextro = $_POST['dextro'];
    $glasgow =$_POST['glasgow'];
    $fCardiaca = $_POST['fCardiaca'];
    $fRespiratoria =$_POST['fRespiratoria'];
    $relatorio =$_POST['relatorio'];
    $prioridade = $_POST['prioridade'];
    $dados =$_POST['oco'];
    $sqlUpadte ="UPDATE tb_ocorrencia SET nm_medico_reg ='$nmMedico', triagem = $triagem,
    paAlta = $paAlta, paBaixa =$paBaixa, dextro=$dextro, fCardiaca =$fCardiaca, fRespiratoria =$fRespiratoria,
     diagnostico ='$relatorio', sat =$sat, glasgow =$glasgow, prioridade='$prioridade '
     WHERE id_ocorrencia = $dados;";
     echo($sqlUpadte);
    mysqli_query($conn,$sqlUpadte) or die("Erro ao tentar cadastrar registro");
    echo "<script>location.href='medico.php';</script>"; 

}
?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<?
echo($sqlUpadte);
?>
</body>
</html>