<?php 
	
     
class banco{
	
	private $conecta;
	private $stmt;
public function __construct(){

	$banco_dados="mysql:dbname=".BANCO['BANCO_NOME'].";host=".BANCO['HOST'].";charset=utf8";
	$login=BANCO['USER'];
	$senh=BANCO['PASSWORD'];
	$opcoes = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
	PDO::ATTR_PERSISTENT=>true,
	PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
);
	try{
	$this->conecta=new PDO($banco_dados , $login, $senh,$opcoes);



    

		
	}catch(PDOException $e)
	{
		echo"não foi possivel fazer a conexão com banco de dados <br>";
		echo"codigo de erro =".$e->getMessage();
	}



}


public function query($sql){

	
$this->stmt=$this->conecta->prepare($sql);
}







public function bind($parametro,$valor,$tipo=null){

	if(is_null($tipo)){
switch(true){

case is_int($valor):  
	$tipo=PDO::PARAM_INT;
break;
case is_bool($valor):  
	$tipo=PDO::PARAM_BOOL;
break;
case is_null($valor):  
	$tipo=PDO::PARAM_INT;
break;
default:

	$tipo=PDO::PARAM_STR;
break;
}
}
$this->stmt->bindValue($parametro,$valor,$tipo);

	
	}

public function executa(){
	
return $this->stmt->execute();

}

public function resultado(){


     $this->executa();
	return $this->stmt->fetch();
}
	
public function resultados(){
	
	$this->executa();
     return $this->stmt->fetchAll();

}


public function totalResultados(){
	
     return $this->stmt->rowCount();

}
public function ultimoID(){
	
	return $this->conecta->lastInsertId();

}
   
	

}