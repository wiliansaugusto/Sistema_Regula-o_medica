<?php
session_start();
include('conexao.php');


date_default_timezone_set('America/Sao_Paulo');

$nOrdemPronto = criarNumeroDeOrdem($contador, $ponteiroData);
function enviarAmbu(){

    $sql = " SELECT id_ocorrencia,tp_ocorrencia, nr_telefone, tp_logradouro, nm_endereco,num_enderco ,ds_complemento,nm_bairro,ref_endereco, nm_medico_reg, diagnostico FROM tb_ocorrencia WHERE triagem =1";

}

function criarNumeroDeOrdem(&$contador, &$ponteiroData){
/**
 * cria um numero de ordem para as ocorrências
 * as ocorrências são a partir de 00:00 do dia primeiro do mês
 * a primeira ocorrência recebe o numero 1 e assim sucessivamente são numeradas
 * então para evitar ocorrências duplicadas iremos concatenar com mês e ano
 */
$arquivo = "contador.txt";
$arquivoData= "salvaData.txt";
//arquivo que abre o contador
$handle = fopen($arquivo, 'r+');
$handledata = fopen($arquivoData, 'r+');
//obtem contagem atual
$ponteiroData= fread($handledata, 512);
$ponteiro = fread($handle, 512);
//adiciona +1
$contador =$ponteiro +1;
//CONTADOR No começo do arquivo
fseek($handle, 0);
fseek($handledata, 0);
//grava
fwrite($handle, $contador);
//fecha o arquivo
fclose($handle);
fclose($handledata);
    $dataAtual = date('my');
    if($ponteiroData !=  $dataAtual){
        $novContador =1 ;
        $arquivo = "contador.txt";
        $handle = fopen($arquivo, 'r+');
        $ponteiro = fread($handle, 512);
        fseek($handle, 0);
        fwrite($handle, $novContador);
        fclose($handle);

        $arquivoData= "salvaData.txt";
        $handledata = fopen($arquivoData, 'r+');
        $novoPonteiro = fread($handledata,512);
        fseek($handledata, 0);
        fwrite($handledata, $dataAtual);
        fclose($handledata);

    return $novContador.$dataAtual;
    }else{
        return $contador.$ponteiroData;
    }
}
function criarChamado( $nOrdemPronto){
    require('conexao.php');
    $nm_tarm =$_SESSION['usuario'];
    $tp_solicitante = $_POST['solicitante'];
    $nr_telefone = $_POST['tel_solicitante'];
    $tp_logradouro = $_POST['logradouro'];
    $nm_endereco = $_POST['endereco'];
    $ds_complemento = $_POST['comp'];
    $num_endereco =  (int) $_POST['numRes'];
    $nm_bairro = $_POST['bairro'];
    $ref_endereco = $_POST['referencia'];
    $tp_ocorrencia = $_POST['tp_ocorrencia'];
    $sexo_paciente = $_POST['sexo'];
    $idade_paciente= (int) $_POST['idade'];
    $nm_usuario = $_POST['nm_solicitante'];
    $dataOcorrencia = date('Y-m-d');
    $queixa = $_POST['msg']; 
    $_SESSION['nOrdem'] = $nOrdemPronto;

    $sql = "INSERT into tb_ocorrencia (id_ocorrencia ,tp_solicitante ,nr_telefone ,nm_solicitante, tp_logradouro ,nm_endereco ,ds_complemento ,num_enderco ,nm_bairro ,ref_endereco,tp_ocorrencia ,queixa ,vl_idade ,sexo_paciente, nm_tarm, time_entrada_ocorrencia,dt_ocorrencia) VALUES ($nOrdemPronto, '$tp_solicitante',$nr_telefone,'$nm_usuario','$tp_logradouro','$nm_endereco','$ds_complemento', $num_endereco,'$nm_bairro', '$ref_endereco', '$tp_ocorrencia', '$queixa', $idade_paciente, '$sexo_paciente','$nm_tarm', CURRENT_TIME ,CURRENT_DATE);";
   // $strcon = mysqli_connect('localhost:8889','root','root','id7124820_samu') or die('Erro ao conectar ao banco de dados'. mysqli_connect_error());
    
    echo($sql);
    mysqli_query($conn,$sql) or die("Erro ao tentar cadastrar registro");
    echo "<script>location.href='atendente1.php';</script>"; 

   }

if ( $_POST['exec'] != null){
 criarChamado($nOrdemPronto);

}else{
    echo ("<p>não conectado</p>");
}

?>