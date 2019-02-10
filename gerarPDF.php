<?php
    date_default_timezone_set('America/Sao_Paulo');
    
$id = $_POST['id_ocorrencia'];
$nm_TARM= $_POST['nm_TARM'];
$dt_ocorrencia= $_POST ['dt_ocorrencia'];
$tp_ocorrencia= $_POST['tp_ocorrencia'];
$tp_solicitante= $_POST['tp_solicitante'];
$nm_solicitante= $_POST['nm_solicitante'];
$nr_telefone=$_POST['nr_telefone'];
$endereco=$_POST['endereco'];
$num_enderco=$_POST['num_enderco'];
 $ds_complemento=$_POST['ds_complemento'];
    $ref_endereco=$_POST['ref_endereco'];
    $nm_bairro=$_POST['nm_bairro'];
    $bombeiro = $_POST['bombeiro'];
    $policia= $_POST['policia'];
    $cet= $_POST['cet'];
    $multiplos_meios = $_POST['multiplos_meios'];
    $nm_radio_op= $_POST ['nm_radio_op'];
    $acionamento= $_POST['acionamento'];
    $chegada_origem= $_POST['chegada_origem'];
    $saida_origem= $_POST['saida_origem'];
    $cheagada_destino= $_POST['chegada_destino'];
    $saida_destino= $_POST['saida_destino'];
    $qrv=$_POST['qrv'];
    $qta=$_POST['qta'];
    $nm_destino=$_POST['nm_destino'];
    $relatorio_rua= $_POST['relatorio_rua'];
    $pressaoArterial= $_POST['pressaoArterial'];
    $dextro= $_POST['dextro'];
    $sat=$_POST['sat'];
    $glasgow=$_POST['glasgow'];
    $fCardiaca=$_POST['fCardiaca'];
    $fRespiratoria=$_POST['fRespiratoria'];
    $suporte=$_POST['suporte'];
    $equipe= $_POST['equipe'];
    $nm_motorista= $_POST['nm_motorista'];
    $nm_aux_enf= $_POST['nm_aux_enf'];
    $nm_enfermeiro= $_POST['nm_enfermeiro'];
    $nm_med_intervencao= $_POST['nm_med_intervencao'];
    $sexo_paciente= $_POST['sexo_paciente'];
    $vl_idade= $_POST['vl_idade'];
    $queixa= $_POST['queixa'];
    $diagnostico= $_POST['diagnostico'];
    $med_uso= $_POST['med_uso'];
    $prioridade= $_POST['prioridade'];
    $nm_med_reg= $_POST['nm_medico_reg'];

//Inclui a classe 'class.ezpdf.php'
include("php/pdf-php/src/Cezpdf.php");
  
//Instancia um novo documento com o nome de pdf
$pdf = new Cezpdf(); 
  
//Seleciona a fonte que será usada. As fontes estão localizadas na pasta "pdf-php/fonts". Use a de sua preferencia.
$pdf -> selectFont('pdf-php/fonts/Helvetica.afm'); 
  
//Chama o método "ezText".
//No 1° parametro passa o texto do documento
//No 2° parametro define o tamanho da fonte.
//No 3° parametro é do tipo array. A seguir uma explicação desse 3° parametro:
  
// justification => seta a posição de um label, pode ser center, right, left, aright, ou aleft
// leading = > define o tamanho que cada linha usará para se mostrada, deverá  ser um int
// spacing => define o espaçamento entrelinhas, deverá ser um float
// você pode usar apenas leading ou apenas spacing, nunca os dois

$pdf -> ezText('Relatorio do Atendimento: ' . $id, 20, array(justification => 'center', spacing => 2.0)); 
$pdf -> ezText('<b>TARM: </b>' . $nm_TARM  , 12, array(justification => 'left', spacing => 3.0));
$pdf -> ezText('<b>Complemento: </b> ' .$ds_complemento. ' <b>Bairro: </b>' .$nm_bairro. ' <b>Referencia: </b>'.$ref_endereco, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Nome do Solicitante: </b> '.$nm_solicitante.' <b>Tipo do Solicitante:</b> '.$tp_solicitante, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Numero do telefone: </b> '.$nr_telefone.' <b>Endereço:</b> '.$endereco.'<b>Nº End: </b> '.$num_enderco, 12, array(justification => 'left', spacing => 1.5));  
$pdf -> ezText('<b>Complemento: </b> ' .$ds_complemento. ' <b>Bairro: </b>' .$nm_bairro. ' <b>Referencia: </b>'.$ref_endereco, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Sexo: </b> ' .$sexo_paciente. ' <b>Idade: </b>' .$vl_idade. ' <b>Queixa: </b>'.$queixa, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Diagnostico Médico: </b> ' .$diagnostico , 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Medicação em Uso: </b> ' .$med_uso, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Proridade: </b> ' .$prioridade. ' <b>Médico Regulador: </b>' .$nm_med_reg,12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Equipe: </b> ' .$equipe. ' <b>Tipo da VTR: </b>' .$suporte, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Condutor: </b> ' .$nm_motorista. ' <b>Aux de Enfermagem: </b>' .$nm_aux_enf, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Enfermeiro(a): </b> ' .$nm_enfermeiro. ' <b>Médico Intervencionista: </b>' .$nm_med_intervencao, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Pressão Arterial: </b> ' .$pressaoArterial. ' <b>Dextro: </b>' .$dextro. ' <b>Saturação: </b>'.$sat, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>F. Cardiaca: </b> ' .$fCardiaca. ' <b>F. Respiratoria: </b>' .$fRespiratoria. ' <b>Glasgow: </b>'.$glasgow, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Relatorio da Equipe: </b> ' .$relatorio_rua, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Radio Operador: </b> ' .$nm_radio_op. ' <b>Acionameto: </b>' .$acionamento. ' <b>Chegada na Origem: </b>'.$chegada_origem, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Saída Origem: </b> ' .$saida_origem. ' <b>Chegada no Destino: </b>' .$cheagada_destino. ' <b>Saida do Destino: </b>'.$saida_destino, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>QRV: </b> ' .$qrv. ' <b>QTA: </b>' .$qta. ' <b>Unidade de Destino: </b>'.$nm_destino, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Acionamento de Multiplos Meios<b>', 14, array(justification => 'center', spacing => 1.5));
$pdf -> ezText('<b>Bobeiros: </b> ' .$bombeiro. ' <b>Policia: </b>' .$policia. ' <b>CET: </b>'.$cet, 12, array(justification => 'left', spacing => 1.5));
$pdf -> ezText('<b>Observações: </b> ' .$multiplos_meios, 12, array(justification => 'left', spacing => 1.5));


//Gera o PDF
$pdf -> ezStream();

?>

