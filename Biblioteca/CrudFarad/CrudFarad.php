<?php  

use CrudF\Paginacao;

class Crud extends CrudFarad\Table
{
    private $dados=array();
    private $banco;
    public $crud_banco;
    public $crud_tabela;
    public $where;
    public $sql;
    public $limite;
    public $paginacao;
    public $exetoArray;
    public $id_insert;
   
    function __construct(){

        $this->crud_banco=BANCO['BANCO_NOME'];
        $this->banco=new banco;
        $this->where='';
        $this->limite='';
        $this->exetoArray=null;
        $this->paginacao=['limitePaginacao'=>2];
        $this->paginacao=['registrosPorPagina'=>8];
        
   
    }

public function __set($nome,$valor){
$this->dados[$nome]=$valor;

}

public function __get($nome){

  return $this->dados[$nome];
    
    }


function insert(){

    if(is_null($this->sql)) {
        $valorLabel='';
        $valoresCampos='';
        foreach ($this->dados as $key=>$valor) {
            $valorLabel.="$key,";
            $valoresCampos.=":$key,";
        }
        $label=substr($valorLabel, 0, -1);
        $campos=substr($valoresCampos, 0, -1);
    
        $label=substr($valorLabel, 0, -1);
        $this->banco->query("INSERT INTO $this->crud_tabela ($label) VALUES($campos) $this->where");
        foreach ($this->dados as $key=>$valor) {
            $this->banco->bind(":$key", $valor);
        }
    } else {

        $this->banco->query($this->sql);
    }


    $this->where='';
    
if($this->banco->executa()){

    $this->id_insert=$this->banco->ultimoID();


    return true;
}else{

    return false; 
}

    


}






function sql($sql){
    $this->sql=$sql;
      
    }





function  update(){
    if(is_null($this->sql)) {
        $valorLabel='';
        foreach ($this->dados as $key=>$valor) {
            $valorLabel.=" $key=:$key,";
 
        }
        $label=substr($valorLabel, 0, -1);
      
        $this->banco->query("UPDATE  $this->crud_tabela SET $label $this->where");

        foreach ($this->dados as $key=>$valor) {
            $this->banco->bind(":$key", $valor);
        }
    } else {

        $this->banco->query($this->sql);
    }

    $this->where='';
    return $this->banco->executa()?true:false;
    
}

function  delete(){

    if(is_null($this->sql)) {

        $this->banco->query("DELETE FROM $this->crud_tabela  $this->where");

    } else {

        $this->banco->query($this->sql);
    }

    $this->where='';
    return $this->banco->executa()?true:false;
}



function  get($campos=null){
    if (is_null($this->sql)) {
    $this->banco->query("SELECT $campos FROM $this->crud_tabela  $this->where");

    }else{
        $this->banco->query($this->sql);
        $this->sql=null;
    }
    $this->where='';
   return $this->banco->resultado();
    
}


function  get_hall(){

    $formulario=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


$retornoPage=isset($formulario['p'])?$formulario['p']:'1,1';


   $pagArray=explode(",",$retornoPage);


    $inicio=isset($pagArray[0])?$pagArray[0]:0;

    $this->paginacao['paginaAtual']=$inicio;
    $this->paginacao['pagiMarcacao']=isset($pagArray[1])?$pagArray[1]:0;


    $inicio=($inicio-1)*$this->paginacao['registrosPorPagina'];

    $this->limite($inicio, $this->paginacao['registrosPorPagina']);


    if (is_null($this->sql)) {

        if (is_null($this->exetoArray)) {
           $labels="*"; 

        }else{
            $labels=$this->exetoColunns($this->exetoArray);

        }
        $this->banco->query("SELECT $labels FROM $this->crud_tabela  $this->where $this->limite");
        $this->where='';

        $this->limite=' ';
$resultados=$this->banco->resultados();

$this->paginacao['total_registros']=$this->contaRegistros("SELECT count(*) AS total FROM $this->crud_tabela  $this->where ");

$this->paginacao['inicio_pagina']=$inicio;
$this->paginacao['paginacao']='';
        return $resultados;


    }else{
        $this->where=' ';
   
        $this->banco->query($this->sql.' '.$this->limite);
        $retorno= $this->banco->resultados();


        $this->banco->query($this->sql);
        $total= $this->banco->resultados();


        $this->paginacao['total_registros']=count($total);
$this->paginacao['inicio_pagina']=$inicio;
        $this->paginacao['paginacao']='';
       

        return $retorno;
 


    }

   


    
}


function limite($posicao,$posicao2){

$this->limite=" LIMIT $posicao,$posicao2";
}







function se_existe_dado($where){    // dados em array

foreach($where as $condicoes){
    $this->where($condicoes);
}  


$retorno=$this->get('*');


      if($retorno){
return true;

      }else{

        return false;
      }

    return false;  

}







function where($where){

    if($this->where==''){
        $this->where.='WHERE '.$where;
    }else{
        $this->where.=' AND '.$where; 
    }
    
        
    }




     function create_paginacao(){
$paginacao=new Paginacao($this->paginacao['pagiMarcacao'],$this->paginacao['paginaAtual'],$this->paginacao['total_registros'],$this->paginacao['limitePaginacao'],$this->paginacao['registrosPorPagina']);
$paginacao->setUrl($this->paginacao['link']);

$this->paginacao['paginacao']=$paginacao->gerarPaginacao();

   
        }


 
    



private function exetoColunns($array){

    $this->table_banco=BANCO['BANCO_NOME'];
    $this->table_tabela=$this->crud_tabela;

    return   $this->retirarColunns($array);
}


private function contaRegistros($sql){
    $this->banco->query($sql);
$resultados=$this->banco->resultados();
return $resultados[0]['total'];
}
    
}
?>