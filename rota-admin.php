

<?php 




use \App\LoginUser;
use \App\CriarLeads;

use \App\configurar\AtualizarMeusDados;
use \App\configurar\AtualizarUsuario;
use \App\configurar\AtualizarUsuarioDados;
use \App\configurar\CadastrarUsuario;
use \App\configurar\AtribuirLead;
use \App\configurar\MostrarLogs;

use \App\configurar\Arquivo;
use \App\EditarUser;


////


$app->get('/dashboard/configurar', function() {

	LoginUser::verifyLogin();



	$totalArquivos = Arquivo::totalArquivos();
	// $rotaPastas = EditarUser::rotaPastas();
	$tamanho = Arquivo::arquivoTamanhoTotal();

	$responsavelTotal = AtribuirLead::responsavelTotal();
	$responsavelTotalLead = AtribuirLead::responsavelTotalLead();
	$responsavelMeuLead = AtribuirLead::responsavelMeuLead();

	//var_dump($responsavelTotalLead);



	if ($tamanho[0]['sum(tamanho)'] >= 1000000) { 
      $resultado = round($tamanho[0]['sum(tamanho)'] /1000000) . " Mb"; 
     
    } else if ($tamanho[0]['sum(tamanho)'] >= 100) {
       
       $resultado = round($tamanho[0]['sum(tamanho)'] /1000,1) . " kb"; 
       
    } else { 
    	

    	if ($tamanho[0]['sum(tamanho)'] == null) {
    		 $resultado = 0 . " bytes";
    	}else{
    		$resultado = $tamanho[0]['sum(tamanho)'] . " bytes";
    		
    	}

    	 
    }
	

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

	var_dump($user);


	
	

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

	$logs = CadastrarUsuario::listlog();

	
	

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

	//LoginUser::verifyNivel2();

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

	//LoginUser::verifyNivel2();

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


	LoginUser::verifyLogin();

	LoginUser::verifyNivel2();




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




	$itemsPerPage = 22;

	$users = new MostrarLogs();
	$users->atribuirResponsavel($page, $itemsPerPage, $responsavel);




	$user = MostrarLogs::user();


	

	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/configurar/log.php');



	require_once('../'.pastaPrincipal.'/views/'.footer);

});

$app->post('/dashboard/configurar/log', function() {

	
	 
	

});

///




$app->get('/dashboard/configurar/arquivos', function() {


	LoginUser::verifyLogin();

	LoginUser::verifyNivel2();


	$datainicio = Arquivo::dataInicio();


	if (!isset($_SESSION['datainicio'])) {
	    $_SESSION['datainicio'] = $datainicio[0]['MIN(data)'];
	  }

	if (!isset($_SESSION['datafinal'])) {
	    $_SESSION['datafinal'] = date('Y-m-d');
	  }





	$itemsPerPage = 10;

	$arquivos = new Arquivo();
	$arquivos->listaArquivos($itemsPerPage);


	$tamanho = Arquivo::arquivoTamanhoTotal();
	$totalArquivos = Arquivo::totalArquivos();
	$rotaPastas = EditarUser::rotaPastas();



	if ($tamanho[0]['sum(tamanho)'] >= 1000000) { 
      $resultado = round($tamanho[0]['sum(tamanho)'] /1000000) . " Mb"; 
     
    } else if ($tamanho[0]['sum(tamanho)'] >= 100) {
       
       $resultado = round($tamanho[0]['sum(tamanho)'] /1000,1) . " kb"; 
       
    } else { 
    	

    	if ($tamanho[0]['sum(tamanho)'] == null) {
    		 $resultado = 0 . " bytes";
    	}else{
    		$resultado = $tamanho[0]['sum(tamanho)'] . " bytes";
    		
    	}

    	 
    }

	
//arrumar para update o delete
	

	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/configurar/arquivo.php');



	require_once('../'.pastaPrincipal.'/views/'.footer);



	

});




$app->post('/dashboard/configurar/arquivos', function() {

	
	 $arquivos = new Arquivo();

	$arquivos->setData($_POST);

	


	if (isset($_POST['page'])) {

		$arquivos->paginavalor();

	}else if (isset($_POST['deletar'])) {

		$arquivos->paginavalor();

		$arquivos->deletar();

	}else if (isset($_POST['buscar'])){

		$itemsPerPage = 2;

		$arquivos->listaArquivos($itemsPerPage);

	}


header("location: /".pastaPrincipal."/dashboard/configurar/arquivos");
     exit; 
	

});


/////



$app->get('/dashboard/configurar/meu-lead', function() {


	LoginUser::verifyLogin();



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
	$users->meuLead($val, $page, $itemsPerPage);

	// var_dump($users);



	

	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/configurar/meu-lead.php');



	require_once('../'.pastaPrincipal.'/views/'.footer);



	

});



$app->post('/dashboard/configurar/meu-lead', function() {


	

});





$app->get('/dashboard/configurar/meu-lead/:id', function($id) {

	
	 $user = new EditarUser();

	$user->setData($_POST);

	setcookie("Atualizado", "Atualizado");

	
	$user->tomarPosseLead2($id);

	
	

});
















 ?>