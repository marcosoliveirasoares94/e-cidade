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

require("libs/db_stdlib.php");
require("libs/db_conecta.php");
include("libs/db_sessoes.php");
include("libs/db_usuariosonline.php");
include("classes/db_cidadao_classe.php");
include("classes/db_cidadaoemail_classe.php");
include("classes/db_cidadaotelefone_classe.php");
include("dbforms/db_funcoes.php");
include("libs/db_utils.php");
include("libs/db_app.utils.php");

$oGet     = db_utils::postMemory($_GET);
$db_opcao = 3;
$db_botao = true;

?>
<html>
<head>
<title>DBSeller Inform&aacute;tica Ltda - P&aacute;gina Inicial</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Expires" CONTENT="0">
<? 
	db_app::load('strings.js');
	db_app::load('scripts.js');
	db_app::load('datagrid.widget.js');
	db_app::load('prototype.js');
	db_app::load('estilos.css');
	db_app::load('grid.style.css');
	
?>
</head>
<body bgcolor=#CCCCCC leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="a=1" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr align="center"> 
    <td height="430" align="left" valign="top" bgcolor="#CCCCCC"> 
    <center>
			<?
			  include("forms/db_frmdetalhecidadaoatendimento.php");
			?>
    </center>
	</td>
  </tr>
</table>
</body>
</html>
<script>
  <?

    if ( $oGet->sTipo == 'CGM' ) {
		  echo "js_pesquisaCGM({$oGet->iCodigo});";
    } else {
      echo "js_pesquisaCidadao({$oGet->iCodigo});";    	
    }
  
  ?>
</script>