<?php 

//$fachada = new Fachada();
$fachada = Fachada::getInstance();
$mensagem ="";
$camposPreenchidos = false;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $camposPreenchidos = true;
}

try
{
    $listaDietas = $fachada->listarDietas($_SESSION['Nutricionista'], EAGER);
    $listaAlimentos = $fachada->listarAlimentos(LAZY);
    if(sizeof($listaDietas)==0)
    {
        $mensagem = "Nenhum aluno recebeu a prescrição da dieta.";
    }
} 
catch (Exception $exc)
{
    $mensagem = $exc->getMessage();
}   
    


?>

<h1 class="title">Alterar Dieta</h1>
    <div class="line"></div>
    Telefone:<?php echo $nutricionista->getTelefone() ?> | Email:<?php echo $nutricionista->getEmail() ?> | Endereço:<?php echo $nutricionista->getEndereco() ?>
    <div class="intro" style="margin-bottom:50px"></div>
    
    
    
    <h3>Usuário logado: <?php echo $nutricionista->getNome() ?></h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
    <?php 
     if(!$camposPreenchidos) 
     { ?>

    <div class="form-container" style="margin-bottom:50px">
      <form class="forms" action="alterarDieta.php" method="post" >
      <fieldset>
      
       <ol>
            <li class="form-row text-input-row">     
               <table style="width:100%;margin-bottom:50px">
                         <tr>
                           <th>Nome Aluno</th> 
                           <th>Descrição Dieta</th>
                           <th>Alimentos</th>
                           <th>Qtd</th>
                           <th>Selecionar</th>
                         </tr>

                         <?php 
                         
                         
                         foreach ($listaDietas as $dieta)
                         { 
                           $numAlimentos = sizeof($dieta->getListaAlimentos());
                           $nomeAluno = $dieta->getAluno()->getNome();
                           $descDieta = $dieta->getDescricao();
                           $idDieta = $dieta->getIdDieta();
                           $first = true;
                           
                           foreach ($dieta->getListaAlimentos() as $alimento)
                           {
                         ?>
                         
                         
                         <tr>
                             <?php if($first){ ?><td rowspan="<?php echo $numAlimentos ?>"><?php echo $nomeAluno ?></td> 
                             <td rowspan="<?php echo $numAlimentos ?>"><?php echo $descDieta ?></td><?php } ?>
                             <td><?php echo $alimento->getDescricao() ?></td>
                             <td><?php echo $alimento->getQtdAlimento() ?> </td>
                             <?php if($first){ ?><td rowspan="<?php echo $numAlimentos ?>"><input type="radio" name="idDieta" value="<?php echo $idDieta ?>"></td><?php $first=false; } ?>
                         </tr>
                           <?php }                   
                    
                         } ?>

               </table>
             </li>
             <?php if(sizeof($listaDietas)!=0) { ?>
             <li class="form-row text-input-row" style="text-align:center;margin-left:-100px">
                    <input type="submit" value="Alterar" name="submit" class="btn-submit">
             </li>
            <?php } ?>
        </ol>  
       </fieldset>
       </form>
    </div>
    <?php 
    }
    else
    {
         if(isset($_POST['idDieta']))
         {
             $dieta = new Dieta($_POST['idDieta']);
             $dietaRetornada = $fachada->detalharDieta($dieta, EAGER);
             
             $listaAlimentosNaoSelecionados = array();
             $listaAlimentosSelecionados = $dietaRetornada->getListaAlimentos();
            
             
             foreach ($listaAlimentos as $alimento)
             {
                   $alimentoPresente = false;
                   foreach($listaAlimentosSelecionados as $alimentoSelecionado)
                   {
                      
                       if($alimentoSelecionado->getIdAlimento() == $alimento->getIdAlimento())
                       {                          
                           $alimentoPresente = true;
                       }
                       
                   }
                   if(!$alimentoPresente)
                   {
                       array_push($listaAlimentosNaoSelecionados, $alimento);
                   }
                 
                 
             }
            
             
         
             $_SESSION['dietaRetornada']=$dietaRetornada;
             
             ?>
    
                <div class="form-container" style="margin-bottom:50px">
                    <form class="forms" action="alterarDieta.php" method="post" >
                    <fieldset>
                      <ol>
                         
                        <li class="form-row text-input-row">
                            <label style="margin-top:-7px">Aluno</label>                          
                          <div><?php if(isset($dietaRetornada)) echo $dietaRetornada->getAluno()->getNome()?></div>
                        </li>  

                        <li class="form-row text-input-row">
                          <label>Descrição</label>
                          <textarea class="text-input" name="descricao" style="width:478px; height: 100px"><?php 
                                   if(isset($dietaRetornada)) echo $dietaRetornada->getDescricao() 
                           ?></textarea>
                        </li>

                        

                        <li class="form-row text-input-row">
                         <label>Alimentos</label>   
                            <table style="width:500px; margin-left:100px">
                               <tr>
                                 <th>Descrição</th> 
                                 <th>Cal. (%)</th>
                                 <th>Carb. (%)</th>
                                 <th>Prot. (%)</th>
                                 <th>Gord. (%)</th>
                                 <th>Qtd. <br/>(g)</th>
                                 <th>Sel.</th>
                                </tr>

                                 <?php foreach ($listaAlimentosSelecionados as $alimentoSelecionado) { ?>
                                    <tr>
                                        <td> <?php echo $alimentoSelecionado->getDescricao() ?> </td>
                                        <td> <?php echo $alimentoSelecionado->getCaloria() ?> </td>
                                        <td> <?php echo $alimentoSelecionado->getCarboidrato() ?> </td>
                                        <td> <?php echo $alimentoSelecionado->getProteina() ?> </td>
                                        <td> <?php echo $alimentoSelecionado->getGordura() ?> </td>
                                        <td> <input style="width: 50px" type="text" value="<?php echo $alimentoSelecionado->getQtdAlimento() ?>" name="qtd<?php echo $alimentoSelecionado->getIdAlimento() ?>"> </td>
                                        <td> <input type="checkbox" name="alimento<?php echo $alimentoSelecionado->getIdAlimento() ?>" value="true" checked> </td>
                                    </tr>
                                 <?php } 
                                    
                                     foreach($listaAlimentosNaoSelecionados as $alimentoNaoSelecionado)
                                     { ?>
                                        <tr>
                                            <td> <?php echo $alimentoNaoSelecionado->getDescricao() ?> </td>
                                            <td> <?php echo $alimentoNaoSelecionado->getCaloria() ?> </td>
                                            <td> <?php echo $alimentoNaoSelecionado->getCarboidrato() ?> </td>
                                            <td> <?php echo $alimentoNaoSelecionado->getProteina() ?> </td>
                                            <td> <?php echo $alimentoNaoSelecionado->getGordura() ?> </td>
                                            <td> <input style="width: 50px" type="text" name="qtd<?php echo $alimentoNaoSelecionado->getIdAlimento() ?>"> </td>
                                        <td> <input type="checkbox" name="alimento<?php echo $alimentoNaoSelecionado->getIdAlimento() ?>" value="true"> </td>
                                        </tr>
                                    <?php
                                     }
                                 ?>


                         </table>
                        </li>



                        <li class="button-row" style="margin-top:50px">
                          <input type="submit" value="Salvar Alterações" name="submit" class="btn-submit">
                        </li>
                      </ol>

                    </fieldset>
                  </form>
                  <div class="response"></div>
                </div>
                
             <?php
         }
         else
         {
            if($_POST['submit']=='Salvar Alterações')
            {
                $listaAlimentosPrescritos = array();
      
                foreach(array_keys($_POST) as $parametro)
                {
                    if(strpos($parametro,'alimento') !== false)
                    {
                        $idAlimento = explode("alimento", $parametro);

                        foreach($listaAlimentos as $alimento) 
                        {
                             if ($idAlimento[1] == $alimento->getIdAlimento()) 
                             {  
                                 $alimento->setQtdAlimento($_POST['qtd'.$alimento->getIdAlimento()]);
                                 array_push($listaAlimentosPrescritos, $alimento);
                                 break;
                             }
                        }
                    }
                }


                $dietaAlterada = new Dieta($_SESSION['dietaRetornada']->getIdDieta(), $_POST['descricao'], $listaAlimentosPrescritos, $_SESSION['Nutricionista'], $_SESSION['dietaRetornada']->getAluno());
                
                try
                {
                    $fachada->alterarDieta($dietaAlterada);
                    $mensagem = "A dieta do aluno ".$_SESSION['dietaRetornada']->getAluno()->getNome()." foi alterada com successo";
                } 
                catch (Exception $exc)
                {
                    $mensagem = $exc->getMessage();
                }

            }
            else
            {
                $mensagem = "Não foi selecionada a dieta";
            }
         }
         
    }
    if($camposPreenchidos && !isset($_POST['idDieta']) || isset($dietaAlterada) || (sizeof($listaDietas)==0)) { ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php } 
    
    include('componentes/footerOne.php') ?>