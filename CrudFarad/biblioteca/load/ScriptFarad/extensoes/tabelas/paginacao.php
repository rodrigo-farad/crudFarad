<?php
  $totalR=$this->contarTable($this->tabela);

  $paginasT=ceil($totalR/$totalRegistros);




  if($this->proriedadeTable['paginaAtual']!='nulo'){
	$valores.='
	  <nav aria-label="...">
	  <ul class="pagination">
		<li class="page-item disabled">
		  <a class="page-link" href="#" tabindex="-1">Anterior</a>
		</li>';
$botoes=1;




$idDiv=$Id;
$tabela=$this->tabela;
$banco=$this->banco;
$maxRegistros=$this->proriedadeTable['maxRegistros'];
$classe=$this->proriedadeTable['classe'];
$where=$this->proriedadeTable['where'];


//fazendo encapsulamento para mandar array no javascript

$encapsulamento='';

$es=0;
foreach($visiveis as $desmenbra){


	$encapsulamento.=$visiveis[$es].'-';
	$es++;
}
$siz= strlen($encapsulamento);
     $encapsulamento=substr($encapsulamento,0, $siz-1);



		while($botoes<=$paginas){

			if($botoes==$this->proriedadeTable['paginaAtual']){
				$class='page-item active';
			}else{
				$class='page-item';	
			}

			$valores.="<li class='".$class."'><a class='page-link'".' onClick="'."paginacao('{$idDiv}','{$tabela}','{$banco}','{$maxRegistros}','{$botoes}','{$classe}','{$encapsulamento}','{$where}'".')"
			
			 >'.$botoes."</a></li>";

			$botoes++;
		}

		



		$valores.='
		<li class="page-item">
		  <a class="page-link" >Próximo</a>
		</li>
	  </ul>
	</nav>';
	
	}


$valores.='</div>';



	$valores.='
	<script>

	function paginacao(idform, tabela, banco, maxRegistros, pagina, classe, visivel,wher) {


	
		






		var parametros = {
			idform: idform,
			tabela: tabela,
			banco: banco,
			maxRegistros: maxRegistros,
			pagina: pagina,
			classe: classe,
			visivel: visivel,
			wher: wher,
		};
	
		
	
		$.ajax({
	
				url: "paginacao.php",
				type: "post",
				data: parametros,
	
	
				beforeSend: function() {
					
					
					}
			})
			.done(function(msg) {
			

				
				
	
				var variavel = setTimeout(function() {
	
					$("#" + idform).html(msg);
					
			
				
	
	
				}, 10);
	
	
	
			})
			.fail(function(jqXHR, textStatus, msg) {
				alert("erro");
			});
	
	
	
	
	
	}
	
	
  </script>';



?>