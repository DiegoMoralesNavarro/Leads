






<div class="container">

  <div class="row">
    <div class="col s12">
      <h1>Dashboard</h1>
      
       <blockquote>Consulte, Edite ou Exclua um Lead.</blockquote>
     </div>
  </div>

</div>



<?php 


if (isset($_GET['pesquisa'])) {
	$_SESSION["pesquisa"] = $_GET['pesquisa'];

	$valor = $_SESSION["pesquisa"];
}else{
	$_SESSION["pesquisa"] = "";

	$valor = $_SESSION["pesquisa"];
}



foreach ($user as $value){
	
 
}


?>

<div class="container">

  <div class="">
  	<div class="col s12 form ">


<form role="form" action="/<?php echo pastaPrincipal ?>/leads/?pesquisa=$pesquisa&page=$numero" method="get">

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
			<th>ID</th>
			<th>Nome</th>
			<th>Telefone</th>
			<th>Origem</th>
			<th>Status</th>
			<th>Editar</th>
		</tr>
	</thead>
	<tbody>

		  <?php foreach ($users as $value) { 

		

		  	if (!$value == null) {

		  		for ($i=0; $i < count($value); $i++) { 

		  	?>

			<tr>
				<td><?php echo $value[$i]['idlead']; ?></td>
				<td><?php echo $value[$i]['nome']; ?></td>
				<td><?php echo $value[$i]['telefone']; ?></td>
				<td><?php echo $value[$i]['tipo_origem']; ?></td>
				<td><?php echo $value[$i]['tipostatus']; ?></td>
				<td class="edite-form"> 
					<a class="waves-effect waves-light btn-small" 
					href="editar/<?php echo $value[$i]['idlead']?>">Editar</a>

					<a class=" red accent-4 btn-small" 
					href="<?php echo $value[$i]['idlead']?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" >Excluir</a>

					<a class="waves-effect light-green btn-small" 
					href="follow-up/<?php echo $value[$i]['idlead']?>">Follow up</a>

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



	<?php for($i = $page - $itemsPerPage; $i <= $page; $i++ ){
	if($i >= 1){ ?>
		<li <?php echo selected( $page, $i ); ?> > <button <?php echo selected( $page, $i ); ?> id="paginar" name="page" type="submit" value="<?php echo $i ?>"><?php echo $i ?></button> </li>
		
	<?php 	}
	}
	?> 


	<?php for($i = $page + 1; $i <= $page + $itemsPerPage; $i++ ){
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


</form>
<br><br>
</div>





	</div>
  </div> <!-- row -->

</div>


<br>


<!--  -->

<div class="container">

  <div class="row status">
    <div class="col s12">
      
       <blockquote>Total geral dos Status</blockquote>
    </div>
 

<?php

foreach ($status as $value) {

	$nome = $value['tipostatus'];

	if (isset(array_count_values(array_column($totalStatus, 'tipostatus'))[$nome]) ) {
		 ?>

		<div class="col s12 l3">
	    	<div class="col s12 form ">
	       	<h3 class="center-align"><?php echo array_count_values(array_column($totalStatus, 'tipostatus'))[$nome]; ?></h3>

	       	<p class="center-align"><?php echo $value['tipostatus']; ?></p>

	    	</div>
	    </div>

		 <?php
	}else{

		 ?>

		<div class="col s12 l3">
	    	<div class="col s12 form ">
	       	<h3 class="center-align"><?php echo "0"; ?></h3>

	       	<p class="center-align"><?php echo $value['tipostatus']; ?></p>

	    	</div>
	    </div>

		 <?php
	}
	
}


 ?>

 </div>

</div>

<br><br><br><br>