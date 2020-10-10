



<div class="container">

  <div class="row">
    <div class="col s12">
      <h1>Todos os meus lembretes</h1>
      
       <blockquote>Não serão exibidos lembretes de outros usuários</blockquote>
     </div>
  </div>

</div>




<div class="container">

  <div class="row">
    <div class="col s12 form">

    	<a href="<?php echo URLestilo ?>/dashboard/" 
  			class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >arrow_back</i></a>

  			<br><br>

    	<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/meus-lembretes?page=$numero" method="get">

    		


    		<table class="striped responsive-table">
				<thead>
					<tr>
						<th>Data do lembrete </th>
                        <th>Descrição</th>
                        <th>Nome do lead</th>
                        <th>Ver Follow Up</th>
					</tr>
				</thead>
				<tbody>

					  <?php foreach ($lembrete as $value) { 

					

					  	if (!$value == null) {

					  		for ($i=0; $i < count($value); $i++) { 

					  	?>

						<tr>

							 <td><?php echo date('d/m/Y', strtotime($value[$i]['data_lembrete']));?></td>

	                          <td>
	                            <?php echo $value[$i]['texto_lembrete'] ?>
	                          </td>

	                          <td>
	                            <?php echo $value[$i]['nome'] ?>
	                          </td>

	                          <td>

	                            
	                          	<a href="follow-up/<?php echo $value[$i]['fk_idlead']?>#follow<?php echo $value[$i]['fk_idfollowup']?>" class="btn-floating btn-small waves-effect light-green " style="padding: 0 0px!important;"><i class="material-icons" >done_all</i></a>

	                          	<a href="meus-lembretes/<?php echo $value[$i]['id_lembrete']?>/delete/<?php echo $value[$i]['fk_idfollowup']?>" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn-floating btn-small waves-effect red accent-4 " style="padding: 0 0px!important;">
  								<i class="material-icons" >delete_forever</i></a>

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
$numerosPorPagina = 6;

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
