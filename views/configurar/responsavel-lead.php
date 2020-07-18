



<?php 


if (isset($_GET['pesquisa'])) {
	$_SESSION["pesquisa"] = $_GET['pesquisa'];

	$valor = $_SESSION["pesquisa"];
}else{
	$_SESSION["pesquisa"] = "";

	$valor = $_SESSION["pesquisa"];
}



if (isset($_GET['responsavel'])) {
	$_SESSION["responsavel"] = $_GET['responsavel'];

	$responsavel = $_SESSION["responsavel"];
}else{
	$_SESSION["responsavel"] = 0;

	$responsavel = $_SESSION["responsavel"];
}



?>





<div class="container">

  <div class="row">
    <div class="col s12">
      <h1>Reponsável pelo lead</h1>
      
       <blockquote>Realize um pesquisa por responsável.</blockquote>
     </div>
  </div>

</div>




<div class="container">

  <div class="row">
    <div class="col s12 form">

    	<a href="<?php echo URLestilo ?>/dashboard/configurar" 
  			class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >arrow_back</i></a>

  			<br><br>

    	<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/configurar/responsavel-lead?pesquisa=$pesquisa&page=$numero&responsavel=$numero" method="get">

    		<div class="row">
				<div class="input-field col s12 l5">
					<i class="material-icons prefix">textsms</i>
			          <input type="text" id="autocomplete-input" class="autocomplete" name="pesquisa" value="<?php echo $valor; ?>">
			          <label for="autocomplete-input">Nome do Usuario</label>
				</div>



				<div class="col s12 l4">
					<div class="input-field col s12">
						
					    <select name="responsavel" >

					    	<option  value="0" > Todos </option>
					    	
					      <?php foreach ($user as $value){ ?>

					      		<option  value="<?php echo $value['id_user'] ?>" >  <?php echo $value['user'] ?> </option>

						    	

						    <?php } ?>
					    </select>
					    <label>Responsável</label>
					</div>
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
						<th>Nome</th>
						<th>Telefone</th>
						<th>E-mail</th>
						<th>Responsável</th>
						<th>Editar</th>
					</tr>
				</thead>
				<tbody>

					  <?php foreach ($users as $value) { 

					

					  	if (!$value == null) {

					  		for ($i=0; $i < count($value); $i++) { 

					  	?>

						<tr>

							<td><?php echo $value[$i]['nome']; ?></td>
							
							<td><?php
							$numero = preg_replace("/[^0-9]/", "", $value[$i]['telefone']);
							if (strlen($value[$i]['telefone']) == 14) {

								?>	<a href="https://api.whatsapp.com/send?phone=55<?php echo $numero ?>" target="_blank"><?php echo $value[$i]['telefone']; ?></a> <?php
							}else{ ?>
								<a href="tel:+55<?php echo $value[$i]['telefone']; ?>" target="_blank"><?php echo $value[$i]['telefone']; ?></a>
								<?php
							}

							?> </td>
				
							<td><?php echo $value[$i]['email']; ?></td>
							<td><?php echo $value[$i]['user']; ?></td>

							<td class="edite-form"> 
								<a class="waves-effect waves-light btn-small" 
								href="<?php echo URLestilo ?>/dashboard/configurar/atribuir-lead/existente/<?php echo $value[$i]['idlead'] ?>">Novo responsável</a>

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
