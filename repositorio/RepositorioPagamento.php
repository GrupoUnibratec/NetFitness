<?php
/**
 * Description of RepositorioPagamento
 *
 * @author Fábio
 */
include($serverPath.'interfaceRepositorio/IRepositorioPagamento.php');
include_once($serverPath.'excecoes/Excecoes.php');
include_once($serverPath.'conexao/Conexao.php');

class RepositorioPagamento extends RepositorioPessoa implements IRepositorioPagamento {
    
    function __construct() {
       parent::__construct();  
    }
    
   public function inserir($pagamento){
        
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === true){
            
            /*$sql = "INSERT INTO pagamento VALUES( null,";
            //$sql.= NULL. ",";
            $sql.= $pagamento->getValor().",'";
            //$sql.= "null, '";
            $sql.= $pagamento->getDataPagamento()."','";
            $sql.= $pagamento->getDataVencimento()."',";
            $sql.= $pagamento->getSecretaria()->getIdSecretaria().",";
            $sql.= $pagamento->getAluno()->getIdAluno().")";*/
            
            $sql = "INSERT INTO pagamento VALUES( null,"
                    .$pagamento->getValor().", null,'"
                    //.$pagamento->getDataPagamento().",'"
                    .$pagamento->getDataVencimento()."',"
                    .$pagamento->getSecretaria()->getIdSecretaria().","
                    .$pagamento->getAluno()->getIdAluno(). ")";
            
            //$sql = "INSERT INTO pagamento(valor,dataVencimento, idSecretaria, idAluno) VALUES (200,'2015-05-12',12,10";
            
            if(mysqli_query($this->getConexao(), $sql)){
               
               // $this->fecharConexao();
           
            }else{
                throw new Exception(Excecoes::inserirObjeto("Pagamento".  mysqli_error($this->getConexao())));
            }
            
        }else {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->erro.")"));
        }   
    } 
    
    public function alterar($pagamento){
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            $sql = "UPDATE pagamento SET valor = '".$pagamento->getValor()
                                                 ."', dataPagamento = '".$pagamento->getDataPagamento()
                                                 ."', dataVencimento = '".$pagamento->getDataVencimento()
                                                 ."' WHERE idSecretaria = '".$pagamento->getSecretaria()->getIdSecretaria()
                                                 ."' AND idAluno = '".$pagamento->getAluno()->getIdAluno();//getIdAluno();  
                       
            if( mysqli_query($this->getConexao(), $sql)){
                
                //$this->fecharConexao();
                return TRUE;
            }else{
                throw new Exception(Excecoes::alterarObjeto("Pagamento: ".mysqli_error($this->getConexao())));
            }
            
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
        
    }
    
    public function excluir($pagamento){
       
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            $sql = "DELETE FROM pagamento WHERE idPagamento = ".$pagamento->getIdPagamento();
            
            if( mysqli_query($this->getConexao(), $sql)){
                
                //$this->fecharConexao();
                return TRUE;
            }else{
                throw new Exception(Excecoes::alterarObjeto("Pagamento: ".mysqli_error($this->getConexao())));
            }
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }   
    
    
    public function listar($fetchType)
    {
        $listaPagamentosRetornados = array();       
        $sql = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sql) === TRUE)
        {
            $sqlListaPagamentos = "SELECT * FROM pagamento";
                    
            try
            {
                $resultListaPagamentos = mysqli_query($this->getConexao(), $sqlListaPagamentos);

                while ($rowListaPagamentos = mysqli_fetch_array($resultListaPagamentos)) 
                {
                    $pagamentoRetornado = new Pagamento($rowListaPagamentos['idPagamento']);

                    if($fetchType == EAGER)
                    {
                        $pagamentoRetornado = $this->detalhar($pagamentoRetornado, EAGER);                       
                    }
                    else 
                    {
                        $pagamentoRetornado = $this->detalhar($pagamentoRetornado, LAZY);    
                    }

                    array_push($listaPagamentosRetornados, $pagamentoRetornado);

                }
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            
            return $listaPagamentosRetornados;
        }
        else
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->error.")"));
        }
        
    }

 
    public function detalhar($pagamento, $fetchType)
    {
        $sqlPagamento = "USE " . $this->getNomeBanco();
        
        if($this->getConexao()->query($sqlPagamento) === true)
        { 
            $sqlPagamento = "SELECT * FROM pagamento WHERE idPagamento = '".$pagamento->getIdPagamento()."'";             
            
            try
            {
                $resultPagamento = mysqli_query($this->getConexao(), $sqlPagamento);
                $rowPagamento = mysqli_fetch_assoc($resultPagamento);
                $pagamentoRetornado = new Pagamento($rowPagamento['idPagamento'], $rowPagamento['valor'], 
                                                    $rowPagamento['dataVencimento'], $rowPagamento['dataPagamento'],
                                                    null/*$secretaria*/, null/*$aluno*/);
            }
            catch (Exception $exc)
            {
                throw new Exception($exc->getMessage());
            }
            
            if($fetchType === EAGER)
            {
               try
               {
                    //Secretaria            
                    $pagamentoRetornado->setSecretaria($this->detalharObjeto(new Secretaria($rowPagamento['idSecretaria']), LAZY));
                    //Aluno
                    $pagamentoRetornado->setAluno($this->detalharObjeto(new Aluno($rowPagamento['idAluno']), LAZY));
                                
                }
                catch (Exception $exc)
                {
                    throw new Exception($exc->getMessage());
                }
            }         
            
            return $pagamentoRetornado;
        }  
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco()."(".$this->getConexao()->error.")"));
        }
    }
}
