


<?php 

if (isset($_COOKIE['Atualizado'])) {
	?> 
	<script>
		window.addEventListener("load", function() {
	    M.toast({html: 'Deletado'})
	  });
	</script>
	<?php
	setcookie("Atualizado", '', time() - 2000);
}else{

}


 ?> 


<?php 


if (isset($_GET['pesquisa'])) {
	$_SESSION["pesquisa"] = $_GET['pesquisa'];

	$valor = $_SESSION["pesquisa"];
}else{
	$_SESSION["pesquisa"] = "";

	$valor = $_SESSION["pesquisa"];
}





?>



<div class="container">

  <div class="row">
    <div class="col s12">
      <h1>Editar dados de usuário da empresa: <?php echo $nomecliente[0]['nome_cliente']; ?></h1>
      
       <blockquote>Pesquisa e atualização de usuário</blockquote>
     </div>
  </div>

</div>




<div class="container">

  <div class="row">
    <div class="col s12 form">

    	<a href="<?php echo URLestilo ?>/dashboard/configurar/cliente/<?php echo $nomecliente[0]['id_cliente']; ?>" 
  			class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >arrow_back</i></a>

  			<br><br>

    	<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/configurar/cliente/atualizar-usuario-cliente/<?php echo $nomecliente[0]['id_cliente']; ?>?pesquisa=$pesquisa&page=$numero" method="get">

    		<div class="row">
				<div class="input-field col s12 l9">
					<i class="material-icons prefix">textsms</i>
			          <input type="text" id="autocomplete-input" class="autocomplete" name="pesquisa" value="<?php echo $valor; ?>">
			          <label for="autocomplete-input">Nome do Usuario</label>
				</div>
				<div class="input-field col s12 l3 center-align">
					<button class="btn waves-effect waves-light" type="submit">Pesquisar
						<i class="material-icons right">search</i>
					</button>
				</div>
			</div>
	


    		<table class="striped centered responsive-table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>E-mail</th>
						<th>Nivel</th>
						<th>Editar</th>
					</tr>
				</thead>
				<tbody>

					  <?php foreach ($users as $value) { 

					

					  	if (!$value == null) {

					  		for ($i=0; $i < count($value); $i++) { 

					  	?>

						<tr>
							
							<td><?php echo $value[$i]['id_user']; ?></td>
							<td><?php echo $value[$i]['user']; ?></td>
							<td><?php echo $value[$i]['email']; ?></td>
							<td><?php echo $value[$i]['nivel']; ?></td>

							<td class="edite-form"> 
								<a class="waves-effect waves-light btn-small" 
								href="<?php echo URLestilo ?>/dashboard/configurar/cliente/atualizar-usuario-cliente/<?php echo $nomecliente[0]['id_cliente']; ?>/editar/<?php echo $value[$i]['id_user'] ?>">Editar</a>

								<a class=" red accent-4 btn-small" 
					href="<?php echo URLestilo ?>/dashboard/configurar/cliente/atualizar-usuario-cliente/<?php echo $value[$i]['id_user']?>/delete/<?php echo $nomecliente[0]['id_cliente']; ?>" onclick="return confirm('Deseja realmente excluir este registro?')" >Excluir</a>

							</td>
						</tr>
					<?php } // for?>

						<?php

						
						}else{  ?>

							<tr>
								<td>xx</td>
								<td>vazio</td>
								<td></td>
								<td></td>
							</tr>

					<?php
						}// if
					 } //for
					?>
				
				</tbody>
			</table>




<br>
<!-- pagina -->
<?php 


$voltar = $page - 1;
$avancar = $page + 1;
$numerosPorPagina = 4;

$linhas = $_SESSION["paginas"];

$total_Paginas = ceil($linhas/$itemsPerPage);

function selected( $value, $selected ){
    return $value==$selected ? ' class="active" style="color: #fff;" "' : '';
}

 ?>



<div class="col s12 m4 l12 center-align">

<ul class="pagination">

	<?php 
	if ($linhas > $itemsPerPage) { 
		if($page == 1){
			?>

	<?php }else{ ?>
	<li class="disabled">
		<button name="page" type="submit" value="<?php echo $voltar; ?>"><i class="material-icons">chevron_left</i></button>
	</li>
	<?php } ?>



	<?php for($i = $page - $numerosPorPagina; $i <= $page; $i++ ){

	if($i >= 1){ ?>
		<li <?php echo selected( $page, $i ); ?> > <button <?php echo selected( $page, $i ); ?> id="paginar" name="page" type="submit" value="<?php echo $i ?>"><?php echo $i ?></button> </li>
		
	<?php 	}

	}
	?> 


	<?php for($i = $page + 1; $i <= $page + $numerosPorPagina; $i++ ){
	if($i <= $total_Paginas){ ?>
		<li class="waves-effect">
			<button name="page" type="submit" value="<?php echo $i ?>"><?php echo $i ?></button>
		</li>
		
	<?php 	}
	}
	?> 


	<?php if($page == $total_Paginas){ ?>

	<?php }else{ ?>
	<li class="disabled">
		<button name="page" type="submit" value="<?php echo $avancar; ?>"><i class="material-icons">chevron_right</i></button>
	</li>
	<?php } ?>

	<?php 
	}else{
			// não mostrar paginação pois o total do DB é menor que o o limite exibido
	} ?>

 </ul>


</div>






    	</form>


    	

	</div>
  </div>

</div>    	


<br><br><br><br>
