	 <?php 
$sqlConta=$conecta->prepare("select count(*) from information_schema.columns  Where Table_Name='{$this->tabela}'");

$sqlConta->execute();
$result = $sqlConta->fetch();



if($regMax=='todos'){
	

   $totalColunas=$result[0]-1;
   $inicio=0;

}else{

	$totalColunas=$result[0]-1;

	if($regMax>=$totalColunas){


	}else{
		$totalColunas=$regMax;

	}
   
  
   $inicio=0;

}
	 
	 
	



if($visiveis[0]=='todos'){

	$valores=' <table class="table">
	<thead class="thead-dark">
		';
	
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
	
		
		$valores.= " <th scope='col'>{$nomeSeparado}</th>";
	}
	}

	$valores.='</tr></thead> <tbody>';

	




$limite=0; 
$soma=1;  

while($limite < $totalColunas){
$mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$this->banco}' AND TABLE_NAME = '{$this->tabela}'";


$soma=$limite+$soma; 

$tabelasarray=$conecta->query($mostrartabelas);

$tables = $conecta->prepare("SELECT * FROM {$this->tabela}  LIMIT {$limite},{$totalColunas}"   );
$tables->execute();
$resultados = $tables->fetchAll();


foreach($resultados as $key2=>$tabels){

if($key2!=1){

foreach($tabelasarray as $key=>$tabelass){

  if($key!=0){

	if($inicio==0){
	  $valores.='<tr>';

  }



  $valores.="<td>{$tabels[$tabelass['COLUMN_NAME']]}</td>";

  if( $totalColunas==$inicio){
	$valores.='</tr>';
	$inicio=0;
		   }

$inicio++;   
	
}

}
}   
}
$limite++;
$inicio=0;
}  // fechamento  do while


  $valores.=' </tbody> </table>';

}else{
	

                 



	$valores=' <table class="table">
	<thead class="thead-dark">
		';
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
					
					}


		$valores.= " <th scope='col'>{$nomeSeparado}</th>";
			
		
		}
		$num++;	
	}
	$num=0;
		
	}
	}

	$valores.='</tr></thead> <tbody>';
	
	




$limite=0; 
$soma=1;  

while($limite < $totalColunas){
$mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$this->banco}' AND TABLE_NAME = '{$this->tabela}'";


$soma=$limite+$soma; 

$tabelasarray=$conecta->query($mostrartabelas);

$tables = $conecta->prepare("SELECT * FROM {$this->tabela}  LIMIT {$limite},{$totalColunas}"   );
$tables->execute();
$resultados = $tables->fetchAll();


foreach($resultados as $key2=>$tabels){

if($key2!=1){

foreach($tabelasarray as $key=>$tabelass){

  if($key!=0){

	if($inicio==0){
	  $valores.='<tr>';

  }




  while($num<count($visiveis)){
	if($visiveis[$num]==$key){
		$valores.="<td>{$tabels[$tabelass['COLUMN_NAME']]}</td>";


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
$limite++;
$inicio=0;
}  // fechamento  do while


  $valores.=' </tbody> </table>';


}

	
?>