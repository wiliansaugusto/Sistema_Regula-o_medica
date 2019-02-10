<?php
session_start();
 if($_SESSION[id]==2){                
                $_SESSION[loginErro] = "Você não tem premissão para acessar! <br> Refaça o seu login";
                header("Location: index.php");
}?>


<!DOCTYPE html>

<html>
    <head>
        <title>Pagina Atendente</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        
    </head>
    <body>
    <?php require_once "navbar.php"; ?>
  
                <div class="container">
                        <div class="container">
                                <div class="row">

                                    <div class="col-lg-12">
                                  
                <h1>Telefonista Auxiliar de Regulação Médica</h1>
                                        <hr>
                                        <?php
if(isset($_SESSION['nOrdem'])){
    $texto = $_SESSION['nOrdem'];
         echo ("
             <script>alert('Chamado salvo com Sucesso, numero de ordem: ' + $texto )</script>
         ");
  
}
 ?>

                        <br>

            <form method="POST" action="crud.php">
            <input type="hidden" name="exec" value="true"/>
            <table  border ="0" style="border-collapse: separate; border-spacing: 10px;" >
            <tr> 
            <td> Nome do Solicitante: <input type="text" name="nm_solicitante"></td> 
           <td>
           <select name="solicitante">
            <option type="hidden">Tipo de Solicitante</option>
            <option value="FAMILIAR">FAMILIAR</option>
            <option value="PRÓPRIO">PRÓPIO</option>
            <option value="TRANSEUNTE">TRANSEUNTE</option>
            <option value="POLÍCIA MILITAR">POLICIA MILITAR</option>
            <option value="CORPO DE BOMBEIROS">CORPO DE BOMBEIROS</option>
            <option value="GUARDA VIDAS">GUARDA VIDAS</option>
            <option value="GUARDA MUNICIPAL">GUARDA MUNICIPAL</option>
            <option value="SETRANS">SETRANS</option>
            <option value="OUTROS">OUTROS</option>
            </select>      
            </td>
               <td>Telefone do Solicitante: <input type="number" min="00000001" max="99999999999"name="tel_solicitante"></td> 
         </tr>
         <tr>
         <td>   <select name="logradouro">
                <option type="hidden" >Tipo Logradouro</option>
                <option value="Rua">Rua</option>
                <option value="avenida">Avenida</option>
                <option value="praca">Praça</option>
                <option value="beco">Beco</option>
                <option value="viela">Viela</option>
            </select></td>
                
                    <td> Endereço:  
                     <input placeholder="Digite o campo com nome da Rua/Avenida.." type="text" name="endereco" size=60></td>

                    <td> Numero:  
                    <input type="number" name="numRes"></td>
               </tr>
               <tr>
                    <td>Complemento:
                    <input type="text" name="comp"></td>
                    <td>Bairro:
                     <input type="text" name="bairro"></td> 
                    <td>Referência:
                    <input type="textarea" name="referencia" ></td>        
               </tr>
        </table>
                <br>

             <fieldset> 
                    <hr>
             <h4 > Tipo de Ocorrencia</h4>
             <table  border ="0" style="border-collapse: separate; border-spacing: 10px;" >
                <tr>
                <td>    
                <select name="sexo">
                <option type="hidden">Sexo Paciente</option>   
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>   
                <option value="Outros">Outros</option>
                </select>   
            </td>
        <td>Idade da Vitima: 
                       <input type="number" name="idade"></td>
                  <td>
        <select name="tp_ocorrencia" >
        <option type="hidden">Tipo da Ocorrência</option>   

        <option value="Paciente clinico Adulto">Paciente clinico Adulto</option>
        <option value="Paciente Pediático">Paciente Pediático</option>    
        <option value="Gineco/Obstetrico">Gineco/Obstetrico</option> 
        <option value="Paciente Psiquiatrico">Paciente Psiquiatrico</option>   
        <option value="Paciente Queimado">Paciente Queimado</option>
        <option value="Acidente de Trânsito">Acidente de Trânsito</option>
        <option value="Trauma">Trauma</option>
        <option value="Outros">Outros</option>
        </select> </td></tr> 
                 
        <tr><td><label for="fQeuixas">Queixas:</label></td></tr>
        <tr><td><textarea id="fQueixas"rows="5" cols="50" placeholder="Insera os detalhes informado pelo solicitante" name="msg"> </textarea></td></tr>
                        </table>
                        
             
                     </div>                  
                <br>
            </fieldset>          
        </table>
        <input type="submit" value="Salvar Ocorrência"> 
        </form>

                </div>
         </div>
    </div>
</div>
<br>
<br>
<!-- INÍCIO DO RODAPÉ -->
<?php require_once "footer.php"; ?>

<!-- FIM DO RODAPÉ -->

    </body>
</html>