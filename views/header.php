<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


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
<body>



<dir class="barra-user">
  <div>
    <p> Olá <?php echo $_SESSION["user"]; ?></p> <a href="/<?php echo pastaPrincipal ?>/dashboard/logout"><i class="material-icons prefix" >exit_to_app</i></a>
  </div>
  <div> 
    <a href=""><i class="material-icons prefix">folder_shared</i>Configurar</a>
  </div>
 
</dir>

<nav class="nav-extended" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo">Logo</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard">Dashboard</a></li>
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard/cadastro">Cadastrar Lead</a></li>
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard/servico">Criar Serviço</a></li>
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard/status">Criar Status</a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard">Dashboard</a></li>
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard/cadastro">Cadastrar Lead</a></li>
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard/servico">Criar Serviço</a></li>
        <li><a href="/<?php echo pastaPrincipal ?>/dashboard/status">Criar Status</a></li>
      </ul>

      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>

    </div>
  </nav>


<br>