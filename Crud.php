<?php  
namespace  Admin\Biblioteca\CrudFarad;
use  Admin\Biblioteca\CrudFarad\Paginacao;
use  Admin\Biblioteca\CrudFarad\Tabelas;
use  Admin\Biblioteca\service\conecta;
use Exception;

class Crud{

    private $dados=array();
    public $banco;
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
    public $relacion;
    public $campos;
    
    function __construct($createDb=false){
       
           //include("../Admin/Biblioteca/service/banco.php");

       
            $this->banco=new conecta($createDb);
            $this->where='';
            $this->limite='';
            $this->relacion='';     // em teste
            $this->join = '';
            $this->exetoArray=null;
            $this->paginacao['limitePaginacao']=8;
            $this->paginacao['registrosPorPagina']=null;
            $this->index_pagina=null;
            $this->labels='';
            $this->campos='';
            $this->paginacao['total_registros']=null;
            $this->paginacao['link']=null;
        
                   
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

$this->selectSQL("insert");
   
    } else {

        $this->banco->query($this->sql);
    }

    $retorno=is_array($this->params)?$this->banco->executa($this->params):$this->banco->executa();
    $this->id_insert=$this->banco->ultimoID();
$this->resetAttributes();
return $retorno;


}



function  ultimoID(){
    return $this->banco->ultimoID();
}


function maxID($tabela){
return $this->banco->maxID($tabela);
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
   
     $this->limit();

    if(is_null($this->sql)){
        $this->checkOptions($campos);
        $this->selectSQL("select");
    }else{
$cleanedSql = preg_replace('/;\s*$/', '', $this->sql);
$cleanedSql=$this->sql.' '.$this->limite;
$this->banco->query($cleanedSql);

    }
    
$retorno=is_array($this->params)?$this->banco->resultado($this->params):$this->banco->resultado();

if(is_null($this->sql)){
    $this->paginacao['total_registros']=$this->count();
}
$this->resetAttributes();

         return $retorno;

  
}











function getAll($options = array())
{ 
    

    if (!array_key_exists('total_registros', $this->paginacao) ) {
        $this->paginacao['total_registros'] = $this->count('getall');
    }
    
    $this->limit();

    if(is_null($this->sql)){
        $this->checkOptions($options);
        $this->selectSQL("select");
    }else{
$cleanedSql = preg_replace('/;\s*$/', '', $this->sql);
$cleanedSql=$this->sql." {$this->limite}";
$this->banco->query($cleanedSql);

    }
   

    $resultados = is_array($this->params) ? $this->banco->resultados($this->params) : $this->banco->resultados();

    
    
    $this->resetAttributes();

    return $resultados;
}

function checkOptions($options)
{

if(is_null($this->sql)){
    if (isset($options['label'])) {
        $label = $options['label'];
        $this->setLabels($label);
    }else{
        $this->setLabels("*");  
    }
}

   

    
}



function limit(){

    $this->paginationData();

    if($this->paginacao['registrosPorPagina'] && $this->index_pagina) {
       $this->limite ='LIMIT ' . ($this->index_pagina - 1) * $this->paginacao['registrosPorPagina'] . ', ' . $this->paginacao['registrosPorPagina'];
       
    }
    
 
       
   
}








function checkResult(): bool {   
   
return $this->count()>0?true:false;
    
    }

public function executa(){
   
    $this->banco->executa();
}



public function where(string $where, string $condicao = 'AND'): self {
    if (!is_string($where)) {
        throw new \InvalidArgumentException('O parâmetro $where deve ser uma string.');
    }
    
    $this->where .= $this->where === ''
        ? "WHERE $where"
        : " $condicao $where";

    return $this;
}




    public function count($padrao='padrao'){

        $countSql = "";

        if (is_null($this->sql)) {

           // Usar os atributos da classe para construir a consulta padrão de contagem
           $this->banco->query("SELECT COUNT(*) as total FROM $this->crud_tabela $this->where $this->join"); 

        } else {
           
// Se um SQL personalizado for passado, modificar a consulta para realizar a contagem

$cleanedSql = preg_replace('/;\s*$/', '', $this->sql);

$countSql = "SELECT COUNT(*) as total FROM ($cleanedSql) AS subquery";
 $this->banco->query($countSql);

  
        }

      $retorno=is_array($this->params)?$this->banco->resultado($this->params):$this->banco->resultado();

      if($padrao=='padrao'){
$this->resetAttributes();

      }
       
         return (int)$retorno['total'];

    }

 
    

    public function paginationData($pagina = null) {
        if (!isset($pagina) && !isset($_GET['p'])) {
            $this->index_pagina = 1;
        } else {
            $pagina = isset($_GET['p']) ? $_GET['p'] : $pagina;
            $pagina = is_numeric($pagina) ? $pagina : 1;
            $pagina = intval($pagina);
            $pagina = max($pagina, 1);
            $this->index_pagina = $pagina;
        }
    
        return $this;
    }
    
    
    

public function setLink(string $link): self {
    // Verifica se o link informado é válido
    if (filter_var($link, FILTER_VALIDATE_URL) === false) {
        throw new Exception('O link informado não é válido.');
    }

    // Define o link da paginação
    $this->paginacao['link'] = $link;

    // Retorna a própria instância da classe
    return $this;
}


function create_paginacao($função=null){  //  $tipo=null resultara em link normal caso coloque a função ele executara

    
        $this->paginacao['total_registros'] = $this->count();
    
$this->paginationData();
   
        $paginacao=new Paginacao($this->index_pagina,$this->paginacao['registrosPorPagina'],$this->paginacao['total_registros'] ,$this->paginacao['limitePaginacao'], $this->paginacao['link'],$função);
         $pages = $paginacao->render_pages($this->index_pagina); 
         $this->paginacao['paginacao']= $pages;
       
        
}


        

function resetAttributes() {
    
        $this->where = '';
        $this->join = '';
        $this->limite = '';
        $this->sql = null;
        $this->labels = '';    
        $this->campos = '';
        $this->index_pagina = null;
    }





function relacion() {
    // Cria uma nova instância da classe conecta
    $conecta = new conecta(false);
    $Tabelas = new Tabelas();

    // Chama tabelasRelacionadas passando a tabela e a conexão
    $relacion = $Tabelas->tabelasRelacionadas($this->crud_tabela, $conecta);
    
        if (!empty($this->relacion)) {
        foreach ($this->relacion as $table) {
            // Monta a condição de junção
            $condicao = "{$tabela}.{$table['foreign_key']} = {$table['name']}.{$table['primary_key']}";
            // Chama o método join da classe Crud
            $this->Crud->join($table['name'], $condicao);
        }
    return $this;
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

$valorLabel='';
$valoresCampos='';

        foreach ($this->dados as $key=>$valor) {
                $valorLabel.="`$key`,";
                $valoresCampos.=":$key,";
        }
        $this->labels=substr($valorLabel, 0, -1);
        $campos=substr($valoresCampos, 0, -1);
 


    $this->banco->query("INSERT INTO $this->crud_tabela ($this->labels) VALUES($this->campos) ");
      foreach ($this->dados as $key=>$valor) {
                        $this->banco->bind(":$key", $valor);
                        
            }
   break;
    default:
        throw new Exception("Erro tipo de comando sql inváldio no \"{selectSQL(\$tipo)}\"");
        break;
}

       
  

}


private function blindFor(){
    foreach ($this->dados as $key => $valor) {
        $this->banco->bind(":$key", $valor);
        }
    
}


function params($params){
    if(is_array($params)){
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