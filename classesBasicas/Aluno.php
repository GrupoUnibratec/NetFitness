<?php

/**
 * Description of Aluno
 *
 * @author Daniele
 */

include_once('Pessoa.php');

class Aluno extends Pessoa
{
    private $idAluno;
    private $sexo;
    private $dataNascimento;
    private $secretaria;
    private $musica;
    private $dieta;
    private $listaPagamentos;
    private $listaTreinos; 
    private $foto;


    public function __construct() 
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }
    
    public function __construct1($idAluno)
    {
        parent::__construct($idAluno);
        $this->setIdAluno($idAluno);
    }
    
    public function __construct2($login, $senha)
    {
        $this->setLogin($login);
        $this->setSenha($senha);
    }

        public function __construct16($idAluno, $nome, $cpf, $endereco, $senha, $telefone, $login, $email, $sexo, $dataNascimento, $secretaria,
                                $musica, $dieta, $listaPagamentos, $listaTreinos, $foto) 
    {
        parent::__construct($idAluno, $nome, $cpf, $endereco, $senha, $telefone, $login, $email);
        
        $this->setIdAluno($idAluno);
        $this->setSexo($sexo);
        $this->setdataNascimento($dataNascimento);
        $this->setSecretaria($secretaria);
        $this->setDieta($dieta);
        $this->setMusica($musica);
        $this->setListaPagamentos($listaPagamentos);
        $this->setListaTreinos($listaTreinos);
        $this->setFoto($foto);
        
    }
    
    
    function getIdAluno() {
        return $this->idAluno;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getdataNascimento() {
        return $this->dataNascimento;
    }

    function getSecretaria() {
        return $this->secretaria;
    }

    function setIdAluno($idAluno) {
        $this->idAluno = $idAluno;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setdataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    function setSecretaria($secretaria) {
        $this->secretaria = $secretaria;
    }
    
    function getMusica() {
        return $this->musica;
    }

    function getDieta() {
        return $this->dieta;
    }

    function getListaPagamentos() {
        return $this->listaPagamentos;
    }

    function getListaTreinos() {
        return $this->listaTreinos;
    }

     function getFoto() {
        return $this->foto;
    }
    function setMusica($musica) {
        $this->musica = $musica;
    }

    function setDieta($dieta) {
        $this->dieta = $dieta;
    }

    function setListaPagamentos($listaPagamentos) {
        $this->listaPagamentos = $listaPagamentos;
    }

    function setListaTreinos($listaTreinos) {
        $this->listaTreinos = $listaTreinos;
    }

   

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function calcularIMC($peso, $altura){
        
        if($peso <= 0 || $altura <= 0){
            
            return "Peso e Altura não podem ser menor ou igual a 0.";
            
        }else{
            
            $imc = $peso / ($altura * $altura);
            
            if($imc < 17){

                return "Seu IMC é ".substr($imc, 0, 5)." você está muito abaixo do peso.";

            }else if($imc <= 18.49){

                return "Seu IMC é ".substr($imc, 0, 5)." você está abaixo do peso.";

            }else if($imc <= 24.99){

                return "Seu IMC é ".substr($imc, 0, 5)." você está no peso normal.";

            }else if($imc <= 29.99){

                return "Seu IMC é ".substr($imc, 0, 5)." você está acima do peso.";

            }else if($imc <= 34.99){

                return "Seu IMC é ".substr($imc, 0, 5)." você está na obesidade I.";

            }else if($imc <= 39.99){

                return "Seu IMC é ".substr($imc, 0, 5)." você está na obesidade II(Severa).";

            }else{

                return "Seu IMC é ".substr($imc, 0, 5)." você está na obesidade III(Morbida).";

            }
            
        }
        
    }
    
}
