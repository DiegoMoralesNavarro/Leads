

<?php 




use \App\LoginUser;
use \App\CriarLeads;

use \App\configurar\AtualizarMeusDados;
use \App\configurar\AtualizarUsuario;
use \App\configurar\AtualizarUsuarioDados;



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

////











$app->get('/dashboard/configurar/cadastrar-usuario', function() {

	LoginUser::verifyLogin();


	/// só pode ser feito por admin
	

	require_once('../'.pastaPrincipal.'/views/'.header);



	require_once('../'.pastaPrincipal.'/views/configurar/cadastro-usuario.php');



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/cadastrar-usuario', function() {

	 $user = new CriarLeads();

	 $user->setData($_POST);
	 
	

});




///



$app->get('/dashboard/configurar/atribuir-lead', function() {



	//filtro dos lisd sem responsavel ou vazio
	

	require_once('../'.pastaPrincipal.'/views/'.header);



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/atribuir-lead', function() {

	 $user = new CriarLeads();

	 $user->setData($_POST);
	 
	

});




///



$app->get('/dashboard/configurar/meu-lead', function() {



	//consulta simples editar e follow

	//tomar posse de de leads
	

	require_once('../'.pastaPrincipal.'/views/'.header);



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/meu-lead', function() {

	 $user = new CriarLeads();

	 $user->setData($_POST);
	 
	

});






///



$app->get('/dashboard/configurar/meu-lead/posse', function() {


//com pesquisa sem delete mas com edite e tomar posse
	//tomar posse de de leads // com o nome de pose da tabela leads, verificar se é igual 
	// ao user de sessao e virar ou não o botão tomar na lista
	

	require_once('../'.pastaPrincipal.'/views/'.header);



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/meu-lead/posse', function() {

	 $user = new CriarLeads();

	 $user->setData($_POST);
	 
	

});





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