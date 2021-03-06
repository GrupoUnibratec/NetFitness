<?php
/**
 * Description of repositorioPessoa
 *
 * @author Daniele
 */


include ($serverPath.'interfaceRepositorio/IRepositorioPessoa.php');
include ($serverPath.'repositorioGenerico/RepositorioGenerico.php');

class RepositorioPessoa extends RepositorioGenerico implements IRepositorioPessoa
{
    public function __construct() 
    {
        parent::__construct();
    }
  
    public function conferirLoginSenha($pessoa)
    {
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE)
        {
        
            $sql = "SELECT * FROM pessoa WHERE login = '".$pessoa->getLogin()."' AND senha = '".$pessoa->getSenha()."'";

            if($result = mysqli_query($this->getConexao(), $sql))
            {
                $numRows = mysqli_num_rows($result);
                
                if($numRows!=0)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                throw new Exception(mysqli_error($this->getConexao()));
            }
        }
        else 
        {
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }
    
    public function inserirPessoa($pessoa)
    {
        $sql = "INSERT INTO pessoa values(null,'";
        $sql .= $pessoa->getNome()."','";
        $sql .= $pessoa->getCpf()."','";
        $sql .= $pessoa->getEndereco()."','";
        $sql .= $pessoa->getSenha()."','";
        $sql .= $pessoa->getTelefone()."','";
        $sql .= $pessoa->getLogin()."','";
        $sql .= $pessoa->getEmail()."')";

        if( mysqli_query($this->getConexao(), $sql))
        {return TRUE;}
        else
        {return FALSE;}
    }
 
    public function alterarPessoa($pessoa)
    {
        $sql = "UPDATE pessoa SET nome='" . $pessoa->getNome() . "',";
        $sql.= "cpf='" . $pessoa->getCpf(). "',";
        $sql.= "endereco='" . $pessoa->getEndereco(). "',";
        $sql.= "senha='" . $pessoa->getSenha().  "',";
        $sql.= "telefone='" . $pessoa->getTelefone().  "',";
        $sql.= "login='" . $pessoa->getLogin().  "',";
        $sql.= "email='" . $pessoa->getEmail().  "' ";
        $sql.= "WHERE idPessoa='" . $pessoa->getIdPessoa() . "'";

        if (mysqli_query($this->getConexao(), $sql)) 
        {return TRUE;}
        else
        {return FALSE;}
    }
    
    public function alterarPerfilPessoa($pessoa)
    {
        $sql = "UPDATE pessoa SET nome='" . $pessoa->getNome() . "',";
        $sql.= "senha='" . $pessoa->getSenha().  "',";
        $sql.= "telefone='" . $pessoa->getTelefone().  "',";
        $sql.= "login='" . $pessoa->getLogin().  "',";
        $sql.= "email='" . $pessoa->getEmail().  "' ";
        $sql.= "WHERE idPessoa='" . $pessoa->getIdPessoa() . "'";

        if (mysqli_query($this->getConexao(), $sql)) 
        {return TRUE;}
        else
        {return FALSE;}
    }
    
    public function logarPessoa($pessoa)
    {
        $pessoaReturn = null;
            
        $query = "SELECT * FROM pessoa WHERE login = '".$pessoa->getLogin()."' AND senha = '".$pessoa->getSenha()."' LIMIT 0,1";

        $result = mysqli_query($this->getConexao(), $query);
        
        while ($row = mysqli_fetch_array($result)) 
        {
            $pessoaReturn = new Pessoa($row['idPessoa'], $row['nome'], $row['cpf'], $row['endereco'], 
                                 $row['senha'], $row['telefone'], $row['login'], $row['email']);
        }        
        
        return $pessoaReturn;
    }

    public function excluirPessoa($pessoa)
    {
        $sql = "DELETE FROM pessoa WHERE idPessoa = '" . $pessoa->getIdPessoa() . "'";
        
        if (!mysqli_query($this->getConexao(), $sql))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

}
