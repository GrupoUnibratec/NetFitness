<?php
/**
 *
 * @author Fábio
 */

interface IRepositorioOpiniao {
    
    public function inserir($opiniao);
    public function alterar($opiniao);
    public function excluir($opiniao);
    public function detalhar($opiniao, $fetchType);
    public function listar($fetchType);
    public function listarPorAluno($aluno, $fetchType);
}
