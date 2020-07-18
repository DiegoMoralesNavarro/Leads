


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
      <h1>Lista de Leads no Status <strong><?php echo $status[0]['tipostatus'] ?></strong></h1>
     
     </div>
  </div>

</div>




<div class="container">

  <div class="row">
    <div class="col s12 form">

    	

    	<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/status-lista/<?php echo $status[0]['idstatus'] ?>?pesquisa=$pesquisa&page=$numero" method="get">

    		<div class="row">
				<div class="input-field col s12 l9">
					<i class="material-icons prefix">textsms</i>
			          <input type="text" id="autocomplete-input" class="autocomplete" name="pesquisa" value="<?php echo $valor; ?>">
			          <label for="autocomplete-input">Nome do Lead</label>
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
						<th>Empresa</th>
						<th>Telefone</th>
						<th>E-mail</th>
						<th>Último <br>Follow UP</th>
						<th>Editar</th>
					</tr>
				</thead>
				<tbody>

					  <?php foreach ($users as $value) { 

					

					  	if (!$value == null) {

					  		for ($i=0; $i < count($value); $i++) { 

					  	?>

						<tr>
							<td style="overflow: hidden; max-width: 150px;" ><?php echo $value[$i]['nome']; ?></td>
							<td style="overflow: hidden; max-width: 150px;" ><?php echo $value[$i]['empresa']; ?></td>
							
							<td><?php
								$numero = preg_replace("/[^0-9]/", "", $value[$i]['telefone']);
								if (strlen($value[$i]['telefone']) == 14) {

									?>	<a href="https://api.whatsapp.com/send?phone=55<?php echo $numero ?>" target="_blank"><?php echo $value[$i]['telefone']; ?></a> <?php
								}else{ ?>
									<a href="tel:+55<?php echo $value[$i]['telefone']; ?>" target="_blank"><?php echo $value[$i]['telefone']; ?></a>
									<?php
								}

								?> </td>

							<td ><a href="mailto:<?php echo $value[$i]['email']; ?>"><?php echo $value[$i]['email']; ?></a></td>


							<td><?php if ($value[$i]['ultimo_followup'] == "vazio" || $value[$i]['ultimo_followup'] == null) {
								echo "Não existe <br> Follow UP";
							}else{
								echo date('d/m/Y', strtotime($value[$i]['ultimo_followup']));
							} ?>
								
							</td>

				
							<td class="edite-form"> 

								<a href="<?php echo URLestilo ?>/dashboard/editar/<?php echo $value[$i]['idlead']?>" 
					  			class="btn-floating btn-small waves-effect waves-light " style="padding: 0 0px!important;">
					  			<i class="material-icons" >edit</i></a>

					  				<a href="<?php echo URLestilo ?>/dashboard/status-lista/<?php echo $value[$i]['idlead']?>/delete?idstatus=<?php echo $status[0]['idstatus'] ?>" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn-floating btn-small waves-effect red accent-4 " style="padding: 0 0px!important;">
					  			<i class="material-icons" >delete_forever</i></a>

					  			<a href="<?php echo URLestilo ?>/dashboard/follow-up/<?php echo $value[$i]['idlead']?>" class="btn-floating btn-small waves-effect light-green " style="padding: 0 0px!important;"><i class="material-icons" >done_all</i></a>


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
