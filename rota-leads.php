<?php 



use \App\EditarUser;
use \App\EditarStatus;
use \App\EditarServico;
use \App\CriarLeads;
use \App\VerLeads;
use \App\FollowUp;
use \App\StatusLista;
use \App\LoginUser;
use \App\AjaxNomes2;
use \App\Lembrete;

use \App\configurar\AtribuirLead;

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


if (isset($_GET['followup'])) {
	$FollowUP = $_GET['followup'];
}else{
	$FollowUP = 1;
}


	
	$itemsPerPage = 20;

	$users = new VerLeads();
	$users->listAll($val, $page, $itemsPerPage, $FollowUP);




	$user = EditarUser::listAll(); ///

	$dataA = new DateTime();

	$dataB = new DateTime();

	$dataC = new DateTime();

	$dataD = new DateTime();

	$dataE = new DateTime();

	$tempoum = VerLeads::novoLeadsQuatroH($dataA, $dataB);

	$tempodois = VerLeads::novoLeadsUmDia($dataC, $dataD);

	$tempotres = VerLeads::novoLeadsDoisDias($dataE);

	
	

	$status = VerLeads::status();
	$totalStatus = VerLeads::totalStatus();



	
	$responsavelTotal = AtribuirLead::responsavelTotal();
	$responsavelTotalLead = AtribuirLead::responsavelTotalLead();
	$responsavelMeuLead = AtribuirLead::responsavelMeuLead();


	$followMinhaLista = Lembrete::followMinhaLista();



	require_once('../'.pastaPrincipal.'/views/index.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});






$app->post('/dashboard/', function() {


	$user = new VerLeads();
	$user->setData($_POST);

	$user->imprimir();




     header("location: /".pastaPrincipal."/dashboard/");
     exit;

});

//


$app->get('/dashboard/lead-espera/', function() {

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


	if (isset($_GET['tempo'])) {
		$tempo = $_GET['tempo'];
		$_SESSION["tempo"] = $_GET['tempo'];
	}else{
		$tempo = 1;
		$_SESSION["tempo"] = "1";
	}





	$itemsPerPage = 20;

	$dataA = new DateTime();
	$dataB = new DateTime();
	$dataC = new DateTime();
	$dataD = new DateTime();

	$users = new StatusLista();
	$users->listAllStatus($val, $page, $itemsPerPage, $dataA, $dataB, $dataC, $dataD, $tempo);

	$status = StatusLista::saberStatus(1);


	require_once('../'.pastaPrincipal.'/views/lead-espera.php');

	require_once('../'.pastaPrincipal.'/views/'.footer);



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
	$responsavel = EditarUser::responsavel($idlead);
	$responsavelAtualizou = EditarUser::responsavelAtualizou($idlead);


	$servicoNao = EditarUser::servicoNaoDesejado($idlead);
	$servicoDesejado = EditarUser::servicoDesejado($idlead);

	$userStatus = EditarUser::listStatus($idlead);

	$userObs = EditarUser::listObs($idlead);

	$nomeArquivo = EditarUser::nomeArquivo($idlead);


	$rotaPastas = EditarUser::rotaPastas();

	


	require_once('../'.pastaPrincipal.'/views/lead.php');

	require_once('../'.pastaPrincipal.'/views/'.footer);

});


$app->post('/dashboard/editar/:idlead', function($idlead) {


	$user = new EditarUser();

	$user->setData($_POST);
	

	//var_dump($user);


	if (isset($_POST['nome'])) {
		$user->saveUpdateLead((int)$idlead);
		$user->gravarArquivo((int)$idlead);
	}else if (isset($_POST['posse'])) {
		$user->tomarPosseLead($idlead);
	}else{
		$user->adicionaServico((int)$idlead);
		$user->removeServico((int)$idlead);
	}


	

	



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


	$followUp = FollowUp::listFolloUp1($idlead);



	

	$followUpVazio = FollowUp::listFolloUpVazio($idlead);





	$lead = FollowUp::listLead($idlead);

	$userStatus = FollowUp::listStatus();

	$listStatus = FollowUp::listAll($idlead);


///


	$rotaPastas = EditarUser::rotaPastas();

	$responsavel = EditarUser::responsavel($idlead);

	


	$totalLembrete = Lembrete::totalLembrete();

	



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

	if (isset($_POST['posse'])) {
		$user->tomarPosseLead3($idlead);
	}

	if (isset($_POST['imprimirsimples'])) {
		$user->imprimirSimples($idlead);

		
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

	if (isset($_POST['tiposervico'])) {
		$user->saveServico(); 
		
	}

	if (isset($_POST['tiposervicoEditar'])) {
		$user->saveServicoUpdate();
		
	}
	 
	 

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

	 // var_dump($user);

	if (isset($_POST['tipostatus'])) {
		$user->saveStatus();
		
	}

	if (isset($_POST['tipostatusEditar'])) {
		$user->saveStatusUpdate();
		
	}
	 
	 

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


	$status = StatusLista::saberStatus($idstatus);
	
	

	require_once('../'.pastaPrincipal.'/views/status-lista.php');



	require_once('../'.pastaPrincipal.'/views/'.footer);

});





$app->post('/dashboard/status-lista/:idstatus', function($idstatus) {


	$user = new StatusLista();
	$user->setData($_POST);

	$page = $_SESSION["page"];
	$val = $_SESSION["pesquisa"];

	$itemsPerPage = 20;

	if (isset($_POST['imprimirsimples'])) {
		$user->imprimirSimples($idstatus);
		
	}

	if (isset($_POST['imprimir'])) {
		$user->imprimir($val, $page, $itemsPerPage, $idstatus);
		
	}

	if (isset($_POST['imprimirSimplesFollowup'])) {
		$user->imprimirSimplesFollowup($idstatus);
		
	}
	

	if (isset($_POST['imprimirFollowup'])) {
		$user->imprimirFollowup($val, $page, $itemsPerPage, $idstatus);
		
	}

	


     // header("location: /".pastaPrincipal."/dashboard/status-lista/:idstatus");
     // exit;

});




////




$app->get('/dashboard/lembrete/:idfollow', function($idfollow) {

	LoginUser::verifyLogin();

	//LoginUser::verifyNivel2();

	$follow = Lembrete::follow($idfollow);

	$followLembrete = Lembrete::followLembrete($idfollow);


	$followUsuario = Lembrete::followUsuario();


	




	require_once('../'.pastaPrincipal.'/views/'.header);
	
	require_once('../'.pastaPrincipal.'/views/lembrete.php');

	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/lembrete/:idfollow', function($idfollow) {

	 $user = new Lembrete();

	 $user->setData($_POST);




	 

	if (isset($_POST['textolembrete'])) {
		$user->cadastrarLembrete($idfollow);
	}

	if (isset($_POST['textolembretenovo'])) {
		$user->atualizarLembrete($idfollow);
	}
	
	

	 
	 

	 setcookie("Atualizado", "Atualizado");

	 header("location: /".pastaPrincipal."/dashboard/lembrete/$idfollow");
  	 exit; 

});







$app->get('/dashboard/meus-lembretes', function() {

	LoginUser::verifyLogin();

	
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}else{
		$page = 1;
	}



	$itemsPerPage = 30;

	$lembrete = new Lembrete();
	$lembrete->TodosMeusLembretes($page, $itemsPerPage);

	// var_dump($lembrete);
	




	require_once('../'.pastaPrincipal.'/views/'.header);
	
	require_once('../'.pastaPrincipal.'/views/meus-lembretes.php');

	require_once('../'.pastaPrincipal.'/views/'.footer);

});





$app->post('/dashboard/meus-lembretes', function() {

	$lembrete = new Lembrete();

	$lembrete->setData($_POST);

	
});


$app->get('/dashboard/meus-lembretes/:idlembrete/delete/:idfollow', function($idlembrete, $idfollow) {

	$lembrete = new Lembrete();

	$lembrete->deletarMeuLembrete($idlembrete, $idfollow);

	header("Location: /".pastaPrincipal."/dashboard/meus-lembretes");
 	exit;


	
});







 ?>