<?
/*
 *     E-cidade Software Publico para Gestao Municipal                
 *  Copyright (C) 2009  DBselller Servicos de Informatica             
 *                            www.dbseller.com.br                     
 *                         e-cidade@dbseller.com.br                   
 *                                                                    
 *  Este programa e software livre; voce pode redistribui-lo e/ou     
 *  modifica-lo sob os termos da Licenca Publica Geral GNU, conforme  
 *  publicada pela Free Software Foundation; tanto a versao 2 da      
 *  Licenca como (a seu criterio) qualquer versao mais nova.          
 *                                                                    
 *  Este programa e distribuido na expectativa de ser util, mas SEM   
 *  QUALQUER GARANTIA; sem mesmo a garantia implicita de              
 *  COMERCIALIZACAO ou de ADEQUACAO A QUALQUER PROPOSITO EM           
 *  PARTICULAR. Consulte a Licenca Publica Geral GNU para obter mais  
 *  detalhes.                                                         
 *                                                                    
 *  Voce deve ter recebido uma copia da Licenca Publica Geral GNU     
 *  junto com este programa; se nao, escreva para a Free Software     
 *  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA          
 *  02111-1307, USA.                                                  
 *  
 *  Copia da licenca no diretorio licenca/licenca_en.txt 
 *                                licenca/licenca_pt.txt 
 */

//MODULO: orcamento
$clreceita->rotulo->label();
$clrotulo = new rotulocampo;
$clrotulo->label("o02_descr");
$clrotulo->label("o02_descr");
?>
<form name="form1" method="post" action="">
<center>
<table border="0">
  <tr>
    <td nowrap title="<?=@$To08_codigo?>">
       <?
       db_ancora(@$Lo08_codigo,"js_pesquisao08_codigo(true);",$db_opcao);
       ?>
    </td>
    <td> 
<?
db_input('o08_codigo',12,$Io08_codigo,true,'text',$db_opcao," onchange='js_pesquisao08_codigo(false);'")
?>
       <?
db_input('o02_descr',40,$Io02_descr,true,'text',3,'')
       ?>
    <td>
  <tr>
  <tr>
    <td nowrap title="<?=@$To08_reduz?>">
       <?=@$Lo08_reduz?>
    </td>
    <td> 
<?
db_input('o08_reduz',5,$Io08_reduz,true,'text',$db_opcao,"")
?>
    <td>
  <tr>
  <tr>
    <td nowrap title="<?=@$To08_valor?>">
       <?=@$Lo08_valor?>
    </td>
    <td> 
<?
db_input('o08_valor',0,$Io08_valor,true,'text',$db_opcao,"")
?>
    <td>
  <tr>

  </table>
  </center>
<input name="db_opcao" type="submit" id="db_opcao" value="<?=($db_opcao==1?"Incluir":($db_opcao==2?"Alterar":"Excluir"))?>" <?=($db_botao==false?"disabled":"")?> >
<input name="pesquisar" type="button" id="pesquisar" value="Pesquisar" onclick="js_pesquisa();" >
</form>
<script>

function js_pesquisao08_codigo(mostra){
  if(mostra==true){
    db_iframe.jan.location.href = 'func_orcam.php?funcao_js=parent.js_mostraorcam1|0|1';
    db_iframe.mostraMsg();
    db_iframe.show();
    db_iframe.focus();
  }else{
    db_iframe.jan.location.href = 'func_orcam.php?pesquisa_chave='+document.form1.o08_codigo.value+'&funcao_js=parent.js_mostraorcam';
  }
}
function js_mostraorcam(chave,erro){
  document.form1.o02_descr.value = chave; 
  if(erro==true){ 
    document.form1.o08_codigo.focus(); 
    document.form1.o08_codigo.value = ''; 
  }
}
function js_mostraorcam1(chave1,chave2){
  document.form1.o08_codigo.value = chave1;
  document.form1.o02_descr.value = chave2;
  db_iframe.hide();
}
function js_pesquisa(){
  db_iframe.jan.location.href = 'func_receita.php?funcao_js=parent.js_preenchepesquisa|0';
  db_iframe.mostraMsg();
  db_iframe.show();
  db_iframe.focus();
}
function js_preenchepesquisa(chave){
  db_iframe.hide();
  location.href = '<?=basename($GLOBALS["HTTP_SERVER_VARS"]["PHP_SELF"])?>'+"?chavepesquisa="+chave;
}
</script>
<?
$func_iframe = new janela('db_iframe','');
$func_iframe->posX=1;
$func_iframe->posY=20;
$func_iframe->largura=780;
$func_iframe->altura=430;
$func_iframe->titulo='Pesquisa';
$func_iframe->iniciarVisivel = false;
$func_iframe->mostrar();
?>