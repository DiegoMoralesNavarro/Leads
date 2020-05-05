
<?php 

date_default_timezone_set('America/Sao_Paulo');

define("header", "header.php");

define("footer", "footer.php");

define("URLestilo", "http://localhost/meuteste");



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



$app->get('/leads/', function() {


	require_once('../meuteste/views/'.header);


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

	require_once('../meuteste/views/index.php');


	require_once('../meuteste/views/'.footer);

});





$app->post('/leads/', function() {


	$user = new VerLeads();
	$user->setData($_POST);


	 header("location: /meuteste/leads/");
     exit; 

});





///





$app->get('/leads/editar/:idlead', function($idlead) {


	require_once('../meuteste/views/'.header);


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


	require_once('../meuteste/views/lead.php');

	require_once('../meuteste/views/'.footer);

});


$app->post('/leads/editar/:idlead', function($idlead) {


	$user = new EditarUser();

	$user->setData($_POST);
	$user->saveUpdateLead((int)$idlead);
	//var_dump($user);

	$user->adicionaServico((int)$idlead);
	$user->removeServico((int)$idlead);

	$user->gravarArquivo((int)$idlead);



	$userId = EditarUser::listAllId($idlead);

	header("location: /meuteste/leads/editar/$idlead");
    exit; 



});

//


$app->get('/leads/follow-up/:idlead', function($idlead){


	require_once('../meuteste/views/'.header);

	$idlead = $idlead;

	$followUp = FollowUp::listFolloUp($idlead);
	$lead = FollowUp::listLead($idlead);

	$userStatus = FollowUp::listStatus();

	$listStatus = FollowUp::listAll($idlead);



	require_once('../meuteste/views/follow-up.php');


	require_once('../meuteste/views/'.footer);


});



$app->post('/leads/follow-up/:idlead', function($idlead) {

	$user = new FollowUp();

	$user->setData($_POST);
	$user->cadastrarFollowUp($idlead);
	$user->salvarFollowUp($idlead);
	$user->salvarStatus($idlead);
	

	header("location: /meuteste/leads/follow-up/$idlead");
  	 exit; 

});

/////////////fazer o difine DO URL

////



$app->get('/leads/cadastro', function() {
	

	require_once('../meuteste/views/'.header);

	$servico = CriarLeads::listServico();
	$origem = CriarLeads::origem();

	
	require_once('../meuteste/views/create.php');


	require_once('../meuteste/views/'.footer);

});

$app->post('/leads/cadastro', function() {

	 $user = new CriarLeads();

	 $user->setData($_POST);
	 $user->save();
	 

	

});




////





$app->get('/leads/servico', function() {

	require_once('../meuteste/views/'.header);

	$servico = EditarServico::listServico();
	
		
	require_once('../meuteste/views/servico.php');

	require_once('../meuteste/views/'.footer);

});

$app->post('/leads/servico', function() {

	 $user = new EditarServico();

	 $user->setData($_POST);
	 $user->saveServico(); 
	 $user->saveServicoUpdate();
	 header("location: /meuteste/leads/servico");
  	 exit; 

});




////





$app->get('/leads/status', function() {

	require_once('../meuteste/views/'.header);

	$status = EditarStatus::listStatus();
	

	require_once('../meuteste/views/status.php');


	require_once('../meuteste/views/'.footer);

});

$app->post('/leads/status', function() {


	 $user = new EditarStatus();

	 $user->setData($_POST);
	 $user->saveStatus();
	 var_dump($user);
	 $user->saveStatusUpdate();
	header("location: /meuteste/leads/status");
  	exit; 

});











$app->get('/leads/status/:idstatus/delete', function($idstatus) {

	$status = EditarStatus::listStatus();
	
	$user = new EditarStatus();
	$user->saveStatusDeletar((int)$idstatus);

});





$app->get('/leads/servico/:idstatus/delete', function($idstatus) {

	$servico = EditarServico::listServico();
	
	$user = new EditarServico();
	$user->ServicoDeletar((int)$idstatus);

});




$app->get('/leads/:idlead/delete', function($idlead) {

	$user = new VerLeads();
	$user->deleteUser($idlead);
	header("location: /meuteste/leads");
  	exit; 

});




$app->get('/leads/editar/:idlead/delete', function($idlead){

	$user = new EditarUser();
	$user->deleteArquivo($idlead);

	

});


$app->get('/leads/follow-up/:idlead/delete/', function($idlead){


	if (isset($_GET['id'])) {
		$val = $_GET['id'];
	}

	$user = new FollowUp();
	$user->deletarFollowUp((int)$idlead);

	

	header("location: /meuteste/leads/follow-up/$val");
  	exit; 

	

});


$app->run();









 ?>