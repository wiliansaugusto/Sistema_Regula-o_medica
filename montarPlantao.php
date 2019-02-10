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
            <title>Montar Plantão</title> 
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

if (isset($_POST['btn_plantao'])) {
    ?>
    <div class="container jumbotron">

    <h2>Cadastrar Equipes de plantão</h2>
    <form action='montarPlantao.php' method='POST'>
    <label for=''>Identificação de VTR: </label>
    <select name='nr_viatura' >
    <option hidden>Nome da Viatura </option>
    
<?php
  $sql="SELECT nr_viatura FROM tb_viatura WHERE vl_viatura_operacional =1  ";
  if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
  //Consultando banco de dados
  $qryLista = mysqli_query($conn, $sql);    
  while($resultado = mysqli_fetch_assoc($qryLista)){
      $vetor[] = array_map('utf8_encode', $resultado); 
  } 

$max = sizeof($vetor);
if($max == 0){
  echo ("<h2>Não há registros para exibir</h2>");
}
for($i = 0; $i < $max; $i++){
    echo("   
    <option value='".$vetor[$i]{nr_viatura}."'> ". $vetor[$i]{nr_viatura}."</option>
    ");
}
?>
    </select>


    <label for="">Tipo de VTR: </label>
    <select name='tp_viatura' >
    <option hidden>Tipo de Viatura </option>
    <option value='basica'>Básica</option>
    <option value='avancada'>Avançada</option>
    </select><br>

    <label for="">Periodo: </label>
    <select name='periodo' >
    <option hidden>Periodo do Plantão </option>
    <option value='diurno'>Diurno</option>
    <option value='noturno'>Noturno</option>
    </select><br>

    <label for=''>Identificação Condutor</label>
    <select name='nm_motorista' >
    <option hidden>Nome do Condutor </option>

<?php
  $sqlMot="SELECT nm_profissional FROM tb_profissional WHERE tp_profissional =5 ";
  if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
  //Consultando banco de dados
  $qryLista = mysqli_query($conn, $sqlMot);    
  while($resultado = mysqli_fetch_assoc($qryLista)){
      $vetorMot[] = array_map('utf8_encode', $resultado); 
  } 
  $maxMot = sizeof($vetorMot);
if($maxMot == 0){
  echo ("<h2>Não há registros para exibir</h2>");
}

for( $m =0; $m < $maxMot; $m++){
    
    echo("   
    <option value='".$vetorMot[$m]{nm_profissional}."'> ". $vetorMot[$m]{nm_profissional}."</option>
    ");
}
?>
    </select><br>

      <label for=''>Identificação Auxiliar de Enfermagem </label>
    <select name='nm_aux_enf' >
    <option hidden>Nome do Auxiliar de Enfermagem </option>

<?php
  $sqlAux="SELECT nm_profissional FROM tb_profissional WHERE tp_profissional =4 ";
  if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
  //Consultando banco de dados
  $qryLista = mysqli_query($conn, $sqlAux);    
  while($resultado = mysqli_fetch_assoc($qryLista)){
      $vetorAux[] = array_map('utf8_encode', $resultado); 
  } 

$maxAux = sizeof($vetorAux);
if($maxAux == 0){
  echo ("<h2>Não há registros para exibir</h2>");
}
for($j = 0; $j < $maxAux; $j++){
    echo("   
    <option value='".$vetorAux[$j]{nm_profissional}."'> ". $vetorAux[$j]{nm_profissional}."</option>
    ");
}
?>
    </select><br>


      <label for='nm_enfermeiro'>Identificação do Enfermeiro(a) </label>
    <select name='nm_enfermeiro' >
    <option hidden>Nome do Enfermeiro(a) </option>

<?php
  $sqlEnf="SELECT nm_profissional FROM tb_profissional WHERE tp_profissional =6 ";
  if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
  //Consultando banco de dados
  $qryLista = mysqli_query($conn, $sqlEnf);    
  while($resultado = mysqli_fetch_assoc($qryLista)){
      $vetorEnf[] = array_map('utf8_encode', $resultado); 
  } 

$maxEnf = sizeof($vetorEnf);
if($maxEnf == 0){
  echo (" <option value='Não há registros cadastrados'></option>");
}
for($e = 0; $e < $maxEnf; $e++){
    echo("   
    <option value='".$vetorEnf[$e]{nm_profissional}."'> ". $vetorEnf[$e]{nm_profissional}."</option>
    ");
}
?>
    </select><br>

    <label for='nm_med_intervencao'>Identificação do Medico(a) Intervencionista:  </label>
    <select name='nm_med_intervencao' >
    <option hidden>Nome do Médico(a) </option>

<?php
  $sqlMed="SELECT nm_profissional FROM tb_profissional WHERE tp_profissional = 2 ";
  if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
  //Consultando banco de dados
  $qryLista = mysqli_query($conn, $sqlMed);    
  while($resultado = mysqli_fetch_assoc($qryLista)){
      $vetorMed[] = array_map('utf8_encode', $resultado); 
  } 

$maxMed = sizeof($vetorMed);
if($maxMed == 0){
  echo (" <option value='Não há registros cadastrados'></option>");
}
for($med = 0; $med < $maxMed; $med++){
    echo("   
    <option value='".$vetorMed[$med]{nm_profissional}."'> ". $vetorMed[$med]{nm_profissional}."</option>
    ");
}
?>
    </select><br>

    <label for="">Disponibilidade </label>
    <select name='ativa' >
    <option hidden>Disponibilidade </option>
    <option value='1'>SIM</option>
    <option value='0'>BAIXADA</option>
    </select><br>

    <input type='submit' value='Salvar' name='btn_salvar'>
    
    </form>
    </div>
    <?php
}


if(isset($_POST['btn_salvar'])) { 
    
    $ativa = $_POST['ativa'];
    $nm_vtr =$_POST['nr_viatura'];
    $tp_viatura = $_POST['tp_viatura'];
    $nm_motorista = $_POST['nm_motorista'];
    $nm_aux_enf= $_POST['nm_aux_enf'];
    $nm_enfermeiro =$_POST['nm_enfermeiro'];
    $nm_med_intervencao = $_POST['nm_med_intervencao'];
    $periodo = $_POST['periodo'];


    $sql="INSERT INTO `tb_plantao` ( `nm_vtr`, `tp_viatura`, `nm_motorista`, 
    `nm_aux_enf`, `nm_enfermeiro`, `nm_med_intervencao`, `periodo`, ativa)
     VALUES ('$nm_vtr','$tp_viatura','$nm_motorista',
     '$nm_aux_enf','$nm_enfermeiro','$nm_med_intervencao', '$periodo',$ativa)";
    mysqli_query($conn,$sql) or die("Erro ao tentar cadastrar registro");
    echo(" <script>alert('Registro Salvo no Banco de Dados!')</script> ");
    
}

if (isset($_POST['alt_plantao_esp'])) {

    echo("<div class='container jumbotron'>
    <form action='montarPlantao.php' method='post'>
    <label for='nm'>Equipes no Plantão</label>
    <input type='number' value='' name='nm' />
    <label >Periodo: </label>
    <select name='periodo' >
    <option hidden>Periodo do Plantão </option>
    <option value='diurno'>Diurno</option>
    <option value='noturno'>Noturno</option>
    </select><br>
    <button name='alt_plantao_esp' type='submit'>Pesquisar</button>
    </form></div>");


    if(!isset($_POST['nm'])){

        echo("digite os dados acima");
        }else{
            $nm = $_POST['nm'];
            $periodo = $_POST['periodo'];
            $sql="SELECT * FROM `tb_plantao` WHERE periodo = '$periodo' AND `nm_vtr` LIKE '%$nm%'";
            if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
            //Consultando banco de dados
            $qryLista = mysqli_query($conn, $sql); 
            while($resultado = mysqli_fetch_assoc($qryLista)){
                $vetor[] = array_map('utf8_encode', $resultado); 
            } 

            $totalRegistro = mysqli_num_rows($qryLista);
            for($i = 0; $i < $totalRegistro-1 ; $i++){
                ?>    
            <div class="container jumbotron">
            <form action='montarPlantao.php' method='POST'>
            <input type="hidden" name="id_equipe"value='<?= $vetor[$i]{id_equipe}?>'>
            <label for='nr_vtr'>Nome de VTR</label>
            <select name="nm_vtr" >Nome da VTR
            <option value="<?= $vetor[$i]{nm_vtr}?>"><?=$vetor[$i]{nm_vtr}?></option>
            <?php
            $sql="SELECT nr_viatura FROM tb_viatura WHERE vl_viatura_operacional =1  ";
            if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
           //Consultando banco de dados
            $qryLista = mysqli_query($conn, $sql);    
            while($resultado = mysqli_fetch_assoc($qryLista)){
                $vetorVTR[] = array_map('utf8_encode', $resultado); 
            } 
            $totalRegistroVTR = mysqli_num_rows($qryLista);
            $maxVTR = sizeof($vetorVTR);

            if($maxVTR == 0){
            echo ("<h2>Não há registros para exibir</h2>");
            }

            for($k = 0; $k < $totalRegistroVTR; $k++){
            echo("   
            <option value='".$vetorVTR[$k]{nr_viatura}."'> ". $vetorVTR[$k]{nr_viatura}."</option>
                ");
            }
            ?>
            </select>

            <label for="">Tipo de VTR: </label>
            <select name='tp_viatura' >
            <option hidden>Tipo de Viatura </option>
            <option value='basica'>Básica</option>
            <option value='avancada'>Avançada</option>
            </select><br>

            <label for="">Periodo: </label>
            <select name='periodo' >
            <option hidden>Periodo do Plantão </option>
            <option value='diurno'>Diurno</option>
            <option value='noturno'>Noturno</option>
            </select><br>
            
            <label for='nm_motorista'>Nome do Motorista: </label>
            <select name="nm_motorista" id="">
            <option value="<?= $vetor[$i]{nm_motorista}?>"> <?= $vetor[$i]{nm_motorista}?> </option>
            <?php
            $sqlMot="SELECT nm_profissional FROM tb_profissional WHERE tp_profissional =5 ";
            if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
            //Consultando banco de dados
            $qryLista = mysqli_query($conn, $sqlMot);    
            while($resultado = mysqli_fetch_assoc($qryLista)){
                $vetorMot[] = array_map('utf8_encode', $resultado); 
            } 
            $TotalRegistrosMot = mysqli_num_rows($qryLista);
            $maxMot = sizeof($vetorMot);
            if($maxMot == 0){
            echo ("<h2>Não há registros para exibir</h2>");
            }
            for($m = 0; $m < $TotalRegistrosMot; $m++){
                echo("   
                <option value='".$vetorMot[$m]{nm_profissional}."'> ". $vetorMot[$m]{nm_profissional}."</option>
                ");
            }
            ?>
                </select><br>

            <label for='nm_aux_enf'>Nome do Auxiliar de Enfermagem</label>
            <select name="nm_aux_enf" >
            <option value="<?= $vetor[$i]{nm_aux_enf}?>"><?= $vetor[$i]{nm_aux_enf}?> </option>
            <?php
           $sqlAux="SELECT nm_profissional FROM tb_profissional WHERE tp_profissional =4 ";
            if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
            //Consultando banco de dados
            $qryLista = mysqli_query($conn, $sqlAux);    
            while($resultado = mysqli_fetch_assoc($qryLista)){
                $vetorAux[] = array_map('utf8_encode', $resultado); 

            }
            $totalRegistroAux =mysqli_num_rows($qryLista);
            $maxAux = sizeof($vetorAux);
            if($maxAux == 0){
            echo ("<h2>Não há registros para exibir</h2>");
            }
            for($j = 0; $j < $totalRegistroAux; $j++){
                echo("   
                <option value='".$vetorAux[$j]{nm_profissional}."'> ". $vetorAux[$j]{nm_profissional}."</option>
                ");
            }
            ?>
                </select> <br>
                <label for='nm_enfermeiro'>Nome do Enfermeiro</label>
                <select name="nm_enfermeiro" id="">
                <option value="<?= $vetor[$i]{nm_enfermeiro}?>"><?= $vetor[$i]{nm_enfermeiro}?></option>
                <?php
            $sqlEnf="SELECT nm_profissional FROM tb_profissional WHERE tp_profissional =6 ";
            if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
            //Consultando banco de dados
            $qryLista = mysqli_query($conn, $sqlEnf);    
            while($resultado = mysqli_fetch_assoc($qryLista)){
                $vetorEnf[] = array_map('utf8_encode', $resultado); 
            } 
            $totalRegistroEnf = mysqli_num_rows($qryLista);
            $maxEnf = sizeof($vetorEnf);
            if($maxEnf == 0){
            echo (" <option value='Não há registros cadastrados'></option>");
        }
        for($e = 0; $e < $totalRegistroEnf; $e++){
            echo("   
            <option value='".$vetorEnf[$e]{nm_profissional}."'> ". $vetorEnf[$e]{nm_profissional}."</option>
            ");
        }
        ?>
        </select><br>

            <label for='nm_med_intervencao'>Nome do Médico Intervencionista</label>
            <select name="nm_med_intervencao">
            <option value="<?= $vetor[$i]{nm_med_intervencao}?>"><?= $vetor[$i]{nm_med_intervencao}?></option>
            <?php
        $sqlMed="SELECT nm_profissional FROM tb_profissional WHERE tp_profissional = 2 ";
        if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
        //Consultando banco de dados
        $qryLista = mysqli_query($conn, $sqlMed);    
        while($resultado = mysqli_fetch_assoc($qryLista)){
            $vetorMed[] = array_map('utf8_encode', $resultado); 
        } 
        $totalRegistroMed =  mysqli_num_rows($qryLista);
        $maxMed = sizeof($vetorMed);
        if($maxMed == 0){
        echo (" <option value='Não há registros cadastrados'></option>");
        }
        for($med = 0; $med < $totalRegistroMed; $med++){
            echo("   
            <option value='".$vetorMed[$med]{nm_profissional}."'> ". $vetorMed[$med]{nm_profissional}."</option>
            ");
        }
        ?>
            
            </select><br>
            <label for="">Disponibilidade </label>
            <select name='ativa' >
            <option hidden>Disponibilidade </option>
            <option value='1'>SIM</option>
            <option value='0'>BAIXADA</option>
            </select><br>
            
            <br>
            <input type='submit' value='Salvar' name='btn_alt '>
            <input type='submit' value='Excluir' name='btn_excluir'>      
            </div>
            </form>
        <?php
        }
        }
        }
        ?>

<?php

if (isset($_POST['alt_plantao'])) {
    echo(" <h2>Equipes de plantão</h2> ");
    $sql="SELECT * FROM `tb_plantao` ";
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
    <div class="container jumbotron">
    <form action='montarPlantao.php' method='POST'>
    <input type="hidden" name="id_equipe"value='<?= $vetor[$i]{id_equipe}?>'>
    <label for='nr_vtr'>Nome de VTR</label>
    <select name="nm_vtr" >Nome da VTR
    <option value="<?= $vetor[$i]{nm_vtr}?>"><?=$vetor[$i]{nm_vtr}?></option>
    <?php
    $sql="SELECT nr_viatura FROM tb_viatura WHERE vl_viatura_operacional =1  ";
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
  //Consultando banco de dados
    $qryLista = mysqli_query($conn, $sql);    
    while($resultado = mysqli_fetch_assoc($qryLista)){
        $vetorVTR[] = array_map('utf8_encode', $resultado); 
    } 
$totalRegistroVTR = mysqli_num_rows($qryLista);
$maxVTR = sizeof($vetorVTR);
if($maxVTR == 0){
  echo ("<h2>Não há registros para exibir</h2>");
}

for($k = 0; $k < $totalRegistroVTR; $k++){
    echo("   
    <option value='".$vetorVTR[$k]{nr_viatura}."'> ". $vetorVTR[$k]{nr_viatura}."</option>
    ");
}
?>
    </select>

    <label for="">Tipo de VTR: </label>
    <select name='tp_viatura' >
    <option hidden>Tipo de Viatura </option>
    <option value='basica'>Básica</option>
    <option value='avancada'>Avançada</option>
    </select><br>

    <label for="">Periodo: </label>
    <select name='periodo' >
    <option hidden>Periodo do Plantão </option>
    <option value='diurno'>Diurno</option>
    <option value='noturno'>Noturno</option>
    </select><br>
    
    <label for='nm_motorista'>Nome do Motorista: </label>
    <select name="nm_motorista" id="">
    <option value="<?= $vetor[$i]{nm_motorista}?>"> <?= $vetor[$i]{nm_motorista}?> </option>
    <?php
  $sqlMot="SELECT nm_profissional FROM tb_profissional WHERE tp_profissional =5 ";
  if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
  //Consultando banco de dados
  $qryLista = mysqli_query($conn, $sqlMot);    
  while($resultado = mysqli_fetch_assoc($qryLista)){
      $vetorMot[] = array_map('utf8_encode', $resultado); 
  } 
$TotalRegistrosMot = mysqli_num_rows($qryLista);
$maxMot = sizeof($vetorMot);
if($maxMot == 0){
  echo ("<h2>Não há registros para exibir</h2>");
}
for($m = 0; $m < $TotalRegistrosMot; $m++){
    echo("   
    <option value='".$vetorMot[$m]{nm_profissional}."'> ". $vetorMot[$m]{nm_profissional}."</option>
    ");
}
?>
    </select><br>

    <label for='nm_aux_enf'>Nome do Auxiliar de Enfermagem</label>
    <select name="nm_aux_enf" >
    <option value="<?= $vetor[$i]{nm_aux_enf}?>"><?= $vetor[$i]{nm_aux_enf}?> </option>
    <?php
  $sqlAux="SELECT nm_profissional FROM tb_profissional WHERE tp_profissional =4 ";
  if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
  //Consultando banco de dados
  $qryLista = mysqli_query($conn, $sqlAux);    
  while($resultado = mysqli_fetch_assoc($qryLista)){
      $vetorAux[] = array_map('utf8_encode', $resultado); 

  }
  $totalRegistroAux =mysqli_num_rows($qryLista);
$maxAux = sizeof($vetorAux);
if($maxAux == 0){
  echo ("<h2>Não há registros para exibir</h2>");
}
for($j = 0; $j < $totalRegistroAux; $j++){
    echo("   
    <option value='".$vetorAux[$j]{nm_profissional}."'> ". $vetorAux[$j]{nm_profissional}."</option>
    ");
}
?>
    </select> <br>
    <label for='nm_enfermeiro'>Nome do Enfermeiro</label>
    <select name="nm_enfermeiro" id="">
    <option value="<?= $vetor[$i]{nm_enfermeiro}?>"><?= $vetor[$i]{nm_enfermeiro}?></option>
    <?php
  $sqlEnf="SELECT nm_profissional FROM tb_profissional WHERE tp_profissional =6 ";
  if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
  //Consultando banco de dados
  $qryLista = mysqli_query($conn, $sqlEnf);    
  while($resultado = mysqli_fetch_assoc($qryLista)){
      $vetorEnf[] = array_map('utf8_encode', $resultado); 
  } 
$totalRegistroEnf = mysqli_num_rows($qryLista);
$maxEnf = sizeof($vetorEnf);
if($maxEnf == 0){
  echo (" <option value='Não há registros cadastrados'></option>");
}
for($e = 0; $e < $totalRegistroEnf; $e++){
    echo("   
    <option value='".$vetorEnf[$e]{nm_profissional}."'> ". $vetorEnf[$e]{nm_profissional}."</option>
    ");
}
?>
</select><br>

    <label for='nm_med_intervencao'>Nome do Médico Intervencionista</label>
    <select name="nm_med_intervencao">
    <option value="<?= $vetor[$i]{nm_med_intervencao}?>"><?= $vetor[$i]{nm_med_intervencao}?></option>
    <?php
  $sqlMed="SELECT nm_profissional FROM tb_profissional WHERE tp_profissional = 2 ";
  if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
  //Consultando banco de dados
  $qryLista = mysqli_query($conn, $sqlMed);    
  while($resultado = mysqli_fetch_assoc($qryLista)){
      $vetorMed[] = array_map('utf8_encode', $resultado); 
  } 
$totalRegistroMed =  mysqli_num_rows($qryLista);
$maxMed = sizeof($vetorMed);
if($maxMed == 0){
  echo (" <option value='Não há registros cadastrados'></option>");
}
for($med = 0; $med < $totalRegistroMed; $med++){
    echo("   
    <option value='".$vetorMed[$med]{nm_profissional}."'> ". $vetorMed[$med]{nm_profissional}."</option>
    ");
}
?>
    
    </select><br>
    <label for="">Disponibilidade </label>
    <select name='ativa' >
    <option hidden>Disponibilidade </option>
    <option value='1'>SIM</option>
    <option value='0'>BAIXADA</option>
    </select><br>
    
    <br>
    <input type='submit' value='Salvar ' name='btn_alt'>
    <input type='submit' value='Excluir ' name='btn_excluir'>      
    </form></div>   
<?php
}

if (isset($_POST['btn_excluir'])) {
    
    $id_equipe = $_POST['id_equipe'];
    $sqlDelete =("DELETE FROM `tb_plantao` WHERE `id_equipe` = $id_equipe");
    $qryDelete = mysqli_query($conn, $sqlDelete);    
    echo("<script>alert(' Registro deletado com sucesso')</script>");
   }
   
if (isset($_POST['btn_alt'])) {
    
    $id_equipe = $_POST['id_equipe'];
    $nm_vtr = $_POST['nm_vtr'];
    $tp_viatura=$_POST['tp_viatura'];
    $nm_motorista=$_POST['nm_motorista'];
    $nm_aux_enf = $_POST['nm_aux_enf'];
    $nm_enfermeiro = $_POST['nm_enfermeiro'];
    $nm_med_intervencao = $_POST['nm_med_intervencao'];
    $ativa=$_POST['ativa'];
    $periodo = $_POST['periodo'];
    $sql="UPDATE tb_plantao SET nm_vtr='$nm_vtr' , tp_viatura ='$tp_viatura', nm_motorista ='$nm_motorista',
    nm_aux_enf = '$nm_aux_enf', nm_enfermeiro = '$nm_enfermeiro', nm_med_intervencao ='$nm_med_intervencao'
    ,periodo='$periodo', ativa='$ativa'
    where id_equipe = $id_equipe";
    $qryLista = mysqli_query($conn, $sql)or die("erro no banco de dados");
}        
?>

<div class=" jumbotron">
    <div class="container ">
        <form action="montarPlantao.php" method="POST">
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="btn_plantao">Inserir Equipes</button>
        </form>
        <form action="montarPlantao.php" method="post">
        <button class="btn btn-primary btn-lg btn-block" type="submit" name='alt_plantao_esp'>Pesquisar Equipes Especificas</button>
        </form> 
        <form method="POST" action="montarPlantao.php" onSubmit="openForm('about:blank','popup',  top=70')" target="popup" >
        <button class="btn btn-primary btn-lg btn-block" name="alt_plantao">Plantão</button>
        </form>
    </div>
</div>

<?php require_once "footer.php"; ?>
</body> 
</html> 