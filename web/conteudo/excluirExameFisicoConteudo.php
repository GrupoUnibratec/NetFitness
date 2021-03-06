<?php 

    $camposPreenchidos = false;
    //$fachada = new Fachada();
    $fachada = Fachada::getInstance();
    $mensagem ="";


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $camposPreenchidos = true;
    }

    try
    {
        $listaExameFisico = $fachada->listarExamesFisicos($_SESSION['Instrutor'], EAGER);

    } 
    catch (Exception $exc)
    {
        $mensagem = $exc->getMessage();
    }   
  
?>

<h1 class="title">Excluir Exame Físico</h1>
<div class="line"></div>
Telefone:<?php echo $instrutor->getTelefone() ?> | Email:<?php echo $instrutor->getEmail() ?> | Endereço:<?php echo $instrutor->getEndereco() ?>
<div class="intro" style="margin-bottom:50px"></div>

<h3>Usuário logado: <?php echo $instrutor->getNome() ?></h3>

<div class="clear"></div>
<div class="line"></div>

<?php if(!$camposPreenchidos){ 
    
?>

<div class="form-container" style="margin-bottom:50px">
    <form class="forms" action="excluirExameFisico.php" method="post" >
        <fieldset>
      
            <ol>
                <li class="form-row text-input-row">     
                    <table style="width:100%;margin-bottom:50px">
                        <tr>
                            <th>Aluno</th> 
                            <th>Descrição</th>
                            <th>Data</th>
                            <th>Selecionar</th>
                        </tr>
                        
                        <?php foreach ($listaExameFisico as $exameFisico){ ?>
                        
                        <tr>
                            <td><?php echo $exameFisico->getAluno()->getNome() ?></td> 
                            <td><?php echo $exameFisico->getDescricao() ?></td>  
                        <td><?php echo ExpressoesRegulares::inverterData($exameFisico->getData()) ?></td> 
                            <td><input type="radio" name="idExameFisico" value="<?php echo $exameFisico->getIdExameFisico() ?>"></td>
                        </tr>
                        <?php 
                            } 
                        ?>

                    </table>
                  </li>

                  <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                         <input type="submit" value="Excluir" name="submit" class="btn-submit">
                         <input type="hidden" name="">
                  </li>       
            </ol>  
        </fieldset>
    </form>
</div>

<?php 
    }else{
        try{
            
            $exameFisicoExc = new ExameFisico($_POST['idExameFisico']);
            $fachada->excluirExameFisico($exameFisicoExc);
            $mensagem = "O exame físico foi excluído com sucesso!!";
        } catch (Exception $ex) {

            $mensagem = $ex->getMessage();
        }
?>

<h3>Mensagem</h3>
<p><?php echo $mensagem ?></p>

<?php     
    } 
    
    include('componentes/footerOne.php') 
?>