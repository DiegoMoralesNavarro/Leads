



<?php 





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
      <h1>Log básico do cliente: <?php echo $nomecliente[0]['nome_cliente'] ?></h1>
      
       <blockquote>Consulta básica sobre ação executada pelo usuário</blockquote>
     </div>
  </div>

</div>




<div class="container">

  <div class="row">
    <div class="col s12 form">

    	<a href="<?php echo URLestilo ?>/dashboard/configurar/cliente/<?php echo $id; ?>" 
  			class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >arrow_back</i></a>

  			<br><br>

    	<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/configurar/cliente/log/<?php echo $id; ?>?page=$numero&responsavel=$numero" method="get">

    		<div class="row">
			

				<div class="col s12 l4">
					<div class="input-field col s12">
						
					    <select name="responsavel" >

					    	<option  value="0" > Todos </option>
					    	
					      <?php foreach ($user as $value){ ?>

					      		<option  value="<?php echo $value['id_user'] ?>" >  <?php echo $value['user'] ?> </option>

						    	

						    <?php } ?>
					    </select>
					    <label>Usuário da ação</label>
					</div>
				</div>


				<div class="input-field col s12 l3 center-align">
					<button class="btn waves-effect waves-light" type="submit">Pesquisar
						<i class="material-icons right">search</i>
					</button>
				</div>
			</div>



			


	


    		<table class="striped responsive-table">
				<thead>
					<tr>
						<th>Usuário</th>
						<th>Data</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody>

					  <?php foreach ($users as $value) { 

					

					  	if (!$value == null) {

					  		for ($i=0; $i < count($value); $i++) { 

					  	?>

						<tr>

							<td><?php echo $value[$i]['user']; ?></td>

							<td><?php echo date('d/m/Y H:i', strtotime($value[$i]['datalog'])); ?></td>

							<td><?php echo $value[$i]['acao']; ?></td>
							
							
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
