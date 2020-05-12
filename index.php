
<?php 

date_default_timezone_set('America/Sao_Paulo');

define("header", "header.php");

define("footer", "footer.php");

define("URLestilo", "http://localhost/leads");

define("pastaPrincipal", "leads");

require_once("vendor/autoload.php");

use \Slim\Slim;
use \App\EditarUser;
use \App\EditarStatus;
use \App\EditarServico;
use \App\CriarLeads;
use \App\VerLeads;
use \App\FollowUp;


$app = new Slim();



$app->config('debug', true);



//



$app->get('/', function() {
	echo "login";
});	



////



$app->get('/dashboard/', function() {


	require_once('../'.pastaPrincipal.'/views/'.header);


if (isset($_GET['pesquisa'])) {
	$val = $_GET['pesquisa'];
}else{
	$val = "";
}

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}else{
	$page = 1;
}


	
	$itemsPerPage = 4;

	$users = new VerLeads();
	$users->listAll($val, $page, $itemsPerPage);

	$user = EditarUser::listAll(); ///
	
	

	$status = VerLeads::status();
	$totalStatus = VerLeads::totalStatus();

	require_once('../'.pastaPrincipal.'/views/index.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});





$app->post('/dashboard/', function() {


	$user = new VerLeads();
	$user->setData($_POST);


	 header("location: /".pastaPrincipal."/dashboard/");
     exit; 

});





///





$app->get('/dashboard/editar/:idlead', function($idlead) {


	require_once('../'.pastaPrincipal.'/views/'.header);


	$userlistId = EditarUser::listId($idlead);
	$userlistIdOrigem = EditarUser::listIdOrigem($idlead);

	$user = EditarUser::listAll();
	$origem = EditarUser::origem();
	$userId = EditarUser::listAllId($idlead);
	$servicoNao = EditarUser::servicoNaoDesejado($idlead);
	$servicoDesejado = EditarUser::servicoDesejado($idlead);

	$userStatus = EditarUser::listStatus($idlead);

	$userObs = EditarUser::listObs($idlead);

	$nomeArquivo = EditarUser::nomeArquivo($idlead);


	require_once('../'.pastaPrincipal.'/views/lead.php');

	require_once('../'.pastaPrincipal.'/views/'.footer);

});


$app->post('/dashboard/editar/:idlead', function($idlead) {


	$user = new EditarUser();

	$user->setData($_POST);
	$user->saveUpdateLead((int)$idlead);
	//var_dump($user);

	$user->adicionaServico((int)$idlead);
	$user->removeServico((int)$idlead);

	$user->gravarArquivo((int)$idlead);



	$userId = EditarUser::listAllId($idlead);

	setcookie("Atualizado", "Atualizado");

	header("location: /".pastaPrincipal."/dashboard/editar/$idlead");
    exit; 



});

//


$app->get('/dashboard/follow-up/:idlead', function($idlead){



	require_once('../'.pastaPrincipal.'/views/'.header);

	$idlead = $idlead;

	$followUp = FollowUp::listFolloUp($idlead);
	$lead = FollowUp::listLead($idlead);

	$userStatus = FollowUp::listStatus();

	$listStatus = FollowUp::listAll($idlead);


///
	$img = FollowUp::selectImg($idlead);



	require_once('../'.pastaPrincipal.'/views/follow-up.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);


});



$app->post('/dashboard/follow-up/:idlead', function($idlead) {

	$user = new FollowUp();

	$user->setData($_POST);
	$user->cadastrarFollowUp($idlead);
	$user->salvarFollowUp($idlead);
	$user->salvarStatus($idlead);




	setcookie("Atualizado", "Atualizado");
	

	header("location: /".pastaPrincipal."/dashboard/follow-up/$idlead");
  	 exit; 

});

/////////////fazer o difine DO URL

////



$app->get('/dashboard/cadastro', function() {
	

	require_once('../'.pastaPrincipal.'/views/'.header);

	$servico = CriarLeads::listServico();
	$origem = CriarLeads::origem();

	
	require_once('../'.pastaPrincipal.'/views/create.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/cadastro', function() {

	 $user = new CriarLeads();

	 $user->setData($_POST);
	 $user->save();
	 

	

});




////





$app->get('/dashboard/servico', function() {

	require_once('../'.pastaPrincipal.'/views/'.header);

	$servico = EditarServico::listServico();
	
		
	require_once('../'.pastaPrincipal.'/views/servico.php');

	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/servico', function() {

	 $user = new EditarServico();

	 $user->setData($_POST);
	 $user->saveServico(); 
	 $user->saveServicoUpdate();

	 setcookie("Atualizado", "Atualizado");

	 header("location: /".pastaPrincipal."/dashboard/servico");
  	 exit; 

});




////





$app->get('/dashboard/status', function() {

	require_once('../'.pastaPrincipal.'/views/'.header);

	$status = EditarStatus::listStatus();
	

	require_once('../'.pastaPrincipal.'/views/status.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/status', function() {


	 $user = new EditarStatus();

	 $user->setData($_POST);
	 $user->saveStatus();
	 var_dump($user);
	 $user->saveStatusUpdate();

	 setcookie("Atualizado", "Atualizado");
	 
	header("location: /".pastaPrincipal."/dashboard/status");
  	exit; 

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




$app->run();









 ?>