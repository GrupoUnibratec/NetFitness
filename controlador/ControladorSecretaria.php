<?php
/**
 * Description of ControladorSecretaria
 *
 * @author Schmitz
 */

include ($serverPath.'repositorio/RepositorioSecretaria.php');

class ControladorSecretaria {
    //put your code here
    
    private $repositorioSecretaria;
    
    function __construct() {
        $this->repositorioSecretaria = new RepositorioSecretaria();
    }
    
    function getRepositorioSecretaria() {
        return $this->repositorioSecretaria;
    }

    function setRepositorioSecretaria($repositorioSecretaria) {
        $this->repositorioSecretaria = $repositorioSecretaria;
    }

    public function inserir($secretaria){
        
        if(ExpressoesRegulares::validarTodosOsCampos($secretaria)){
            return $this->repositorioSecretaria->inserir($secretaria);
        }else{
            throw new Exception(Excecoes::inserirObjeto("secretaria"));
       }
        
    }
    public function alterar($secretaria){
        
        if(ExpressoesRegulares::validarTodosOsCampos($secretaria)){
            return $this->repositorioSecretaria->alterar($secretaria);
        }else{
            throw new Exception(Excecoes::alterarObjeto("secretaria"));
        }
    }

    public function excluir($secretaria){ 
        $this->repositorioSecretaria->excluir($secretaria);    
    }
    
   public function listar($fetchType){
        return $this->getRepositorioSecretaria()->listar($fetchType);
    }
    
    public function logar($secretaria){
        return $this->getRepositorioSecretaria()->logar($secretaria);
    }
    
    public function detalhar($secretaria, $fetchType)
    {
        return $this->getRepositorioSecretaria()->detalhar($secretaria, $fetchType);
    }
    
    public function conferirLoginSenha($secretaria)
    {
        return $this->getRepositorioSecretaria()->conferirLoginSenha($secretaria);
    }
}
