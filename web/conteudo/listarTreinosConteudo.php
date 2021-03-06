<?php 

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";

try
{
    $listaTreinos = $fachada->listarTreinos($_SESSION['Instrutor'],EAGER);

} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    
?>

<h1 class="title">Listar Treinos</h1>
<div class="line"></div>
Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>
     
<h3>Usuário logado: <?php echo $instrutor->getNome() ?></h3>
   
<div class="clear"></div>
<div class="line"></div>

<div style="margin-bottom: 50px">
        
        <table style="width:100%">
                    <tr>
                      <th>Nome</th> 
                      <th>Descrição</th>
                      <th>Exercicios</th>
                    </tr>
                    
                    <?php foreach ($listaTreinos as $treino){ ?>
                    <tr>
                        <td><?php echo $treino->getNome() ?></td> 
                        <td><?php echo $treino->getDescricao() ?></td>  
                         <td><?php 
                                 $sizeListaExercicios = count($treino->getListaExercicios());
                                 $count = 1;
                                 foreach ($treino->getListaExercicios() as $exercicio)
                                 {
                                     if($count == $sizeListaExercicios)
                                     {
                                       echo $exercicio->getNome();
                                     }
                                     else
                                     {
                                       echo $exercicio->getNome().", ";  
                                     }
                                     
                                     $count++;
                                 }
                             ?></td> 
                    </tr>
                  
                    <?php } ?>
                    
        </table>
</div>

<?php include('componentes/footerOne.php') ?>

