<?php

namespace CrudFarad;

use PDO;
use PDOException;

class Tabelas {

    public function tabelasRelacionadas($tableName, conecta $conecta) {
        $relatedTables = [];
        
        try {
            // Usa a conexão da classe conecta
            $conn = $conecta->conecta; // Acesso à conexão

            // Consulta para pegar as chaves estrangeiras
            $stmt = $conn->prepare("
                SELECT 
                    TABLE_NAME AS foreign_table,
                    COLUMN_NAME AS foreign_key,
                    REFERENCED_TABLE_NAME AS primary_table,
                    REFERENCED_COLUMN_NAME AS primary_key
                FROM 
                    information_schema.KEY_COLUMN_USAGE
                WHERE 
                    REFERENCED_TABLE_NAME = :table_name
                    AND TABLE_SCHEMA = :database_name
            ");
            
            // Defina o nome do banco de dados
            $databaseName = $conecta->BANCO_NOME; // Acessa o nome do banco via objeto conecta
            
            $stmt->bindParam(':table_name', $tableName);
            $stmt->bindParam(':database_name', $databaseName);
            $stmt->execute();
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($results as $row) {
                $relatedTables[] = [
                    'name' => $row['foreign_table'],
                    'foreign_key' => $row['foreign_key'],
                    'primary_key' => $row['primary_key']
                ];
            }
            
        } catch (PDOException $e) {
            echo "Erro ao buscar tabelas relacionadas: " . $e->getMessage();
        }
        
        return $relatedTables;
    }
}