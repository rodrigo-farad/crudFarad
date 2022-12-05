     <?php 
	
	 
	$banco_dados="mysql:dbname={$this->banco};host=localhost;charset=utf8";
	$login="root";
	$senh="123";
	$opcoes = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
);
	try{
	$conecta=new PDO($banco_dados , $login, $senh);



    

		
	}catch(PDOException $e)
	{
		echo"não foi possivel fazer a conexão com banco de dados <br>";
		echo"codigo de erro =".$e->getMessage();
	}
	
	
	






?>