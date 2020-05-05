

<div class="container">

  <div class="row">
    <div class="col s12">
      <h1>Follow up</h1>
      
       <blockquote>Crie atualizações sobre o acompanhamento.</blockquote>
     </div>
  </div>

</div>


<div class="container">

  <div class="row">
    <div class="col s12 form">

    	<form role="form" action="/meuteste/leads/follow-up/<?php echo $idlead; ?>/" method="post" >

    	<div class="input-field col s12 l12">

	      	<h4>Criar um acompanhamento do lead: <strong><?php echo $lead[0]['nome']; ?> </strong></h4>

	      	<div class="input-field col s11">
		        <i class="material-icons prefix">people</i>
	          	<input id="textofollow" type="text" class="validate" name="textofollow">
	          	<label for="textofollow">Follow Up</label>
			</div>

			<div class="input-field col s12 ">

	          	<button class="btn waves-effect waves-light" type="submit" name="action">Cadastrar
				    <i class="material-icons right">send</i>
				</button>
			</div>

	      </div> <!-- coluna 1 -->


		</form>

		<div class="col s12  ">
		<br><br><br>
		</div>
    	


    	<?php foreach ($followUp as $value) { ?>

    	<form role="form" action="/meuteste/leads/follow-up/<?php echo $idlead; ?>" method="post" enctype="multipart/form-data">

    		<div class="col s12 linha">
    			<div class="col s5 l3">
    				<p>Criado em: <?php echo date('d/m/Y', strtotime($value['data'])); ?></p>
				</div>
				<div class="col s5 l6">
					 <p>Ultima atualização: <?php echo date('d/m/Y', strtotime($value['dataAtualizada']));  ?></p>
				</div>

    			<div class="col s9">
    				<input type="hidden" id="idfollowup" name="idfollowup" value="<?php echo $value['idfollowup'] ?>">
    				<div class="input-field col s12">
			          <i class="material-icons prefix">mode_edit</i>
			          <label for="obs">Follow Up</label>
			          <textarea id="obs" name="texto" required="" class="materialize-textarea" maxlength="100"><?php echo $value['texto'] ?></textarea>
			        </div>
				</div>

				<div class="col s3">

					<button class="waves-effect waves-light btn-small" type="submit" name="action">Salvar
					</button>

					<a class=" red accent-4 btn-small"
					 href="follow-up/<?php echo $value['idfollowup'] ?>/delete" 
					 onclick="return confirm('Deseja realmente excluir o Serviço')" >Excluir</a>

				</div>

			</div>

    	</form>


    	<?php } ?>
      
     </div>
  </div>

</div>