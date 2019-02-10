<?php
session_start();
require('conexao.php');
 if($_SESSION[id]==2){
                $_SESSION[loginErro] = "Você não tem premissão para acessar! <br> Refaça o seu login";
                header("Location: index.php");
              }
      
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="jquery/jquery.min.js"></script>

      
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
        '<div class="container interno" id="'+dados[i].id_ocorrencia+'_ext" >'+
'<form onsubmit="enviarDados(this.id)" id="'+dados[i].id_ocorrencia+' "method="POST">'+
'<div  data-toggle="collapse" data-target="#'+dados[i].id_ocorrencia+'_col">'+
'<input hidden type="text" name="id_ocorrencia" value="'+dados[i].id_ocorrencia+'"/>'+
'<table class="table">'+
'<tr><th>Numero de ordem</th> <th>Tipo da Ocorrência </th>'+
'<th>Numero de Telefone</th> <th>Endereço</th> '+
'<th>Numero residência</th></tr>'+
'<tr><td ><label id="id_ocorrencia">'+dados[i].id_ocorrencia+'</label></td>'+
'<td>'+dados[i].tp_ocorrencia+ '</td>'+
'<td>'+dados[i].nr_telefone+'</td>'+
'<td>'+dados[i].tp_logradouro+'  '+dados[i].nm_endereco+'</td>'+
'<td>'+dados[i].num_enderco+'</td></tr><tr></table>'+
'<span id="'+(dados[i].id_ocorrencia+"_lbl")+'"></span>'+
'</div>'+
'<div id="'+dados[i].id_ocorrencia+'_col" class="collapse">'+
'<table class="table container" >'+
'<tr><th><select class=" custom-select-lg mb-3" id="'+(dados[i].id_ocorrencia+"_opt")+'"  ondblclick="getOption(this.id)" name="nm_equipe" >'+
'<option value="false" hidden>Equipes</option>'+
'</select></th><td></td></tr></table>'+
'<table class ="table"><th>Complemento</th> <th>Bairro</th> <th>Referência</th></tr> '+
'<tr><td>'+dados[i].ds_complemento+'</td>'+
'<td>'+dados[i].nm_bairro+'</td>'+
'<td>'+dados[i].ref_endereco+'</td>'+
'</tr>'+
'<tr><th>Nome do Médico</th><th>Diagnostico Médico</th><th>Suporte Solicitado</th></tr>'+   
'<tr><td>'+dados[i].nm_medico_reg+'</td><td>'+dados[i].diagnostico+'</td><td>'+dados[i].tp_vtr_solicitado+'</td></tr></table>'+
'<table class="table container" >'+
'<tr><td><button class="btn btn-primary " type="button" id="'+(dados[i].id_ocorrencia+"aa_btn")+'"  onclick="getTime(this.id)"> Acionamento</button> </td>'+
'<td><input type="text" name="acionamento" id="'+(dados[i].id_ocorrencia+"aa_txt")+'" value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ab_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Local</button></td>'+
'<td><input type="text" name="chegadaOrigem" id="'+(dados[i].id_ocorrencia+"ab_txt")+'" value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ac_btn")+'" type="button" onclick="getTime(this.id)">Saida do Local</button></td>'+
'<td><input type="text" name="saidaLocal" id="'+(dados[i].id_ocorrencia+"ac_txt")+'" value="" ></td></tr>'+
'<tr><td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ad_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Destino</button></td>'+
'<td><input type="text" name="chegadaDestino" id="'+(dados[i].id_ocorrencia+"ad_txt")+'"value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ae_btn")+'" type="button" onclick="getTime(this.id)">Saida no Destino</button></td>'+
'<td><input type="text" name="saidaDestino" id="'+(dados[i].id_ocorrencia+"ae_txt")+'"value=""></td>'+
'<td><button class="btn btn-primary " type="button" id="'+(dados[i].id_ocorrencia+"af_btn")+'" type="button" onclick="getTime(this.id)">QRV</button></td>'+
'<td><input type="text" name="qrv" id="'+(dados[i].id_ocorrencia+"af_txt")+'"value="" ></td></tr></table>'+
'<table  class="table container" >'+
'<h4>Acionamentos de Múltiplos Meios</h4>'+
'<tr><td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ag_btn")+'" type="button" onclick="getTime(this.id)">Bombeiros</button>'+
'<input type="text" name="bombeiros" placeholder="Acionamento dos Bombeiros" id="'+(dados[i].id_ocorrencia+"ag_txt")+'"value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ah_btn")+'"  type="button" onclick="getTime(this.id)">Policia</button>'+
'<input type="text" name="policia"placeholder="Acionamento dos PM" id="'+(dados[i].id_ocorrencia+"ah_txt")+'"value="" >  </td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ai_btn")+'"  type="button" onclick="getTime(this.id)">CET</button>'+
'<input type="text" name="cet" placeholder="Acionamento da CET" id="'+(dados[i].id_ocorrencia+"ai_txt")+'" value="" ></td></tr>'+
'<tr><th ><label>Observações: </label></th> </tr><td><textarea placeholder="Informações relativas ao acionamento de multiplos meios" id="obs"rows="5" cols="50"  name="multiplos_meios"></textarea></td></table>'+
'<table class="table container" >'+
'<h2>Dados Fornecidos pela Equipe<h2/>'+
'<tr><td colspan="4"><label>Observações: </label><textarea id="obs"rows="5" cols="50" placeholder="Observações fornecidas pela equipe" name="msg"></textarea></td></tr>'+
'<tr><th><label>Pressão Arterial</label></th> '+
'<th>F. Cardiaca:</th>'+
'<th><label>Respiratoria: </label></th></tr>'+
'<tr><td><input placeholder="Sistolica" name="paAlta"type="number"/>X<input placeholder="Diastolica" name="paBaixa" type="number"/></td>'+
'<td><input placeholder="Cardiaca" name="fCardiaca" type="number"/></td>'+
'<td><input placeholder="Respiratoria"type="number"name="fRespiratoria"/></td></tr>'+
'<tr><td><label>Dextro</label>'+
'<th><label>Saturação</label></th>'+
'<th>Glasgow</th></tr>'+
'<tr><td><input placeholder="Dextro" type="number" name="dextro"/></td>'+
'<td><input placeholder="Saturação" type="number"name="sat"></td>'+
'<td><input type="number" placeholder="Entre 3 e 15" min="3" max="15" name="glasgow" style="width:152px"/></td></tr>'+
'<tr><td><label>Unidade de Destino</label> <input placeholder="Destino da ocorrência" type="text" name="unidade" value=""></td>'+
'<td><button class="btn btn-primary  " type="button" id="'+(dados[i].id_ocorrencia+"aj_btn")+'" type="button" onclick="getTime(this.id)">QTA</button>'+
'<input type="text" placeholder="Informar o motivo no campo Destino" name="qta" id="'+(dados[i].id_ocorrencia+"aj_txt")+'"value="" ></td></tr></table>'+
'<button class="btn btn-primary btn-lg btn-block " type="submit" id="enviar" >Finalizar Ocorrência</button></form>' +
'</table></div></div><div class="baixa" ></div>'
                      );
}else if(dados[i].prioridade == "media"){
    $('#media').append(
        '<div class="container interno" id="'+dados[i].id_ocorrencia+'_ext" >'+
'<form onsubmit="enviarDados(this.id)" id="'+dados[i].id_ocorrencia+' "method="POST">'+
'<div  data-toggle="collapse" data-target="#'+dados[i].id_ocorrencia+'_col">'+
'<input hidden type="text" name="id_ocorrencia" value="'+dados[i].id_ocorrencia+'"/>'+
'<table class="table">'+
'<tr><th>Numero de ordem</th> <th>Tipo da Ocorrência </th>'+
'<th>Numero de Telefone</th> <th>Endereço</th> '+
'<th>Numero residência</th></tr>'+
'<tr><td ><label id="id_ocorrencia">'+dados[i].id_ocorrencia+'</label></td>'+
'<td>'+dados[i].tp_ocorrencia+ '</td>'+
'<td>'+dados[i].nr_telefone+'</td>'+
'<td>'+dados[i].tp_logradouro+'  '+dados[i].nm_endereco+'</td>'+
'<td>'+dados[i].num_enderco+'</td></tr><tr></table>'+
'<span id="'+(dados[i].id_ocorrencia+"_lbl")+'"></span>'+
'</div>'+
'<div id="'+dados[i].id_ocorrencia+'_col" class="collapse">'+
'<table class="table container" >'+
'<tr><th><select class=" custom-select-lg mb-3" id="'+(dados[i].id_ocorrencia+"_opt")+'"  ondblclick="getOption(this.id)" name="nm_equipe" >'+
'<option value="false" hidden>Equipes</option>'+
'</select></th><td></td></tr></table>'+
'<table class ="table"><th>Complemento</th> <th>Bairro</th> <th>Referência</th></tr> '+
'<tr><td>'+dados[i].ds_complemento+'</td>'+
'<td>'+dados[i].nm_bairro+'</td>'+
'<td>'+dados[i].ref_endereco+'</td>'+
'</tr>'+
'<tr><th>Nome do Médico</th><th>Diagnostico Médico</th><th>Suporte Solicitado</th></tr>'+   
'<tr><td>'+dados[i].nm_medico_reg+'</td><td>'+dados[i].diagnostico+'</td><td>'+dados[i].tp_vtr_solicitado+'</td></tr></table>'+
'<table class="table container" >'+
'<tr><td><button class="btn btn-primary " type="button" id="'+(dados[i].id_ocorrencia+"aa_btn")+'"  onclick="getTime(this.id)"> Acionamento</button> </td>'+
'<td><input type="text" name="acionamento" id="'+(dados[i].id_ocorrencia+"aa_txt")+'" value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ab_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Local</button></td>'+
'<td><input type="text" name="chegadaOrigem" id="'+(dados[i].id_ocorrencia+"ab_txt")+'" value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ac_btn")+'" type="button" onclick="getTime(this.id)">Saida do Local</button></td>'+
'<td><input type="text" name="saidaLocal" id="'+(dados[i].id_ocorrencia+"ac_txt")+'" value="" ></td></tr>'+
'<tr><td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ad_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Destino</button></td>'+
'<td><input type="text" name="chegadaDestino" id="'+(dados[i].id_ocorrencia+"ad_txt")+'"value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ae_btn")+'" type="button" onclick="getTime(this.id)">Saida no Destino</button></td>'+
'<td><input type="text" name="saidaDestino" id="'+(dados[i].id_ocorrencia+"ae_txt")+'"value=""></td>'+
'<td><button class="btn btn-primary " type="button" id="'+(dados[i].id_ocorrencia+"af_btn")+'" type="button" onclick="getTime(this.id)">QRV</button></td>'+
'<td><input type="text" name="qrv" id="'+(dados[i].id_ocorrencia+"af_txt")+'"value="" ></td></tr></table>'+
'<table  class="table container" >'+
'<h4>Acionamentos de Múltiplos Meios</h4>'+
'<tr><td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ag_btn")+'" type="button" onclick="getTime(this.id)">Bombeiros</button>'+
'<input type="text" name="bombeiros" placeholder="Acionamento dos Bombeiros" id="'+(dados[i].id_ocorrencia+"ag_txt")+'"value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ah_btn")+'"  type="button" onclick="getTime(this.id)">Policia</button>'+
'<input type="text" name="policia"placeholder="Acionamento dos PM" id="'+(dados[i].id_ocorrencia+"ah_txt")+'"value="" >  </td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ai_btn")+'"  type="button" onclick="getTime(this.id)">CET</button>'+
'<input type="text" name="cet" placeholder="Acionamento da CET" id="'+(dados[i].id_ocorrencia+"ai_txt")+'" value="" ></td></tr>'+
'<tr><th ><label>Observações: </label></th> </tr><td><textarea placeholder="Informações relativas ao acionamento de multiplos meios" id="obs"rows="5" cols="50"  name="multiplos_meios"></textarea></td></table>'+
'<table class="table container" >'+
'<h2>Dados Fornecidos pela Equipe<h2/>'+
'<tr><td colspan="4"><label>Observações: </label><textarea id="obs"rows="5" cols="50" placeholder="Observações fornecidas pela equipe" name="msg"></textarea></td></tr>'+
'<tr><th><label>Pressão Arterial</label></th> '+
'<th>F. Cardiaca:</th>'+
'<th><label>Respiratoria: </label></th></tr>'+
'<tr><td><input placeholder="Sistolica" name="paAlta"type="number"/>X<input placeholder="Diastolica" name="paBaixa" type="number"/></td>'+
'<td><input placeholder="Cardiaca" name="fCardiaca" type="number"/></td>'+
'<td><input placeholder="Respiratoria"type="number"name="fRespiratoria"/></td></tr>'+
'<tr><td><label>Dextro</label>'+
'<th><label>Saturação</label></th>'+
'<th>Glasgow</th></tr>'+
'<tr><td><input placeholder="Dextro" type="number" name="dextro"/></td>'+
'<td><input placeholder="Saturação" type="number"name="sat"></td>'+
'<td><input type="number" placeholder="Entre 3 e 15" min="3" max="15" name="glasgow" style="width:152px"/></td></tr>'+
'<tr><td><label>Unidade de Destino</label> <input placeholder="Destino da ocorrência" type="text" name="unidade" value=""></td>'+
'<td><button class="btn btn-primary  " type="button" id="'+(dados[i].id_ocorrencia+"aj_btn")+'" type="button" onclick="getTime(this.id)">QTA</button>'+
'<input type="text" placeholder="Informar o motivo no campo Destino" name="qta" id="'+(dados[i].id_ocorrencia+"aj_txt")+'"value="" ></td></tr></table>'+
'<button class="btn btn-primary btn-lg btn-block " type="submit" id="enviar" >Finalizar Ocorrência</button></form>' +
'</table></div></div><div class="media" ></div>'             
);

}else{
    $('#baixa').append(
'<div class="container interno" id="'+dados[i].id_ocorrencia+'_ext" >'+
'<form onsubmit="enviarDados(this.id)" id="'+dados[i].id_ocorrencia+' "method="POST">'+
'<div  data-toggle="collapse" data-target="#'+dados[i].id_ocorrencia+'_col">'+
'<input hidden type="text" name="id_ocorrencia" value="'+dados[i].id_ocorrencia+'"/>'+
'<table class="table">'+
'<tr><th>Numero de ordem</th> <th>Tipo da Ocorrência </th>'+
'<th>Numero de Telefone</th> <th>Endereço</th> '+
'<th>Numero residência</th></tr>'+
'<tr><td ><label id="id_ocorrencia">'+dados[i].id_ocorrencia+'</label></td>'+
'<td>'+dados[i].tp_ocorrencia+ '</td>'+
'<td>'+dados[i].nr_telefone+'</td>'+
'<td>'+dados[i].tp_logradouro+'  '+dados[i].nm_endereco+'</td>'+
'<td>'+dados[i].num_enderco+'</td></tr><tr></table>'+
'<span id="'+(dados[i].id_ocorrencia+"_lbl")+'"></span>'+
'</div>'+
'<div id="'+dados[i].id_ocorrencia+'_col" class="collapse">'+
'<table class="table container" >'+
'<tr><th><select class=" custom-select-lg mb-3" id="'+(dados[i].id_ocorrencia+"_opt")+'"  ondblclick="getOption(this.id)" name="nm_equipe" >'+
'<option value="false" hidden>Equipes</option>'+
'</select></th><td></td></tr></table>'+
'<table class ="table"><th>Complemento</th> <th>Bairro</th> <th>Referência</th></tr> '+
'<tr><td>'+dados[i].ds_complemento+'</td>'+
'<td>'+dados[i].nm_bairro+'</td>'+
'<td>'+dados[i].ref_endereco+'</td>'+
'</tr>'+
'<tr><th>Nome do Médico</th><th>Diagnostico Médico</th><th>Suporte Solicitado</th></tr>'+   
'<tr><td>'+dados[i].nm_medico_reg+'</td><td>'+dados[i].diagnostico+'</td><td>'+dados[i].tp_vtr_solicitado+'</td></tr></table>'+
'<table class="table container" >'+
'<tr><td><button class="btn btn-primary " type="button" id="'+(dados[i].id_ocorrencia+"aa_btn")+'"  onclick="getTime(this.id)"> Acionamento</button> </td>'+
'<td><input type="text" name="acionamento" id="'+(dados[i].id_ocorrencia+"aa_txt")+'" value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ab_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Local</button></td>'+
'<td><input type="text" name="chegadaOrigem" id="'+(dados[i].id_ocorrencia+"ab_txt")+'" value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ac_btn")+'" type="button" onclick="getTime(this.id)">Saida do Local</button></td>'+
'<td><input type="text" name="saidaLocal" id="'+(dados[i].id_ocorrencia+"ac_txt")+'" value="" ></td></tr>'+
'<tr><td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ad_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Destino</button></td>'+
'<td><input type="text" name="chegadaDestino" id="'+(dados[i].id_ocorrencia+"ad_txt")+'"value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ae_btn")+'" type="button" onclick="getTime(this.id)">Saida no Destino</button></td>'+
'<td><input type="text" name="saidaDestino" id="'+(dados[i].id_ocorrencia+"ae_txt")+'"value=""></td>'+
'<td><button class="btn btn-primary " type="button" id="'+(dados[i].id_ocorrencia+"af_btn")+'" type="button" onclick="getTime(this.id)">QRV</button></td>'+
'<td><input type="text" name="qrv" id="'+(dados[i].id_ocorrencia+"af_txt")+'"value="" ></td></tr></table>'+
'<table  class="table container" >'+
'<h4>Acionamentos de Múltiplos Meios</h4>'+
'<tr><td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ag_btn")+'" type="button" onclick="getTime(this.id)">Bombeiros</button>'+
'<input type="text" name="bombeiros" placeholder="Acionamento dos Bombeiros" id="'+(dados[i].id_ocorrencia+"ag_txt")+'"value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ah_btn")+'"  type="button" onclick="getTime(this.id)">Policia</button>'+
'<input type="text" name="policia"placeholder="Acionamento dos PM" id="'+(dados[i].id_ocorrencia+"ah_txt")+'"value="" >  </td>'+
'<td><button class="btn btn-primary " id="'+(dados[i].id_ocorrencia+"ai_btn")+'"  type="button" onclick="getTime(this.id)">CET</button>'+
'<input type="text" name="cet" placeholder="Acionamento da CET" id="'+(dados[i].id_ocorrencia+"ai_txt")+'" value="" ></td></tr>'+
'<tr><th ><label>Observações: </label></th> </tr><td><textarea placeholder="Informações relativas ao acionamento de multiplos meios" id="obs"rows="5" cols="50"  name="multiplos_meios"></textarea></td></table>'+
'<table class="table container" >'+
'<h2>Dados Fornecidos pela Equipe<h2/>'+
'<tr><td colspan="4"><label>Observações: </label><textarea id="obs"rows="5" cols="50" placeholder="Observações fornecidas pela equipe" name="msg"></textarea></td></tr>'+
'<tr><th><label>Pressão Arterial</label></th> '+
'<th>F. Cardiaca:</th>'+
'<th><label>Respiratoria: </label></th></tr>'+
'<tr><td><input placeholder="Sistolica" name="paAlta"type="number"/>X<input placeholder="Diastolica" name="paBaixa" type="number"/></td>'+
'<td><input placeholder="Cardiaca" name="fCardiaca" type="number"/></td>'+
'<td><input placeholder="Respiratoria"type="number"name="fRespiratoria"/></td></tr>'+
'<tr><td><label>Dextro</label>'+
'<th><label>Saturação</label></th>'+
'<th>Glasgow</th></tr>'+
'<tr><td><input placeholder="Dextro" type="number" name="dextro"/></td>'+
'<td><input placeholder="Saturação" type="number"name="sat"></td>'+
'<td><input type="number" placeholder="Entre 3 e 15" min="3" max="15" name="glasgow" style="width:152px"/></td></tr>'+
'<tr><td><label>Unidade de Destino</label> <input placeholder="Destino da ocorrência" type="text" name="unidade" value=""></td>'+
'<td><button class="btn btn-primary  " type="button" id="'+(dados[i].id_ocorrencia+"aj_btn")+'" type="button" onclick="getTime(this.id)">QTA</button>'+
'<input type="text" placeholder="Informar o motivo no campo Destino" name="qta" id="'+(dados[i].id_ocorrencia+"aj_txt")+'"value="" ></td></tr></table>'+
'<button class="btn btn-primary btn-lg btn-block " type="submit" id="enviar" >Finalizar Ocorrência</button></form>' +
'</table></div></div><div class="baixa" ></div>'
    );
}
}
}
        }
	})
  },2000);


function enviarDados(id_){
event.preventDefault();
    let id_equipe = document.getElementById(id_).elements.namedItem('id_equipe').value;
    let interno =  document.getElementById(id_).elements.namedItem('id_ocorrencia').value;
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
    let unidade = document.getElementById(id_).elements.namedItem('unidade').value;
    let qta = document.getElementById(id_).elements.namedItem('qta').value;
    let nome_equipe= document.getElementById(id_).elements.namedItem('nome_equipe').value;
    let nm_motorista= document.getElementById(id_).elements.namedItem('nm_motorista').value;
    let nm_aux_enf= document.getElementById(id_).elements.namedItem('nm_aux_enf').value;
    let nm_enfermeiro= document.getElementById(id_).elements.namedItem('nm_enfermeiro').value;
    let nm_med_intervencao= document.getElementById(id_).elements.namedItem('nm_med_intervencao').value;
    let suporte = document.getElementById(id_).elements.namedItem('suporte').value;
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
            id_equipe: id_equipe,
            qta : qta
            
            }
        }).done(function(data){
             //faz algo quando enviar certo 
             alert("Chamado Gravado com Sucesso!");
             var idTexton = interno+"_ext";
             document.getElementById(idTexton).style.display = 'none';

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

		for(var i=0;i < dados.length;i++){
tabelaUno.push(
 dados[i].id_ocorrencia
 
);
	//Adicionando registros retornados na tabela
	if (dados[i].prioridade == "alta") {
    $('#alta').append(

'<div class="container interno" id="'+dados[i].id_ocorrencia+'_ext" >'+
'<form onsubmit="enviarDados(this.id)" id="'+i+' "method="POST">'+
'<div  data-toggle="collapse" data-target="#'+dados[i].id_ocorrencia+'_col">'+
'<input hidden type="text" name="id_ocorrencia" value="'+dados[i].id_ocorrencia+'"/>'+
'<table class="table">'+
'<tr><th>Numero de ordem</th> <th>Tipo da Ocorrência </th>'+
'<th>Numero de Telefone</th> <th>Endereço</th> '+
'<th>Numero residência</th></tr>'+
'<tr><td ><label id="id_ocorrencia">'+dados[i].id_ocorrencia+'</label></td>'+
'<td>'+dados[i].tp_ocorrencia+ '</td>'+
'<td>'+dados[i].nr_telefone+'</td>'+
'<td>'+dados[i].tp_logradouro+'  '+dados[i].nm_endereco+'</td>'+
'<td>'+dados[i].num_enderco+'</td></tr><tr></table>'+
'<span id="'+(dados[i].id_ocorrencia+"_lbl")+'"></span>'+
'</div>'+
'<div id="'+dados[i].id_ocorrencia+'_col" class="collapse">'+
'<table class="table container" >'+
'<tr><th><select class=" custom-select-lg mb-3" id="'+(dados[i].id_ocorrencia+"_opt")+'"  ondblclick="getOption(this.id)" name="nm_equipe" >'+
'<option value="false" hidden>Equipes</option>'+
'</select></th><td></td></tr></table>'+
'<table class ="table"><th>Complemento</th> <th>Bairro</th> <th>Referência</th></tr> '+
'<tr><td>'+dados[i].ds_complemento+'</td>'+
'<td>'+dados[i].nm_bairro+'</td>'+
'<td>'+dados[i].ref_endereco+'</td>'+
'</tr>'+
'<tr><th>Nome do Médico</th><th>Diagnostico Médico</th><th>Suporte Solicitado</th></tr>'+   
'<tr><td>'+dados[i].nm_medico_reg+'</td><td>'+dados[i].diagnostico+'</td><td>'+dados[i].tp_vtr_solicitado+'</td></tr></table>'+
'<table class="table container" >'+
'<tr><td><button class="btn btn-primary " type="button" id="'+(i+"a_btn")+'"  onclick="getTime(this.id)"> Acionamento</button> </td>'+
'<td><input type="text" name="acionamento" id="'+(i+"a_txt")+'" value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(i+"b_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Local</button></td>'+
'<td><input type="text" name="chegadaOrigem" id="'+(i+"b_txt")+'" value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(i+"c_btn")+'" type="button" onclick="getTime(this.id)">Saida do Local</button></td>'+
'<td><input type="text" name="saidaLocal" id="'+(i+"c_txt")+'" value="" ></td></tr>'+
'<tr><td><button class="btn btn-primary " id="'+(i+"d_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Destino</button></td>'+
'<td><input type="text" name="chegadaDestino" id="'+(i+"d_txt")+'"value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(i+"e_btn")+'" type="button" onclick="getTime(this.id)">Saida no Destino</button></td>'+
'<td><input type="text" name="saidaDestino" id="'+(i+"e_txt")+'"value=""></td>'+
'<td><button class="btn btn-primary " type="button" id="'+(i+"f_btn")+'" type="button" onclick="getTime(this.id)">QRV</button></td>'+
'<td><input type="text" name="qrv" id="'+(i+"f_txt")+'"value="" ></td></tr></table>'+
'<table  class="table container" >'+
'<h4>Acionamentos de Múltiplos Meios</h4>'+
'<tr><td><button class="btn btn-primary " id="'+(i+"g_btn")+'" type="button" onclick="getTime(this.id)">Bombeiros</button>'+
'<input type="text" name="bombeiros" placeholder="Acionamento dos Bombeiros" id="'+(i+"g_txt")+'"value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(i+"h_btn")+'"  type="button" onclick="getTime(this.id)">Policia</button>'+
'<input type="text" name="policia"placeholder="Acionamento dos PM" id="'+(i+"h_txt")+'"value="" >  </td>'+
'<td><button class="btn btn-primary " id="'+(i+"i_btn")+'"  type="button" onclick="getTime(this.id)">CET</button>'+
'<input type="text" name="cet" placeholder="Acionamento da CET" id="'+(i+"i_txt")+'" value="" ></td></tr>'+
'<tr><th ><label>Observações: </label></th> </tr><td><textarea placeholder="Informações relativas ao acionamento de multiplos meios" id="obs"rows="5" cols="50"  name="multiplos_meios"></textarea></td></table>'+
'<table class="table container" >'+
'<h2>Dados Fornecidos pela Equipe<h2/>'+
'<tr><td colspan="4"><label>Observações: </label><textarea id="obs"rows="5" cols="50" placeholder="Observações fornecidas pela equipe" name="msg"></textarea></td></tr>'+
'<tr><th><label>Pressão Arterial</label></th> '+
'<th>F. Cardiaca:</th>'+
'<th><label>Respiratoria: </label></th></tr>'+
'<tr><td><input placeholder="Sistolica" name="paAlta"type="number"/>X<input placeholder="Diastolica" name="paBaixa" type="number"/></td>'+
'<td><input placeholder="Cardiaca" name="fCardiaca" type="number"/></td>'+
'<td><input placeholder="Respiratoria"type="number"name="fRespiratoria"/></td></tr>'+
'<tr><td><label>Dextro</label>'+
'<th><label>Saturação</label></th>'+
'<th>Glasgow</th></tr>'+
'<tr><td><input placeholder="Dextro" type="number" name="dextro"/></td>'+
'<td><input placeholder="Saturação" type="number"name="sat"></td>'+
'<td><input type="number" placeholder="Entre 3 e 15" min="3" max="15" name="glasgow" style="width:152px"/></td></tr>'+
'<tr><td><label>Unidade de Destino</label> <input placeholder="Destino da ocorrência" type="text" name="unidade" value=""></td>'+
'<td><button class="btn btn-primary  " type="button" id="'+(i+"j_btn")+'" type="button" onclick="getTime(this.id)">QTA</button>'+
'<input type="text" placeholder="Informar o motivo no campo Destino" name="qta" id="'+(i+"j_txt")+'"value="" ></td></tr></table>'+
'<button class="btn btn-primary btn-lg btn-block " type="submit" id="enviar" >Finalizar Ocorrência</button></form>' +
'</table></div></div><div class="alta" ></div>'
);
}else if(dados[i].prioridade == "media"){
        $('#media').append(
            
            '<div class="container interno" id="'+dados[i].id_ocorrencia+'_ext" >'+
'<form onsubmit="enviarDados(this.id)" id="'+i+' "method="POST">'+
'<div  data-toggle="collapse" data-target="#'+dados[i].id_ocorrencia+'_col">'+
'<input hidden type="text" name="id_ocorrencia" value="'+dados[i].id_ocorrencia+'"/>'+
'<table class="table">'+
'<tr><th>Numero de ordem</th> <th>Tipo da Ocorrência </th>'+
'<th>Numero de Telefone</th> <th>Endereço</th> '+
'<th>Numero residência</th></tr>'+
'<tr><td ><label id="id_ocorrencia">'+dados[i].id_ocorrencia+'</label></td>'+
'<td>'+dados[i].tp_ocorrencia+ '</td>'+
'<td>'+dados[i].nr_telefone+'</td>'+
'<td>'+dados[i].tp_logradouro+'  '+dados[i].nm_endereco+'</td>'+
'<td>'+dados[i].num_enderco+'</td></tr><tr></table>'+
'<span id="'+(dados[i].id_ocorrencia+"_lbl")+'"></span>'+
'</div>'+
'<div id="'+dados[i].id_ocorrencia+'_col" class="collapse">'+
'<table class="table container" >'+
'<tr><th><select class=" custom-select-lg mb-3" id="'+(dados[i].id_ocorrencia+"_opt")+'"  ondblclick="getOption(this.id)" name="nm_equipe" >'+
'<option value="false" hidden>Equipes</option>'+
'</select></th><td></td></tr></table>'+
'<table class ="table"><th>Complemento</th> <th>Bairro</th> <th>Referência</th></tr> '+
'<tr><td>'+dados[i].ds_complemento+'</td>'+
'<td>'+dados[i].nm_bairro+'</td>'+
'<td>'+dados[i].ref_endereco+'</td>'+
'</tr>'+
'<tr><th>Nome do Médico</th><th>Diagnostico Médico</th><th>Suporte Solicitado</th></tr>'+   
'<tr><td>'+dados[i].nm_medico_reg+'</td><td>'+dados[i].diagnostico+'</td><td>'+dados[i].tp_vtr_solicitado+'</td></tr></table>'+
'<table class="table container" >'+
'<tr><td><button class="btn btn-primary " type="button" id="'+(i+"a_btn")+'"  onclick="getTime(this.id)"> Acionamento</button> </td>'+
'<td><input type="text" name="acionamento" id="'+(i+"a_txt")+'" value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(i+"b_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Local</button></td>'+
'<td><input type="text" name="chegadaOrigem" id="'+(i+"b_txt")+'" value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(i+"c_btn")+'" type="button" onclick="getTime(this.id)">Saida do Local</button></td>'+
'<td><input type="text" name="saidaLocal" id="'+(i+"c_txt")+'" value="" ></td></tr>'+
'<tr><td><button class="btn btn-primary " id="'+(i+"d_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Destino</button></td>'+
'<td><input type="text" name="chegadaDestino" id="'+(i+"d_txt")+'"value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(i+"e_btn")+'" type="button" onclick="getTime(this.id)">Saida no Destino</button></td>'+
'<td><input type="text" name="saidaDestino" id="'+(i+"e_txt")+'"value=""></td>'+
'<td><button class="btn btn-primary " type="button" id="'+(i+"f_btn")+'" type="button" onclick="getTime(this.id)">QRV</button></td>'+
'<td><input type="text" name="qrv" id="'+(i+"f_txt")+'"value="" ></td></tr></table>'+
'<table  class="table container" >'+
'<h4>Acionamentos de Múltiplos Meios</h4>'+
'<tr><td><button class="btn btn-primary " id="'+(i+"g_btn")+'" type="button" onclick="getTime(this.id)">Bombeiros</button>'+
'<input type="text" name="bombeiros" placeholder="Acionamento dos Bombeiros" id="'+(i+"g_txt")+'"value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(i+"h_btn")+'"  type="button" onclick="getTime(this.id)">Policia</button>'+
'<input type="text" name="policia"placeholder="Acionamento dos PM" id="'+(i+"h_txt")+'"value="" >  </td>'+
'<td><button class="btn btn-primary " id="'+(i+"i_btn")+'"  type="button" onclick="getTime(this.id)">CET</button>'+
'<input type="text" name="cet" placeholder="Acionamento da CET" id="'+(i+"i_txt")+'" value="" ></td></tr>'+
'<tr><th ><label>Observações: </label></th> </tr><td><textarea placeholder="Informações relativas ao acionamento de multiplos meios" id="obs"rows="5" cols="50"  name="multiplos_meios"></textarea></td></table>'+
'<table class="table container" >'+
'<h2>Dados Fornecidos pela Equipe<h2/>'+
'<tr><td colspan="4"><label>Observações: </label><textarea id="obs"rows="5" cols="50" placeholder="Observações fornecidas pela equipe" name="msg"></textarea></td></tr>'+
'<tr><th><label>Pressão Arterial</label></th> '+
'<th>F. Cardiaca:</th>'+
'<th><label>Respiratoria: </label></th></tr>'+
'<tr><td><input placeholder="Sistolica" name="paAlta"type="number"/>X<input placeholder="Diastolica" name="paBaixa" type="number"/></td>'+
'<td><input placeholder="Cardiaca" name="fCardiaca" type="number"/></td>'+
'<td><input placeholder="Respiratoria"type="number"name="fRespiratoria"/></td></tr>'+
'<tr><td><label>Dextro</label>'+
'<th><label>Saturação</label></th>'+
'<th>Glasgow</th></tr>'+
'<tr><td><input placeholder="Dextro" type="number" name="dextro"/></td>'+
'<td><input placeholder="Saturação" type="number"name="sat"></td>'+
'<td><input type="number" placeholder="Entre 3 e 15" min="3" max="15" name="glasgow" style="width:152px"/></td></tr>'+
'<tr><td><label>Unidade de Destino</label> <input placeholder="Destino da ocorrência" type="text" name="unidade" value=""></td>'+
'<td><button class="btn btn-primary  " type="button" id="'+(i+"j_btn")+'" type="button" onclick="getTime(this.id)">QTA</button>'+
'<input type="text" placeholder="Informar o motivo no campo Destino" name="qta" id="'+(i+"j_txt")+'"value="" ></td></tr></table>'+
'<button class="btn btn-primary btn-lg btn-block " type="submit" id="enviar" >Finalizar Ocorrência</button></form>' +
'</table></div></div><div class="media" ></div>'
);

}else{
    $('#baixa').append(
        '<div class="container interno" id="'+dados[i].id_ocorrencia+'_ext" >'+
'<form onsubmit="enviarDados(this.id)" id="'+i+' "method="POST">'+
'<div  data-toggle="collapse" data-target="#'+dados[i].id_ocorrencia+'_col">'+
'<input hidden type="text" name="id_ocorrencia" value="'+dados[i].id_ocorrencia+'"/>'+
'<table class="table">'+
'<tr><th>Numero de ordem</th> <th>Tipo da Ocorrência </th>'+
'<th>Numero de Telefone</th> <th>Endereço</th> '+
'<th>Numero residência</th></tr>'+
'<tr><td ><label id="id_ocorrencia">'+dados[i].id_ocorrencia+'</label></td>'+
'<td>'+dados[i].tp_ocorrencia+ '</td>'+
'<td>'+dados[i].nr_telefone+'</td>'+
'<td>'+dados[i].tp_logradouro+'  '+dados[i].nm_endereco+'</td>'+
'<td>'+dados[i].num_enderco+'</td></tr><tr></table>'+
'<span id="'+(dados[i].id_ocorrencia+"_lbl")+'"></span>'+
'</div>'+
'<div id="'+dados[i].id_ocorrencia+'_col" class="collapse">'+
'<table class="table container" >'+
'<tr><th><select class=" custom-select-lg mb-3" id="'+(dados[i].id_ocorrencia+"_opt")+'"  ondblclick="getOption(this.id)" name="nm_equipe" >'+
'<option value="false" hidden>Equipes</option>'+
'</select></th><td></td></tr></table>'+
'<table class ="table"><th>Complemento</th> <th>Bairro</th> <th>Referência</th></tr> '+
'<tr><td>'+dados[i].ds_complemento+'</td>'+
'<td>'+dados[i].nm_bairro+'</td>'+
'<td>'+dados[i].ref_endereco+'</td>'+
'</tr>'+
'<tr><th>Nome do Médico</th><th>Diagnostico Médico</th><th>Suporte Solicitado</th></tr>'+   
'<tr><td>'+dados[i].nm_medico_reg+'</td><td>'+dados[i].diagnostico+'</td><td>'+dados[i].tp_vtr_solicitado+'</td></tr></table>'+
'<table class="table container" >'+
'<tr><td><button class="btn btn-primary " type="button" id="'+(i+"a_btn")+'"  onclick="getTime(this.id)"> Acionamento</button> </td>'+
'<td><input type="text" name="acionamento" id="'+(i+"a_txt")+'" value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(i+"b_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Local</button></td>'+
'<td><input type="text" name="chegadaOrigem" id="'+(i+"b_txt")+'" value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(i+"c_btn")+'" type="button" onclick="getTime(this.id)">Saida do Local</button></td>'+
'<td><input type="text" name="saidaLocal" id="'+(i+"c_txt")+'" value="" ></td></tr>'+
'<tr><td><button class="btn btn-primary " id="'+(i+"d_btn")+'" type="button" onclick="getTime(this.id)">Chegada no Destino</button></td>'+
'<td><input type="text" name="chegadaDestino" id="'+(i+"d_txt")+'"value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(i+"e_btn")+'" type="button" onclick="getTime(this.id)">Saida no Destino</button></td>'+
'<td><input type="text" name="saidaDestino" id="'+(i+"e_txt")+'"value=""></td>'+
'<td><button class="btn btn-primary " type="button" id="'+(i+"f_btn")+'" type="button" onclick="getTime(this.id)">QRV</button></td>'+
'<td><input type="text" name="qrv" id="'+(i+"f_txt")+'"value="" ></td></tr></table>'+
'<table  class="table container" >'+
'<h4>Acionamentos de Múltiplos Meios</h4>'+
'<tr><td><button class="btn btn-primary " id="'+(i+"g_btn")+'" type="button" onclick="getTime(this.id)">Bombeiros</button>'+
'<input type="text" name="bombeiros" placeholder="Acionamento dos Bombeiros" id="'+(i+"g_txt")+'"value="" ></td>'+
'<td><button class="btn btn-primary " id="'+(i+"h_btn")+'"  type="button" onclick="getTime(this.id)">Policia</button>'+
'<input type="text" name="policia"placeholder="Acionamento dos PM" id="'+(i+"h_txt")+'"value="" >  </td>'+
'<td><button class="btn btn-primary " id="'+(i+"i_btn")+'"  type="button" onclick="getTime(this.id)">CET</button>'+
'<input type="text" name="cet" placeholder="Acionamento da CET" id="'+(i+"i_txt")+'" value="" ></td></tr>'+
'<tr><th ><label>Observações: </label></th> </tr><td><textarea placeholder="Informações relativas ao acionamento de multiplos meios" id="obs"rows="5" cols="50"  name="multiplos_meios"></textarea></td></table>'+
'<table class="table container" >'+
'<h2>Dados Fornecidos pela Equipe<h2/>'+
'<tr><td colspan="4"><label>Observações: </label><textarea id="obs"rows="5" cols="50" placeholder="Observações fornecidas pela equipe" name="msg"></textarea></td></tr>'+
'<tr><th><label>Pressão Arterial</label></th> '+
'<th>F. Cardiaca:</th>'+
'<th><label>Respiratoria: </label></th></tr>'+
'<tr><td><input placeholder="Sistolica" name="paAlta"type="number"/>X<input placeholder="Diastolica" name="paBaixa" type="number"/></td>'+
'<td><input placeholder="Cardiaca" name="fCardiaca" type="number"/></td>'+
'<td><input placeholder="Respiratoria"type="number"name="fRespiratoria"/></td></tr>'+
'<tr><td><label>Dextro</label>'+
'<th><label>Saturação</label></th>'+
'<th>Glasgow</th></tr>'+
'<tr><td><input placeholder="Dextro" type="number" name="dextro"/></td>'+
'<td><input placeholder="Saturação" type="number"name="sat"></td>'+
'<td><input type="number" placeholder="Entre 3 e 15" min="3" max="15" name="glasgow" style="width:152px"/></td></tr>'+
'<tr><td><label>Unidade de Destino</label> <input placeholder="Destino da ocorrência" type="text" name="unidade" value=""></td>'+
'<td><button class="btn btn-primary  " type="button" id="'+(i+"j_btn")+'" type="button" onclick="getTime(this.id)">QTA</button>'+
'<input type="text" placeholder="Informar o motivo no campo Destino" name="qta" id="'+(i+"j_txt")+'"value="" ></td></tr></table>'+
'<button class="btn btn-primary btn-lg btn-block " type="submit" id="enviar" >Finalizar Ocorrência</button></form>' +
'</table></div></div><div class="baixa" ></div>'

       );
            }//else
        }//for 
    
    }// sucess 
	})//ajax
  //
});//ready

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
      if(dadosVTR == null){
        $('#'+id_).html(
            '<option value="false" hidden>SEM EQUIPES DISPONIVEIS</option>'
);
      }else{
      for(var i=0;i < dadosVTR.length; i++){
        
      $('#'+id_).append(
            '<option  id="'+i+'" value="'+i+'">'+dadosVTR[i].nm_vtr+'</option>'

        );
      }
}
  }
    })

    $('#'+id_).on('change', function() {
	Select(this.value, this);
});

function Select(index) {
    
    var idLabel = id_.replace("opt","lbl");
    $.ajax({
  type:'post',		        //Definimos o método HTTP usado
  dataType: 'json',	        //Definimos o tipo de retorno
  url: 'pegarEquipes.php',    //Definindo o arquivo onde serão buscados os dados
  success: function(dadosVTR){
             $('#'+idLabel).html(
        
        '<table style="background-color:whitesmoke;" class="table container">'+
        '<input name="id_equipe" type="hidden" id="id_equipe"value="'+dadosVTR[index].id_equipe+'"/>'+
        '<input name="nome_equipe" type="hidden" value="'+dadosVTR[index].nm_vtr+'"/>'+
        '<tr><td><label>Suporte: </label> '+
        '<input type="text" name="suporte" value="'+dadosVTR[index].tp_viatura+'" ></td>'+
        '<td><label id="" for="">Condutor: </label>'+
        '<input type="text" name="nm_motorista" value="'+dadosVTR[index].nm_motorista+'"> </td>'+
        '<td><label>Aux de Enfermagem: </label>'+
        '<input type="text" name="nm_aux_enf" value="'+dadosVTR[index].nm_aux_enf+'" ></td></tr>'+
        '<tr><td><label>Enfermeiro: </label>'+
        '<input type="text" name="nm_enfermeiro" value="'+dadosVTR[index].nm_enfermeiro+'" ></td>'+
        '<td><label>Médico(a) Intervenção </label>'+
        '<input type="text" name="nm_med_intervencao" value="'+dadosVTR[index].nm_med_intervencao+'" ></td></tr></table>'
        
        );
        }
    }).done(function(dadosVTR){
        
        let id_equipe = document.getElementById('id_equipe').value;
        $.ajax({
            url: "salvarEquipe.php",
            method: "POST",
            dataType: "html",
            data: {
                id_equipe: id_equipe
            }
           
    });

    }) 
    }//fim da function SELECT
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
