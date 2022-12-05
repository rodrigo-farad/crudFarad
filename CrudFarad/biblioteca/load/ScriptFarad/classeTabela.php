<?php
namespace cadastrarTabela;



 
Class tabela {
    public $banco; // este é o banco de dados o qual ele se conectara
    public $tabela;   //nome da tabela que vc está referenciando
    public $colunas;   // é um arraay, colunas capturas de acordo com a tabela acima selecionada
    public $PerColun; //  personalizando o nome das colunas de acordo com indice do array , a ordem do indeice depende da ordem da coluna da tabela
    public $where;  // condição sql que deseja que pesquise as tabelas
    public $sucesso; // o nome já dis comtem scrip de alert de sucesso
    public $erro;    // o nome já dis comtem scrip de alert de erro
    public $alert;    // o nome já dis comtem scrip de alert 
    public $valuess;  // é um aarray com todos os values listado em uma coluna, ou que contenha num formulário com id especificado
    public $tipoImput;   //é um array, contem o tipo de input o formulário especificado com id 
    public $estiloTabela;   //é um nome de classe ou outro para exibir o modelo escolhido da tabela
    public $estiloForm;    //é um nome de classe ou outro para exibir o modelo escolhido do formulário
    public $proriedadeTable;    // é um array
    public $proriedadeInput;
    // public $idDiv;          //id da div ou tabela para retorno de dados no ajax ou paginação

 





    // construindo propriedades defalts pra proriedadeTable


    function __construct(){
      


      $this->banco='associacao';  // banco de dados default

                         // defaults de tabelas
      $this->proriedadeTable['maxRegistros']='10'; // valor default exibirá todas as tabelas
      $this->proriedadeTable['paginaAtual']=1;      // valor default exibirá começando pela página 1
      $this->proriedadeTable['classe']='table table-sm table-dark';      // valor default exibirá tabela modelo  da classe table table-dark
      $this->proriedadeTable['tableDiv']='table';
      $this->proriedadeTable['where']="";
      
      
      // valor default que exibirá uma tabela
     // $this->proriedadeTable['where']='';  // por enquanto sem uso no momento



                         // defaults de inputs
    $this->proriedadeInputs['estilo']='form';  //estilos == 'login' 'modal' 'form' 'edit_modal'
    $this->proriedadeInputs['required']='nao'; // para definir os required colocase em ordem das colunas tipo assim 1,2,3  e assim sucessivamente
    $this->proriedadeInputs['colunaVerific']=0;// usado para informar qual é a coluna que será verificada no login form de registro duplo etc
  }
    



    private function setCadastrar() {


include('cmd/conecta.php');
include('extensoes/tabelas/set_table.php');




    }

    private function updateCadastro() {


      include('cmd/conecta.php');
      include('extensoes/tabelas/update_table.php');
      
      
          }





    public function getTabela($visiveis,$Id){

      $this->proriedadeTable['where']=" order by ".$this->capturarColuna(0)." desc";  // foi colocado aqui porque no construct ele não funciona, não chama função
      

      include('cmd/conecta.php');

      if($this->proriedadeTable['tableDiv']=='table'){

        include('extensoes/tabelas/class/get_table.php');
        return  $valores;

      }





     
     

    }





// debugador função somente para fazer a estrutura 
//sql do insert tipo $sql=insert into (aqui onde essa funcao coloca as colunas) (aaqui coloc o prepared)



public function registroDuplo($where,$explota){
  include('cmd/conecta.php');




 

$sql = "select  *from {$this->tabela}  {$where}";
$verica = $conecta->prepare($sql);
foreach($explota as $num){
  
  $verica->bindValue(":{$this->colunas[$num]}",$this->valuess[$num]);

}

$verica->execute();

$vok=$verica->fetchAll();
$verrifica=count($vok);

if($verrifica>0){
   
  return $this->erroDuplicado($num);
}else{
  return $this->setCadastrar();
}



}







function debugarTabela($tipo,$para){
    
  include('extensoes/tabelas/debug_table.php');
     return $intoValues;

}









// função pra criar inputs de tabelas







function criarImputs($visiveis,$idForm,$nomeButton){  
   include('cmd/conecta.php');

  if($this->proriedadeInputs['estilo']=='form' or  $this->proriedadeInputs['estilo']=='modal'){
    include('extensoes/tabelas/inputs_table.php');

    return  $valores;

  }
   
   if($this->proriedadeInputs['estilo']=='login'){
   
    include('extensoes/validar/login.php');

    return  $valores;
    
  }
   
  
   





}





//funções pra erros  e sucessos





function erroDuplicado($num){

    //modal alert de erro  com id= 'erro_cadastrar'
    if($this->proriedadeInputs['estilo']=='form' or  $this->proriedadeInputs['estilo']=='modal'){

   echo'erro';


    }

}







// funções especificas , ou seja pequenas funções





public function contarTable(){  // dois parametros $table o nome da tabela $where condicao
  include('cmd/conecta.php');


  $sqlConta=$conecta->prepare("select count(*) from  {$this->tabela} {$this->proriedadeTable['where']}  " );

  $sqlConta->execute();
  $result = $sqlConta->fetch();

  return $result[0];
  


}



             // login para fazer validações etc






 function login($explodido,$where){


  include('cmd/conecta.php');




  $sql = "select  *from {$this->tabela}  {$where}";
  $verica = $conecta->prepare($sql);
  foreach($explodido as $num){
  
      $verica->bindValue(":{$this->colunas[$num]}",$this->valuess[$num]);
  
  }
  
  $verica->execute();
  
  $vok=$verica->fetchAll();
  $verrifica=count($vok);
  
  if($verrifica>0){
    session_start();
  
    $_SESSION['logarte']="logarte123";    //significa logado
       
    
  
     return "logado";
  
  }else{
  
 return "erro";
  
  }




}






public function deslogar(){

 session_destroy();
} 




public function capturarColuna($possicion){
  

  include('cmd/conecta.php');

  $mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$this->banco}' AND TABLE_NAME = '{$this->tabela}'";
	
	$tabelasarray=$conecta->query($mostrartabelas);
	
	foreach($tabelasarray as $key=>$tabelass){
	   
		if($key==$possicion){

      $colunaVar=$tabelass['COLUMN_NAME'];

		}
	}




  return $colunaVar;
}





























    
}








?>