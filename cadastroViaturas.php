<?php
    session_start();
    /*
    if($_SESSION[id]==2){                
        $_SESSION[loginErro] = "Você não tem premissão para acessar! <br> Refaça o seu login";
        header("Location: i.php");
    }*/
    require('conexao.php');

    ?>
    <!DOCTYPE html>
        <head> 
            <title>Cadastro de Viaturas</title> 
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
    <?php
    if (isset($_POST['btn_vtr'])) {
        echo(" <h2>Cadastrar Viaturas</h2><form action='cadastroViaturas.php' method='POST'>
        <label for='nr_viatura'>Identificação de VTR</label>
        <input type='text' name='nr_viatura' value='' id='nr_viatura' placeholder='Insira o numero de descrição da Vtr'><br>
        <label for='ds_placa_viatura'>Placa</label>
        <input type='text' id='ds_placa_viatura' value='' name='ds_placa_viatura'placeholder='Insira o valor da Placa'><br>
        <label for='ds_tipo_viatura'>Descrição do Tipo da VTR</label>
        <input type='text' id='ds_tipo_viatura' name='ds_tipo_viatura' placeholder='Básica, Avançada, de Remoção..'>
        <label for='ds_modelo_viatura'>Descrição do modelo da VTR</label>
        <input type='text'id='ds_modelo_viatura' name='ds_modelo_viatura' placeholder='Descrição do Modelo da VTR'><br>
        <select name='vtr_operacional' >
        <option hidden>Na opereção? </option>
        <option value='1'>SIM</option>
        <option value='0'>NÃo</option>
        </select><br>
        <input type='submit' value='Salvar Registro' name='btn_salvar'>
        
        </form>");
    }
    
    
    if(isset($_POST['btn_salvar'])) { 
        
        $nr_viatura = $_POST['nr_viatura'];
        $ds_placa_viatura=$_POST['ds_placa_viatura'];
        $ds_tipo_viatura=$_POST['ds_tipo_viatura'];
        $ds_modelo_viatura = $_POST['ds_modelo_viatura'];
        $vl_viatura_operacional = $_POST['vtr_operacional'];

        $sql="INSERT INTO `tb_viatura` ( `nr_viatura`, `ds_placa_viatura`, `ds_tipo_viatura`, `ds_modelo_viatura`, `vl_viatura_operacional`) VALUES ('$nr_viatura','$ds_placa_viatura','$ds_tipo_viatura','$ds_modelo_viatura',$vl_viatura_operacional );";
        echo($sql);
        mysqli_query($conn,$sql) or die("Erro ao tentar cadastrar registro");
        echo(" <script>alert('Registro Salvo no Banco de Dados!')</script> ");
        
    }

    if (isset($_POST['alt_func'])) {
    
        echo("<form action='cadastroViaturas.php' method='post'>
        <label for='nm'>Numero da VTR</label>
        <input type='text' value='' name='nm' />
        <button name='alt_func' type='submit'>Pesquisar</button>
        </form>");

        if(!isset($_POST['nm'])){
            $nm = null;
        
        }else{
            $nm = $_POST['nm'];
        
        
        $sql="SELECT * FROM `tb_viatura` WHERE `nr_viatura` LIKE '%$nm%'";
        if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
        //Consultando banco de dados
        $qryLista = mysqli_query($conn, $sql);    
        while($resultado = mysqli_fetch_assoc($qryLista)){
            $vetor[] = array_map('utf8_encode', $resultado); 
        } 
    }
    $max = sizeof($vetor);
    if($max == 0){
        echo ("<h2>Não há registros para exibir</h2>");
    }
    for($i = 0; $i < $max; $i++){
            ?>    
    <form action='cadastroViaturas.php' method='POST'>
        <input type="hidden" name="cd_viatura"value='<?= $vetor[$i]{cd_viatura}?>'>
        <label for='nr_viatura'>Identificação de VTR</label>
        <input type='text' name='nr_viatura' value='<?= $vetor[$i]{nr_viatura}?>' id='nr_viatura' placeholder='Insira o numero de descrição da Vtr'><br>
        <label for='ds_placa_viatura'>Placa</label>
        <input type='text' id='ds_placa_viatura' value='<?= $vetor[$i]{ds_placa_viatura}?>' name='ds_placa_viatura'placeholder='Insira o valor da Placa'><br>
        <label for='ds_tipo_viatura'>Descrição do Tipo da VTR</label>
        <input type='text' id='ds_tipo_viatura' name='ds_tipo_viatura' placeholder='Básica, Avançada, de Remoção..' value='<?= $vetor[$i]{ds_tipo_viatura}?>'>
        <label for='ds_modelo_viatura'>Descrição do modelo da VTR</label>
        <input type='text'id='ds_modelo_viatura' name='ds_modelo_viatura' placeholder='Descrição do Modelo da VTR' value='<?= $vetor[$i]{ds_modelo_viatura}?>'><br>
        <select name='vtr_operacional' >
        <option hidden value='<?= $vetor[$i]{vl_viatura_operacional}?>'> <?php if($vetor[$i]{vl_viatura_operacional} ==1){
            echo("Sim");
        }else{echo("Não");}
        
        ?> </option>
        <option value='1'>SIM</option>
        <option value='0'>NÃo</option>
        </select><br>
        <br>
        <input type='submit' value='Salvar' name='btn_alt'>
        <input type='submit' value='Excluir' name='btn_excluir'>      
        </form>
<?php
    }
}
    if (isset($_POST['btn_excluir'])) {
        
        $cd_viatura = $_POST['cd_viatura'];
        $sqlDelete =("DELETE FROM `tb_viatura` WHERE `cd_viatura` = $cd_viatura");
        $qryDelete = mysqli_query($conn, $sqlDelete);    
        echo("<script>alert(' Registro deletado com sucesso')</script>");
        
    
    }
    if (isset($_POST['btn_alt'])) {
        
        $cd_viatura = $_POST['cd_viatura'];
        $nr_viatura = $_POST['nr_viatura'];
        $ds_placa_viatura=$_POST['ds_placa_viatura'];
        $ds_tipo_viatura=$_POST['ds_tipo_viatura'];
        $ds_modelo_viatura = $_POST['ds_modelo_viatura'];
        $vl_viatura_operacional = $_POST['vtr_operacional'];
          
        $sql="UPDATE tb_viatura SET nr_viatura='$nr_viatura' , ds_placa_viatura ='$ds_placa_viatura', ds_tipo_viatura ='$ds_tipo_viatura', ds_modelo_viatura = '$ds_modelo_viatura', vl_viatura_operacional = $vl_viatura_operacional
        where cd_viatura = $cd_viatura";
        echo($sql);
        $qryLista = mysqli_query($conn, $sql)or die("erro no banco de dados");
        echo(" <script>alert('Registro Alterado com sucesso!')</script> ");    
        echo $qryLista;
    }        
    ?>
    <form action="cadastroViaturas.php" method="POST">
    <button type="submit" name="cadastroProfissionais">Cadastrar Novas VTR</button>
    </form>
    <form action="cadastroViaturas.php" method="post">
    <button type="submit" name='alt_func'>Pesquisar VTRS</button>
    </form> 

    <?php require_once "footer.php"; ?>
    </body> 
    </html> 