<?php
session_start();
require("conexao.php");
//atualiza se equipe está sendo usada;
    $suporte = $_POST['suporte'];
    $acionamento = $_POST['acionamento'];
    $chegadaOrigem = variaveisLiterais($_POST['chegadaOrigem']);
    $saidaLocal = variaveisLiterais($_POST['saidaLocal']);
    $chegadaDestino = variaveisLiterais($_POST['chegadaDestino']);
    $saidaDestino =variaveisLiterais( $_POST['saidaDestino']);
    $qrv = variaveisLiterais($_POST['qrv']);
    $bombeiros =variaveisLiterais($_POST['bombeiros']);
    $policia = variaveisLiterais($_POST['policia']);
    $cet = variaveisLiterais($_POST['cet']);
    $multiplos_meios = variaveisLiterais($_POST['multiplos_meios']);
    $nm_TARM = $_SESSION['usuario'];
    $sat=variaveisInt($_POST['sat']);
    $triagem = variaveisInt($_POST['triagem']);
    $paAlta= variaveisInt($_POST['paAlta']);
    $paBaixa =variaveisInt($_POST['paBaixa']);
    $dextro = variaveisInt($_POST['dextro']);
    $glasgow =variaveisInt($_POST['glasgow']);
    $fCardiaca = variaveisInt($_POST['fCardiaca']);
    $fRespiratoria =variaveisInt($_POST['fRespiratoria']);
    $relatorio =variaveisLiterais($_POST['msg']);
    $id_ocorrencia =$_POST['id_ocorrencia'];
    $unidade =variaveisLiterais($_POST['unidade']);
    $qta = variaveisLiterais($_POST['qta']);
    $nm_vtr =$_POST['nome_equipe'] ;
    $nm_motorista =  $_POST['nm_motorista'];
    $nm_aux_enf = variaveisLiterais($_POST['nm_aux_enf']);
    $nm_enfermeiro = variaveisLiterais($_POST ['nm_enfermeiro']);
    $nm_med_intervencao =variaveisLiterais($_POST ['nm_med_intervencao']);

    $sqlUpadte ="UPDATE tb_ocorrencia SET suporte='$suporte', triagem = 3, nm_radio_op = '$nm_TARM' , paAlta = $paAlta, paBaixa =$paBaixa, dextro=$dextro, fCardiaca =$fCardiaca, fRespiratoria =$fRespiratoria,
     relatorio_rua ='$relatorio', sat =$sat, glasgow =$glasgow, multiplos_meios = '$multiplos_meios',
     cet= '$cet', policia= '$policia', bombeiro='$bombeiros', acionamento= '$acionamento',chegada_origem= '$chegadaOrigem',
     saida_origem ='$saidaLocal' , chegada_destino='$chegadaDestino' , saida_destino ='$saidaDestino',
     qrv ='$qrv', nm_destino='$unidade', qta = '$qta', equipe = '$nm_vtr', nm_motorista = '$nm_motorista', nm_aux_enf = '$nm_aux_enf',
     nm_enfermeiro= '$nm_enfermeiro', nm_med_intervencao = '$nm_med_intervencao'            
     WHERE id_ocorrencia = $id_ocorrencia;";

     echo($sqlUpadte);
        mysqli_query($conn,$sqlUpadte) or die("Erro ao tentar cadastrar registro");
        echo("<script>Alert('SALVO DNO BANCO COM SUCESSO'+'<?=mysqli_query?')></script>");
       
        $alt = $_POST['id_equipe'];
        $sqlUpdateEquipe = "UPDATE `tb_plantao` SET `ativa` = '1' WHERE `tb_plantao`.`id_equipe` = $alt";
        mysqli_query($conn,$sqlUpdateEquipe) or die("Erro ao tentar cadastrar registro");
    echo("<br>".$sqlUpdateEquipe);
//espaço dos metodos

function variaveisLiterais($variavel ){
    if(!$variavel){
       return $variavel="";
    
    }else{
        return $variavel;
        }
    }
function variaveisInt($variavel ){
        if(!$variavel){
           return $variavel=0;
        
        }else{
            return $variavel;
            }
        }
    
?>

