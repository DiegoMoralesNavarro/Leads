

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
      <form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/status" method="post" enctype="multipart/form-data">

	      <div class="input-field col s12 l6">

	      	<h3>Criar um Status</h3>

	      	<div class="input-field col s11">
		        <i class="material-icons prefix">assignment_turned_in</i>
	          	<input id="icon_prefix" type="text" class="validate" name="tipostatus">
	          	<label for="icon_prefix">Status</label>
			</div>

			<div class="input-field col s11 right-align">

	          	<button class="btn waves-effect waves-light" type="submit" name="action">Cadastrar
				    <i class="material-icons right">send</i>
				</button>
			</div>

	      </div> <!-- coluna 1 -->

	      <div class="input-field col s12 l6">
	      	<h3>Editar um Status</h3>

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
			              <th>Status</th>
			              <th>Editar</th>
			          </tr>
			        </thead>

			        <tbody>

			          <?php foreach ($status as $value) { ?>
						<form id="form" role="form" action="/<?php echo pastaPrincipal ?>/dashboard/status" method="post">
							<tr>

								<input type="hidden" id="idstatusEditar" name="idstatusEditar" value="<?php echo $value['idstatus'] ?>">

								<td><input type="text" id="tipostatusEditar" name="tipostatusEditar" value="<?php echo $value['tipostatus'] ?>"></td>
								<td>

								
								<button class="waves-effect waves-light btn-small" type="submit" name="action">Salvar
								</button>

								 <a class=" red accent-4 btn-small" 
								 href="status/<?php echo $value['idstatus'] ?>/delete" 
								 onclick="return confirm('Deseja realmente excluir o Status')" >Excluir</a>

								</td>

							</tr>
						</form>
						<?php } ?>

			        </tbody>
			      </table>

			</div>
	        
	      </div>

      </form>
    </div>
  </div> <!-- row -->

</div>

<br><br>

