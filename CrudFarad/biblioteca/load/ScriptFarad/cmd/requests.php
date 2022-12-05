     <?php 
	
                   
	$valoresvalor=isset($_REQUEST['valor'])?$_REQUEST['valor']:'';
	$valorescoluna=isset($_REQUEST['coluna'])?$_REQUEST['coluna']:'';
	$tabel=isset($_REQUEST['tabel'])?$_REQUEST['tabel']:'';
	$tipoImput=isset($_REQUEST['tipoImput'])?$_REQUEST['tipoImput']:'';
	$banco=isset($_REQUEST['banco'])?$_REQUEST['banco']:'';
	$estilo=isset($_REQUEST['estilo'])?$_REQUEST['estilo']:'';
	$colunaVerific=isset($_REQUEST['colunaVerific'])?$_REQUEST['colunaVerific']:'';

	

	$Insert->banco=$banco; 
$Insert->tabela=$tabel;  // nome da tabela
$Insert->colunas=$valorescoluna;  // array com os nome das colunas
$Insert->valuess=$valoresvalor;   // array com os valores dos inputs do formulário
$Insert->tipoImput=$tipoImput;    // array com os tipos dos inputs do formulário
$Insert->sucesso="<div class='alert alert-success' role='alert'>{$tabel} Cadastrado com sucesso!</div>";
$Insert->erro="<div class='alert alert-danger' role='alert'>{$tabel} Cadastrado com sucesso!</div>";
$Insert->proriedadeInputs['estilo']=$estilo;
$Insert->proriedadeInputs['colunaVerific']=$colunaVerific;
?>