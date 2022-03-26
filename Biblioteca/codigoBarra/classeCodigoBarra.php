<?php

class geraCodigoBarra{

	public $altura;  // array   altura pagina  ou altura codigo de barra etec
	public $largura;// array
	public $tipoCodigoBarra;


	function __construct(){
		$this->largura['codigoBarra']=3;
		$this->altura['codigoBarra']=50;
		}
		
	
	
		function geraCodigoBarra($numero){
			$fino = 1;
			$largo = $this->largura['codigoBarra'];
			$altura = $this->altura['codigoBarra'];
		
		
		$barcodes[0] = '00110';
		$barcodes[1] = '10001';
		$barcodes[2] = '01001';
		$barcodes[3] = '11000';
		$barcodes[4] = '00101';
		$barcodes[5] = '10100';
		$barcodes[6] = '01100';
		$barcodes[7] = '00011';
		$barcodes[8] = '10010';
		$barcodes[9] = '01010';
		
		for($f1 = 9; $f1 >= 0; $f1--){
			for($f2 = 9; $f2 >= 0; $f2--){
				$f = ($f1*10)+$f2;
				$texto = '';
				for($i = 1; $i < 6; $i++){
					$texto .= substr($barcodes[$f1], ($i-1), 1).substr($barcodes[$f2] ,($i-1), 1);
				}
				$barcodes[$f] = $texto;
			}
		}
		
		$retorno= '<img class="imgBarras" src="codigoBarra/imagens/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
		$retorno.= '<img class="imgBarras" src="codigoBarra/imagens/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
		$retorno.= '<img class="imgBarras" src="codigoBarra/imagens/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
		$retorno.= '<img class="imgBarras" src="codigoBarra/imagens/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
		
		$retorno.= '<img class="imgBarras"';
		
		$texto = $numero;
		
		if((strlen($texto) % 2) <> 0){
			$texto = '0'.$texto;
		}
		
		while(strlen($texto) > 0){
			$i = round(substr($texto, 0, 2));
			$texto = substr($texto, strlen($texto)-(strlen($texto)-2), (strlen($texto)-2));
			
			if(isset($barcodes[$i])){
				$f = $barcodes[$i];
			}
			
			for($i = 1; $i < 11; $i+=2){
				if(substr($f, ($i-1), 1) == '0'){
  					$f1 = $fino ;
  				}else{
  					$f1 = $largo ;
  				}
  				
  				$retorno.= 'src="codigoBarra/imagens/p.gif" width="'.$f1.'" height="'.$altura.'" border="0">';
  				$retorno.= '<img class="imgBarras" ';
  				
  				if(substr($f, $i, 1) == '0'){
					$f2 = $fino ;
				}else{
					$f2 = $largo ;
				}
				
				$retorno.= 'src="codigoBarra/imagens/b.gif" width="'.$f2.'" height="'.$altura.'" border="0">';
				$retorno.= '<img class="imgBarras"';
			}
		}
		$retorno.= 'src="codigoBarra/imagens/p.gif" width="'.$largo.'" height="'.$altura.'" border="0" />';
		$retorno.= '<img class="imgBarras" src="codigoBarra/imagens/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
		$retorno.= '<img class="imgBarras" src="codigoBarra/imagens/p.gif" width="1" height="'.$altura.'" border="0" />';
	
	
		return $retorno;
	
	
	}

	


}



	


?>