<?php
/**
 * Description of ControladorSecretaria
 *
 * @author Schmitz
 */
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
    
    public function listar(){
        return $this->getRepositorioSecretaria()->listar();
    }
}