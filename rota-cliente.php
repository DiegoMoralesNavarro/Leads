<?php 




use \App\LoginUser;

use \App\cliente\CriarCliente;

use \App\cliente\ListarCliente;

use \App\cliente\VerCliente;

use \App\cliente\Arquivos;

use \App\cliente\Delete;

use \App\cliente\MostrarLogsCliente;

use \App\cliente\EditarDadosClientes;



////



$app->get('/dashboard/configurar/cliente', function() {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel1();
	LoginUser::verifyNivelMaster();


	$nomecliente = CriarCliente::nomecliente();

	$totalcontas = CriarCliente::totalcontas();

	$totalarquivos = CriarCliente::totalarquivos();
	


	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/cliente/cliente.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});






$app->post('/dashboard/configurar/cliente', function() {


	$user = new CriarCliente();
	$user->setData($_POST);




     header("location: /".pastaPrincipal."/dashboard/configurar/cliente");
     exit;

});

//


$app->get('/dashboard/configurar/cliente/cadastro', function() {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel1();
	LoginUser::verifyNivelMaster();





	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/cliente/cadastro.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});






$app->post('/dashboard/configurar/cliente/cadastro', function() {


	$user = new CriarCliente();
	$user->setData($_POST);

	var_dump($user);

	$user->cadastar();




     // header("location: /".pastaPrincipal."/dashboard/configurar/cliente/cadastro");
     // exit;

});

//




////



$app->get('/dashboard/configurar/cliente/:id', function($id) {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel1();
	LoginUser::verifyNivelMaster();

	

	$datainicio = Arquivos::dataInicio($id);
	
	$_SESSION['datainicio'] = $datainicio[0]['MIN(data)'];

	$_SESSION['datafinal'] = date('Y-m-d');
	  


	$nomecliente = VerCliente::nomecliente($id);

	$totalContas = ListarCliente::totalContas($id);

	$totalLeads = ListarCliente::totalLeads($id);

	$totalArquivos = ListarCliente::totalArquivos($id);

	$totalConsumo = ListarCliente::totalConsumo($id);

	if ($totalConsumo[0]['sum(tamanho)'] >= 1000000) { 
      $resultado = round($totalConsumo[0]['sum(tamanho)'] /1000000) . " Mb"; 
     
    } else if ($totalConsumo[0]['sum(tamanho)'] >= 100) {
       
       $resultado = round($totalConsumo[0]['sum(tamanho)'] /1000,1) . " kb"; 
       
    } else { 
    	

    	if ($totalConsumo[0]['sum(tamanho)'] == null) {
    		 $resultado = 0 . " bytes";
    	}else{
    		$resultado = $totalConsumo[0]['sum(tamanho)'] . " bytes";
    		
    	}

    	 
    }

	


	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/cliente/dados-cliente.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});









$app->post('/dashboard/configurar/cliente/:id', function($id) {


	$user = new CriarCliente();
	$user->setData($_POST);




     header("location: /".pastaPrincipal."/dashboard/configurar/cliente/$id");
     exit;

});

//




$app->get('/dashboard/configurar/cliente/atualizar-usuario-cliente/:id', function($id) {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel1();
	LoginUser::verifyNivelMaster();






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

	$users = new VerCliente();
	$users->listUsuario($val, $page, $itemsPerPage, $id);

	$nomecliente = VerCliente::nomecliente($id);
	
	


	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/cliente/atualizar-usuario-cliente.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});






$app->post('/dashboard/configurar/cliente/atualizar-usuario-cliente/:id', function($id) {


	$user = new CriarCliente();
	$user->setData($_POST);




     header("location: /".pastaPrincipal."/dashboard/configurar/cliente/atualizar-usuario-cliente/$id");
     exit;

});




$app->get('/dashboard/configurar/cliente/atualizar-usuario-cliente/:iduser/delete/:id', function($iduser, $id){


	
	$user = new Delete();
	$user->deletarUserCliente((int)$iduser, $id);


	header("Location: /".pastaPrincipal."/dashboard/configurar/cliente/atualizar-usuario-cliente/$id");
 	exit;

	

});








//



$app->get('/dashboard/configurar/cliente/atualizar-usuario-cliente/:id/editar/:user', function($id, $user) {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel1();
	LoginUser::verifyNivelMaster();




	$usuarioDados = VerCliente::usuarioDados($id, $user);

	$nomecliente = VerCliente::nomecliente($id);

	

	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/cliente/usuario-cliente-editar.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});






$app->post('/dashboard/configurar/cliente/atualizar-usuario-cliente/:id/editar/:users', function($id, $users) {


	$user = new VerCliente();
	$user->setData($_POST);

	


	if (isset($_POST['user'])) {
		$user->atualizarDados($id, $users);
		
	}else{
		$user->atualizarSenha($id, $users);
	}

	


 // header("Location: /".pastaPrincipal."/dashboard/configurar/cliente/atualizar-usuario-cliente/$id/editar/$user");
 //    exit;

});

//





$app->get('/dashboard/configurar/cliente/arquivos/:id', function($id) {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel1();
	LoginUser::verifyNivelMaster();



	$datainicio = Arquivos::dataInicio($id);


	if (!isset($_SESSION['datainicio'])) {
	    $_SESSION['datainicio'] = $datainicio[0]['MIN(data)'];
	  }

	if (!isset($_SESSION['datafinal'])) {
	    $_SESSION['datafinal'] = date('Y-m-d');
	  }

	




	$itemsPerPage = 10;

	$arquivos = new Arquivos();
	$arquivos->listaArquivos($itemsPerPage, $id);


	$tamanho = Arquivos::arquivoTamanhoTotal($id);
	$totalArquivos = Arquivos::totalArquivos($id);
	$rotaPastas = Arquivos::rotaPastas($id);





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


	require_once('../'.pastaPrincipal.'/views/cliente/arquivos.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});






$app->post('/dashboard/configurar/cliente/arquivos/:id', function($id) {


	$arquivos = new Arquivos();
	$arquivos->setData($_POST);



	if (isset($_POST['page'])) {

		$arquivos->paginavalor();

	}else if (isset($_POST['deletar'])) {

		$arquivos->paginavalor();

		$arquivos->deletar($id);

	}else if (isset($_POST['buscar'])){

		$itemsPerPage = 2;

		$arquivos->listaArquivos($itemsPerPage, $id);

	}




     header("location: /".pastaPrincipal."/dashboard/configurar/cliente/arquivos/$id");
     exit;

});




$app->get('/dashboard/configurar/cliente/arquivos/:ididarquivo/delete/:id', function($idarquivo, $id){


	$arquivos = new Arquivos();
	$arquivos->deleteSimples((int)$idarquivo, $id);

	header("location: /".pastaPrincipal."/dashboard/configurar/cliente/arquivos/$id");
     exit;

	

});


//



$app->get('/dashboard/configurar/cliente/log/:id', function($id) {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel1();
	LoginUser::verifyNivelMaster();




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

	$users = new MostrarLogsCliente();
	$users->atribuirResponsavel($page, $itemsPerPage, $responsavel, $id);


	$user = MostrarLogsCliente::user($id);

	$nomecliente = VerCliente::nomecliente($id);



	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/cliente/logs-cliente.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});






$app->post('/dashboard/configurar/cliente/log/:id', function($id) {



     // header("location: /".pastaPrincipal."/dashboard/configurar/cliente/log/$id");
     // exit;

});




///

$app->get('/dashboard/configurar/cliente/editar-dados-cliente/:id', function($id) {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel1();
	LoginUser::verifyNivelMaster();



	$nomecliente = VerCliente::nomecliente($id);

	$limiteConsumo = EditarDadosClientes::limiteConsumo($id);

	$resultado = round($limiteConsumo[0]['consumo'] /1000000); 






	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/cliente/editar-dados-cliente.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});






$app->post('/dashboard/configurar/cliente/editar-dados-cliente/:id', function($id) {


	$clientedados = new EditarDadosClientes();
	$clientedados->setData($_POST);

	$clientedados->atualizarDadosCliente($id);
	setcookie("Atualizado", "Atualizado");



     header("location: /".pastaPrincipal."/dashboard/configurar/cliente/editar-dados-cliente/$id");
     exit;

});

////



///

$app->get('/dashboard/configurar/cliente/deletar-lista/', function() {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel1();
	LoginUser::verifyNivelMaster();



	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}else{
		$page = 1;
	}

	$itemsPerPage = 20;

	$users = new Delete();
	$users->listCliente($page, $itemsPerPage);

	





	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/cliente/deletar-lista.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});






$app->post('/dashboard/configurar/cliente/deletar-lista/', function() {



     // header("location: /".pastaPrincipal."/dashboard/configurar/cliente/editar-dados-cliente/$id");
     // exit;

});

////


$app->get('/dashboard/configurar/cliente/delete/:id', function($id) {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel1();
	LoginUser::verifyNivelMaster();


$nomecliente = VerCliente::nomecliente($id);



	require_once('../'.pastaPrincipal.'/views/'.header);


	require_once('../'.pastaPrincipal.'/views/cliente/deletar-confirmar.php');


	require_once('../'.pastaPrincipal.'/views/'.footer);

});



$app->post('/dashboard/configurar/cliente/delete/:id', function($id) {



     // header("location: /".pastaPrincipal."/dashboard/configurar/cliente/editar-dados-cliente/$id");
     // exit;

});

/////



$app->get('/dashboard/configurar/cliente/delete-definitivo/:id', function($id) {

	LoginUser::verifyLogin();

	LoginUser::verifyNivel1();
	LoginUser::verifyNivelMaster();


	$deletarTudoCliente = new Delete();

	$deletarTudoCliente->deletarTudoCliente($id);



});



$app->post('/dashboard/configurar/cliente/delete-definitivo/:id', function($id) {



     // header("location: /".pastaPrincipal."/dashboard/configurar/cliente/editar-dados-cliente/$id");
     // exit;

});

////






 ?>