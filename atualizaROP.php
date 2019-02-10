<?php
session_start();


    //Conectando ao banco de dados
    $con =  mysqli_connect('localhost:8889','root','root','id7124820_samu') or die('Erro ao conectar ao banco de dados');
    $sql ="SELECT id_ocorrencia,tp_ocorrencia,prioridade, nr_telefone, tp_logradouro, nm_endereco,num_enderco ,ds_complemento,nm_bairro,ref_endereco, nm_medico_reg, diagnostico, vl_idade FROM tb_ocorrencia WHERE triagem =1";
    //Consultando banco de dados
    $qryLista = mysqli_query($con, $sql);  
     while($resultado = mysqli_fetch_assoc($qryLista)){
        $vetor[] = array_map('utf8_encode', $resultado); 
        
    }    
    //Passando vetor em forma de json
    echo json_encode($vetor);
    

?>