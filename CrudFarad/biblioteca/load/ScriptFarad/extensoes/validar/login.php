
<?php



if($this->proriedadeInputs['required']=='nao'){
  $required='';
  
     }else{
  
    $arrayRequired=explode(',',$this->proriedadeInputs['required']);
  
     }
  
  
  
  










     






if($this->proriedadeInputs['estilo']=="login"){

  $valores="<form name='form'  id='{$idForm}'  >";
  $valores.="<div id='{$idForm}2'></div>";


  if($visiveis[0]=='todos'){

    
    
    $mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$this->banco}' AND TABLE_NAME = '".$this->tabela."'";
    
    $tabelasarray=$conecta->query($mostrartabelas);
    
    foreach($tabelasarray as $key=>$tabelass){
       
        if($key==0){

        }else{


          $colunns=explode('_',$tabelass['COLUMN_NAME']);
          $nomeSeparado='';
          foreach($colunns as $colunns){
          
              $nomeSeparado.=$colunns.' ';
          
          }
$validator=0;
          if($this->proriedadeInputs['required']!='nao'){
            foreach($arrayRequired as $ey){
    if($ey==$key){
      $required='required';
    
    }else{
     if($validator==0){
      $required='';
     }
     
    }
    
    $validator++;   
            }
          }
          
        
        $valores.= '<div class="form-group"  ><label style="font-weight: bold ">'.$nomeSeparado.'</label><input  class="form-control" type="text" name="'.$tabelass['COLUMN_NAME'].'" '.$required.' > 
        </div>';
    }
    }
    


  }else{


    $num=0;
    
    
    $mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$this->banco}' AND TABLE_NAME = '".$this->tabela."'";
    
    $tabelasarray=$conecta->query($mostrartabelas);
    
    foreach($tabelasarray as $key=>$tabelass){
      
        if($key==0){

        }else{

          while($num<count($visiveis)){

            if($visiveis[$num]==$key){
    
              $colunns=explode('_',$tabelass['COLUMN_NAME']);
              $nomeSeparado='';
              foreach($colunns as $colunns){
              
                  $nomeSeparado.=$colunns.' ';
              
              }


              $validator=0;
              if($this->proriedadeInputs['required']!='nao'){
                foreach($arrayRequired as $ey){
        if($ey==$key){
          $required='required';
        
        }else{
         if($validator==0){
          $required='';
         }
         
        }
        
        $validator++;   
                }
              }
              
              $valores.= '<div class="form-group" ><label style="font-weight: bold ">'.$nomeSeparado.'</label><input  class="form-control" type="text" name="'.$tabelass['COLUMN_NAME'].'" '.$required.' > 
              </div>';
          }
          $num++;
          }

          $num=0;


       

          }
          
        
    }
    


    
  }
  

  $valores.='<a  class="btn btn-primary"'; 
  $valores.='onClick="cadastrar(';
  $valores.="'{$idForm}',";
  $valores.="'{$this->tabela}',";
  $valores.="'{$this->banco}',";
  $valores.="'{$this->proriedadeInputs["estilo"]}',";
  $valores.="'{$this->proriedadeInputs["colunaVerific"]}'";
  $valores.=')" >';
  $valores.="{$nomeButton}</a>";

   $valores.='</form>';
}





     ?>