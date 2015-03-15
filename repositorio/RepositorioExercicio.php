<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include($serverPath.'interfaceRepositorio/IRepositorioExercicio.php');
include_once($serverPath.'repositorioGenerico/RepositorioGenerico.php');
include_once($serverPath.'excecoes/Excecoes.php');

/**
 * Description of RepositorioExercicio
 *
 * @author Schmitz
 */
class RepositorioExercicio extends RepositorioGenerico implements IRepositorioExercicio{
    //put your code here
    
    public function inserir($exercicio) {
        
        $idReturn = -1;
        
        $sql = "USE " . $this->getNomeBanco();
        
        if(@$this->getConexao()->query($sql) === TRUE){
            
            $sql = "INSERT INTO exercicio VALUES (NULL, ".$exercicio->getNome()
                                                         .",".$exercicio->getMusculo()
                                                         .",".$exercicio->getDescricao().")";
            
            if( mysqli_query($this->getConexao(), $sql)){
                
                $this->fecharConexao();
                return TRUE;
            }else{
                throw new Exception(Excecoes::inserirObjeto("Exercício: ".mysqli_error($this->getConexao())));
            }
        }else{
            throw new Exception(Excecoes::selecionarBanco($this->getNomeBanco() . " (" . $this->getConexao()->error) . ")");
        }
    }

    public function alterar($exercicio) {
        
    }

    public function excluir($exercicio) {
        
    }

    public function listar() {
        
    }

}
