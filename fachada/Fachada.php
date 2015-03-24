<?php

/**
 * Description of Fachada
 *
 * @author Marcelo
 */
include('../serverPath.php');
include('IFachada.php');
include($serverPath . 'controlador/ControladorAluno.php');
include($serverPath . 'controlador/ControladorCoordenador.php');
include($serverPath . 'controlador/ControladorInstrutor.php');
include($serverPath . 'controlador/ControladorSecretaria.php');
include($serverPath . 'controlador/ControladorExercicio.php');
include($serverPath . 'controlador/ControladorNutricionista.php');
include($serverPath . 'controlador/ControladorTreino.php');
include($serverPath . 'controlador/ControladorOpiniao.php');
include($serverPath . 'controlador/ControladorAlimento.php');
include($serverPath . 'controlador/ControladorDieta.php');
include($serverPath . 'controlador/ControladorPagamento.php');

class Fachada implements IFachada 
{

    private $controladorAluno;
    private $controladorInstrutor;
    private $controladorSecretaria;
    private $controladorCoordenador;
    private $controladorExercicio;
    private $controladorNutricionista;
    private $controladorTreino;
    private $controladorOpiniao;
    private $controladorAlimento;
    private $controladorDieta;
    private $controladorPagamento;
    
    private static $instance = null;

    function __construct() 
    {
        $this->controladorAluno = new ControladorAluno();
        $this->controladorInstrutor = new ControladorInstrutor();
        $this->controladorSecretaria = new ControladorSecretaria();
        $this->controladorCoordenador = new controladorCoordenador();
        $this->controladorExercicio = new ControladorExercicio();
        $this->controladorNutricionista = new ControladorNutricionista();
        $this->controladorTreino = new ControladorTreino();
        $this->controladorAlimento = new ControladorAlimento();
        $this->controladorDieta = new ControladorDieta();
        $this->controladorOpiniao = new ControladorOpiniao();
        $this->controladorPagamento = new ControladorPagamento();
    }

//self:: serve para chamar um atributo statico da propria classe
    public static function getInstance() {

        if (self::$instance === null) {
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
        $this->controladorAluno->inserir($aluno);
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

    public function incluirSecretaria($secretaria) {
        $this->controladorSecretaria->inserir($secretaria);
    }

    public function alterarSecretaria($secretaria) {
        $this->controladorSecretaria->alterar($secretaria);
    }

    public function excluirSecretaria($secretaria) {
        $this->controladorSecretaria->excluir($secretaria);
    }

    public function listarSecretaria() {
        return $this->controladorSecretaria->listar();
    }

    public function detalharSecretaria($secretaria) {
        return $this->controladorSecretaria->listar();
    }

    public function logarCoordenador($coordenador) {
        return $this->controladorCoordenador->logar($coordenador);
    }

    public function logarSecretaria($secretaria) {
        return $this->controladorSecretaria->logar($secretaria);
    }

    public function logarAluno($aluno) {
        return $this->controladorAluno->logar($aluno);
    }

    public function incluirExercicio($exercicio) {
        return $this->controladorExercicio->inserir($exercicio);
    }

    public function alterarExercicio($exercicio) {
        return $this->controladorExercicio->alterar($exercicio);
    }

    public function excluirExercicio($exercicio) {
        return $this->controladorExercicio->excluir($exercicio);
    }

    public function listarExercicios() {
        
    }

    public function detalharExercicio($exercicio) {
        
    }

    public function logarInstrutor($instrutor) {
        return $this->controladorInstrutor->logar($instrutor);
    }

       public function incluirTreino($treino) {
        return $this->controladorTreino->inserir($treino);
    }

    public function alterarTreino($treino) {
        return $this->controladorTreino->alterar($treino);
    }

    public function excluirTreino($treino) {
        return $this->controladorTreino->excluir($treino);
    }

    public function listarTreino() {
        return $this->controladorTreino->listar();
    }

    public function detalharTreino($treino) {
        return $this->controladorTreino->detalhar($treino);
    }
    
    //Opinião
    public function inserirOpiniao($opiniao) {
        return $this->controladorOpiniao->inserir($opiniao);
    }
    
    public function alterarOpiniao($opiniao) {
        return $this->controladorOpiniao->alterar($opiniao);
    }
    
    public function excluirOpiniao($opiniao) {
        return $this->controladorOpiniao->excluir($opiniao);
    }

    public function listarOpinioes() {
        return $this->controladorOpiniao->listar();
    }

    public function alterarAlimento($alimento) 
    {
        
    }

    public function detalharAlimento($alimento) 
    {
        
    }

    public function excluirAlimento($alimento) 
    {
        
    }

    public function inserirAlimento($alimento) 
    {
        
    }

    public function listarAlimentos() 
    {
        return $this->controladorAlimento->listar();
    }

    public function alterarDieta($dieta)
    {
        $this->controladorDieta->alterar($dieta);
    }

    public function detalharDieta($dieta)
    {
        return $this->controladorDieta->detalhar($dieta);
    }

    public function excluirDieta($dieta)
    {
        $this->controladorDieta->excluir($dieta);
    }

    public function inserirDieta($dieta)
    {
        $this->controladorDieta->inserir($dieta);
    }

    public function listarDietas($nutricionista)
    {
        return $this->controladorDieta->listar($nutricionista);
    }
    
    //Nutricionista
     public function logarNutricionista($nutricionista) {
        return $this->controladorNutricionista->logar($nutricionista);
    }
    
    public function inserirNutricionista($nutricionista)
    {
        $this->controladorNutricionista->inserir($nutricionista);
    }
    
     public function alterarNutricionista($nutricionista)
    {
        $this->controladorNutricionista->alterar($nutricionista);
    }
    
    public function excluirNutricionista($nutricionista)
    {
        $this->controladorNutricionista->excluir($nutricionista);
    }

    public function listarNutricionistas()
    {
        return $this->controladorNutricionista->listar();
    }
    
    public function detalharNutricionista($nutricionista)
    {
        $this->controladorNutricionista->detalhar($nutricionista);
    }
    
    //pagamento
    public function inserirPagamento($pagamento) {
        $this->controladorPagamento->inserir($pagamento);
    }
    
    public function alterarPagamento($pagamento) {
        $this->controladorPagamento->alterar($pagamento);
    }
    
    public function excluirPagamento($pagamento) {
        $this->controladorPagamento->excluir($pagamento);
    }
    
    public function ListarPagamento() {
        $this->controladorPagamento->listar();
    }
}
