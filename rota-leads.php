<?php 



use \App\EditarUser;
use \App\EditarStatus;
use \App\EditarServico;
use \App\CriarLeads;
use \App\VerLeads;
use \App\FollowUp;
use \App\StatusLista;
use \App\LoginUser;



////



$app->get('/dashboard/', function() {

	LoginUser::verifyLogin();

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

	LoginUser::verifyLogin();


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
	


	if (isset($_POST['nome'])) {
		$user->saveUpdateLead((int)$idlead);
	}else{
		$user->adicionaServico((int)$idlead);
		$user->removeServico((int)$idlead);
	}


	

	$user->gravarArquivo((int)$idlead);



	$userId = EditarUser::listAllId($idlead);

	setcookie("Atualizado", "Atualizado");

	header("location: /".pastaPrincipal."/dashboard/editar/$idlead");
    exit; 



});

//


$app->get('/dashboard/follow-up/:idlead', function($idlead){

	LoginUser::verifyLogin();



	require_once('../'.pastaPrincipal.'/views/'.header);

	$idlead = $idlead;

	$followUp = FollowUp::listFolloUp($idlead);

	$followUpVazio = FollowUp::listFolloUpVazio($idlead);

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

	if (isset($_POST['textofollow'])) {
		$user->cadastrarFollowUp($idlead);
		
	}

	if (isset($_POST['statusLead'])) {
		$user->salvarStatus($idlead);
	}
	

	if (isset($_POST['texto'])) {
		$user->salvarFollowUp($idlead);
	}


	


	

	setcookie("Atualizado", "Atualizado");
	

	header("location: /".pastaPrincipal."/dashboard/follow-up/$idlead");
  	 exit; 

});

/////////////fazer o difine DO URL

////



$app->get('/dashboard/cadastro', function() {

	LoginUser::verifyLogin();
	

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

	LoginUser::verifyLogin();

	LoginUser::verifyNivel2();

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

	LoginUser::verifyLogin();

	LoginUser::verifyNivel2();

	require_once('../'.pastaPrincipal.'/views/'.header);

	$status = EditarStatus::listStatus();
	

	require_once('../'.pastaPrincipal.'/views/status.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/status', function() {


	 $user = new EditarStatus();

	 $user->setData($_POST);
	 $user->saveStatus();
	 $user->saveStatusUpdate();

	 setcookie("Atualizado", "Atualizado");
	 
	header("location: /".pastaPrincipal."/dashboard/status");
  	exit; 

});


///


$app->get('/dashboard/status-lista/:idstatus', function($idstatus) {

	LoginUser::verifyLogin();

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

	$itemsPerPage = 20;

	$users = new StatusLista();
	$users->listAll($val, $page, $itemsPerPage, $idstatus);

	//$user = EditarUser::listAll(); ///

	$status = StatusLista::saberStatus($idstatus);
	
	

	require_once('../'.pastaPrincipal.'/views/status-lista.php');



	require_once('../'.pastaPrincipal.'/views/'.footer);

});








 ?>