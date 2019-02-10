    <?php
    session_start();
        if($_SESSION[id]!=6){                
        $_SESSION[loginErro] = "Você não tem premissão para acessar! <br> Refaça o seu login";
        header("Location: i.php");
    }
    
    require('conexao.php');

    ?>
    <!DOCTYPE html>
        <head> 
            <title>Cadastrar Profissionais</title> 
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
    if (isset($_POST['cadastroProfissionais'])) {
        echo(" <h2>Cadastrar Profissional</h2><form action='cadastro.php' method='POST'>
        <label for='nm_profissional'>Nome do Profissional</label>
        <input type='text' name='nm_profissional' value='' id='nm_profissional' placeholder='Insirao o nome do Profissional'><br>
        <label>Tipo de Profissional</label>
        <select name='ds_profissional'>
        <option hidden name='tp_profissional'>Tipo de Profissional</option>
        <option value='1'>TARM</option>
        <option value='2'>Médico</option>
        <option value='3'>Radio Operador</option>
        <option value='5'>Motorista</option>
        <option value='4'>Aux de Enfermagem</option>
        <option value='6'>Enfermeiro</option>
        </select> <br>
        <label for='nr_telefone'>Telefone</label>
        <input type='number' id='nr_telefone' value='' name='nr_telefone'placeholder='Insira o numero de telefone '><br>
        <label >Endereço</label>
        <select name='ds_tipo_endereco'>
        <option type='hidden' >Tipo Logradouro</option>
        <option value='Rua'>Rua</option>
        <option value='avenida'>Avenida</option>
        <option value='praca'>Praça</option>
        <option value='beco'>Beco</option>
        <option value='viela'>Viela</option>
        </select>
        <label for='nm_endereco'>Nome do Logradouro</label>
        <input type='text' id='nm_endereco' name='nm_endereco' placeholder='Insira o nome do logradouro'>
        <label for='nr_residencia'>Numero da Residencia</label>
        <input type='number'id='nr_residencia' name='nr_residencia' placeholder='Numero da residencia'><br>
        <label for='ds_complemento'>Complemento</label>
        <input type='text' id='ds_complemento' name='ds_complemento'placeholder='Complemento'>
        <label for='nm_bairro'>Bairro</label>
        <input type='text'id='nm_bairro' name='nm_bairro' placeholder='Nome do Bairro'>
        <label for='nm_cidade'>Cidade</label>
        <input type='text'id='nm_cidade' name='nm_cidade' placeholder='Nome da Cidade'><br>
        <label for='t_habilitacao'>TIpo Habilitação</label>
        <select name='tp_habilitacao' >
        <option hidden>Tipo da Habilitação</option>
        <option value='coren'>Coren</option>
        <option value='CNH'>CNH</option>
        <option value='CRM'>CRM</option>
        <option value='n/a'>Não Especifica</option>
        </select>
        <label for='nr_habilitacao'>Numero</label>
        <input type='text' id='nr_habilitacao' placeholder='Insira o numero do Coren, CNH ou CRM' name='nr_habilitacao' value=''>
        <label for='nr_funcional'>Registro Funcional</label>
        <input type='text' id='nr_funcional' value='' name='nr_funcional' placeholder='Insira o numero da funcional se houver'><br>
        <label for='nm_usuario'>Nome de Usuário</label>
        <input type='text'id='nm_usuario' value='' name='nm_usuario' placeholder='Nome de Usuario'>
        <label for='ds_senha'>Senha</label>
        <input type='text'name='ds_senha' id='ds_senha' placeholder='digite a sua senha' value=''><br>
        <input type='submit' value='Salvar Registro' name='btn_salvar'>
        
        </form>");
    }
    
    
    if(isset($_POST['btn_salvar'])) { 
        
        $nm_profissional = $_POST['nm_profissional'];
        $ds_tipo_profissional=$_POST['ds_profissional'];
        $nr_telefone_profissional=$_POST['nr_telefone'];
        $nm_endereco = $_POST['nm_endereco'];
        $ds_tipo_endereco = $_POST['ds_tipo_endereco'];
        $nm_endereco =$_POST['nm_endereco'];
        $nr_residencia =$_POST['nr_residencia'];
        $ds_complemento= $_POST['ds_complemento'];
        $nm_bairro = $_POST['nm_bairro'];
        $nm_cidade = $_POST['nm_cidade'];
        $tp_habilitacao=$_POST['tp_habilitacao'];
        $nr_habilitacao=$_POST['nr_habilitacao'];
        $nr_funcional = $_POST['nr_funcional'];
        $nm_usuario=$_POST['nm_usuario'];
        $ds_senha =$_POST['ds_senha'];
        
        //valida o tipo de profissional para regular o acesso
        if($ds_tipo_profissional ==1){
            $tp_profissional ="TARM";
        }elseif($ds_tipo_profissional == 2){
            $tp_profissional = "Medico";
        }elseif($ds_tipo_profissional == 3){
            $tp_profissional = "Radio Operador";
        }elseif($ds_tipo_profissional == 4){
            $tp_profissional="Auxiliar de Enfermagem";
        }elseif($ds_tipo_profissional == 5){
            $tp_profissional ="Motorista";
        }elseif($ds_tipo_profissional == 6){
            $tp_profissional="Enfermeiro";
        }else{
            $tp_profissional="erro";
        }
        
        $sql="INSERT INTO `tb_profissional` ( `nm_profissional`, `tp_profissional`, 
        `ds_tipo_profissional`, `nr_telefone_profissional`, `nm_endereco`, 
        `ds_tipo_endereco`, `nm_bairro`, `nr_numero_residencia`, `ds_complemento`,
       
        `nm_cidade`, `nr_habilitacao`, `nr_registro_funcional`, `ds_senha`,
        `nm_usuario`,  `tp_habilitacao`) VALUES ( 
            '$nm_profissional', $ds_tipo_profissional, '$tp_profissional' ,
            $nr_telefone_profissional, '$nm_endereco', '$ds_tipo_endereco','$nm_bairro',
            $nr_residencia, '$ds_complemento', '$nm_cidade', $nr_habilitacao, $nr_funcional,
            '$ds_senha', '$nm_usuario', '$tp_habilitacao' );";
        echo($sql);
        mysqli_query($conn,$sql) or die("Erro ao tentar cadastrar registro");

        
    }

    if (isset($_POST['alt_func'])) {
    
        echo("<form action='cadastro.php' method='post'>
        <label for='nm'>Nome do Funcionario</label>
        <input type='text' value='' name='nm' />
        <button name='alt_func' type='submit'>Pesquisar</button>
        </form>");

        if(!isset($_POST['nm'])){
            $nm = null;
        
        }else{
            $nm = $_POST['nm'];
        
        
        $sql="SELECT *  FROM `tb_profissional` WHERE `nm_profissional` LIKE '%$nm%'";
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
    <form action='cadastro.php' method='POST'>
        <h2>Alterar dados </h2>
        <label for='nm_profissional'>Nome do Profissional</label>
        <input hidden type="text" value='<?= $vetor[$i]{cd_profissional}?>'name='cd_profissional'>
        <input type='text' name='nm_profissional' value='<?= $vetor[$i]{nm_profissional}?>' id='nm_profissional' placeholder='<?= $vetor[$i]{nm_profissional}?>'><br>
        <label>Tipo de Profissional</label>
        <select name='ds_profissional'>
        <option hidden  value='<?= $vetor[$i]{tp_profissional}?>'><?php
         if($vetor[$i]{tp_profissional} == 1){
            $tp_profissional ="TARM";
        }elseif($vetor[$i]{tp_profissional} == 2){
            $tp_profissional = "Medico";
        }elseif($vetor[$i]{tp_profissional} == 3){
            $tp_profissional="Radio Operador";
        }elseif($vetor[$i]{tp_profissional} == 4){
            $tp_profissional ="Auxiliar de Enfermagem";
        }elseif($vetor[$i]{tp_profissional} == 5){
            $tp_profissional="Motorista";
        }elseif($vetor[$i]{tp_profissional} == 6){    
            $tp_profissional="Enfermeiro";
        }else{
            $tp_profissional="erro";
        }  
        echo($tp_profissional)?></option>
        <option value='1'>TARM</option>
        <option value='2'>Médico</option>
        <option value='3'>Radio Operador</option>
        <option value='4'>Aux de Enfermagem</option>
        <option value='5'>Motorista</option>
        <option value='6'>Enfermeiro</option>
        </select> <br>
        <label for='nr_telefone'>Telefone</label>
        <input type='number' id='nr_telefone' value='<?= $vetor[$i]{nr_telefone_profissional}?>' name='nr_telefone'placeholder='Insira o numero de telefone '><br>
        <label >Endereço</label>
        <select name='ds_tipo_endereco'>
                    <option type='hidden' name="ds_tipo_endereco"value='<?= $vetor[$i]{ds_tipo_endereco}?>' ><?= $vetor[$i]{ds_tipo_endereco}?></option>
                    <option value='Rua'>Rua</option>
                    <option value='avenida'>Avenida</option>
                    <option value='praca'>Praça</option>
                    <option value='beco'>Beco</option>
                    <option value='viela'>Viela</option>
    </select>
    <label for='nm_endereco'>Nome do Logradouro</label>
    <input type='text' value='<?= $vetor[$i]{nm_endereco}?>' id='nm_endereco' name='nm_endereco' placeholder='Insira o nome do logradouro'>
    <label for='nr_residencia'>Numero da Residencia</label>
    <input type='number'id='nr_residencia' value='<?= $vetor[$i]{nr_numero_residencia}?>' name='nr_residencia' placeholder='Numero da residencia'><br>
    <label for='ds_complemento'>Complemento</label>
    <input type='text' value='<?= $vetor[$i]{ds_complemento}?>' id='ds_complemento' name='ds_complemento'placeholder='Complemento'>
    <label for='nm_bairro'>Bairro</label>
    <input type='text'id='nm_bairro' value='<?= $vetor[$i]{nm_bairro}?>' name='nm_bairro' placeholder='Nome do Bairro'>
    <label for='nm_cidade'>Cidade</label>
    <input type='text'id='nm_cidade' name='nm_cidade' value='<?= $vetor[$i]{nm_cidade}?>' placeholder='Nome da Cidade'><br>
    <label for='tp_habilitacao'>TIpo Habilitação</label>
    <select name='tp_habilitacao' >
    <option value='<?= $vetor[$i]{tp_habilitacao}?>' hidden><?= $vetor[$i]{tp_habilitacao}?></option>
    <option value='coren'>Coren</option>
    <option value='CNH'>CNH</option>
    <option value='CRM'>CRM</option>
    <option value='n/a'>Não Especifica</option>
    </select>
    <label for='nr_habilitacao'>Numero</label>
    <input type='text' id='nr_habilitacao' value='<?= $vetor[$i]{nr_habilitacao}?>' placeholder='Insira o numero do Coren, CNH ou CRM' name='nr_habilitacao' value=''>
    <label for='nr_funcional'>Registro Funcional</label>
    <input type='text' id='nr_funcional'  name='nr_funcional' value='<?= $vetor[$i]{nr_registro_funcional}?>'placeholder='Insira o numero da funcional se houver'><br>
    <label for='nm_usuario'>Nome de Usuário</label>
    <input type='text'id='nm_usuario' value='<?= $vetor[$i]{nm_usuario}?>' name='nm_usuario' placeholder='Nome de Usuario'>
    <label for='ds_senha'>Senha</label>
    <input type='text'name='ds_senha' id='ds_senha' placeholder='digite a sua senha' value='<?= $vetor[$i]{ds_senha}?>'><br>
    <input type='submit' value='Salvar' name='btn_alt'>
    <input type='submit' value='Excluir' name='btn_excluir'>

    
        </form>
<?php
    }
}
    if (isset($_POST['btn_excluir'])) {
        
        $cd_profissional = $_POST['cd_profissional'];
        $sqlDelete =("DELETE FROM `tb_profissional` WHERE `cd_profissional` = $cd_profissional");
        $qryDelete = mysqli_query($conn, $sqlDelete);    
        echo("<script>alert(' Registro deletado com sucesso')</script>");
        
    
    }
    if (isset($_POST['btn_alt'])) {
        
        $cd_profissional = $_POST['cd_profissional'];
        $nm_profissional = $_POST['nm_profissional'];
        $ds_tipo_profissional=$_POST['ds_profissional'];
        $nr_telefone_profissional=$_POST['nr_telefone'];
        $nm_endereco = $_POST['nm_endereco'];
        $ds_tipo_endereco = $_POST['ds_tipo_endereco'];
        $nm_endereco =$_POST['nm_endereco'];
        $nr_residencia =$_POST['nr_residencia'];
        $ds_complemento= $_POST['ds_complemento'];
        $nm_bairro = $_POST['nm_bairro'];
        $nm_cidade = $_POST['nm_cidade'];
        $tp_habilitacao=$_POST['tp_habilitacao'];
        $nr_habilitacao=$_POST['nr_habilitacao'];
        $nr_funcional = $_POST['nr_funcional'];
        $nm_usuario=$_POST['nm_usuario'];
        $ds_senha =$_POST['ds_senha'];
 
        //valida o tipo de profissional para regular o acesso
        if($ds_tipo_profissional == 1){
            $tp_profissional ="TARM";
        }elseif($ds_tipo_profissional == 2){
            $tp_profissional = "Medico";
        }elseif($ds_tipo_profissional == 3){
            $tp_profissional="Radio Operador";
        }elseif($ds_tipo_profissional == 4){
            $tp_profissional ="Auxiliar de Enfermagem";
        }elseif($ds_tipo_profissional == 5){
            $tp_profissional="Motorista";
        }elseif($ds_tipo_profissional == 6){    
            $tp_profissional="Enfermeiro";
        }else{
            $tp_profissional="erro";
        }           
        $sql="UPDATE tb_profissional SET nm_profissional='$nm_profissional' , tp_profissional= $ds_tipo_profissional,
        ds_tipo_profissional = '$tp_profissional', nr_telefone_profissional =$nr_telefone_profissional,
        nm_endereco='$nm_endereco', ds_tipo_endereco='$ds_tipo_endereco', nm_endereco = '$nm_endereco',
        nr_numero_residencia= $nr_residencia, ds_complemento='$ds_complemento',nm_bairro='$nm_bairro',
        nm_cidade='$nm_cidade', tp_habilitacao='$tp_habilitacao', nr_habilitacao=$nr_habilitacao,
        nr_registro_funcional =$nr_funcional, nm_usuario='$nm_usuario',ds_senha='$ds_senha'
        where cd_profissional=$cd_profissional";
        $qryLista = mysqli_query($conn, $sql)or die("erro no banco de dados");
        echo(" <script>alert('Registro Alterado com sucesso!')</script> ");    
    }        
    ?>
    <form action="cadastro.php" method="POST">
    <button type="submit" name="cadastroProfissionais">Cadastrar Novos Funcionario</button>
    </form>
    <form action="cadastro.php" method="post">
    <button type="submit" name='alt_func'>Pesquisar Funcionário</button>
    </form> 

    <?php require_once "footer.php"; ?>
    </body> 
    </html> 