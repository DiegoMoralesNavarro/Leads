<?php 

if (isset($_COOKIE['Atualizado'])) {
	?> 
	<script>
		window.addEventListener("load", function() {
	    M.toast({html: 'Atualizado'})
	  });
	</script>
	<?php
	setcookie("Atualizado", '', time() - 2000);
}else{

}


 ?> 

<div class="container">

  <div class="row">
    <div col s12>
      <h1>Cadastar Status</h1>
      
       <blockquote>Crie ou edite um Statu.</blockquote>
     </div>
  </div>

</div>



<div class="container">

  <div class="row">
    <div class="col s12 form">

    	<a href="<?php echo URLestilo ?>/dashboard" 
  			class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >arrow_back</i></a>
  			
      <form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/status" method="post" enctype="multipart/form-data">

      	
      	<div class="input-field col s12 l9">
      		<h3>Criar um Status</h3>
      	</div> 

	      	<div class="input-field col s12 l7">

		      	<div class="input-field col s11">
			        <i class="material-icons prefix">assignment_turned_in</i>
		          	<input id="icon_prefix" type="text" class="validate" name="tipostatus">
		          	<label for="icon_prefix">Status</label>
				</div>

			</div> <!-- coluna 1 -->

			

			<div class="input-field col s12 l4">

				<div class="input-field col s12 left-align">

		          	<button class="btn waves-effect waves-light" type="submit" name="action">Cadastrar
					    <i class="material-icons right">send</i>
					</button>
				</div>

	      	</div> <!-- coluna 1 -->
	    </form>
	    
	      <div class="input-field col s12 l12">
	      	<h3>Editar um Status</h3>
	      	 <blockquote>A visibilidade muda o que será exibido na tabela do Dashboard.</blockquote>

	      	<?php 

			if (isset($_GET['delete'])) {
				?> <p> <?php echo "Não pode deletar quem já esta associado a um Lead"; ?> </p><?php
			}else{
				echo "";
			}

			?>

			<div class="input-field col s12">


				<?php
					function selectedVisivel( $value, $selected ){
					    return $value==$selected ? ' selected="selected"' : '';
					}
				?>

				
				    
				    <div class="col s12 l12">	
				      
			      		<div class="col s12 l4">
			      			<h4><strong >Status</strong></h4>
			      		</div>
			      		<div class="col s12 l4">
			      			<h4><strong >Visibilidade</strong></h4>
			      		</div>
			      		<div class="col s12 l4">
			      			<h4><strong >Editar</strong></h4>
			      		</div>
				          
				      
				    </div>


					<?php foreach ($status as $value) { ?>
					<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/status" method="post" enctype="multipart/form-data">
					<div class="col s12 linha ">

					</div>
					<div class="col s12 l12">
						
						

						<div class="col s12 l4">			

							<input type="hidden" id="idstatusEditar" name="idstatusEditar" value="<?php echo $value['idstatus'] ?>">

							
							<input type="text" id="tipostatusEditar" name="tipostatusEditar" value="<?php echo $value['tipostatus'] ?>">
							
						</div>

							
						<div class="col s12 l4">
							
							<select name="visibilidade" >
							    <option <?php echo selectedVisivel( $value['visivel'], '1' ); ?> value="1" > visível </option>
							    <option <?php echo selectedVisivel( $value['visivel'], '0' ); ?>  value="0" > invisível </option>
						    </select>
							
						</div>

						<div class="col s12 l4">
							
							<button class="waves-effect waves-light btn-small" type="submit" name="action<?php echo $value['idstatus'] ?>">Salvar
							</button>

							 <a class=" red accent-4 btn-small" 
							 href="status/<?php echo $value['idstatus'] ?>/delete" 
							 onclick="return confirm('Deseja realmente excluir o Status')" >Excluir</a>

							
						</div>

						
						</div>
									

					</form>

					<?php } ?>

					 
				<!-- </table>  -->

				

			</div>
	        
	      </div>

      
    </div>
  </div> <!-- row -->

</div>

<br><br>


