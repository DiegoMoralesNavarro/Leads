









<div class="container">

  <div class="row">
    <div class="col s12">
      <h1>Controle de arquivos</h1>
      
       <blockquote>Consultar e deletar arquivos que não são mais necessarios</blockquote>
     </div>
  </div>

</div>




<div class="container">

  <div class="row">
    <div class="col s12 form">

    	<div class="col  s12 l12">
    		<p><strong>Total geral</strong> - Arquivos: <?php echo $totalArquivos[0]['count(arquivo)'] ?> | Consumo: <?php echo $resultado ?></p>
    	</div>

    	<div class="col  s12 l12">

	    	<a href="<?php echo URLestilo ?>/dashboard/configurar" 
	  			class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
	  			<i class="material-icons" >arrow_back</i></a>
  		</div>

  			<br><br>

    	<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/configurar/arquivos" method="post">

    		<div class="input-field col  s5 l2">
    			<?php $datai = $_SESSION['datainicio'] ?>

    			<!-- <input type="text" class="datainicio" name="datainicio" placeholder="De: dd/mm/yyyy" > -->
    			
		      <input type="text" class="datainicio" name="datainicio" placeholder="De: dd/mm/yyyy" value="<?php echo date("d/m/Y", strtotime("$datai"))  ?>">
		    </div>

		    <div class="input-field col  s5 l2">
		    	<?php $dataf = $_SESSION['datafinal'] ?>

		    	<!-- <input type="text" class="datafinal" name="datafinal" placeholder="Até: dd/mm/yyyy" > -->

		      <input type="text" class="datafinal" name="datafinal" placeholder="Até: dd/mm/yyyy" value="<?php echo date("d/m/Y", strtotime("$dataf"))  ?>">
		    </div>

		    <div class="input-field col s12 l3 center-align">
				<button class="btn waves-effect waves-light" name="buscar" type="submit">Pesquisar
					 <i class="material-icons right">search</i>
				</button>
			</div>


    		<?php  
    		$path = "uploads/".$rotaPastas[0]['nome_pasta']."/";
    		?>
    		<table class="striped responsive-table">
				<thead>
					<tr>
						<th> 
							<label>
							        <input type = "checkbox" class="filled-in" name='tudo' onclick='verificaStatus(this)' >
							        <span></span>
							     </label>
						</th>
						<th>Arquivo</th>
						<th>Tamanho</th>
						<th>Data</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>

					  <?php foreach ($arquivos as $value) { 

					

					  	if (!$value == null) {

					  		for ($i=0; $i < count($value); $i++) { 

					  	?>

						<tr>
							<td>
								<input type='checkbox' name='tudo' onclick='verificaStatus(this)' />
								<label>
							        <input type = "checkbox" class="filled-in"  name = "chkl[]"  value = "<?php echo $value[$i]['idtarquivo'] ?>" onclick='verifica(this)'>
							        <span></span>
							     </label>
							 </td>

							<td>
								<a href="<?php echo URLestilo ?>/<?php echo $path . $value[$i]['arquivo'] ?>" target="_blank"><?php echo $value[$i]['arquivo']; ?></a>
							</td>

							<td>
							<?php 

							if ($value[$i]['tamanho'] >= 1000000) { 
							      $resultado = round($value[$i]['tamanho'] /1000000) . " Mb"; 
							      echo $resultado;
							    } else if ($value[$i]['tamanho'] >= 100) {
							       
							       $resultado = round($value[$i]['tamanho'] /1000,1) . " kb"; 
							        echo $resultado;
							    } else { 
							    	$resultado = $value[$i]['tamanho'] . " bytes"; 
							    	 echo $resultado;
							    }

							 ?></td>

							<td><?php echo date('d/m/Y', strtotime($value[$i]['data'])); ?></td>

							<td>
								<a href="<?php echo URLestilo ?>/dashboard/configurar/arquivos/<?php echo $value[$i]['idtarquivo']?>/delete" onclick="return confirm('Deseja realmente excluir este arquivo?')" class="btn-floating btn-small waves-effect red accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >delete_forever</i></a>
							</td>
							
							
						</tr>
						
					<?php } // for?>

						<?php

						
						}else{ $_SESSION['page'] = 1; ?>

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

			<div class="row">
			
				<div id="myDIV" class="input-field col s12 l3">
					<button class="btn waves-effect red darken-1" name="deletar" type="submit">Deletar
						<i class="material-icons left">delete</i>
					</button>
				</div>
			</div>




<br>
<!-- pagina -->
<?php 

if ($_SESSION['page'] == null) {
	$pagina = 1;
}else{
	$pagina = $_SESSION['page'];
}


$voltar = $pagina - 1;
$avancar = $pagina + 1;
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
		if($pagina == 1){
			?>

	<?php }else{ ?>
	<li class="disabled">
		<button name="page" type="submit" value="<?php echo $voltar; ?>"><i class="material-icons">chevron_left</i></button>
	</li>
	<?php } ?>



	<?php for($i = $pagina - $numerosPorPagina; $i <= $pagina; $i++ ){

	if($i >= 1){ ?>
		<li <?php echo selected( $pagina, $i ); ?> > <button <?php echo selected( $pagina, $i ); ?> id="paginar" name="page" type="submit" value="<?php echo $i ?>"><?php echo $i ?></button> </li>
		
	<?php 	}

	}
	?> 


	<?php for($i = $pagina + 1; $i <= $pagina + $numerosPorPagina; $i++ ){
	if($i <= $total_Paginas){ ?>
		<li class="waves-effect">
			<button name="page" type="submit" value="<?php echo $i ?>"><?php echo $i ?></button>
		</li>
		
	<?php 	}
	}
	?> 


	<?php if($pagina == $total_Paginas){ ?>

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


<div class="col s12">
  <div class="row">
    
  </div>
</div>


<style type="text/css">
	.esconde{
		display: none;
	}
</style>



<script type="text/javascript">

$(document).ready(function(){
    
    let v = <?php echo $_SESSION['datainicio']  ?>;

    $('.datainicio').datepicker({
i18n: {
months: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
today: 'Hoje',
clear: 'Limpar',
cancel: 'Sair',
done: 'Confirmar',
labelMonthNext: 'Próximo mês',
labelMonthPrev: 'Mês anterior',
labelMonthSelect: 'Selecione um mês',
labelYearSelect: 'Selecione um ano',
selectMonths: true,
selectYears: 20,
},
format: 'dd/mm/yyyy',
container: 'body',
// minDate: new Date(),
maxDate: new Date(),
defaultDate: new Date(),
});



  });

$(document).ready(function(){

$('.datafinal').datepicker({
i18n: {
months: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
today: 'Hoje',
clear: 'Limpar',
cancel: 'Sair',
done: 'Confirmar',
labelMonthNext: 'Próximo mês',
labelMonthPrev: 'Mês anterior',
labelMonthSelect: 'Selecione um mês',
labelYearSelect: 'Selecione um ano',
selectMonths: true,
selectYears: 15,
},
format: 'dd/mm/yyyy',
container: 'body',
//minDate: new Date(),
maxDate: new Date(),
defaultDate: new Date(),
});



  });




function verificaStatus(nome){
	if(nome.form.tudo.checked == 1)
		{
			nome.form.tudo.checked = 0;
			
			desmarcarTodos(nome);

			
		}
	else
		{
			nome.form.tudo.checked = 1;
			marcarTodos(nome);
			
		}
}




function verifica(nome){


  //  		if(nome.checked == 1)
		// {
		// 	var element = document.getElementById("myDIV");
  //  		element.classList.remove("esconde");
			
		// }else if (nome.form.tudo.checked == 1) {
		// 	var element = document.getElementById("myDIV");
  //  		element.classList.romeve("esconde");
		// }else{
		// 	var element = document.getElementById("myDIV");
  //  		element.classList.add("esconde");
		// }

			
		
}



 
function marcarTodos(nome){
   for (i=0;i<nome.form.elements.length;i++)
	  if(nome.form.elements[i].type == "checkbox")
		 nome.form.elements[i].checked=1
		// var element = document.getElementById("myDIV");
  //  		element.classList.remove("esconde");

		
}
 
function desmarcarTodos(nome){
   for (i=0;i<nome.form.elements.length;i++)
	  if(nome.form.elements[i].type == "checkbox")
		 nome.form.elements[i].checked=0
		// var element = document.getElementById("myDIV");
  //  		element.classList.add("esconde");

		
}
</script>




