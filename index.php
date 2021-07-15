





<?php 


session_start();


date_default_timezone_set('America/Sao_Paulo');

define("header", "header.php");

define("footer", "footer.php"); 

define("URLestilo", "http://localhost/leads");

define("pastaPrincipal", "leads");




require_once("vendor/autoload.php");

use \Slim\Slim;
use \App\LoginUser;
use \App\EditarUser;
use \App\EditarStatus;
use \App\EditarServico;
use \App\CriarLeads;
use \App\VerLeads;
use \App\FollowUp;
use \App\StatusLista;

use \App\configurar\Arquivo;
use \App\Lembrete;



use \App\configurar\AtualizarUsuarioDados;


$app = new Slim();



$app->config('debug', true);



//



$app->get('/', function() {

	require_once('../'.pastaPrincipal.'/views/login-header.php');

	require_once('../'.pastaPrincipal.'/views/login.php');

	require_once('../'.pastaPrincipal.'/views/login-footer.php');

	
});	


$app->post('/', function() {


	if ( ($_POST["valor1"] + $_POST["valor2"]) == $_POST["totalvalores"]) {
		LoginUser::login($_POST["user"],$_POST["senha"]);

		header("Location: /leads/dashboard/");
		exit;
	}else{
		header("Location: /leads/?recaptcha=invalido");
			exit;
	}


	
	
});	



$app->get('/dashboard/logout', function() {

	LoginUser::logout();

	header("Location: /leads/");
	exit;

});




///


require_once("rota-admin.php");


require_once("rota-leads.php");


require_once("rota-cliente.php");


$app->get('/dashboard/buscar', function() {

require_once('../'.pastaPrincipal.'/views/'.header);




	require_once('../'.pastaPrincipal.'/index2.php');

		require_once('../'.pastaPrincipal.'/views/'.footer);

	//$user = EditarUser::listAll(); ///

	//var_dump($user);

	
});	


$app->post('/dashboard/buscar', function() {


	
	
});	










$app->get('/dashboard/status/:idstatus/delete', function($idstatus) {

	$status = EditarStatus::listStatus();
	
	$user = new EditarStatus();
	$user->saveStatusDeletar((int)$idstatus);

});





$app->get('/dashboard/servico/:idstatus/delete', function($idstatus) {

	$servico = EditarServico::listServico();
	
	$user = new EditarServico();
	$user->ServicoDeletar((int)$idstatus);

});




$app->get('/dashboard/:idlead/delete', function($idlead) {

	$user = new VerLeads();
	$user->deleteUser($idlead);
	header("location: /".pastaPrincipal."/dashboard");
  	exit; 

});








$app->get('/dashboard/editar/:idlead/delete', function($idlead){

	$user = new EditarUser();
	$user->deleteArquivo($idlead);

	

});


$app->get('/dashboard/follow-up/:idlead/delete/', function($idlead){


	if (isset($_GET['id'])) {
		$val = $_GET['id'];
	}

	$user = new FollowUp();
	$user->deletarFollowUp((int)$idlead, $val);

	

	// header("location: /".pastaPrincipal."/dashboard/follow-up/$val");
 //  	exit; 

	

});


$app->get('/dashboard/follow-up/:idlead/delete-img/', function($idlead){


	if (isset($_GET['id'])) {
		$val = $_GET['id'];
	}

	$user = new FollowUp();
	$user->deleteImg2($idlead, $val);

	

	header("location: /".pastaPrincipal."/dashboard/follow-up/$val");
  	exit; 

	

});



$app->get('/dashboard/status-lista/:idlead/delete', function($idlead) {

	if (isset($_GET['idstatus'])) {
		$val = $_GET['idstatus'];
	}


	$user = new VerLeads();
	$user->deleteUser($idlead);
	header("location: /".pastaPrincipal."/dashboard/status-lista/$val");
  	exit; 

});


$app->get('/dashboard/lead-espera/:idlead/delete', function($idlead) {


	$val = $_SESSION["tempo"];


	$user = new VerLeads();
	$user->deleteUser($idlead);
	header("location: /".pastaPrincipal."/dashboard/lead-espera/?tempo=$val");
  	exit; 

});




$app->get('/dashboard/configurar/atualizar-usuario/:id/delete/', function($id){


	
	$user = new AtualizarUsuarioDados();
	$user->deletarUsuario((int)$id);


	header("Location: /".pastaPrincipal."/dashboard/configurar/atualizar-usuario");
 	exit;

	

});




$app->get('/dashboard/configurar/arquivos/:id/delete/', function($id){


	$arquivos = new Arquivo();
	$arquivos->deleteSimples((int)$id);

	header("Location: /".pastaPrincipal."/dashboard/configurar/arquivos");
 	exit;

	

});


$app->get('/dashboard/lembrete/:idlembrete/delete/:idfollow', function($idlembrete, $idfollow) {




	$user = new Lembrete();


	$user->deletarLembrete($idlembrete, $idfollow);


	 setcookie("Atualizado", "Atualizado");
	header("location: /".pastaPrincipal."/dashboard/lembrete/$idfollow");
  	exit; 

});





$app->run();









 ?>