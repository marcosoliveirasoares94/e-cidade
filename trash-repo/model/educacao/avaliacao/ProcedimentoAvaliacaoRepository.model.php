<?php
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

  /**
   * Classe repository para classes ProcedimentoAvaliacao
   * @author Iuri Guntchnigg <iuri@dbseller.com.br>
   * @package
   */
  class ProcedimentoAvaliacaoRepository {

    /**
     * Collection de ProcedimentoAvaliacao
     * @var array
     */
    private $aProcedimentoAvaliacao = array();

    /**
     * Instancia da classe
     * @var ProcedimentoAvaliacaoRepository
     */
    private static $oInstance;

    private function __construct() {

    }
    private function __clone() {

    }

    /**
     * Retorno uma instancia do ProcedimentoAvaliacao pelo Codigo
     * @param integer $iCodigo Codigo do ProcedimentoAvaliacao
     * @return ProcedimentoAvaliacao
     */
    public static function getProcedimentoByCodigo($iCodigoProcedimentoAvaliacao) {

      if (!array_key_exists($iCodigoProcedimentoAvaliacao, ProcedimentoAvaliacaoRepository::getInstance()->aProcedimentoAvaliacao)) {
        ProcedimentoAvaliacaoRepository::getInstance()->aProcedimentoAvaliacao[$iCodigoProcedimentoAvaliacao] = new ProcedimentoAvaliacao($iCodigoProcedimentoAvaliacao);
      }
      return ProcedimentoAvaliacaoRepository::getInstance()->aProcedimentoAvaliacao[$iCodigoProcedimentoAvaliacao];
    }

    /**
     * Retorna a instancia da classe
     * @return ProcedimentoAvaliacaoRepository
     */
    protected static function getInstance() {

      if (self::$oInstance == null) {

        self::$oInstance = new ProcedimentoAvaliacaoRepository();
      }
      return self::$oInstance;
    }

    /**
     * Adiciona um ProcedimentoAvaliacao dao repositorio
     * @param ProcedimentoAvaliacao $oProcedimentoAvaliacao Instancia do ProcedimentoAvaliacao
     * @return boolean
     */
    public static function adicionarProcedimentoAvaliacao(ProcedimentoAvaliacao $oProcedimentoAvaliacao) {

      if (!array_key_exists($oProcedimentoAvaliacao->getCodigo(), ProcedimentoAvaliacaoRepository::getInstance()->aProcedimentoAvaliacao)) {
        ProcedimentoAvaliacaoRepository::getInstance()->aProcedimentoAvaliacao[$oProcedimentoAvaliacao->getCodigo()] = $oProcedimentoAvaliacao;
      }
      return true;
    }

    /**
     * Remove o ProcedimentoAvaliacao passado como parametro do repository
     * @param ProcedimentoAvaliacao $oProcedimentoAvaliacao
     * @return boolean
     */
    public static function removerProcedimentoAvaliacao(ProcedimentoAvaliacao $oProcedimentoAvaliacao) {
       /**
        *
        */
      if (array_key_exists($oProcedimentoAvaliacao->getCodigo(), ProcedimentoAvaliacaoRepository::getInstance()->aProcedimentoAvaliacao)) {
        unset(ProcedimentoAvaliacaoRepository::getInstance()->aProcedimentoAvaliacao[$oProcedimentoAvaliacao->getCodigo()]);
      }
      return true;
    }

    /**
     * Retorna o total de cidadoes existentes no repositorio;
     * @return integer;
     */
    public static function getTotalProcedimentoAvaliacao() {
      return count(ProcedimentoAvaliacaoRepository::getInstance()->aProcedimentoAvaliacao);
    }
  }