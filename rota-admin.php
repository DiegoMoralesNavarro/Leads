

<?php 




use \App\LoginUser;
use \App\CriarLeads;

use \App\configurar\AtualizarMeusDados;
use \App\configurar\AtualizarUsuario;
use \App\configurar\AtualizarUsuarioDados;
use \App\configurar\CadastrarUsuario;
use \App\configurar\AtribuirLead;



////


$app->get('/dashboard/configurar', function() {

	LoginUser::verifyLogin();
	

	require_once('../'.pastaPrincipal.'/views/'.header);

	require_once('../'.pastaPrincipal.'/views/configurar/configurar.php');

	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar', function() {

	 $user = new CriarLeads();

	 $user->setData($_POST);
	 
	

});



///




$app->get('/dashboard/configurar/atualizar-dados', function() {

	LoginUser::verifyLogin();
	

	require_once('../'.pastaPrincipal.'/views/'.header);

	$meusDados = AtualizarMeusDados::meusDados($_SESSION["id_user"]);

	
	 

	require_once('../'.pastaPrincipal.'/views/configurar/atualizar-dados.php');



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/atualizar-dados', function() {

	$user = new AtualizarMeusDados();

	$user->setData($_POST);




	if (isset($_POST['user'])) {
		$user->atualizarDados($_SESSION["id_user"]);
	}else{
		$user->atualizarSenha($_SESSION["id_user"]);
	}
	

});



////



$app->get('/dashboard/configurar/atualizar-usuario', function() {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel1();
	

//tabela con lista de usuario com botão editar

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

	$users = new AtualizarUsuario();
	$users->listUsuario($val, $page, $itemsPerPage, $_SESSION["nivel"]);

	//$user = AtualizarUsuario::listAll(); ///



	require_once('../'.pastaPrincipal.'/views/configurar/atualizar-usuario.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});




///



$app->get('/dashboard/configurar/atualizar-usuario/:id', function($id) {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel1();

require_once('../'.pastaPrincipal.'/views/'.header);

	$usuarioDados = AtualizarUsuarioDados::usuarioDados($id);


	
	require_once('../'.pastaPrincipal.'/views/configurar/editandoUsuario.php');

/// fazer DEPOIS o excluir e passar para outro


require_once('../'.pastaPrincipal.'/views/'.footer);


});




$app->post('/dashboard/configurar/atualizar-usuario/:id', function($id) {

	$user = new AtualizarUsuarioDados();

	$user->setData($_POST);


	
	

	if (isset($_POST['user'])) {
		$user->atualizarDados($id);
	}else{
		$user->atualizarSenha($id);
	}




});







// $app->get('/dashboard/configurar/atualizar-usuario/:id/delete', function($id) {

// 	LoginUser::verifyLogin();

// 		$usuarioDados = AtualizarUsuarioDados::usuarioDados($id);

// require_once('../'.pastaPrincipal.'/views/'.header);


// require_once('../'.pastaPrincipal.'/views/configurar/usuario-delete.php');



// require_once('../'.pastaPrincipal.'/views/'.footer);


// });




// $app->post('/dashboard/configurar/atualizar-usuario/:id/delete', function($id) {

// 	$user = new AtualizarUsuarioDados();

// 	$user->setData($_POST);




// });







////











$app->get('/dashboard/configurar/cadastrar-usuario', function() {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel1();


	/// só pode ser feito por admin
	

	require_once('../'.pastaPrincipal.'/views/'.header);



	require_once('../'.pastaPrincipal.'/views/configurar/cadastro-usuario.php');



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/cadastrar-usuario', function() {

	 $user = new CadastrarUsuario();

	 $user->setData($_POST);

	 $user->cadastrar();


	 header("location: /".pastaPrincipal."/dashboard/configurar/cadastrar-usuario");
     exit; 
	 
	

});




///






$app->get('/dashboard/configurar/atribuir-lead/novo', function() {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel2();

	//filtro dos lisd sem responsavel ou vazio  BOTÃO ATRIBUIR


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

	$users = new AtribuirLead();
	$users->atribuirNovo($val, $page, $itemsPerPage);



	

	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/configurar/atribuir-lead-novo.php');



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/atribuir-lead/novo', function() {

	// $user = new CriarLeads();

	 //$user->setData($_POST);
	 
	

});

//





$app->get('/dashboard/configurar/atribuir-lead/novo/:id', function($id) {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel2();


	$lead = AtribuirLead::lead($id);
	$responsavel = AtribuirLead::responsavel($id);
	$user = AtribuirLead::user();


	// $id = $id;
	

	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/configurar/atribuir-lead.php');



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/atribuir-lead/novo/:id', function($id) {

	$user = new AtribuirLead();

	$user->setData($_POST);

	$user->atribuir($id);

	 
	header("location: /".pastaPrincipal."/dashboard/configurar/atribuir-lead/novo/$id");
     exit; 

});















$app->get('/dashboard/configurar/atribuir-lead/existente', function() {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel2();

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

	$users = new AtribuirLead();
	$users->atribuirExistente($val, $page, $itemsPerPage);


	

	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/configurar/atribuir-lead-existente.php');



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/atribuir-lead/existente', function() {

	 //$user = new CriarLeads();

	 //$user->setData($_POST);
	 
	

});






$app->get('/dashboard/configurar/atribuir-lead/existente/:id', function($id) {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel2();


	$lead = AtribuirLead::lead($id);
	$responsavel = AtribuirLead::responsavel($id);
	$user = AtribuirLead::user();

	

	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/configurar/atribuir-lead.php');



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/atribuir-lead/existente/:id', function($id) {

	 $user = new AtribuirLead();

	$user->setData($_POST);

	$user->atribuir($id);

	 
	header("location: /".pastaPrincipal."/dashboard/configurar/atribuir-lead/existente/$id");
     exit; 
	 
	

});






///



$app->get('/dashboard/configurar/responsavel-lead', function() {


	LoginUser::verifyLogin();

	LoginUser::verifyNivel2();

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


	if (isset($_GET['responsavel'])) {
		$responsavel = $_GET['responsavel'];
	}else{
		$responsavel = 0;
	}




	$itemsPerPage = 20;

	$users = new AtribuirLead();
	$users->atribuirResponsavel($val, $page, $itemsPerPage, $responsavel);



	$user = AtribuirLead::user();


	//Responsavel por Lead, colocar no filtro nome do funcionario.

	//nome lead nome responsavel editar
	
	

	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/configurar/responsavel-lead.php');



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/responsavel-lead', function() {

	 // $user = new CriarLeads();

	 // $user->setData($_POST);
	 
	

});






///






///



$app->get('/dashboard/configurar/log', function() {


	// user - data - pagina - açao "editar dodos, exluir, posse, editar obs, logar" - id lead
	

	require_once('../'.pastaPrincipal.'/views/'.header);



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/log', function() {

	 $user = new CriarLeads();

	 $user->setData($_POST);
	 
	

});






 ?>