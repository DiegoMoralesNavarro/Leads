

<?php 




use \App\LoginUser;



////


$app->get('/dashboard/configurar', function() {
	

	require_once('../'.pastaPrincipal.'/views/'.header);



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar', function() {

	 $user = new CriarLeads();

	 $user->setData($_POST);
	 
	

});



///




$app->get('/dashboard/configurar/atualizar-dados', function() {
	

	require_once('../'.pastaPrincipal.'/views/'.header);



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/atualizar-dados', function() {

	 $user = new CriarLeads();

	 $user->setData($_POST);
	 
	

});



////



$app->get('/dashboard/configurar/atualizar-usuario', function() {
	

	require_once('../'.pastaPrincipal.'/views/'.header);



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/atualizar-usuario', function() {

	 $user = new CriarLeads();

	 $user->setData($_POST);
	 
	

});


////



$app->get('/dashboard/configurar/cadastrar-usuario', function() {
	

	require_once('../'.pastaPrincipal.'/views/'.header);



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