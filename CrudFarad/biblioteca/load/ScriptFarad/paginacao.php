<?php

namespace cadastrarTabela;
require ('classeTabela.php');


			
			





$idform=isset($_REQUEST['idform'])?$_REQUEST['idform']:''; // ok 
$tabela=isset($_REQUEST['tabela'])?$_REQUEST['tabela']:''; // ok
$banco=isset($_REQUEST['banco'])?$_REQUEST['banco']:'banco'; // ok
$maxRegistros=isset($_REQUEST['maxRegistros'])?$_REQUEST['maxRegistros']:''; // ok
$pagina=isset($_REQUEST['pagina'])?$_REQUEST['pagina']:'';  // ok
$classe=isset($_REQUEST['classe'])?$_REQUEST['classe']:'';
$visivel=isset($_REQUEST['visivel'])?$_REQUEST['visivel']:'';  // ok
$where=isset($_REQUEST['wher'])?$_REQUEST['wher']:'';  // ok





$PaginaTabela=new tabela; // nome da classe para criar um novo objeto
$PaginaTabela->banco=$banco; // nome do banco de dados 
$PaginaTabela->tabela=$tabela;  // nome da tabela

$PaginaTabela->proriedadeTable['maxRegistros']=$maxRegistros; // maximo de registros por consultas
$PaginaTabela->proriedadeTable['paginaAtual']=$pagina;       // numero da página atual

$PaginaTabela->proriedadeTable['classe']=$classe;           // tipo de classe da tabela

$PaginaTabela->proriedadeTable['where']=$where;
$visivel=explode('-',$visivel);


echo $PaginaTabela->getTabela($visivel,$idform);







