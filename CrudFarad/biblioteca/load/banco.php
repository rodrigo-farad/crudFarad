<?php 
	
     
class banco{
	
	private $conecta;
	private $stmt;
	public $BANCO_NOME;
	public $HOST;
	public $USER;
	public $PASSWORD;
	/**
	 * Classe para conexão com o banco de dados e crud
	 *
	 * @param String $try_banco
	 * Nome do banco de dados, caso não seja repassado será o valor default da variável global BANCO['BANCO_NOME']
	 * @param String $try_host
	 *  Nome do Host, caso não seja repassado será o valor default da variável global BANCO['HOST']
	 * @param String $try_user
	 *  Nome do Usuário do banco de dados, caso não seja repassado será o valor default da variável global BANCO['USER']
	 * @param String $try_password
	 *  Senha do banco de dados, caso não seja repassado será o valor default da variável global BANCO['PASSWORD']
	 */
public function __construct($try_banco=null,$try_host=null,$try_user=null,$try_password=null){

if($try_banco==null || $try_host==null || $try_user==null||$try_password==null){

	$try_banco=isset(BANCO['BANCO_NOME'])?BANCO['BANCO_NOME']:null;
	$try_host=isset(BANCO['HOST'])?BANCO['HOST']:null;
	$try_user=isset(BANCO['USER'])?BANCO['USER']:null;
	$try_password=isset(BANCO['PASSWORD'])?BANCO['PASSWORD']:null;
}


	$banco_dados="mysql:dbname=".$try_banco.";host=".$try_host.";charset=utf8";
	$login=$try_user;
	$senh=$try_password;
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

/**
 * função para adicionar o sql para select 
 *
 * @param [type] $sql
 * @return void
 */
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


//$stmt->fetchAll(PDO::FETCH_OBJ);