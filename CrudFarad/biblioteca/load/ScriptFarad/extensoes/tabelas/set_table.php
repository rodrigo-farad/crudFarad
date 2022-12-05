	 <?php 

$valValor=$this->debugarTabela('valor','prepare');
$intoColunas=$this->debugarTabela('colunas','prepare');
$queryIntoColunas=$this->debugarTabela('colunas','query');
$queryValor=$this->debugarTabela('valor','query');



$sql = "INSERT INTO {$this->tabela} ({$queryIntoColunas}) VALUES ({$intoColunas})";
$insert = $conecta->prepare($sql);
$limite=0;
while($limite<count($this->colunas)){

    $insert->bindValue(":{$this->colunas[$limite]}",$this->valuess[$limite]);
   
   
     $limite++;
}

if($insert->execute()){

echo 'sucesso';
}else{

  echo 'erro';

}
	
?>