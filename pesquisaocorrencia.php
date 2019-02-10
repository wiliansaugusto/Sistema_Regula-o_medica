<?php
    session_start();
    /*
    if($_SESSION[id]==2){                
        $_SESSION[loginErro] = "Você não tem premissão para acessar! <br> Refaça o seu login";
        header("Location: i.php");
    }*/
    include('conexao.php');

    ?>
    <!DOCTYPE html>
        <head> 
            <title>SAMU 192 - Salvando Vidas</title> 
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <link rel="stylesheet" href="../css/estilo.css">
            <!-- BOOTSTRAP -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="../jquery/jquery.min.js"></script>
        
            </head> 
    <body> 
    <?php require_once "navbar.php"; ?>

<form action="pesquisaocorrencia.php" method="POST">
<button class="btn btn-primary btn-lg btn-block" name="btn_data">Pesquisar por data e hora</button>
</form>

<?php 
if (isset($_POST['btn_data'])) {
    echo("
        <form action='pesquisaocorrencia.php' method='post'>
        <label for='dt'>Data Inicial</label>
        <input type='date' value='' name='dt_inicial' />
        <label for='dt'>Data Final</label>
        <input type='date' value='' name='dt_final' />
        <label for='dt'>Hora Inicial</label>
        <input type='time' value='' name='h_inicial' />
        <label for='dt'>Hora Final</label>
        <input type='time' value='' name='h_final' />
        <button name='pesquisa_data' type='submit'>Pesquisar</button>
        </form>
        ");
}  

if(isset($_POST['pesquisa_data'])){
    $dt_inicial = $_POST['dt_inicial'];
    $dt_final = $_POST['dt_final'];
    $h_inicial = $_POST['h_inicial'];
    $h_final =$_POST['h_final'];

$sql="SELECT * FROM `tb_ocorrencia` WHERE  dt_ocorrencia BETWEEN '$dt_inicial' AND '$dt_final'";
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    //Consultando banco de dados
    $qryLista = mysqli_query($conn, $sql);    
    while($resultado = mysqli_fetch_assoc($qryLista)){
        $vetor[] = array_map('utf8_encode', $resultado); 
    } 
    $totalRegistro = mysqli_num_rows($qryLista);

    for($i =0; $i < $totalRegistro; $i++){
    ?>
    <div>
    <form action="gerarPDF.php" target="_blank" method="POST">
    <input type="hidden" name="dt_ocorrencia" value="<?=$vetor[$i]{dt_ocorrencia}?>"/>
    <input type="hidden" name="nm_TARM"value="<?=$vetor[$i]{nm_TARM}?>"/>
    <input type="hidden" name="id_ocorrencia" value="<?=$vetor[$i]{id_ocorrencia}?>"/>
    <input type="hidden" name="tp_ocorrencia" value="<?=$vetor[$i]{tp_ocorrencia}?>"/>
    <input type="hidden" name="tp_solicitante" value="<?=$vetor[$i]{tp_solicitante}?>"/>
    <input type="hidden" name="nm_solicitante" value="<?=$vetor[$i]{nm_solicitante}?>"/>
    <input type="hidden" name="nr_telefone" value="<?=$vetor[$i]{nr_telefone}?>"/>
    <input type="hidden" name="endereco"    value="<?=$vetor[$i]{tp_logradouro}." ".$vetor[$i]{nm_endereco}?> "/>
    <input type="hidden" name="num_enderco " value="<?=$vetor[$i]{num_enderco}?>"/>
    <input type="hidden" name="ds_complemento" value="<?=$vetor[$i]{ds_complemento}?>"/>
    <input type="hidden" name="ref_endereco" value="<?=$vetor[$i]{ref_endereco}?>"/>
    <input type="hidden" name="nm_bairro"value="<?=$vetor[$i]{nm_bairro}?>"/>
    <input type="hidden" name="bombeiro"value="<?=$vetor[$i]{bombeiro}?>"/>
    <input type="hidden" name="policia"value="<?=$vetor[$i]{policia}?>"/>
    <input type="hidden" name="cet" value="<?=$vetor[$i]{cet}?>"/>
    <input type="hidden" name="multiplos_meios "value="<?=$vetor[$i]{multiplos_meios}?>"/>
    <input type="hidden" name="nm_radio_op" value="<?=$vetor[$i]{nm_radio_op}?>"/>
    <input type="hidden" name="acionamento"value="<?=$vetor[$i]{acionamento}?>"/>
    <input type="hidden" name="chegada_origem" value="<?=$vetor[$i]{chegada_origem}?>"/>
    <input type="hidden" name="saida_origem" value="<?=$vetor[$i]{saida_origem}?>"/>
    <input type="hidden" name="cheagada_destino" value="<?=$vetor[$i]{chegada_destino}?>"/>
    <input type="hidden" name="saida_destino" value="<?=$vetor[$i]{saida_destino}?>"/>
    <input type="hidden" name="qrv" value="<?=$vetor[$i]{qrv}?>"/>
    <input type="hidden" name="qta" value="<?=$vetor[$i]{qta}?>"/>
    <input type="hidden" name="nm_destino" value="<?=$vetor[$i]{nm_destino}?>"/>
    <input type="hidden" name="relatorio_rua" value="<?=$vetor[$i]{relatorio_rua}?>"/>
    <input type="hidden" name="pressaoArterial" value="<?=$vetor[$i]{paAlta}." X ".$vetor[$i]{paBaixa}?>"/>
    <input type="hidden" name="dextro" value="<?=$vetor[$i]{dextro}?>"/>
    <input type="hidden" name="sat" value="<?=$vetor[$i]{sat}?>"/>
    <input type="hidden" name="glasgow" value="<?=$vetor[$i]{glasgow}?>"/>
    <input type="hidden" name="fCardiaca" value="<?=$vetor[$i]{fCardiaca}?>"/>
    <input type="hidden" name="fRespiratoria" value="<?=$vetor[$i]{fRespiratoria}?>"/>
    <input type="hidden" name="suporte" value="<?=$vetor[$i]{suporte}?>"/>
    <input type="hidden" name="equipe" value="<?=$vetor[$i]{equipe}?>"/>
    <input type="hidden" name="nm_motorista" value="<?=$vetor[$i]{nm_motorista}?>"/>
    <input type="hidden" name="nm_aux_enf" value="<?=$vetor[$i]{nm_aux_enf}?>"/>
    <input type="hidden" name="nm_enfermeiro" value="<?=$vetor[$i]{nm_enfermeiro}?>"/>
    <input type="hidden" name="nm_med_intervencao" value="<?=$vetor[$i]{nm_med_intervencao}?>"/>
    <input type="hidden" name="sexo_paciente" value="<?=$vetor[$i]{sexo_paciente}?>"/>
    <input type="hidden" name="vl_idade" value="<?=$vetor[$i]{vl_idade}?>"/>
    <input type="hidden" name="queixa" value="<?=$vetor[$i]{queixa}?>"/>
    <input type="hidden" name="diagnostico" value="<?=$vetor[$i]{diagnostico}?>"/>
    <input type="hidden" name="med_uso" value="<?=$vetor[$i]{med_uso}?>"/>
    <input type="hidden" name="prioridade" value="<?=$vetor[$i]{prioridade}?>"/>
    <input type="hidden" name="nm_med_reg" value="<?=$vetor[$i]{nm_medico_reg}?>"/>

    <table class="table estiloTabela">
    <tr>
    <th>Data Ocorrência</th>
    <th>TARM</th>
    <th> Numero de Ordem</th>
    <th>Tipo Ocorrência</th>
    <th>Tipo Solicitante</th>
    <th>Nome do Solicitante</th>
    <th>Numero de Telefone</th>
    <th>Endereço</th>
    <th>Numero</th>
    </tr>
    <tr>
    <td><?=$vetor[$i]{dt_ocorrencia}?></td>
    <td><?=$vetor[$i]{nm_TARM}?></td>
    <td><?=$vetor[$i]{id_ocorrencia}?></td>
    <td><?=$vetor[$i]{tp_ocorrencia}?></td> 
    <td><?=$vetor[$i]{tp_solicitante}?></td>
    <td><?=$vetor[$i]{nm_solicitante}?></td>
    <td><?=$vetor[$i]{nr_telefone}?></td>
    <td><?=$vetor[$i]{tp_logradouro}." ".$vetor[$i]{nm_endereco}?></td>
    <td><?=$vetor[$i]{num_enderco}?></td>
    </tr>
    <tr>
    <th>Complemento</th>
    <th>Referência</th>
    <th>Bairro</th>
    </tr>
    <tr>
    <td><?=$vetor[$i]{ds_complemento}?></td>
    <td><?=$vetor[$i]{ref_endereco}?></td>
    <td><?=$vetor[$i]{nm_bairro}?></td>
    </tr>
    <tr>
    <th>Sexo</th>
    <th>Idade</th>
    <th>Queixa Inicial</th>
    <th>Diagnostico Médico</th>
    <th>Medicação em Uso</th>
    <th>Prioridade</th>
    <th>Medico Regulador</th>
    </tr>
    <tr>
    <td><?=$vetor[$i]{sexo_paciente}?></td>
    <td><?=$vetor[$i]{vl_idade}?></td>
    <td><?=$vetor[$i]{queixa}?></td>
    <td><?=$vetor[$i]{diagnostico}?></td>
    <td><?=$vetor[$i]{med_uso}?></td>
    <td><?=$vetor[$i]{prioridade}?></td>
    <td><?= $vetor[$i]{nm_medico_reg}?></td>
    </tr>
    <tr>
    <th>Suporte</th>
    <th>Equipe</th>
    <th>Condutor</th>
    <th>Auxiliar de Enfermagem</th>
    <th>Enfermeiro</th>
    <th>Médico Intervencionista</th>
    </tr>
    <tr>
    <td><?=$vetor[$i]{suporte}?></td>
    <td><?=$vetor[$i]{equipe}?></td>
    <td><?=$vetor[$i]{nm_motorista}?></td>
    <td><?=$vetor[$i]{nm_aux_enf}?></td>
    <td><?=$vetor[$i]{nm_enfermeiro}?></td>
    <td><?=$vetor[$i]{nm_med_intervencao}?></td>
</tr>
    <tr>
    <th>Relatorio Equipe</th>
    <th>Pressão Arterial</th>
    <th>Dextro</th>
    <th>Saturação</th>
    <th>Glasgow</th>
    <th>Frequência Cardiaca</th>
    <th>Frequência Respiratoria</th>
    </tr>
    <tr>
    <td><?=$vetor[$i]{relatorio_rua}?></td>
    <td><?=$vetor[$i]{paAlta}." X ".$vetor[$i]{paBaixa}?></td>
    <td><?=$vetor[$i]{dextro}?></td>
    <td><?=$vetor[$i]{sat}?></td>
    <td><?=$vetor[$i]{glasgow}?></td>
    <td><?=$vetor[$i]{fCardiaca}?></td>
    <td><?=$vetor[$i]{fRespiratoria}?></td>

</tr>
    <tr>
    <th>Radio Operador</th>
    <th>Acionamento</th>
    <th>Chegada Origem</th>
    <th>Saida Origem</th>
    <th>Chegada Destino</th>
    <th>Saida Destino</th>
    <th>QRV</th>
    <th>QTA</th>
    <th>Unidade de Destino</th>
    </tr>
    <tr>
    <td><?=$vetor[$i]{nm_radio_op}?></td>
    <td><?=$vetor[$i]{acionamento}?></td>
    <td><?=$vetor[$i]{chegada_origem}?></td>
    <td><?=$vetor[$i]{saida_origem}?></td>
    <td><?=$vetor[$i]{chegada_destino}?></td>
    <td><?=$vetor[$i]{saida_destino}?></td>
    <td><?=$vetor[$i]{qrv}?></td>
    <td><?=$vetor[$i]{qta}?></td>
    <td><?=$vetor[$i]{nm_destino}?></td>

</tr>
    <tr>
    <th>Bombeiros</th>
    <th>Policia Militar</th>
    <th>CET</th>
    <th>Observações</th>
    </tr>
    <tr>
    <td><?=$vetor[$i]{bombeiro}?></td>
    <td><?=$vetor[$i]{policia}?></td>
    <td><?=$vetor[$i]{cet}?></td>
    <td><?=$vetor[$i]{multiplos_meios}?></td>
</tr>
    </table>
    <button class="btn btn-primary btn-lg btn-block "  type="submit" name="gerarPdf" value="Gerar Pdf">Gerar PDF</button>
    </form>
    <br>
    </div>
    <?php
    
}

}
?>





<?php require_once "footer.php"; ?>
</body> 
</html> 