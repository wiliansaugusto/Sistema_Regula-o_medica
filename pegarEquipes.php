<?php
session_start();
require('conexao.php');

//$con =  mysqli_connect('localhost:8889','root','root','id7124820_samu') or die('Erro ao conectar ao banco de dados');
    //Conectando ao banco de dados
    echo ($_POST['id_equipe ']);

    if(!isset($_POST['id_equipe'])){
        $sql="SELECT * FROM `tb_plantao` WHERE ativa =1 ";
        //Consultando banco de dados
        $qryLista = mysqli_query($conn, $sql);  
         while($resultado = mysqli_fetch_assoc($qryLista)){
            $vetor[] =  array_map('utf8_encode', $resultado); 

        }    
        //Passando vetor em forma de json
        echo json_encode($vetor);

    }
     

   ?>