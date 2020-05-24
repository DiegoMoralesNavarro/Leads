
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

$app = new Slim();



$app->config('debug', true);



//



$app->get('/', function() {

	require_once('../'.pastaPrincipal.'/views/login-header.php');

	require_once('../'.pastaPrincipal.'/views/login.php');

	require_once('../'.pastaPrincipal.'/views/login-footer.php');

	
});	


$app->post('/', function() {


	LoginUser::login($_POST["user"],$_POST["senha"]);



	header("Location: /leads/dashboard/");
	exit;
	
});	



$app->get('/dashboard/logout', function() {

	LoginUser::logout();

	header("Location: /leads/");
	exit;

});




///


require_once("rota-admin.php");


require_once("rota-leads.php");





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
	$user->deletarFollowUp((int)$idlead);

	

	header("location: /".pastaPrincipal."/dashboard/follow-up/$val");
  	exit; 

	

});


$app->get('/dashboard/follow-up/:idlead/delete-img/', function($idlead){


	if (isset($_GET['id'])) {
		$val = $_GET['id'];
	}

	$user = new FollowUp();
	$user->deleteImg($idlead);

	

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






$app->run();









 ?>