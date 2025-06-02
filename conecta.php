<?php

namespace Admin\Biblioteca\service;

use PDO;
use PDOException;

class conecta{
    /**
     * Variável que armazena a conexão com o banco de dados
     * @var PDO
     */
    private $conecta;
    /**
     * Variável que armazena a declaração preparada
     * @var PDOStatement
     */
    private $stmt;
    /**
     * Nome do banco de dados
     * @var string
     */
    public $BANCO_NOME;
    /**
     * Endereço do servidor de banco de dados
     * @var string
     */
    public $HOST;
    /**
     * Nome de usuário para acessar o banco de dados
     * @var string
     */
    public $USER;
    /**
     * Senha para acessar o banco de dados
     * @var string
     */
    public $PASSWORD;
    /**
     * Construtor da classe
     * @param string $try_banco Nome do banco de dados
     * @param string $try_host Endereço do servidor de banco de dados
     * @param string $try_user Nome de usuário para acessar o banco de dados
     * @param string $try_password Senha para acessar o banco de dados
     */
    public function __construct($try_banco = null, $try_host = null, $try_user = null, $try_password = null) {
        // Se as informações de conexão não foram passadas como parâmetros, usa as configurações padrão
        if ($try_banco == true) {
            $banco_dados = "mysql:host=localhost;charset=utf8";
            $try_user = "root";
            $try_password = "";
        } else{
            $try_banco = BANCO['BANCO_NOME'];
            $try_host = BANCO['HOST'];
            $try_user = BANCO['USER'];
            $try_password = BANCO['PASSWORD'];
            $banco_dados = "mysql:dbname=" . $try_banco . ";host=" . $try_host . ";charset=utf8";
           
        }
           
        
    
        if ($try_banco == null || $try_host == null || $try_user == null || $try_password == null) {
            $try_banco = BANCO['BANCO_NOME'];
            $try_host = BANCO['HOST'];
            $try_user = BANCO['USER'];
            $try_password = BANCO['PASSWORD'];
           
        }
    
        // Monta a string de conexão com o banco de dados
        $opcoes = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
      
        try {
            // Tenta se conectar ao banco de dados
            $this->conecta = new PDO($banco_dados, $try_user, $try_password, $opcoes);
        } catch (PDOException $e) {
            // Se a conexão falhar, mostra uma mensagem de erro
            echo "Não foi possível fazer a conexão com o banco de dados <br>";
            echo "Código de erro =" . $e->getMessage();
        }
    }
    
			/**
 * Prepara uma declaração SQL para ser executada
 * @param string $sql SQL a ser preparado
 */
public function query($sql) {
    $this->stmt = $this->conecta->prepare($sql);
}

/**
 * Vincula um valor a um parâmetro de uma declaração preparada
 * @param string $parametro Nome do parâmetro
 * @param mixed $valor Valor a ser vinculado
 * @param int $tipo Tipo do dado (opcional)
 */
public function bind($parametro, $valor, $tipo = null) {
    if (is_null($tipo)) {
        // Se o tipo não foi especificado, tenta inferi-lo automaticamente
        switch (true) {
            case is_int($valor):
                $tipo = PDO::PARAM_INT;
                break;
            case is_bool($valor):
                $tipo = PDO::PARAM_BOOL;
                break;
            case is_null($valor):
                $tipo = PDO::PARAM_INT;
                break;
            default:
                $tipo = PDO::PARAM_STR;
                break;
        }
    }
    $this->stmt->bindValue($parametro, $valor, $tipo);
}

/**
 * Executa uma declaração preparada
 * @return bool Resultado da execução
 */
public function executa() {
    return $this->stmt->execute();
}

/**
 * Retorna o primeiro resultado de uma declaração SELECT
 * @return mixed Resultado da consulta
 */
public function resultado() {
    $this->executa();
    return $this->stmt->fetch();
}

/**
 * Retorna todos os resultados de uma declaração SELECT
 * @return array Resultados da consulta
 */
public function resultados() {
    $this->executa();
    return $this->stmt->fetchAll();
}

/**
 * Retorna o número de linhas afetadas por uma declaração INSERT, UPDATE ou DELETE
 * @return int Número de linhas afetadas
 */
public function totalResultados() {
    return $this->stmt->rowCount();
}

/**
 * Retorna o ID gerado pela última inserção realizada
 * @return string ID gerado
 */
public function ultimoID():int {
    return  $this->conecta->lastInsertId();
}


public function maxID($tabela):int {


    $sql = "SELECT MAX(id) AS ultimo_id FROM {$tabela}";
$stmt = $this->conecta->query($sql);
$ultimoId = $stmt->fetchColumn();
return $ultimoId;

}


			
	/**
 * Escapa caracteres especiais de uma string para uso em uma declaração SQL
 * @param string $value Valor a ser escapado
 * @return string Valor escapado
 */
public function quote($value) {
    return $this->conecta->quote($value);
}		


public function beginTransaction(){
	// desativando o modo autocommit
	$this->conecta->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $this->conecta->beginTransaction();

}



public function commit(){
	$this->conecta->commit();

}

/**
 * FEcha conexão do beginTransaction
 */
public function rollBack(){

if($this->conecta->inTransaction()){
    $this->conecta->rollBack();
}
	
}

public function inTransaction(){
	return $this->conecta->inTransaction();
}


}

	


