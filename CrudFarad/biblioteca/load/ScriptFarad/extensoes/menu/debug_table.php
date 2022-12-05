	 <?php 
// inserção com prepare



if($tipo=='valor'and $para=='prepare'){
    $intoColunas='';
    $intoValues='';
    $exeValues='';

    foreach($this->colunas as $index=>$valColuna){
     
       
        // $intoColunas.=$valColuna.',';
         //$intoValues.=':'.$valColuna.',';
           $intoColunas.="'$valColuna'".',';
         $intoValues.="':'.$valColuna'".',';
     
         foreach($this->valuess as $index2=>$valValor){
     
             if($index==$index2){
     
     
     //$exeValues.=':'.$valColuna."=>".$valValor.',';
     $exeValues.="':{$valColuna}'=>'{$valValor}',";
     
     
             }
     
         }
         

         
     
     
     }
    
    
    $size3 = strlen($exeValues);
    $exeValues = substr($exeValues,0, $size3-1);
     return $exeValues;


}






if($tipo=='colunas'and $para=='prepare'){

    $intoColunas='';
    $intoValues='';
    $exeValues='';
    foreach($this->colunas as $index=>$valColuna){
     
       
        // $intoColunas.=$valColuna.',';
         //$intoValues.=':'.$valColuna.',';
           $intoColunas.="'$valColuna'".',';
         $intoValues.=':'.$valColuna.',';
     
         foreach($this->valuess as $index2=>$valValor){
     
             if($index==$index2){
     
     
     //$exeValues.=':'.$valColuna."=>".$valValor.',';
     $exeValues.=':'.$valValor.',';
     
     
             }
     
         }
        

         
     
     
     }


     $size2 = strlen($intoValues);
     $intoValues=substr($intoValues,0, $size2-1);
    

     return $intoValues;

}





  // paraa query inserção sem prepare






if($tipo=='valor'and $para=='query'){
    $intoColunas='';
    $intoValues='';
    $exeValues='';

    foreach($this->colunas as $index=>$valColuna){
     
       
        // $intoColunas.=$valColuna.',';
         //$intoValues.=':'.$valColuna.',';
           $intoColunas.="'$valColuna'".',';
         $intoValues.="'$valColuna'".',';
     
         foreach($this->valuess as $index2=>$valValor){
     
             if($index==$index2){
     
     
     //$exeValues.=':'.$valColuna."=>".$valValor.',';
     $exeValues.="'$valValor'".',';
     
     
             }
     
         }
         
    
     
     
     }
     $size3 = strlen($exeValues);
    $exeValues = substr($exeValues,0, $size3-1);

        

     return $exeValues;

}






if($tipo=='colunas'and $para=='query'){

    $intoColunas='';
    $intoValues='';
    $exeValues='';
    foreach($this->colunas as $index=>$valColuna){
     
       
        // $intoColunas.=$valColuna.',';
         //$intoValues.=':'.$valColuna.',';
           $intoColunas.="'$valColuna'".',';
         $intoValues.=$valColuna.',';
     
         foreach($this->valuess as $index2=>$valValor){
     
             if($index==$index2){
     
     
     //$exeValues.=':'.$valColuna."=>".$valValor.',';
     $exeValues.=$valValor.',';
     
     
             }
     
         }
        
    
        
     
     
     }
     $size2 = strlen($intoValues);
    $intoValues=substr($intoValues,0, $size2-1);
  
    }
?>