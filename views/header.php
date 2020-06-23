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


<nav id="masthead">
  <div class="container">
    <div class="masthead-inner">
      <img class="logo-leads" src="<?php echo URLestilo; ?>/materialize/panda.png">
      <div class="main-nav">
        <ul>
          <li><a href="/<?php echo pastaPrincipal ?>/dashboard" class="menu-link">Dashboard</a></li>
          <li><a href="/<?php echo pastaPrincipal ?>/dashboard/cadastro" class="menu-link">Cadastrar Lead</a></li>
          <?php if($_SESSION["nivel"] <= 2) { ?>
          <li><a href="/<?php echo pastaPrincipal ?>/dashboard/servico" class="menu-link">Criar Serviço</a></li>
          <li><a href="/<?php echo pastaPrincipal ?>/dashboard/status" class="menu-link">Criar Status</a></li>
           <?php }else{ } ?>

           <li class="menu-trigger"> <i class="material-icons">menu</i></li>
        </ul>
      </dvi>
    </div>
  </nav>
  <aside class="menu">
    <div class="menu-inner">
      <p class="menu-close">  x </p>
      <ul class="menu-pages">
          <li><a href="/<?php echo pastaPrincipal ?>/dashboard">Dashboard</a></li>
          <li><a href="/<?php echo pastaPrincipal ?>/dashboard/cadastro">Cadastrar Lead</a></li>
          <?php if($_SESSION["nivel"] <= 2) { ?>
          <li><a href="/<?php echo pastaPrincipal ?>/dashboard/servico">Criar Serviço</a></li>
          <li><a href="/<?php echo pastaPrincipal ?>/dashboard/status">Criar Status</a></li>
          <?php }else{ } ?>

      </ul>
    </div>
  </div>
</aside>

<div class="overlay hide"></div>

<br><br>