<?php
include ('../classesBasicas/Aluno.php');
include ('../classesBasicas/Coordenador.php');
include ('../classesBasicas/Nutricionista.php');
include ('../classesBasicas/Instrutor.php');
include ('../classesBasicas/Secretaria.php');
session_start();

include ('../fachada/Fachada.php');
include ('componentes/header.php') 

?>


<body>
<div id="wrapper">
    
  <div id="sidebar">
    
    <div id="logo"><a href="index.php"><img src="images/logo.png" alt=""></a></div>

    <?php include ('componentes/menu.php') ?>  
    <?php include ('componentes/leftIcons.php') ?>
    <?php include ('componentes/signature.php'); ?>   
    
  </div><!-- end sidebar -->
     
  <div id="content">
  
     <?php include('conteudo/loginRespostaConteudo.php'); ?>
    
  </div><!-- end content -->
  
</div><!-- end wrapper -->
    
<?php include ('componentes/clear.php'); ?> 

</body>
</html>
