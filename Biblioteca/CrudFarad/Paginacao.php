<?php  

namespace CrudF;




/**
 *
 * Classe para Paginação de Resultado
 * @author David
 *
 */
class Paginacao{
    private $pagina;
    private $totalbotoes;
    private $total;
    private $quantidade;
    private $url;
    private $registrosPorpagina;
    private $parametros;
   
    public function __construct($pagiMarcacao,$pagina, $total_registros, $quantidade,$registrosPorpagina){
        $this->pagina = $pagina;
        $this->total  = $total_registros;
        $this->quantidade = $quantidade;
        $this->registrosPorpagina = $registrosPorpagina;
        $this->parametros['marcacao_select'] = $pagiMarcacao;
    }
    public function setUrl($url){
        if (is_null($url)) {
            $protocolo = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=="on") ? "https" : "http");
            $variavelUrl =$_SERVER['QUERY_STRING'];
            $url = $protocolo.'://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
            $this->url=$url;
        } else {
            $this->url=$url;
        }
            $this->url = $url;
    }







 
    function gerarPaginacao($echo = false)
    {
if($this->total==0){
return '...';
}
        $quantidade_butons=$this->quantidade_butons();
        if( $quantidade_butons==$this->pagina){
            $disabledP='disabled="disabled"';
            $disabledV='';
                            }else{
                                if ($this->pagina==1) {
                                    $disabledP='';
                                    $disabledV='disabled="disabled"';
                                }else{
                                    $disabledP='';
                                    $disabledV='';

                                }
                            }
   
     
        $result =   '<ul class="pagination pagination-sm m-0 float-left">';

        $result .=
        '<form name="f_voltar" action="'.$this->url.'" enctype="multipart/form-data" method="post"> <li  class="page-item"><input name="p" type="hidden" value="'.($this->pagina-1).',1"><input type="submit"  value="«" class="page-link" '. $disabledV.' /></li></form>';
        
      

     
       
 

        for($i = 1; $i <=$quantidade_butons; $i++){
           

            if($this->totalbotoes>$quantidade_butons && $this->pagina>=$quantidade_butons){
                
     

                $result.=$this->verificaAtivo($this->marcacao($i),$i);

            }else{

                $result.=$this->verificaAtivo($i,$i);


            }
     

          
        }


      



        if( $quantidade_butons<$this->pagina){
            $result .= '<form name="f_voltar" action="'.$this->url.'" enctype="multipart/form-data" method="post"> <li  class="page-item"><input name="p" type="hidden" value="'.($this->pagina+1).','.$i.'"><input type="submit"  value="»" class="page-link" '.$disabledP.'/></li></form>';
       
        }else{
            $result .= '<li  class="page-item"><input type="submit"  value="»" class="page-link" disabled/></li></form>';
       

        }
       
        if(!$echo){
            return $result;
        }
        echo $result;
    }



private function quantidade_butons(){
    $this->totalbotoes=$this->total/$this->registrosPorpagina;
    //$botoes=($this->registrosPorpagina*$this->pagina)/$totalRegistrosBotoes;



    if($this->total<=$this->registrosPorpagina){
        $botoes=1;

    }else{
        $botoes=ceil($this->total/$this->registrosPorpagina);
if($this->quantidade<=$botoes){

    $botoes=$this->quantidade;


}

}

return $botoes;
    
    }











public function verificaAtivo($valorPag,$i){

    if($this->pagina ==$valorPag){

                    
        $result = '<form name="f'.$i.'" action="'.$this->url.'" enctype="multipart/form-data" method="post"> <li  class="page-item active"><input name="p" type="hidden" value="'.$valorPag.','.$i.'"><input type="submit"  value="'.$valorPag.'" class="page-link" /></li></form>';
    
    
     }else{
        $result = '<form  name="f'.$i.'" action="'.$this->url.'" enctype="multipart/form-data" method="post"> <li  class="page-item"><input name="p" type="hidden" value="'.$valorPag.','.$i.'"><input type="submit"  value="'.$valorPag.'" class="page-link" /></li></form>';
   
    }
return $result;

}



public function marcacao($i){

    if($i==1){
        $valorPag=$this->parametros['marcacao_select'];
    }else{
        $valorPag=$this->parametros['marcacao_select']+($i-1);

    }
return $valorPag;

}

}






/*
   modo de uso

$pagina = (isset($_GET['pag'])) ? (int)$_GET['pag'] : 1;
 
//Instancia a paginacao
$paginacao = new Paginacao($pagina, 20, 5);
//informa a url ou pagina que terá a paginacao
$paginacao->setUrl('categoria.php');
//adiciona os parametros, com array
$paginacao->setParametros(array('categoria' => 5));
//mostra os links da paginacao
$paginacao->gerarPaginacao();

*/
?>