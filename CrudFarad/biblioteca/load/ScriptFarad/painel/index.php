<?php

session_start();

include_once('../conecta/conecta.php');

$sem=isset($_SESSION['login'])?$_SESSION['login']:'';
$classe=isset($_SESSION['classe'])?$_SESSION['classe']:'';

if($sem=='logado' ){

if($classe=='unidade'){
echo'<script>
window.location="painel.php";

</script>';
}

if($classe=='admin'){
echo'<script>
window.location="admin.php";

</script>';
}
}







$login=isset($_POST['login'])?$_POST['login']:'';

$senha=isset($_POST['senha'])?$_POST['senha']:'';


if($login!=''){



$cont=0;




$stmt = $conecta->prepare("select *from usuario where login='$login' and senha='$senha'");
$stmt->execute();
$res = $stmt->fetchAll();


foreach($res as $linha){
	
	$login2=$linha['login'];
	$senha2=$linha['senha'];
	$classe=$linha['classe'];
	$cont++;
	
}
	


if($cont==0){
	
	echo '<script>alert("ops erro não foi possivel fazer o login \n tente novamente!!!")</script>';	
}else{
	
	
	
	
	if($classe=='unidade'){
		
		$_SESSION['login']='logado';
	$_SESSION['classe']='unidade';
		
		
		echo'<script>window.location="painel.php"</script>';
		
		
	}
	
	if($classe=='admin'){
			$_SESSION['login']='logado';
	$_SESSION['classe']='admin';
		
		echo'<script>window.location="admin.php"</script>';
		
		
	}
	
	
	
	
}






	
	
}else{
	

}
	
	


?>












<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body >
  <div class="container-scroller" >
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto" style="background-image:url(../img/azule.gif)">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5" style="background-image:url(../img/azule.gif);background-repeat:no-repeat;background-size:100% 600px;">
              <div class="brand-logo">
                <!--<img src="../img/logo.jpg" alt="logo">-->
              </div>
              <h4 style="color:#FFF">Bem vindo!!</h4>
              <h6 class="font-weight-light"><font style="color:#FFF">Entre com seu login para continuar</font></h6>
              <form  action="index.php" method="post" enctype="multipart/form-data">
             <div class="form-group">
                  <input style="color:#FFF;background-color:black;" type="text" class="form-control form-control-lg" id="login" name="login" placeholder="Usuário" required>
                </div>
                <div class="form-group">
                  <input style="color:#FFF;background-color:black;" type="password" class="form-control form-control-lg" id="senhaa" name="senha" placeholder="Senha" required>
                </div>
                <div class="mt-3">

                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >ENTRAR</button>
                
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  
             
                </div>  
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
