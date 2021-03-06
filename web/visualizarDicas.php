<?php 
include ('../classesBasicas/Treino.php');
include ('../classesBasicas/Exercicio.php');
include ('../classesBasicas/ExameFisico.php');
include ('../classesBasicas/Coordenador.php');
include ('../classesBasicas/Aluno.php');
include ('../classesBasicas/Musica.php');
include ('../classesBasicas/Nutricionista.php');
include ('../classesBasicas/Instrutor.php');
include ('../classesBasicas/Secretaria.php');
include ('../classesBasicas/Dieta.php');
include ('../classesBasicas/Alimento.php');
include ('../classesBasicas/Dica.php');
include ('../expressoesRegulares/ExpressoesRegulares.php');
include ('../fachada/Fachada.php');
include ('componentes/header.php');
?>
<body>
<div id="wrapper">
    
  <div id="sidebar">
    
    <div id="logo"><a href="index.php"><img src="images/logo.png" alt=""></a></div>

    <?php include ("componentes/menu.php");
     include ('componentes/leftIcons.php'); 
     include ('componentes/signature.php'); ?>   
    
  </div><!-- end sidebar -->
     
  <div id="content">
  
     <?php include('conteudo/visualizarDicaConteudo.php'); ?>
    
  </div><!-- end content -->
  
</div><!-- end wrapper -->
    
<?php include ('componentes/clear.php'); ?> 

</body>
</html>

