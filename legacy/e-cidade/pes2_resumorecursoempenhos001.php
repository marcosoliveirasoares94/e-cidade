<?
/*
 *     E-cidade Software Publico para Gestao Municipal                
 *  Copyright (C) 2013  DBselller Servicos de Informatica             
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

require_once("libs/db_stdlib.php");
require_once("libs/db_conecta.php");
require_once("libs/db_sessoes.php");
require_once("libs/db_usuariosonline.php");
require_once("dbforms/db_funcoes.php");
require_once("classes/db_gerfcom_classe.php");

db_postmemory($HTTP_POST_VARS);

$clgerfcom = new cl_gerfcom;
$clrotulo  = new rotulocampo;

$clrotulo->label('DBtxt23');
$clrotulo->label('DBtxt25');
$clrotulo->label('DBtxt27');
$clrotulo->label('DBtxt28');
$clrotulo->label('r48_semest');
?>
<html>
<head>
<title>DBSeller Inform&aacute;tica Ltda - P&aacute;gina Inicial</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Expires" CONTENT="0">
<script language="JavaScript" type="text/javascript" src="scripts/scripts.js"></script>
<link href="estilos.css" rel="stylesheet" type="text/css">
<script>
function js_verifica(){
  var anoi = new Number(document.form1.datai_ano.value);
  var anof = new Number(document.form1.dataf_ano.value);
  if(anoi.valueOf() > anof.valueOf()){
    alert('Intervalo de data invalido. Velirique !.');
    return false;
  }
  return true;
}

function js_emite() {
  qry = "";
  if(document.form1.r48_semest){
    qry = "&iSemestre="+document.form1.r48_semest.value;
  }
  
  jan = window.open('pes2_resumorecursoempenhos002.php?sPonto='+document.form1.ponto.value+
                    '&iAno='+document.form1.DBtxt23.value+
                    '&iMes='+document.form1.DBtxt25.value+
                    qry, 
                    '', 
                    'width='+(screen.availWidth-5)+', height='+(screen.availHeight-40)+', scrollbars=1, location=0');
  jan.moveTo(0,0);
}
</script> 
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="a=1" bgcolor="#cccccc">
<center>
  <form name="form1" method="post" action="" onsubmit="return js_verifica();">
    <table align="center">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr valign="top">
        <td>
          <fieldset>
            <legend><b>Resumo por Recurso</b></legend>
          <form name="form1" method="post" action="" onsubmit="return js_verifica();">
            <table  align="center">
                <tr >
                  <td align="left" nowrap title="Digite o Ano / Mes de compet�ncia" >
                  <strong>Ano / M�s :&nbsp;&nbsp;</strong>
                  </td>
                  <td>
                    <?
                     $DBtxt23 = db_anofolha();
                     db_input('DBtxt23',4,$IDBtxt23,true,'text',2,'')
                    ?>
                    &nbsp;/&nbsp;
                    <?
                     $DBtxt25 = db_mesfolha();
                     db_input('DBtxt25',2,$IDBtxt25,true,'text',2,'')
                    ?>
                  </td>
                </tr>
                <tr>
                  <td  align="left" ><b>Ponto:</b</td>
                  <td >
                   <?
                     $x = array("s"=>"Sal�rio","c"=>"Complementar","d"=>"13o. Sal�rio","r"=>"Rescis�o","a"=>"Adiantamento");
                     db_select('ponto',$x,true,4,"onchange='document.form1.submit();'");
                   ?>
                  </td>
                </tr>
               <?
               if (isset($ponto) && $ponto == "c") {
                
                 $sSql = $clgerfcom->sql_query_file(null,
                 																    null,
                 																		null,
                 																		null,
                 																		"distinct r48_semest",
                 																		null,
                 																		"   r48_anousu = $DBtxt23 
                 		                                and r48_mesusu = $DBtxt25 
                 		                                and r48_semest <> 0");
                 
                 $result_semest = $clgerfcom->sql_record($sSql);
                 
                 if ($clgerfcom->numrows > 0) {
	                 echo "
	                  <tr>
	                    <td  align='left' title='".$Tr48_semest."'><strong>Nro. Complementar:</strong></td>
	                          <td>
	                      <select name='r48_semest'>
	                  <option value = ''>Todos</option>
	                      ";
	                      for($i=0; $i<$clgerfcom->numrows; $i++){
	                        db_fieldsmemory($result_semest, $i);
	                        
	                        	echo "<option value = '$r48_semest'>$r48_semest</option>";
	                        
	                      }
	                 echo "
	                    </td>
	                  </tr>
	                      ";
                 } else {
                 	echo "<tr><td  align='left' title='Sem complementar'><strong>Sem Complementar</strong></td><td></tr>";
                 }
               }
               ?>
                </tr>
            </table>
          </form>
          </fieldset>
          <table align="center">
            <tr>
              <td colspan="2" align = "center"> 
                <input  name="emite2" id="emite2" type="button" value="Processar" onclick="js_emite();" >
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </form>
</center>
<?
  db_menu(db_getsession("DB_id_usuario"),db_getsession("DB_modulo"),db_getsession("DB_anousu"),db_getsession("DB_instit"));
?>
</body>
</html>
<script>
function js_pesquisatabdesc(mostra){
     if(mostra==true){
       db_iframe.jan.location.href = 'func_tabdesc.php?funcao_js=parent.js_mostratabdesc1|0|2';
       db_iframe.mostraMsg();
       db_iframe.show();
       db_iframe.focus();
     }else{
       db_iframe.jan.location.href = 'func_tabdesc.php?pesquisa_chave='+document.form1.codsubrec.value+'&funcao_js=parent.js_mostratabdesc';
     }
}
function js_mostratabdesc(chave,erro){
  document.form1.k07_descr.value = chave;
  if(erro==true){
     document.form1.codsubrec.focus();
     document.form1.codsubrec.value = '';
  }
}
function js_mostratabdesc1(chave1,chave2){
     document.form1.codsubrec.value = chave1;
     document.form1.k07_descr.value = chave2;
     db_iframe.hide();
}
</script>

<?
if(isset($ordem)){
  echo "<script>
       js_emite();
       </script>";  
}

$func_iframe = new janela('db_iframe','');
$func_iframe->posX=1;
$func_iframe->posY=20;
$func_iframe->largura=780;
$func_iframe->altura=430;
$func_iframe->titulo='Pesquisa';
$func_iframe->iniciarVisivel = false;
$func_iframe->mostrar();
?>