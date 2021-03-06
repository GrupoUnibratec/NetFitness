<?php
/**
 * Description of ControladorOpiniao
 *
 * @author Fábio
 */
include ($serverPath.'repositorio/RepositorioOpiniao.php');

class ControladorOpiniao {
    
    private $repositorioOpiniao;
    
    function __construct() {  
        $this->setRepositorioOpiniao(new RepositorioOpiniao());
    }
    
    function getRepositorioOpiniao() {
        return $this->repositorioOpiniao;
    }
    
    function setRepositorioOpiniao($repositorioOpiniao) {
        $this->repositorioOpiniao = $repositorioOpiniao;
    }
    
    public function inserir($opiniao){        
        if((!ExpressoesRegulares::conferirDescricao($opiniao->getDescricao()))){
            throw Excecoes::descricaoInvalida($opiniao->getDescricao());
        }//if((!ExpressoesRegulares::conferirData($opiniao->getDataPostagem()))){
           // throw Excecoes::dataInvalida($opiniao->getDataPostagem());
        else{
            return $this->getRepositorioOpiniao()->inserir($opiniao);
        }
    }
    
    public function alterar($opiniao){        
        if((!ExpressoesRegulares::conferirDescricao($opiniao->getDescricao()))){
            throw Excecoes::descricaoInvalida($opiniao->getDescricao());
        /*}if((!ExpressoesRegulares::conferirData($opiniao->getDataPostagem()))){
            throw Excecoes::dataInvalida($opiniao->getDataPostagem());*/
        }else{
            return $this->getRepositorioOpiniao()->alterar($opiniao);
        }        
    }
    
    public function excluir($opiniao){
        return $this->getRepositorioOpiniao()->excluir($opiniao);
    }
    
    public function listar($fetchType){
        return $this->repositorioOpiniao->listar($fetchType); 
    }
    
    public function listarPorAluno($aluno, $fetchType){
        return $this->repositorioOpiniao->listarPorAluno($aluno, $fetchType); 
    }
    
    public function detalhar($opiniao, $fetchType)
    {
        return $this->repositorioOpiniao->detalhar($opiniao, $fetchType);
    }
}
