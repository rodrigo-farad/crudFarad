<?php  

namespace CrudFarad;

use banco;

class  Table{
public $table_banco;
public $table_tabela;


    public function retornoColunas(){

        $banco=new banco;
        $banco->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$this->table_banco."' AND TABLE_NAME = '".$this->table_tabela."'");
        return  $banco->resultados();


        }
   
   
  




public function retirarColunns($colunasR){
$colunasR=explode(',',$colunasR);
$Colunas=$this->retornoColunas();
$colunas_retiradas=' ';

foreach($Colunas as $key=>$linhas){

if(in_array($linhas['COLUMN_NAME'],$colunasR)){

}else{
    $colunas_retiradas.=$linhas['COLUMN_NAME'].',';
}
    
}



 $retorno=substr($colunas_retiradas, 0, -1);

 return $retorno;
}



}
?>