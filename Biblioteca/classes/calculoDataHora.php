<?php

class calculoDataHora{

    public $data;    
    public $hora;    
    public $Mensagem;
    public $indice;
    public $dataindice;
    public $horaTolerencia;
    public $indiceHoje;

 function calculoAtual($data,$hora){
    date_default_timezone_set(FUSO_HORARIO);

   
        $this->hora=$hora;
        $this->data=$data;
    
    

    $dataAtual = strtotime(date('Y-m-d'));
    $dataAgenda=strtotime($this->data);
    $horaAtual= strtotime(date('H:i'));
    $horario=strtotime($this->hora);
   
  
  
  

    if($dataAgenda<$dataAtual){
      $this->indice=3;
      $this->Mensagem='A data e o horário excedeu';
      $this->indiceHoje=0;
    }else{
               
      if($dataAgenda==$dataAtual){
        $this->indiceHoje=3;

        if($horario<$horaAtual){
            $this->indice=3;
            $this->Mensagem='Horário excedeu';
        }else{
            $this->indice=1;
          $this->Mensagem='Aguardando horário';
        }
  
  
      }else{
        $this->indiceHoje=1;
        $this->indice=1;
        $this->Mensagem='Aguardando horário';
      }
  
    }
}


 

}