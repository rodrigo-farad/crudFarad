<?php
namespace cadastrarTabela;
session_start();

require ('classeTabela.php');

                   
$tiOrdemServico=new tabela; // nome da classe para criar um novo objeto
$tiOrdemServico->banco='noiteblack';   // nome do banco de dados
$tiOrdemServico->tabela='modelo';//nome da tabela que ser criada e manipulada
$tiOrdemServico->proriedadeInputs['colunaVerific']='0';// usado para informar qual é a coluna que será verificada no login form de registro duplo etc
$tiOrdemServico->proriedadeInputs['estilo']='login'; 
$tiOrdemServico->proriedadeInputs['tipoInput']=['coluna'=>1,'input'=>'select',]; 

//recuperaDados

?>
<html>
<head>

<link href="css/bootstrap.min.css" rel="stylesheet">



</head>
<title>
scriptfarad
</title>
<body>
<h1><?php  


  


?></h1>

<div class="container">
<div class="container-fluid">

<div id="mostra"></div>

<div class="row">
<div class="col-xl-8 col-lg-7">







<?php  







$colunasVisiveis[0]='todos';//  se colocar dessa forma todas as colunas da tabela será mostrado
//$colunasVisiveis[0]=1;
//$colunasVisiveis[1]=2;
//$colunasVisiveis[2]=5;
//$colunasVisiveis[3]=4;
//$colunasVisiveis[3]=5;
$OrdemServico->proriedadeInputs['required']='1';   // ordem pela coluna começaa pelo id 0,1,2 etc  


$Visiveis[0]=1;
$Visiveis[1]=2;
$Visiveis[2]=3;

echo $tiOrdemServico->criarImputs($colunasVisiveis,'idformulario','cadastrar');    // 2º parametro deverá informar um id para ele mesmo criar e se guiar, e o 3º parametro o nome do botão

/*



$tiOrdemServico->proriedadeTable['maxRegistros']='50';

*/
echo $tiOrdemServico->getTabela($Visiveis,'div2');



 




?>


 

</div>
 </div>
 <!-- Content here -->
 </div>
 <!-- Content here -->
 </div>


<script src="scriptfarad.js"></script>
<script src="jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>





</html>
