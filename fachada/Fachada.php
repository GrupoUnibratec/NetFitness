
<?php
/**
 * Description of Fachada
 *
 * @author Marcelo
 */

include('IFachada.php');
include('controlador/ControladorAluno.php');
include('controlador/ControladorCoordenador.php');
include('controlador/ControladorInstrutor.php');
include('controlador/ControladorSecretaria.php');


class Fachada implements IFachada{
    
    private $controladorAluno;
    private $controladorInstrutor;
    private $controladorSecretaria;
    private $controladorCoordenador;
    
    private static $instance = null;
            
    function __construct() {
        $this->controladorAluno = new ControladorAluno();
        $this->controladorInstrutor = new ControladorInstrutor();
        $this->controladorSecretaria = new ControladorSecretaria();
        $this->controladorCoordenador = new controladorCoordenador();
    }
    //self:: serve para chamar um atributo statico da propria classe
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new Fachada();
        }
        return self::$instance;
    }
    
    public function alterarAluno($aluno) {
        
        $this->controladorAluno->alterar($aluno);
    }
    public function alterarInstrutor($instrutor) {
        
        $this->controladorInstrutor->alterar($instrutor);
    }
    public function detalharAluno($aluno) {
        
        return $this->controladorAluno->detalhar($aluno);
    }
    public function detalharInstrutor($instrutor) {
        
        return $this->controladorInstrutor->detalhar($instrutor);
    }
    public function excluirAluno($aluno) {
        
        $this->controladorAluno->excluir($aluno);
    }
    public function excluirInstrutor($instrutor) {
        
        $this->controladorInstrutor->alterar($instrutor);
    }
    public function incluirAluno($aluno) {
        
        $this->controladorAluno->incluir($aluno);
    }
    public function incluirInstrutor($instrutor) {
        
        $this->controladorInstrutor->incluir($instrutor);
    }
    public function listarAlunos() {
        
        return $this->controladorAluno->listar();
    }
    public function listarInstrutores() {
        
        return $this->controladorInstrutor->listar();
    }
    public function incluirSecretaria($secretaria){
        
        $this->controladorSecretaria->inserir($secretaria);
    }
    
    public function alterarSecretaria($secretaria){
        
        $this->controladorSecretaria->alterar($secretaria);
    }
    
    public function excluirSecretaria($secretaria){
        
        $this->controladorSecretaria->excluir($secretaria);
    }
    
    public function listarSecretaria(){
        return  $this->controladorSecretaria->listar();
    }
    
    public function detalharSecretaria($secretaria) {
        return  $this->controladorSecretaria->listar();
    }
    
    public function logarCoordenador($coordenador)
    {
       return $this->controladorCoordenador->logar($coordenador);
    }
    
    public function logarSecretaria($secretaria){
        return $this->controladorSecretaria->logar($secretaria);
    }
    
    public function logarAluno($aluno){
        return $this->controladorAluno->logar($aluno);
    }
}
