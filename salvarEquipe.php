<?php
session_start();
require('conexao.php');

echo ($_POST['id_equipe']);

     if(isset($_POST['id_equipe'])){
        $sqlUpdateEquipe = "UPDATE `tb_plantao` SET `ativa` = '0' WHERE `id_equipe` = $_POST[id_equipe]";
        mysqli_query($conn,$sqlUpdateEquipe) or die("Erro ao tentar cadastrar registro");
        echo $sqlUpdateEquipe;
   } 

?>
   