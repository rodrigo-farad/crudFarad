 <?php  
class apiViacep extends Controller {


public $banco;
public $loginModel;
public $sessoes;
public $script;
function __construct(){}



/*
"cep": "79901-026",
"logradouro": "Rua Caiabis",
"complemento": "",
"bairro": "Jardim Parque dos Eucalíptos",
"localidade": "Ponta Porã",
"uf": "MS",
"ibge": "5006606",
"gia": "",
"ddd": "67",
"siafi": "9131"

*/

 function convertCepGeo($cep){
  
  $cep = $cep;
  $geocode =file_get_contents("https://viacep.com.br/ws/{$cep}/json/");
  $output= json_decode($geocode);
 return $output;

  }
 
 



  
  public function getFileContent($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $contents = curl_exec($ch);
    if (curl_errno($ch)) {
        echo curl_error($ch);
        echo "\n
";
        $contents = '';
    } else {
        curl_close($ch);
    }

    if (!is_string($contents) || !strlen($contents)) {
        echo "Failed to get contents.";
        $contents = '';
    }

    return $contents;
}




 


}
?>