	 <?php 


include('verificaClasse.php');


$sqlConta=$conecta->prepare("select count(*) from information_schema.columns  Where Table_Name='{$this->tabela}'");

$sqlConta->execute();
$result = $sqlConta->fetch();


$totalColunas=$result[0]-1;
$inicio=6;



if($this->proriedadeTable['maxRegistros']=='todos'){

	$para_while=$this->contarTable();

	$totalRegistros=$this->contarTable();
   $limite=0;

   $paginas=1;


}else{





	if($this->proriedadeTable['maxRegistros']>=$this->contarTable()){
		$totalRegistros=$this->contarTable();
		$limite=0;
		$paginas=1;
		$para_while=$this->contarTable();

	}else{

		if($this->proriedadeTable['paginaAtual']==1){


$para_while=$this->proriedadeTable['maxRegistros'];



			$totalRegistros=$this->proriedadeTable['maxRegistros'];
	$limite=0;
	$paginas=ceil($this->contarTable()/$this->proriedadeTable['maxRegistros']);


		}else{

			$para_while=$this->proriedadeTable['maxRegistros'];


		$paginas=ceil($this->contarTable()/$this->proriedadeTable['maxRegistros']);

		$totalRegistros=($this->proriedadeTable['paginaAtual']*$this->proriedadeTable['maxRegistros'])+$this->proriedadeTable['maxRegistros'];


		$limite=(($this->proriedadeTable['paginaAtual']-1)*$this->proriedadeTable['maxRegistros']);
		}

	}
   
  
  

}
	 









if($visiveis[0]=='todos'){
	$valores="<div id='{$Id}' >";
	$valores.=" <table {$tableClass} >
	<thead  {$theadClass}>
		";
	
	$mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$this->banco}' AND TABLE_NAME = '{$this->tabela}'";
	
	$tabelasarray=$conecta->query($mostrartabelas);
	
	foreach($tabelasarray as $key=>$tabelass){
	   
		if($key==0){

		}else{

			
			$colunns=explode('_',$tabelass['COLUMN_NAME']);
			$nomeSeparado='';
			foreach($colunns as $colunns){
			
				$nomeSeparado.=$colunns.' ';
			
			}
	
		
		$valores.= " <th scope='col' >{$nomeSeparado}</th>";
	}
	}

	$valores.='</tr></thead> <tbody>';

	






	$percorre=0;


while($percorre<$para_while){
$mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$this->banco}' AND TABLE_NAME = '{$this->tabela}'";



$tabelasarray=$conecta->query($mostrartabelas);

$tables = $conecta->prepare("SELECT * FROM {$this->tabela} {$this->proriedadeTable['where']}  LIMIT {$limite},{$totalColunas}"   );
$tables->execute();
$resultados = $tables->fetchAll();


foreach($resultados as $key2=>$tabels){

if($key2!=1){

foreach($tabelasarray as $key=>$tabelass){

  if($key!=0){

	if($inicio==0){
	  $valores.="<tr {$trClass} >";

  }



  $valores.="<td {$tdClass} >{$tabels[$tabelass['COLUMN_NAME']]}</td>";

  if( $totalColunas==$inicio){
	$valores.='</tr>';
	$inicio=0;
		   }

$inicio++;   
	
}

}
}   
}
$percorre++;
$limite++;
$inicio=0;
}  // fechamento  do while


  $valores.=' </tbody> </table>
  ';

  // paginação 

  if($totalRegistros==0){


	$valores.="<td {$tdClass}>não há nenhum registro...</td>";





}else{


// aqui fica os códigos da paginação

include('extensoes/tabelas/paginacao.php'); 


}

}else{
	




























































































             // if($visiveis[0]=='todos'){ }  <--------  else {
			






				



                 
	
				$valores="<div id='{$Id}' >";

	$valores.="<table {$tableClass}>
	<thead {$theadClass}>		";
		$num=0;
	$mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$this->banco}' AND TABLE_NAME = '{$this->tabela}'";
	
	$tabelasarray=$conecta->query($mostrartabelas);
	
	foreach($tabelasarray as $key=>$tabelass){
		
		if($key==0){

		}else{
		
			while($num<count($visiveis)){
				if($visiveis[$num]==$key){


					$colunns=explode('_',$tabelass['COLUMN_NAME']);
					$nomeSeparado='';
					foreach($colunns as $colunns){
					
						$nomeSeparado.=$colunns.' ';
					
					} // fecha o foreach()


		$valores.= " <th scope='col'>{$nomeSeparado}</th>";
			
		
		} // fecha o if()
		$num++;	

	}  //  fecha o while()

	$num=0;
		
	}
	}

	$valores.='</tr></thead> <tbody>';
	
	










	//$limite=$limite-1;









	$percorre=0;


while($percorre<$para_while){
$mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$this->banco}' AND TABLE_NAME = '{$this->tabela}'";



$tabelasarray=$conecta->query($mostrartabelas);

$tables = $conecta->prepare("SELECT * FROM {$this->tabela} {$this->proriedadeTable['where']} LIMIT {$limite},{$totalRegistros} "   );
$tables->execute();
$resultados = $tables->fetchAll();


foreach($resultados as $key2=>$tabels){

if($key2!=1){

foreach($tabelasarray as $key=>$tabelass){

  if($key!=0){

	if($inicio==0){
	  $valores.="<tr {$trClass}> ";

  }




  while($num<count($visiveis)){
	if($visiveis[$num]==$key){
		$valores.="<td {$tdClass}>{$tabels[$tabelass['COLUMN_NAME']]}</td>";


}
$num++;	
}
$num=0;










  if( $totalColunas==$inicio){
	$valores.='</tr>';
	$inicio=0;
		   }

$inicio++;   
	
}

}
}   
}

$percorre++;
$limite++;
$inicio=0;
}  // fechamento  do while


  $valores.=' </tbody> </table>';


if($totalRegistros==0){


	$valores.="<td {$tdClass}>não há nenhum registro...</td>";





}else{


// aqui fica os códigos da paginação

include('extensoes/tabelas/paginacao.php');




}

}

	
?>