<?php
session_start();
require('conexao.php');
 if($_SESSION[id]==2){                
                $_SESSION[loginErro] = "Você não tem premissão para acessar! <br> Refaça o seu login";
                header("Location: index.php");
              }
            

            $sql="SELECT * FROM `tb_plantao` WHERE ativa =1 ";
            if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
            $qryLista = mysqli_query($conn, $sql);
            while($resultado = mysqli_fetch_assoc($qryLista)){
                $vetorVTR[] = array_map('utf8_encode', $resultado); 
            } 
            
            $totalRegistroVTR = mysqli_num_rows($qryLista);
            $totalRegistroVTR ;
            ?>

<!DOCTYPE html>
    <head> 
        <title>Radio Operador</title> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <link rel="stylesheet" href="../css/estilo.css">
        <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


        <script src="../jquery/jquery.min.js"></script>
      
        </head> 

        <script language=javascript>    
         document.onkeydown = function () { 
           switch (event.keyCode) {
             case 116 :  
                event.returnValue = false;
                event.keyCode = 0;           
                return false;             
              case 82 : 
                if (event.ctrlKey) {  
                   event.returnValue = false;
                  event.keyCode = 0;             
                  return false;
           }
         }
     } 
     </script>


<script>
var equipes= [];

var tabelaUno= [];
var tabelaDois =[];
setInterval(function(){

   
    $.ajax({
		type:'post',		//Definimos o método HTTP usado
		dataType: 'json',	//Definimos o tipo de retorno
		url: 'getDadosROP.php',//Definindo o arquivo onde serão buscados os dados
		success: function(dados){
    for(var i=0;dados.length !=i;i++){
    tabelaDois.push(
    dados[i].id_ocorrencia
    );
    }     


    for (let i = 0; i < tabelaUno.length; i++) {
    for (let j = 0; j < dados.length; j++) {
            if(tabelaUno[i]== dados[j].id_ocorrencia){
                dados[j].id_ocorrencia =0;
       }        
    }  
}

tabelaUno = tabelaDois;
tabelaDois=[];
    for (let i = 0; i < dados.length; i++) { 
if(dados[i].id_ocorrencia > 0){
  alert("Novo Chamado numeral de ordem: "+dados[i].id_ocorrencia+
  " Prioridade: "+dados[i].prioridade);
   
if (dados[i].prioridade == "alta") {
    $('#alta').append(

'<div class="container interno" id="'+i+'_div" >'+
'<form onsubmit="enviarDados(this.id)" id="'+i+' "method="POST">'+
'<div  data-toggle="collapse" data-target="#'+i+'_col">'+
'<input hidden type="text" name="id_ocorrencia" value="'+dados[i].id_ocorrencia+'"/>'+
'<table border="2">'+
'<tr><th>Numero de ordem</th> <th>Tipo da Ocorrência </th>'+
'<th>Numero de Telefone</th> <th>Logradouro</th> '+
'<th>Nome Logradouro</th><th>Numero residência</th></tr>'+
'<tr><td ><label id="id_ocorrencia">'+dados[i].id_ocorrencia+'</label></td>'+
'<td>'+dados[i].tp_ocorrencia+ '</td>'+
'<td>'+dados[i].nr_telefone+'</td>'+
'<td>'+dados[i].tp_logradouro+'</td>'+
'<td>'+dados[i].nm_endereco+'</td>'+
'<td>'+dados[i].num_enderco+'</td></tr><tr>'+
'<th>Complemento</th> <th>Bairro</th> <th>Referência</th> <th>Nome do Médico</th></tr> '+
'<tr><td>'+dados[i].ds_complemento+'</td>'+
'<td>'+dados[i].nm_bairro+'</td>'+
'<td>'+dados[i].ref_endereco+'</td>'+
'<td>'+dados[i].nm_medico_reg+'</td></tr>'+
'<tr><th>Diagnostico Médico</th></tr>'+   
'<tr><td>'+dados[i].diagnostico+'</td></tr></table></div>'+
'<table border="2";border-collapse: separate; border-spacing: 10px;" >'+
'<select  id="'+(i+"_opt")+'"  onmouseenter="getOption(this.id)" name="nm_equipe" >'+
'<option hidden>Equipes</option>'+
'</select><span id="'+(i+"_lbl")+'"></span>'+
'<tr><td><input type="text" name="acionamento" id="'+(i+"a_txt")+'" value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"a_btn")+'"  onclick="getTime(this.id)"> Acionamento</button> </td>'+
'<td><input type="text" name="chegadaOrigem" id="'+(i+"b_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"b_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Local</button></td>'+
'<td><input type="text" name="saidaLocal" id="'+(i+"c_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"c_btn")+'" type="button" onclick="getTime(this.id)">Saida do Local</button></td>'+
'<td><input type="text" name="chegadaDestino" id="'+(i+"d_txt")+'"value="" size="15"></td>'+
'<td><button id="'+(i+"d_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Destino</button></td></tr>'+
'<td><button id="'+(i+"e_btn")+'" type="button" onclick="getTime(this.id)">Saida no Destino</button></td>'+
'<tr><td><input type="text" name="saidaDestino" id="'+(i+"e_txt")+'"value="" size="15"></td>'+
'<td><input type="text" name="qrv" id="'+(i+"f_txt")+'"value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"f_btn")+'" type="button" onclick="getTime(this.id)">QRV</button><br></td></tr></table>'+
'<div id="'+i+'_col" class="collapse">'+
'<h4>Acionamentos de Múltiplos Meios</h4>'+
'<table border="2" ;"border-collapse: separate; border-spacing: 10px;" >'+
'<tr><td><label >Bombeiros</label></td>'+
'<td><input type="text" name="bombeiros" id="'+(i+"g_txt")+'"value="" size="15"></td>'+
'<td><button id="'+(i+"g_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button></td></tr>'+
'<tr><td><label>Policia</label></td>'+
'<td><input type="text" name="policia" id="'+(i+"h_txt")+'"value="" size="15">  </td>'+
'<td><button id="'+(i+"h_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button><br></td></tr>'+
'<tr><td><label >CET</label>'+
'<td><input type="text" name="cet" id="'+(i+"i_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"i_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button></td></tr>'+
'<tr><td colspan="4"><label>Observações: </label> <textarea id="obs"rows="5" cols="50" placeholder="Observações" name="multiplos_meios"> </textarea></td></tr></table>'+
'<h2>Dados Fornecidos pela Equipe<h2/>'+
'<table border="2" ;"border-collapse: separate; border-spacing: 10px;" >'+
'<tr><td colspan="4"><label>Observações: </label><textarea id="obs"rows="5" cols="50" placeholder="Observações fornecidas pela equipe" name="msg"> </textarea></td></tr>'+
'<tr><td><label>Pressão Arterial</label> '+
'<input name="paAlta"type="number"/>X<input name="paBaixa" type="number"/></td>'+
'<td><label>F. Cardiaca:</label>'+
'<input name="fCardiaca" type="number"/></td>'+
'<td><label>Respiratoria: </label>'+
'<input type="number"name="fRespiratoria"/></td>'+
'<td><label>Dextro</label>'+
'<input type="number" name="dextro"/></td></tr>'+
'<tr><td><label>Saturação</label>'+
'<input type="number"name="sat"></td>'+
'<td><label>Glasgow</label>'+
'<input type="number" name="glasgow"/></td></tr>'+
'<tr><td><label>Unidade de Destino</label> <input type="text" name="unidade" value=""></td>'+
'<td><input type="text" name="qta" id="'+(i+"j_txt")+'"value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"j_btn")+'" type="button" onclick="getTime(this.id)">QTA</button><br></td></tr></table>'+
'<input type="submit" id="enviar" value="Finalizar Ocorrência"/></form>' +
'</table></div></div>'

               );
}else if(dados[i].prioridade == "media"){
    $('#media').append(

'<div class="container interno" id="'+i+'_div" >'+
'<form onsubmit="enviarDados(this.id)" id="'+i+' "method="POST">'+
'<div  data-toggle="collapse" data-target="#'+i+'_col">'+
'<input hidden type="text" name="id_ocorrencia" value="'+dados[i].id_ocorrencia+'"/>'+
'<table border="2">'+
'<tr><th>Numero de ordem</th> <th>Tipo da Ocorrência </th>'+
'<th>Numero de Telefone</th> <th>Logradouro</th> '+
'<th>Nome Logradouro</th><th>Numero residência</th></tr>'+
'<tr><td ><label id="id_ocorrencia">'+dados[i].id_ocorrencia+'</label></td>'+
'<td>'+dados[i].tp_ocorrencia+ '</td>'+
'<td>'+dados[i].nr_telefone+'</td>'+
'<td>'+dados[i].tp_logradouro+'</td>'+
'<td>'+dados[i].nm_endereco+'</td>'+
'<td>'+dados[i].num_enderco+'</td></tr><tr>'+
'<th>Complemento</th> <th>Bairro</th> <th>Referência</th> <th>Nome do Médico</th></tr> '+
'<tr><td>'+dados[i].ds_complemento+'</td>'+
'<td>'+dados[i].nm_bairro+'</td>'+
'<td>'+dados[i].ref_endereco+'</td>'+
'<td>'+dados[i].nm_medico_reg+'</td></tr>'+
'<tr><th>Diagnostico Médico</th></tr>'+   
'<tr><td>'+dados[i].diagnostico+'</td></tr></table></div>'+
'<table border="2";border-collapse: separate; border-spacing: 10px;" >'+
'<select  id="'+(i+"_opt")+'"  onmouseenter="getOption(this.id)" name="nm_equipe" >'+
'<option hidden>Equipes</option>'+
'</select><span id="'+(i+"_lbl")+'"></span>'+
'<tr><td><input type="text" name="acionamento" id="'+(i+"a_txt")+'" value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"a_btn")+'"  onclick="getTime(this.id)"> Acionamento</button> </td>'+
'<td><input type="text" name="chegadaOrigem" id="'+(i+"b_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"b_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Local</button></td>'+
'<td><input type="text" name="saidaLocal" id="'+(i+"c_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"c_btn")+'" type="button" onclick="getTime(this.id)">Saida do Local</button></td>'+
'<td><input type="text" name="chegadaDestino" id="'+(i+"d_txt")+'"value="" size="15"></td>'+
'<td><button id="'+(i+"d_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Destino</button></td></tr>'+
'<td><button id="'+(i+"e_btn")+'" type="button" onclick="getTime(this.id)">Saida no Destino</button></td>'+
'<tr><td><input type="text" name="saidaDestino" id="'+(i+"e_txt")+'"value="" size="15"></td>'+
'<td><input type="text" name="qrv" id="'+(i+"f_txt")+'"value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"f_btn")+'" type="button" onclick="getTime(this.id)">QRV</button><br></td></tr></table>'+
'<div id="'+i+'_col" class="collapse">'+
'<h4>Acionamentos de Múltiplos Meios</h4>'+
'<table border="2" ;"border-collapse: separate; border-spacing: 10px;" >'+
'<tr><td><label >Bombeiros</label></td>'+
'<td><input type="text" name="bombeiros" id="'+(i+"g_txt")+'"value="" size="15"></td>'+
'<td><button id="'+(i+"g_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button></td></tr>'+
'<tr><td><label>Policia</label></td>'+
'<td><input type="text" name="policia" id="'+(i+"h_txt")+'"value="" size="15">  </td>'+
'<td><button id="'+(i+"h_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button><br></td></tr>'+
'<tr><td><label >CET</label>'+
'<td><input type="text" name="cet" id="'+(i+"i_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"i_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button></td></tr>'+
'<tr><td colspan="4"><label>Observações: </label> <textarea id="obs"rows="5" cols="50" placeholder="Observações" name="multiplos_meios"> </textarea></td></tr></table>'+
'<h2>Dados Fornecidos pela Equipe<h2/>'+
'<table border="2" ;"border-collapse: separate; border-spacing: 10px;" >'+
'<tr><td colspan="4"><label>Observações: </label><textarea id="obs"rows="5" cols="50" placeholder="Observações fornecidas pela equipe" name="msg"> </textarea></td></tr>'+
'<tr><td><label>Pressão Arterial</label> '+
'<input name="paAlta"type="number"/>X<input name="paBaixa" type="number"/></td>'+
'<td><label>F. Cardiaca:</label>'+
'<input name="fCardiaca" type="number"/></td>'+
'<td><label>Respiratoria: </label>'+
'<input type="number"name="fRespiratoria"/></td>'+
'<td><label>Dextro</label>'+
'<input type="number" name="dextro"/></td></tr>'+
'<tr><td><label>Saturação</label>'+
'<input type="number"name="sat"></td>'+
'<td><label>Glasgow</label>'+
'<input type="number" name="glasgow"/></td></tr>'+
'<tr><td><label>Unidade de Destino</label> <input type="text" name="unidade" value=""></td>'+
'<td><input type="text" name="qta" id="'+(i+"j_txt")+'"value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"j_btn")+'" type="button" onclick="getTime(this.id)">QTA</button><br></td></tr></table>'+
'<input type="submit" id="enviar" value="Finalizar Ocorrência"/></form>' +
'</table></div></div>'
               );

}else{
    $('#baixa').append(
        '<div class="container interno" id="'+i+'_div" >'+
'<form onsubmit="enviarDados(this.id)" id="'+i+' "method="POST">'+
'<div  data-toggle="collapse" data-target="#'+i+'_col">'+
'<input hidden type="text" name="id_ocorrencia" value="'+dados[i].id_ocorrencia+'"/>'+
'<table border="2">'+
'<tr><th>Numero de ordem</th> <th>Tipo da Ocorrência </th>'+
'<th>Numero de Telefone</th> <th>Logradouro</th> '+
'<th>Nome Logradouro</th><th>Numero residência</th></tr>'+
'<tr><td ><label id="id_ocorrencia">'+dados[i].id_ocorrencia+'</label></td>'+
'<td>'+dados[i].tp_ocorrencia+ '</td>'+
'<td>'+dados[i].nr_telefone+'</td>'+
'<td>'+dados[i].tp_logradouro+'</td>'+
'<td>'+dados[i].nm_endereco+'</td>'+
'<td>'+dados[i].num_enderco+'</td></tr><tr>'+
'<th>Complemento</th> <th>Bairro</th> <th>Referência</th> <th>Nome do Médico</th></tr> '+
'<tr><td>'+dados[i].ds_complemento+'</td>'+
'<td>'+dados[i].nm_bairro+'</td>'+
'<td>'+dados[i].ref_endereco+'</td>'+
'<td>'+dados[i].nm_medico_reg+'</td></tr>'+
'<tr><th>Diagnostico Médico</th></tr>'+   
'<tr><td>'+dados[i].diagnostico+'</td></tr></table></div>'+
'<table border="2";border-collapse: separate; border-spacing: 10px;" >'+
'<select  id="'+(i+"_opt")+'"  onmouseenter="getOption(this.id)" name="nm_equipe" >'+
'<option hidden>Equipes</option>'+
'</select><span id="'+(i+"_lbl")+'"></span>'+
'<tr><td><input type="text" name="acionamento" id="'+(i+"a_txt")+'" value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"a_btn")+'"  onclick="getTime(this.id)"> Acionamento</button> </td>'+
'<td><input type="text" name="chegadaOrigem" id="'+(i+"b_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"b_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Local</button></td>'+
'<td><input type="text" name="saidaLocal" id="'+(i+"c_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"c_btn")+'" type="button" onclick="getTime(this.id)">Saida do Local</button></td>'+
'<td><input type="text" name="chegadaDestino" id="'+(i+"d_txt")+'"value="" size="15"></td>'+
'<td><button id="'+(i+"d_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Destino</button></td></tr>'+
'<td><button id="'+(i+"e_btn")+'" type="button" onclick="getTime(this.id)">Saida no Destino</button></td>'+
'<tr><td><input type="text" name="saidaDestino" id="'+(i+"e_txt")+'"value="" size="15"></td>'+
'<td><input type="text" name="qrv" id="'+(i+"f_txt")+'"value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"f_btn")+'" type="button" onclick="getTime(this.id)">QRV</button><br></td></tr></table>'+
'<div id="'+i+'_col" class="collapse">'+
'<h4>Acionamentos de Múltiplos Meios</h4>'+
'<table border="2" ;"border-collapse: separate; border-spacing: 10px;" >'+
'<tr><td><label >Bombeiros</label></td>'+
'<td><input type="text" name="bombeiros" id="'+(i+"g_txt")+'"value="" size="15"></td>'+
'<td><button id="'+(i+"g_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button></td></tr>'+
'<tr><td><label>Policia</label></td>'+
'<td><input type="text" name="policia" id="'+(i+"h_txt")+'"value="" size="15">  </td>'+
'<td><button id="'+(i+"h_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button><br></td></tr>'+
'<tr><td><label >CET</label>'+
'<td><input type="text" name="cet" id="'+(i+"i_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"i_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button></td></tr>'+
'<tr><td colspan="4"><label>Observações: </label> <textarea id="obs"rows="5" cols="50" placeholder="Observações" name="multiplos_meios"> </textarea></td></tr></table>'+
'<h2>Dados Fornecidos pela Equipe<h2/>'+
'<table border="2" ;"border-collapse: separate; border-spacing: 10px;" >'+
'<tr><td colspan="4"><label>Observações: </label><textarea id="obs"rows="5" cols="50" placeholder="Observações fornecidas pela equipe" name="msg"> </textarea></td></tr>'+
'<tr><td><label>Pressão Arterial</label> '+
'<input name="paAlta"type="number"/>X<input name="paBaixa" type="number"/></td>'+
'<td><label>F. Cardiaca:</label>'+
'<input name="fCardiaca" type="number"/></td>'+
'<td><label>Respiratoria: </label>'+
'<input type="number"name="fRespiratoria"/></td>'+
'<td><label>Dextro</label>'+
'<input type="number" name="dextro"/></td></tr>'+
'<tr><td><label>Saturação</label>'+
'<input type="number"name="sat"></td>'+
'<td><label>Glasgow</label>'+
'<input type="number" name="glasgow"/></td></tr>'+
'<tr><td><label>Unidade de Destino</label> <input type="text" name="unidade" value=""></td>'+
'<td><input type="text" name="qta" id="'+(i+"j_txt")+'"value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"j_btn")+'" type="button" onclick="getTime(this.id)">QTA</button><br></td></tr></table>'+
'<input type="submit" id="enviar" value="Finalizar Ocorrência"/></form>' +
'</table></div></div>'
               );
}
}
}
        }
	})
  },7000);


function enviarDados(id_){
event.preventDefault();

    let id_ocorrencia = document.getElementById(id_).elements.namedItem('id_ocorrencia').value;
    let acionamento = document.getElementById(id_).elements.namedItem('acionamento').value;
    let multiplos_meios = document.getElementById(id_).elements.namedItem('multiplos_meios').value;
    let chegadaOrigem = document.getElementById(id_).elements.namedItem('chegadaOrigem').value;;
    let saidaLocal = document.getElementById(id_).elements.namedItem('saidaLocal').value;
    let chegadaDestino = document.getElementById(id_).elements.namedItem('chegadaDestino').value;
    let saidaDestino =document.getElementById(id_).elements.namedItem('saidaDestino').value;
    let qrv = document.getElementById(id_).elements.namedItem('qrv').value;
    let bombeiros =document.getElementById(id_).elements.namedItem('bombeiros').value;
    let policia = document.getElementById(id_).elements.namedItem('policia').value;
    let cet = document.getElementById(id_).elements.namedItem('cet').value;
    let sat= document.getElementById(id_).elements.namedItem('sat').value;
    let paAlta= document.getElementById(id_).elements.namedItem('paAlta').value;
    let paBaixa = document.getElementById(id_).elements.namedItem('paBaixa').value;
    let dextro = document.getElementById(id_).elements.namedItem('dextro').value;
    let glasgow = document.getElementById(id_).elements.namedItem('glasgow').value;
    let fCardiaca = document.getElementById(id_).elements.namedItem('fCardiaca').value;
    let fRespiratoria = document.getElementById(id_).elements.namedItem('fRespiratoria').value;
    let msg = document.getElementById(id_).elements.namedItem('msg').value;
    let  unidade = document.getElementById(id_).elements.namedItem('unidade').value;
    let qta = document.getElementById(id_).elements.namedItem('qta').value;
    let nome_equipe= document.getElementById(id_).elements.namedItem('nome_equipe').value;
    let nm_motorista= document.getElementById(id_).elements.namedItem('nm_motorista').value;
    let nm_aux_enf= document.getElementById(id_).elements.namedItem('nm_aux_enf').value;
    let nm_enfermeiro= document.getElementById(id_).elements.namedItem('nm_enfermeiro').value;
    let nm_med_intervencao= document.getElementById(id_).elements.namedItem('nm_med_intervencao').value;
    let suporte = document.getElementById(id_).elements.namedItem('suporte').value;
alert("noem "+ nome_equipe);
alert(nm_motorista);
        $.ajax({
            url: "updateReg.php",
            method: "POST",
            dataType: "html",
            data: {
            suporte : suporte,    
            nome_equipe : nome_equipe,
            nm_motorista : nm_motorista,
            nm_aux_enf : nm_aux_enf,
            nm_enfermeiro: nm_enfermeiro,
            nm_med_intervencao : nm_med_intervencao,
            id_ocorrencia : id_ocorrencia,
            acionamento : acionamento,
            multiplos_meios : multiplos_meios,
            chegadaOrigem : chegadaOrigem,
            saidaLocal : saidaLocal,
            chegadaDestino :chegadaDestino,
            saidaDestino : saidaDestino,
            qrv : qrv,
            bombeiros : bombeiros,
            policia : policia,
            cet : cet,
            sat: sat,
            paAlta:  paAlta,
            paBaixa: paBaixa,
            dextro: dextro,
            glasgow: glasgow,
            fCardiaca: fCardiaca,
            fRespiratoria : fRespiratoria,
            msg : msg,
            unidade : unidade,
            qta : qta
            
            }
        }).done(function(data){
             //faz algo quando enviar certo 
             alert("Chamado Gravado com Sucesso!");
             document.getElementById(id_).style.display = 'none';

        }).fail(function(data){
            //faz algo quando der errado
            alert("sistema apresenta falhas");
        });  
   


}

$(document).ready(function(){
	$.ajax({
		type:'post',		//Definimos o método HTTP usado
		dataType: 'json',	//Definimos o tipo de retorno
		url: 'getDadosROP.php',//Definindo o arquivo onde serão buscados os dados
		success: function(dados){
var limite = dados.length;
		for(var i=0;limite !=i;i++){
tabelaUno.push(
 dados[i].id_ocorrencia
);
	//Adicionando registros retornados na tabela
	if (dados[i].prioridade == "alta") {
    $('#alta').append(

'<div class="container interno" id="'+i+'_div" >'+
'<form onsubmit="enviarDados(this.id)" id="'+i+' "method="POST">'+
'<div  data-toggle="collapse" data-target="#'+i+'_col">'+
'<input hidden type="text" name="id_ocorrencia" value="'+dados[i].id_ocorrencia+'"/>'+
'<table border="2">'+
'<tr><th>Numero de ordem</th> <th>Tipo da Ocorrência </th>'+
'<th>Numero de Telefone</th> <th>Logradouro</th> '+
'<th>Nome Logradouro</th><th>Numero residência</th></tr>'+
'<tr><td ><label id="id_ocorrencia">'+dados[i].id_ocorrencia+'</label></td>'+
'<td>'+dados[i].tp_ocorrencia+ '</td>'+
'<td>'+dados[i].nr_telefone+'</td>'+
'<td>'+dados[i].tp_logradouro+'</td>'+
'<td>'+dados[i].nm_endereco+'</td>'+
'<td>'+dados[i].num_enderco+'</td></tr><tr>'+
'<th>Complemento</th> <th>Bairro</th> <th>Referência</th> <th>Nome do Médico</th></tr> '+
'<tr><td>'+dados[i].ds_complemento+'</td>'+
'<td>'+dados[i].nm_bairro+'</td>'+
'<td>'+dados[i].ref_endereco+'</td>'+
'<td>'+dados[i].nm_medico_reg+'</td></tr>'+
'<tr><th>Diagnostico Médico</th></tr>'+   
'<tr><td>'+dados[i].diagnostico+'</td></tr></table></div>'+
'<table border="2";border-collapse: separate; border-spacing: 10px;" >'+
'<select  id="'+(i+"_opt")+'"  onmouseenter="getOption(this.id)" name="nm_equipe" >'+
'<option hidden>Equipes</option>'+
'</select><span id="'+(i+"_lbl")+'"></span>'+
'<tr><td><input type="text" name="acionamento" id="'+(i+"a_txt")+'" value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"a_btn")+'"  onclick="getTime(this.id)"> Acionamento</button> </td>'+
'<td><input type="text" name="chegadaOrigem" id="'+(i+"b_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"b_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Local</button></td>'+
'<td><input type="text" name="saidaLocal" id="'+(i+"c_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"c_btn")+'" type="button" onclick="getTime(this.id)">Saida do Local</button></td>'+
'<td><input type="text" name="chegadaDestino" id="'+(i+"d_txt")+'"value="" size="15"></td>'+
'<td><button id="'+(i+"d_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Destino</button></td></tr>'+
'<td><button id="'+(i+"e_btn")+'" type="button" onclick="getTime(this.id)">Saida no Destino</button></td>'+
'<tr><td><input type="text" name="saidaDestino" id="'+(i+"e_txt")+'"value="" size="15"></td>'+
'<td><input type="text" name="qrv" id="'+(i+"f_txt")+'"value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"f_btn")+'" type="button" onclick="getTime(this.id)">QRV</button><br></td></tr></table>'+
'<div id="'+i+'_col" class="collapse">'+
'<h4>Acionamentos de Múltiplos Meios</h4>'+
'<table border="2" ;"border-collapse: separate; border-spacing: 10px;" >'+
'<tr><td><label >Bombeiros</label></td>'+
'<td><input type="text" name="bombeiros" id="'+(i+"g_txt")+'"value="" size="15"></td>'+
'<td><button id="'+(i+"g_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button></td></tr>'+
'<tr><td><label>Policia</label></td>'+
'<td><input type="text" name="policia" id="'+(i+"h_txt")+'"value="" size="15">  </td>'+
'<td><button id="'+(i+"h_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button><br></td></tr>'+
'<tr><td><label >CET</label>'+
'<td><input type="text" name="cet" id="'+(i+"i_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"i_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button></td></tr>'+
'<tr><td colspan="4"><label>Observações: </label> <textarea id="obs"rows="5" cols="50" placeholder="Observações" name="multiplos_meios"> </textarea></td></tr></table>'+
'<h2>Dados Fornecidos pela Equipe<h2/>'+
'<table border="2" ;"border-collapse: separate; border-spacing: 10px;" >'+
'<tr><td colspan="4"><label>Observações: </label><textarea id="obs"rows="5" cols="50" placeholder="Observações fornecidas pela equipe" name="msg"> </textarea></td></tr>'+
'<tr><td><label>Pressão Arterial</label> '+
'<input name="paAlta"type="number"/>X<input name="paBaixa" type="number"/></td>'+
'<td><label>F. Cardiaca:</label>'+
'<input name="fCardiaca" type="number"/></td>'+
'<td><label>Respiratoria: </label>'+
'<input type="number"name="fRespiratoria"/></td>'+
'<td><label>Dextro</label>'+
'<input type="number" name="dextro"/></td></tr>'+
'<tr><td><label>Saturação</label>'+
'<input type="number"name="sat"></td>'+
'<td><label>Glasgow</label>'+
'<input type="number" name="glasgow"/></td></tr>'+
'<tr><td><label>Unidade de Destino</label> <input type="text" name="unidade" value=""></td>'+
'<td><input type="text" name="qta" id="'+(i+"j_txt")+'"value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"j_btn")+'" type="button" onclick="getTime(this.id)">QTA</button><br></td></tr></table>'+
'<input type="submit" id="enviar" value="Finalizar Ocorrência"/></form>' +
'</table></div></div>'

               );
}else if(dados[i].prioridade == "media"){
    $('#media').append(
        '<div class="container interno" id="'+i+'_div" >'+
'<form onsubmit="enviarDados(this.id)" id="'+i+' "method="POST">'+
'<div  data-toggle="collapse" data-target="#'+i+'_col">'+
'<input hidden type="text" name="id_ocorrencia" value="'+dados[i].id_ocorrencia+'"/>'+
'<table border="2">'+
'<tr><th>Numero de ordem</th> <th>Tipo da Ocorrência </th>'+
'<th>Numero de Telefone</th> <th>Logradouro</th> '+
'<th>Nome Logradouro</th><th>Numero residência</th></tr>'+
'<tr><td ><label id="id_ocorrencia">'+dados[i].id_ocorrencia+'</label></td>'+
'<td>'+dados[i].tp_ocorrencia+ '</td>'+
'<td>'+dados[i].nr_telefone+'</td>'+
'<td>'+dados[i].tp_logradouro+'</td>'+
'<td>'+dados[i].nm_endereco+'</td>'+
'<td>'+dados[i].num_enderco+'</td></tr><tr>'+
'<th>Complemento</th> <th>Bairro</th> <th>Referência</th> <th>Nome do Médico</th></tr> '+
'<tr><td>'+dados[i].ds_complemento+'</td>'+
'<td>'+dados[i].nm_bairro+'</td>'+
'<td>'+dados[i].ref_endereco+'</td>'+
'<td>'+dados[i].nm_medico_reg+'</td></tr>'+
'<tr><th>Diagnostico Médico</th></tr>'+   
'<tr><td>'+dados[i].diagnostico+'</td></tr></table></div>'+
'<table border="2";border-collapse: separate; border-spacing: 10px;" >'+
'<select  id="'+(i+"_opt")+'"  onmouseenter="getOption(this.id)" name="nm_equipe" >'+
'<option hidden>Equipes</option>'+
'</select><span id="'+(i+"_lbl")+'"></span>'+
'<tr><td><input type="text" name="acionamento" id="'+(i+"a_txt")+'" value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"a_btn")+'"  onclick="getTime(this.id)"> Acionamento</button> </td>'+
'<td><input type="text" name="chegadaOrigem" id="'+(i+"b_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"b_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Local</button></td>'+
'<td><input type="text" name="saidaLocal" id="'+(i+"c_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"c_btn")+'" type="button" onclick="getTime(this.id)">Saida do Local</button></td>'+
'<td><input type="text" name="chegadaDestino" id="'+(i+"d_txt")+'"value="" size="15"></td>'+
'<td><button id="'+(i+"d_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Destino</button></td></tr>'+
'<td><button id="'+(i+"e_btn")+'" type="button" onclick="getTime(this.id)">Saida no Destino</button></td>'+
'<tr><td><input type="text" name="saidaDestino" id="'+(i+"e_txt")+'"value="" size="15"></td>'+
'<td><input type="text" name="qrv" id="'+(i+"f_txt")+'"value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"f_btn")+'" type="button" onclick="getTime(this.id)">QRV</button><br></td></tr></table>'+
'<div id="'+i+'_col" class="collapse">'+
'<h4>Acionamentos de Múltiplos Meios</h4>'+
'<table border="2" ;"border-collapse: separate; border-spacing: 10px;" >'+
'<tr><td><label >Bombeiros</label></td>'+
'<td><input type="text" name="bombeiros" id="'+(i+"g_txt")+'"value="" size="15"></td>'+
'<td><button id="'+(i+"g_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button></td></tr>'+
'<tr><td><label>Policia</label></td>'+
'<td><input type="text" name="policia" id="'+(i+"h_txt")+'"value="" size="15">  </td>'+
'<td><button id="'+(i+"h_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button><br></td></tr>'+
'<tr><td><label >CET</label>'+
'<td><input type="text" name="cet" id="'+(i+"i_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"i_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button></td></tr>'+
'<tr><td colspan="4"><label>Observações: </label> <textarea id="obs"rows="5" cols="50" placeholder="Observações" name="multiplos_meios"> </textarea></td></tr></table>'+
'<h2>Dados Fornecidos pela Equipe<h2/>'+
'<table border="2" ;"border-collapse: separate; border-spacing: 10px;" >'+
'<tr><td colspan="4"><label>Observações: </label><textarea id="obs"rows="5" cols="50" placeholder="Observações fornecidas pela equipe" name="msg"> </textarea></td></tr>'+
'<tr><td><label>Pressão Arterial</label> '+
'<input name="paAlta"type="number"/>X<input name="paBaixa" type="number"/></td>'+
'<td><label>F. Cardiaca:</label>'+
'<input name="fCardiaca" type="number"/></td>'+
'<td><label>Respiratoria: </label>'+
'<input type="number"name="fRespiratoria"/></td>'+
'<td><label>Dextro</label>'+
'<input type="number" name="dextro"/></td></tr>'+
'<tr><td><label>Saturação</label>'+
'<input type="number"name="sat"></td>'+
'<td><label>Glasgow</label>'+
'<input type="number" name="glasgow"/></td></tr>'+
'<tr><td><label>Unidade de Destino</label> <input type="text" name="unidade" value=""></td>'+
'<td><input type="text" name="qta" id="'+(i+"j_txt")+'"value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"j_btn")+'" type="button" onclick="getTime(this.id)">QTA</button><br></td></tr></table>'+
'<input type="submit" id="enviar" value="Finalizar Ocorrência"/></form>' +
'</table></div></div>'
               );

}else{
    $('#baixa').append(
        '<div class="container interno" id="'+i+'_div" >'+
'<form onsubmit="enviarDados(this.id)" id="'+i+' "method="POST">'+
'<div  data-toggle="collapse" data-target="#'+i+'_col">'+
'<input hidden type="text" name="id_ocorrencia" value="'+dados[i].id_ocorrencia+'"/>'+
'<table border="2">'+
'<tr><th>Numero de ordem</th> <th>Tipo da Ocorrência </th>'+
'<th>Numero de Telefone</th> <th>Logradouro</th> '+
'<th>Nome Logradouro</th><th>Numero residência</th></tr>'+
'<tr><td ><label id="id_ocorrencia">'+dados[i].id_ocorrencia+'</label></td>'+
'<td>'+dados[i].tp_ocorrencia+ '</td>'+
'<td>'+dados[i].nr_telefone+'</td>'+
'<td>'+dados[i].tp_logradouro+'</td>'+
'<td>'+dados[i].nm_endereco+'</td>'+
'<td>'+dados[i].num_enderco+'</td></tr><tr>'+
'<th>Complemento</th> <th>Bairro</th> <th>Referência</th> <th>Nome do Médico</th></tr> '+
'<tr><td>'+dados[i].ds_complemento+'</td>'+
'<td>'+dados[i].nm_bairro+'</td>'+
'<td>'+dados[i].ref_endereco+'</td>'+
'<td>'+dados[i].nm_medico_reg+'</td></tr>'+
'<tr><th>Diagnostico Médico</th></tr>'+   
'<tr><td>'+dados[i].diagnostico+'</td></tr></table></div>'+
'<table border="2";border-collapse: separate; border-spacing: 10px;" >'+
'<select  id="'+(i+"_opt")+'"  onmouseenter="getOption(this.id)" name="nm_equipe" >'+
'<option hidden>Equipes</option>'+
'</select><span id="'+(i+"_lbl")+'"></span>'+
'<tr><td><input type="text" name="acionamento" id="'+(i+"a_txt")+'" value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"a_btn")+'"  onclick="getTime(this.id)"> Acionamento</button> </td>'+
'<td><input type="text" name="chegadaOrigem" id="'+(i+"b_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"b_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Local</button></td>'+
'<td><input type="text" name="saidaLocal" id="'+(i+"c_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"c_btn")+'" type="button" onclick="getTime(this.id)">Saida do Local</button></td>'+
'<td><input type="text" name="chegadaDestino" id="'+(i+"d_txt")+'"value="" size="15"></td>'+
'<td><button id="'+(i+"d_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Destino</button></td></tr>'+
'<td><button id="'+(i+"e_btn")+'" type="button" onclick="getTime(this.id)">Saida no Destino</button></td>'+
'<tr><td><input type="text" name="saidaDestino" id="'+(i+"e_txt")+'"value="" size="15"></td>'+
'<td><input type="text" name="qrv" id="'+(i+"f_txt")+'"value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"f_btn")+'" type="button" onclick="getTime(this.id)">QRV</button><br></td></tr></table>'+
'<div id="'+i+'_col" class="collapse">'+
'<h4>Acionamentos de Múltiplos Meios</h4>'+
'<table border="2" ;"border-collapse: separate; border-spacing: 10px;" >'+
'<tr><td><label >Bombeiros</label></td>'+
'<td><input type="text" name="bombeiros" id="'+(i+"g_txt")+'"value="" size="15"></td>'+
'<td><button id="'+(i+"g_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button></td></tr>'+
'<tr><td><label>Policia</label></td>'+
'<td><input type="text" name="policia" id="'+(i+"h_txt")+'"value="" size="15">  </td>'+
'<td><button id="'+(i+"h_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button><br></td></tr>'+
'<tr><td><label >CET</label>'+
'<td><input type="text" name="cet" id="'+(i+"i_txt")+'" value="" size="15"></td>'+
'<td><button id="'+(i+"i_btn")+'"  type="button" onclick="getTime(this.id)">Hora de Acionamento</button></td></tr>'+
'<tr><td colspan="4"><label>Observações: </label> <textarea id="obs"rows="5" cols="50" placeholder="Observações" name="multiplos_meios"> </textarea></td></tr></table>'+
'<h2>Dados Fornecidos pela Equipe<h2/>'+
'<table border="2" ;"border-collapse: separate; border-spacing: 10px;" >'+
'<tr><td colspan="4"><label>Observações: </label><textarea id="obs"rows="5" cols="50" placeholder="Observações fornecidas pela equipe" name="msg"> </textarea></td></tr>'+
'<tr><td><label>Pressão Arterial</label> '+
'<input name="paAlta"type="number"/>X<input name="paBaixa" type="number"/></td>'+
'<td><label>F. Cardiaca:</label>'+
'<input name="fCardiaca" type="number"/></td>'+
'<td><label>Respiratoria: </label>'+
'<input type="number"name="fRespiratoria"/></td>'+
'<td><label>Dextro</label>'+
'<input type="number" name="dextro"/></td></tr>'+
'<tr><td><label>Saturação</label>'+
'<input type="number"name="sat"></td>'+
'<td><label>Glasgow</label>'+
'<input type="number" name="glasgow"/></td></tr>'+
'<tr><td><label>Unidade de Destino</label> <input type="text" name="unidade" value=""></td>'+
'<td><input type="text" name="qta" id="'+(i+"j_txt")+'"value="" size="15"></td>'+
'<td><button type="button" id="'+(i+"j_btn")+'" type="button" onclick="getTime(this.id)">QTA</button><br></td></tr></table>'+
'<input type="submit" id="enviar" value="Finalizar Ocorrência"/></form>' +
'</table></div></div>'
               );
            }
        }
    
    }
	})
  
})

</script>

<script>

function getTime(id_){
var data = new Date();
var hora    = data.getHours();          // 0-23
var min     = data.getMinutes();        // 0-59
var seg     = data.getSeconds();        // 0-59
var str_hora = hora + ':' + min + ':' + seg;
var idTexto = id_.replace("btn","txt");
document.getElementById(idTexto).value = str_hora;
}
function getOption(id_) {
    $.ajax({
  type:'post',		        //Definimos o método HTTP usado
  dataType: 'json',	        //Definimos o tipo de retorno
  url: 'pegarEquipes.php',    //Definindo o arquivo onde serão buscados os dados
  success: function(dadosVTR){
      for(var i=0;i < <?=$totalRegistroVTR ?>; i++){
        
      $('#'+id_).append(
            '<option  id="'+i+'" value="'+i+'">'+dadosVTR[i].nm_vtr+'</option>'

        );
      }

  }
    });

    $('#'+id_).on('change', function() {
    
	Select(this.value, this);
})

function Select(index) {
    var idLabel = id_.replace("opt","lbl");

    $.ajax({
  type:'post',		        //Definimos o método HTTP usado
  dataType: 'json',	        //Definimos o tipo de retorno
  url: 'pegarEquipes.php',    //Definindo o arquivo onde serão buscados os dados
  success: function(dadosVTR){
              
             $('#'+idLabel).html(
        '<input name="nome_equipe" type="hidden" value="'+dadosVTR[index].nm_vtr+'"/>'+
        '<label>Suporte: </label>'+
        '<input type="text" name="suporte" value="'+dadosVTR[index].tp_viatura+'" >'+
        '<label id="" for="">Condutor: </label>'+
        '<input type="text" name="nm_motorista" value="'+dadosVTR[index].nm_motorista+'"> '+
        '<label>Aux de Enfermagem: </label>'+
        '<input type="text" name="nm_aux_enf" value="'+dadosVTR[index].nm_aux_enf+'" >'+
        '<label>Enfermeiro: </label>'+
        '<input type="text" name="nm_enfermeiro" value="'+dadosVTR[index].nm_enfermeiro+'" >'+
        '<label>Médico(a) Intervenção </label>'+
        '<input type="text" name="nm_med_intervencao" value="'+dadosVTR[index].nm_med_intervencao+'" >'    
            );
        }
    });
     
    }
}

   
</script>
<body> 

<?php require_once "navbar.php"; ?>

  


                <div class="container">

<h1>Radio Operador</h1>

                
                        <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                    <hr>
                                    

    <div  class="alta  container jumbotron"id="alta"></div>
    <div class="media container jumbotron"id="media"></div>
    <div class="baixa container jumbotron"id="baixa"></div>

                </div>
            </div>
        </div>
    </div>
    <?php require_once "footer.php"; ?>

    </body> 
</html> 