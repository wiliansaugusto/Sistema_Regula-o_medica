<?php
    //Conectando ao banco de dados
    $con =  mysqli_connect('localhost:8889','root','root','id7124820_samu') or die('Erro ao conectar ao banco de dados');
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    $sql ="SELECT id_ocorrencia, nm_solicitante, nr_telefone, vl_idade,queixa, nm_bairro frOM tb_ocorrencia WHERE triagem = 0";

    //Consultando banco de dados
    $qryLista = mysqli_query($con, $sql);    
    while($resultado = mysqli_fetch_assoc($qryLista)){
        $vetor[] = array_map('utf8_encode', $resultado); 
    }    
    
    //Passando vetor em forma de json
    echo json_encode($vetor);
    
?>