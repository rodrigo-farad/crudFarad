   <?php 
   


   if($this->proriedadeInputs['required']=='nao'){
$required='';

   }else{

  $arrayRequired=explode(',',$this->proriedadeInputs['required']);

   }






   

if($this->proriedadeInputs['estilo']=="modal"){

  $valores="

  <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#{$idForm}Modal'>
  {$nomeButton}
</button>



  
  <div class='modal fade' id='{$idForm}Modal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>{$this->tabela}</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>
  
  
  
  <form name='form'  id='{$idForm}'  >";
  $valores.="<div id='{$idForm}2'></div>";
  
  if($visiveis[0]=='todos'){

  
  
  $mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$this->banco."' AND TABLE_NAME = '".$this->tabela."'";
  
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
      
      $valores.= '<div class="form-group"><label style="font-weight: bold ">'. $nomeSeparado.'</label><input  class="form-control" type="text" name="'.$tabelass['COLUMN_NAME'].'" '.$required.' > 
      </div>';
  }
  }
  }else{


  $num=0;
  
  
  $mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$this->banco."' AND TABLE_NAME = '".$this->tabela."'";
  
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
            
            $valores.= '<div class="form-group"><label  style="font-weight: bold ">'. $nomeSeparado.'</label><input  class="form-control" type="text" name="'.$tabelass['COLUMN_NAME'].'" '.$required.' > 
            </div>';
        }
        $num++;
        }

        $num=0;


     

        }
        
      
  }
  

  
}




   $valores.="</form>
   
   </div>
   <div class='modal-footer'>
     <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
    



     $valores.='<a  class="btn btn-primary"'; 
     $valores.='onClick="cadastrar(';
     $valores.="'{$idForm}',";
     $valores.="'{$this->tabela}',";
     $valores.="'{$this->banco}',";
     $valores.="'{$this->proriedadeInputs["estilo"]}',";
     $valores.="'{$this->proriedadeInputs["colunaVerific"]}'";
     $valores.=')" >';
     $valores.="{$nomeButton}</a>";



     
     
     $valores.=" </div> </div> </div></div> ";





}







// outro tipo de form









if($this->proriedadeInputs['estilo']=="form"){

  $valores="<form name='form'  id='{$idForm}'  >";
  $valores.="<div id='{$idForm}2'></div>";


  if($visiveis[0]=='todos'){

    
    
    $mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$this->banco."' AND TABLE_NAME = '".$this->tabela."'";
    
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
    
    
    $mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$this->banco."' AND TABLE_NAME = '".$this->tabela."'";
    
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