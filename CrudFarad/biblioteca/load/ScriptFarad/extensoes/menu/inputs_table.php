	 <?php 

if($modal=="sim"){
  
  if($visiveis[0]=='todos'){

  $valores='';
  
  $mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'ti' AND TABLE_NAME = '".$this->tabela."'";
  
  $tabelasarray=$conecta->query($mostrartabelas);
  
  foreach($tabelasarray as $key=>$tabelass){
     
      if($key==0){

      }else{


        $colunns=explode('_',$tabelass['COLUMN_NAME']);
        $nomeSeparado='';
        foreach($colunns as $colunns){
        
            $nomeSeparado.=$colunns.' ';
        
        }

      
      $valores.= '<div class="form-group"><label style="font-weight: bold ">'. $nomeSeparado.'</label><input  class="form-control" type="text" name="'.$tabelass['COLUMN_NAME'].'"  > 
      </div>';
  }
  }
  
return  $valores;

}else{


  $num=0;
  $valores='';
  
  $mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'ti' AND TABLE_NAME = '".$this->tabela."'";
  
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


            $valores.= '<div class="form-group"><label  style="font-weight: bold ">'. $nomeSeparado.'</label><input  class="form-control" type="text" name="'.$tabelass['COLUMN_NAME'].'"  > 
            </div>';
        }
        $num++;
        }

        $num=0;


     

        }
        
      
  }
  
return  $valores;

  
}}else{

  if($visiveis[0]=='todos'){

    $valores='';
    
    $mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'ti' AND TABLE_NAME = '".$this->tabela."'";
    
    $tabelasarray=$conecta->query($mostrartabelas);
    
    foreach($tabelasarray as $key=>$tabelass){
       
        if($key==0){

        }else{


          $colunns=explode('_',$tabelass['COLUMN_NAME']);
          $nomeSeparado='';
          foreach($colunns as $colunns){
          
              $nomeSeparado.=$colunns.' ';
          
          }


        
        $valores.= '<div class="form-group"  ><label style="font-weight: bold ">'.$nomeSeparado.'</label><input  class="form-control" type="text" name="'.$tabelass['COLUMN_NAME'].'"  > 
        </div>';
    }
    }
    


  }else{


    $num=0;
    $valores='';
    
    $mostrartabelas="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'ti' AND TABLE_NAME = '".$this->tabela."'";
    
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

              $valores.= '<div class="form-group" ><label style="font-weight: bold ">'.$nomeSeparado.'</label><input  class="form-control" type="text" name="'.$tabelass['COLUMN_NAME'].'"  > 
              </div>';
          }
          $num++;
          }

          $num=0;


       

          }
          
        
    }
    


    
  }


}

	
?>