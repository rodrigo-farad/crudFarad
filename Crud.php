<?php  
namespace  Admin\Biblioteca\CrudFarad;
use  Admin\Biblioteca\CrudFarad\Paginacao;
use  Admin\Biblioteca\service\banco as conecta;
use Exception;

class Crud{

    private $dados=array();
    private $banco;
    public $crud_banco;
    public $crud_tabela;
    public $where;
    public $sql;
    public $limite;
    public $paginacao=array();
    public $index_pagina;
    public $exetoArray;
    public $id_insert;
	public $params=null;
    public $join;
    public $labels;
    public $campos;
    
    function __construct($createDb=false){
       
           include("../Admin/Biblioteca/service/banco.php");

       
            $this->banco=new conecta($createDb);
            $this->where='';
            $this->limite='';
            $this->join = '';
            $this->exetoArray=null;
            $this->paginacao['limitePaginacao']=2;
            $this->paginacao['registrosPorPagina']=null;
            $this->index_pagina=null;
            $this->labels='';
            $this->campos='';


      
                   
    }



public function from($from){
            $this->crud_tabela=$from;
            return $this;
}


function join($tabela, $condicao, $tipo = null) {
    if (is_null($this->join)) {
        $this->join = '';
    }
            if (is_null($tipo)) {
                $this->join .= " JOIN $tabela ON $condicao";
            } else {
                $this->join .= " $tipo JOIN $tabela ON $condicao";
            }
    return $this;
}




function insert($dados){
$this->dados=$dados;
    if(is_null($this->sql)) {


$valorLabel='';
$valoresCampos='';
        foreach ($this->dados as $key=>$valor) {
                $valorLabel.="`$key`,";
                $valoresCampos.=":$key,";
        }
        $this->labels=substr($valorLabel, 0, -1);
        $campos=substr($valoresCampos, 0, -1);
 
$this->banco->query("INSERT INTO $this->crud_tabela ($this->labels) VALUES($campos) $this->where $this->join");
            foreach ($this->dados as $key=>$valor) {
                        $this->banco->bind(":$key", $valor);
                        
            }

    } else {

        $this->banco->query($this->sql);
    }
    $retorno=is_array($this->params)?$this->banco->executa($this->params):$this->banco->executa();
    $this->id_insert=$this->banco->ultimoID();
$this->resetAttributes();
return $retorno;


}









    public function update($dados)
    {
        $this->dados=$dados;
        $this->selectSQL("update");
        $this->blindFor();
$retorno=is_array($this->params)?$this->banco->executa($this->params):$this->banco->executa();
$this->resetAttributes();
                                return $retorno;
    }
    


function  delete(){
      
$this->selectSQL('delete');

    $retorno=is_array($this->params)?$this->banco->executa($this->params):$this->banco->executa();
    
     $this->resetAttributes(); 
      return $retorno;


   
}


function  get($campos="*"){
    $this->selectSQL("select");
    $this->setLabels($campos);
$retorno=is_array($this->params)?$this->banco->resultado($this->params):$this->banco->resultado();
$this->paginacao['total_registros']=$this->count();
$this->resetAttributes();
                                 return $retorno;

  
}


function  getAll($campos="*"){

  
        $this->setLabels($campos); 
        $this->paginationData();                           
         $this->limite();
         $this->selectSQL("select");
    $resultados=is_array($this->params)?$this->banco->resultados($this->params):$this->banco->resultados();
    $this->paginacao['total_registros']=$this->count();
    $this->create_paginacao();
 $this->resetAttributes();
    return $resultados; 
   


    
}


function limite(){
    if($this->paginacao['registrosPorPagina'] && $this->index_pagina) {
        $this->limite ='LIMIT ' . ($this->index_pagina - 1) * $this->paginacao['registrosPorPagina'] . ', ' . $this->paginacao['registrosPorPagina'];
    }
}









function checkResult(): bool {   
   
return $this->count()>0?true:false;
    
    }





    function where(string $where, string $condicao = 'AND'): self {
        if (!is_string($where)) {
            throw new \InvalidArgumentException('O parâmetro $where deve ser uma string.');
        }
        
        $this->where .= $this->where === ''
            ? 'WHERE ' . $where
            : " $condicao $where";
    
        return $this;
    }





    public function count():int{

        $this->banco->query("SELECT COUNT(*) as total FROM $this->crud_tabela $this->where $this->join");
        $retorno=is_array($this->params)?$this->banco->resultado($this->params):$this->banco->resultado();
        $this->resetAttributes();
                                      return  (int)$retorno['total'];

    }

 
    







public function paginationData($pagina = null) {

if(is_null($this->index_pagina)){
    if (!isset($pagina) || !is_numeric($_GET)) {
         $this->index_pagina = 1; } 
         else { 
            $this->index_pagina = intval($_GET['p']); 
            } 
        }elseif(!is_null($pagina)){
            $this->index_pagina =$pagina ; 
        }
        return $this;
}


        function create_paginacao(){


            if (isset($this->paginacao['active']) && $this->paginacao['active'] === 'on') { 
                $paginacao=new Paginacao($this->index_pagina,$this-> paginacao['registrosPorPagina'],$this->paginacao['totalRegistros'] ,$this->paginacao['limitePaginacao'], $this->paginacao['link']);
                 $pages = $paginacao->render_pages($this->index_pagina); 
                 $this->paginacao['paginacao']= $pages;
                 }else{
                    $this->paginacao['paginacao']= '';
                 }
                
        }
        
        

function resetAttributes(){

    $this->where = '';
    $this->join = '';
    $this->limite = '';
    $this->sql = null;
    $this->labels='';
    $this->campos='';
    $this->index_pagina=null;
}

function setLabels($labels){
    $this->labels=$labels;
    return $this;
}
function setCampos($campos){
    $this->campos=$campos;
    return $this;
}



public function  selectSQL($tipo){
    if(is_null($this->sql)) {

switch ($tipo) {
    case 'delete':
        $this->banco->query("DELETE FROM $this->crud_tabela  $this->where $this->join $this->limite");
        break;
        case 'update':

            $valorLabel = array_map(function($key, $valor) {
                return "$key=:$key";
                }, array_keys($this->dados), array_values($this->dados));
            
                $this->labels = implode(",", $valorLabel);


            $this->banco->query("UPDATE $this->crud_tabela SET $this->labels $this->where $this->join");
            break;
            case 'select':
 $this->banco->query("SELECT $this->labels FROM $this->crud_tabela $this->where $this->join $this->limite"); 
                break;
 case 'insert':
    $this->banco->query("INSERT INTO $this->crud_tabela ($this->labels) VALUES($this->campos) $this->where $this->join");
   break;
    default:
        throw new Exception("Erro tipo de comando sql inváldio no \"{selectSQL(\$tipo)}\"");
        break;
}

       
    } else {
        $this->banco->query($this->sql);
    }

}


private function blindFor(){
    foreach ($this->dados as $key => $valor) {
        $this->banco->bind(":$key", $valor);
        }
    
}


function params($params){
    if(is_string($params)){
        $this->params=$params; 
    }else{
        throw new Exception("Erro:: parametros devem ser um Array()");
    }
       
    return $this;
    }

function sql($sql){
    $this->sql=$sql;
    return $this;
      
    }




public function beginTransaction(){
	$this->banco->beginTransaction();
    return $this;
}



public function commit(){
	$this->banco->commit();

}

public function rollBack(){


	$this->banco->rollBack();
}


public function inTransaction(){

return $this->banco->inTransaction();

}
   
public function quote($variavel){

     $this->banco->quote($variavel);
     return $this;
    
    }



}



?>