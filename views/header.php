<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">


<?php 
$url = $_SERVER['REQUEST_URI'];

$path = parse_url($url, PHP_URL_PATH);
$pathFragments = explode('/', $path);
if ($pathFragments[3] == '') {
  $pathFragments = explode('leads/', $path);
  $end = end($pathFragments);
}else{
  $end = end($pathFragments);
}
  

 ?>

	<title><?php echo $end; ?></title>


<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 
  <link rel="stylesheet" type="text/css" href="<?php echo URLestilo; ?>/materialize/css/materialize.css" > 
  <link rel="stylesheet" type="text/css" href="<?php echo URLestilo; ?>/materialize/css/lead.css">


</head>
<body >

<dir class="barra-user">
  <div>
    <p> Olá <?php echo $_SESSION["user"]; ?> - </p> <a href="/<?php echo pastaPrincipal ?>/dashboard/logout"><i class="material-icons prefix" >exit_to_app</i></a>
  </div>
  <div> 
    <a href="/<?php echo pastaPrincipal ?>/dashboard/configurar"><i class="material-icons prefix">folder_shared</i>Configurar</a>
  </div>
 
</dir>

<nav class="nav-extended" role="navigation" style="height: 70px;">
    <div class="nav-wrapper container">
      <img class="logo-leads" src="<?php echo URLestilo; ?>/materialize/panda.png">
      <ul class="right hide-on-med-and-down">
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard">Dashboard</a></li>
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard/cadastro">Cadastrar Lead</a></li>
        <?php if($_SESSION["nivel"] <= 2) { ?>
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard/servico">Criar Serviço</a></li>
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard/status">Criar Status</a></li>
         <?php }else{ } ?>
      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard">Dashboard</a></li>
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard/cadastro">Cadastrar Lead</a></li>
        <?php if($_SESSION["nivel"] <= 2) { ?>
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard/servico">Criar Serviço</a></li>
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard/status">Criar Status</a></li>
        <?php }else{ } ?>
      </ul>

      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>

    </div>
  </nav>


<br>