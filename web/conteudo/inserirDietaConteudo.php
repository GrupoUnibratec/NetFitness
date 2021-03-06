<?php
 $camposPreenchidos = false;
 $fachada = Fachada::getInstance();
 //$listaAlunosSemDieta = array();
 $mensagem = "";
 $error = false;
 
  
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $camposPreenchidos = true;
 }
 if(isset($_SESSION['Dieta']))
 {
     $dieta = $_SESSION['Dieta'];
 }

 $listaAlunos = $fachada->listarAlunos(EAGER);
 $listaAlimentos = $fachada->listarAlimentos(LAZY);
 $listaAlunosSelecionados = array();
 
?>

<h1 class="title">Página usuário</h1>
    <div class="line"></div>
    
    Nome: <?php echo $nutricionista->getNome() ?> | Telefone:<?php echo $nutricionista->getTelefone() ?> | Email:<?php echo $nutricionista->getEmail() ?> | Endereço:<?php echo $nutricionista->getEndereco() ?>
    
    <div class="intro" style="margin-bottom:50px">
         
    </div>
    
    
    
    <h3>Prescrever Dieta</h3>
   
    <div class="clear"></div>
    <div class="line"></div>
    
    
    
   <?php 
   
    if(!$camposPreenchidos)
    {   
        
        /*
        foreach($listaAlunos as $aluno)
        {
          
            if($aluno->getDieta() == null)
            {
                array_push($listaAlunosSemDieta, $aluno);
            }
        }
        */
        if(count($listaAlunos)!=0)
        {
        ?> 
         <div class="form-container" style="margin-bottom:50px">
         <form class="forms" action="inserirDieta.php" method="post" >
         <fieldset>
           <ol>


             <li class="form-row text-input-row">
               <label>Descrição</label>
               <textarea class="text-input" name="descricao" style="width:478px; height: 100px"><?php 
                        if(isset($dieta)) echo $dieta->getDescricao() 
                ?></textarea>
             </li>

             <li class="form-row text-input-row">
               <label>Alunos</label>
               
               <div style="border: 1px solid #ddd;width:480px; padding: 10px; padding-bottom: 0; height: auto; margin-left: 100px">
                   
                    <?php
                   $primeiro = true;
                   $selecionado = "checked";
                   foreach ($listaAlunos as $aluno) 
                   {     
                   ?>
                   <input <?php if($primeiro) {echo $selecionado; $primeiro = false; }?> type="checkbox" name="idAluno<?php echo $aluno->getIdAluno() ?>" value="ok" style="margin-bottom:20px;margin-right: 15px"><?php echo $aluno->getNome() ?><br/>
                   <?php } ?>
               </div>
               
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
                      
                      <?php foreach ($listaAlimentos as $alimento) { ?>
                         <tr>
                             <td> <?php echo $alimento->getDescricao() ?> </td>
                             <td> <?php echo $alimento->getCaloria() ?> </td>
                             <td> <?php echo $alimento->getCarboidrato() ?> </td>
                             <td> <?php echo $alimento->getProteina() ?> </td>
                             <td> <?php echo $alimento->getGordura() ?> </td>
                             <td> <input style="width: 50px" type="text" name="qtd<?php echo $alimento->getIdAlimento() ?>"> </td>
                             <td> <input type="checkbox" name="alimento<?php echo $alimento->getIdAlimento() ?>" value="true"> </td>
                             
                         </tr>
                      <?php } ?>
                     
                     
              </table>
             </li>

             

             <li class="button-row" style="margin-top:50px">
               <input type="submit" value="Prescrever" name="submit" class="btn-submit">
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
            $mensagem = "Todos os alunos já têm uma dieta prescrita, ou não tem aluno cadastrado";
        }
    } 
    else
    {
       //$aluno = new Aluno($_POST['idAluno']);
       //$aluno = $fachada->detalharAluno($aluno, LAZY);
       
        $listaAlimentosPrescritos = array();


        
        foreach (array_keys($_POST) as $parametro)
        {
            if(strpos($parametro,'idAluno') !== false)
            {
                $idAluno = explode('idAluno', $parametro);

                array_push($listaAlunosSelecionados, $fachada->detalharAluno(new Aluno($idAluno[1]), LAZY));
                
            }
        }

       
        if(sizeof($listaAlunosSelecionados) != 0)
        {
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


            $mensagem = "As dietas dos alunos ";

            foreach($listaAlunosSelecionados as $aluno)
            {
                $dieta = new Dieta(null, $_POST['descricao'], $listaAlimentosPrescritos, $_SESSION['Nutricionista'], $aluno);      
                $_SESSION['Dieta'] = $dieta;

                try
                {
                    $fachada->inserirDieta($dieta);

                    $mensagem .= $aluno->getNome().", ";
                } 
                catch (Exception $exc)
                {
                    $mensagem = $exc->getMessage();
                    $error = true;
                }
            }

            if(!$error)
            {
                $mensagem.="foram inseridas com sucesso.<br/>";
                unset($_SESSION['Dieta']);
            }
        }
        else 
        {
            $mensagem = "Impossível prescrever as dietas, nenhum aluno foi selecionado.";
        }
  
    }
   
   if($camposPreenchidos || count($listaAlunos)==0 || (sizeof($listaAlunosSelecionados) == 0 && $camposPreenchidos)) { ?>
    
        <h3>Mensagem</h3>
        <p><?php echo $mensagem ?></p>
    
    <?php } 
    
    include('componentes/footerOne.php') ?>
