<?php 

$valValor=$this->debugarTabela('valor','prepareUpdate');
$intoColunas=$this->debugarTabela('colunas','prepareUpdate');




$sql = "UPDATE  {$this->tabela}  SET({$intoColunas})";
$insert = $conecta->prepare($sql);
$limite=0;
while($limite<count($this->colunas)){

    $insert->bindValue(":{$this->colunas[$limite]}",$this->valuess[$limite]);
   
   
     $limite++;
}

if($insert->execute()){

return $this->sucesso;
}else{

  return $this->$erro;

}
	
?>