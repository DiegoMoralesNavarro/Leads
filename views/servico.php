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
      <h1>Cadastrar Serviços</h1>
      
       <blockquote>Crie ou edite um Serviço.</blockquote>
     </div>
  </div>

</div>



<div class="container">

  <div class="row">
    <div class="col s12 form">

    	

      <form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/servico" method="post" >

	      <div class="input-field col s12 l4">

	      	<h3>Criar um Serviço</h3>

	      	<div class="input-field col s11">
		        <i class="material-icons prefix">business_center</i>
	          	<input id="icon_prefix" type="text" class="validate" name="tiposervico">
	          	<label for="icon_prefix">Serviço</label>
			</div>

			<div class="input-field col s11 right-align">

	          	<button class="btn waves-effect waves-light" type="submit" name="action">Cadastrar
				    <i class="material-icons right">send</i>
				</button>
			</div>

	      </div> <!-- coluna 1 -->
	    </form>
	      <div class="input-field col s12 l8">
	      	<h3>Editar um Serviço</h3>

	      	<?php 

			if (isset($_GET['delete'])) {
				?> <p> <?php echo "Não pode deletar quem já esta associado a um Lead"; ?> </p><?php
			}else{
				echo "";
			}

			?>

			<div class="input-field col s12">

				<table class="highlight">
			        <thead>
			          <tr>
			              <th>Serviços</th>
			              <th>Editar</th>
			          </tr>
			        </thead>

			        <tbody>

			        	<?php foreach ($servico as $value) { ?>
						<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/servico" method="post">
							<tr>

								<input type="hidden" id="idservicoEditar" name="idservicoEditar" value="<?php echo $value['idservico'] ?>">

								<td><input type="text" id="tiposervicoEditar" name="tiposervicoEditar" value="<?php echo $value['tiposervico'] ?>"></td>
								<td>

								<button class="waves-effect waves-light btn-small" type="submit" name="action">Salvar
								</button>

								<a class=" red accent-4 btn-small"
								 href="servico/<?php echo $value['idservico'] ?>/delete" 
								 onclick="return confirm('Deseja realmente excluir o Serviço')" >Excluir</a>

								</td>

							</tr>
						</form>
						<?php } ?>



			        </tbody>
			      </table>

			</div>
	        
	      </div>

      
    </div>
  </div> <!-- row -->

</div>

<br><br>






