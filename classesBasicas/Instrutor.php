<?php

/**
 * Description of Instrutor
 *
 * @author Marcelo
 */
class Instrutor extends Pessoa {
    
    private $idInstrutor;
    private $coordenador;
    private $listaTreinos;
    private $listaExamesFisicos;
    private $listaDicas;

    //parent:: (Construtor que passa os valores dos atributos para a super classe Pessoa)
    function __construct($idInstrutor, $coordenador, $listaTreinos, $listaExamesFisicos, $listaDicas, 
            $nome, $cpf, $endereco, $senha, $telefone, $login, $email) {
        parent::__construct($nome, $cpf, $endereco, $senha, $telefone, $login, $email);
        $this->idInstrutor = $idInstrutor;
        $this->coordenador = $coordenador;
        $this->listaTreinos = array();
        $this->listaExamesFisicos = array();
        $this->listaDicas = array();
    }
    
    function getIdInstrutor() {
        return $this->idInstrutor;
    }

    function getCoordenador() {
        return $this->coordenador;
    }

    function getListaTreinos() {
        return $this->listaTreinos;
    }

    function getListaExamesFisicos() {
        return $this->listaExamesFisicos;
    }

    function getListaDicas() {
        return $this->listaDicas;
    }

    function setIdInstrutor($idInstrutor) {
        $this->idInstrutor = $idInstrutor;
    }

    function setCoordenador($coordenador) {
        $this->coordenador = $coordenador;
    }

    function setListaTreinos($listaTreinos) {
        $this->listaTreinos = $listaTreinos;
    }

    function setListaExamesFisicos($listaExamesFisicos) {
        $this->listaExamesFisicos = $listaExamesFisicos;
    }

    function setListaDicas($listaDicas) {
        $this->listaDicas = $listaDicas;
    }
}