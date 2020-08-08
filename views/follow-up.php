




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
    <div class="col s12">
      <h1>Follow up</h1>
      
       <blockquote>Crie atualizações sobre o acompanhamento.</blockquote>
     </div>
  </div>

</div>


<div class="container">

  <div class="row">
    <div class="col s12 form">
    	<a href="<?php echo URLestilo ?>/dashboard/editar/<?php echo $idlead; ?>" 
  			class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >arrow_back</i></a>

    	

    	<h4>Lead: <strong><?php echo $lead[0]['nome']; ?> </strong></h4>

    	<div class="col s12 l6">

	    	<form role="form1" action="/<?php echo pastaPrincipal ?>/dashboard/follow-up/<?php echo $idlead; ?>" method="post" enctype="multipart/form-data">

	    	<div class="input-field col s12 l12">

		      	<div class="input-field col s11">
			        <i class="material-icons prefix">people</i>
		          	<label for="textofollow">Follow Up</label>
		          	<textarea id="textofollow" name="textofollow" required="" class="materialize-textarea" maxlength="200"></textarea>
				</div>

				<div class="input-field col s12 ">

		          	<button class="btn waves-effect light-green" type="submit">Cadastrar
					    <i class="material-icons right">send</i>
					</button>
				</div>

		      </div> <!-- coluna 1 -->


			</form>

		</div>

		



		<div class="input-field col s12 l6">
			<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/follow-up/<?php echo $idlead; ?>" method="post" enctype="multipart/form-data">
				<div class="input-field col s7">
					
				    <select name="statusLead" >
				    	<?php
							function selected( $value, $selected ){
							    return $value==$selected ? ' selected="selected"' : '';
							}
						?>
				      <?php foreach ($userStatus as $value){ ?>

					    	<option <?php echo selected( $value['tipostatus'], $listStatus[0]['tipostatus'] ); ?> value="<?php echo $value['idstatus'] ?>" >  <?php echo $value['tipostatus'] ?> </option>

					    <?php } ?>
				    </select>
				    <label>Status atual: <?php echo $listStatus[0]['tipostatus'] ?></label>
				    
				</div>

				<div class="input-field col s5 ">
					<button class="btn waves-effect waves-light" style="font-size: 10px!important;" type="submit">Atualizar Status
					    <i class="material-icons right">send</i>
					</button>
				</div>

			</form>
		</div>


		<div class="col s12 linha ">
		<br><br>
		</div>
    	





    	<?php foreach ($followUp as $value) { ?>

    	<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/follow-up/<?php echo $idlead; ?>" method="post" enctype="multipart/form-data">

    		<div class="col s12 linha">
    			<div class="col s12 l3">
    				<p>Criado em: <?php echo date('d/m/Y', strtotime($value['data'])); ?></p>
				</div>
				<div class="col s12 l9">
				<p>Ultima atualização: <?php echo date('d/m/Y H:i', strtotime($value['dataAtualizada']));?>
				 - <?php if (isset($value['user'])) {
				 	echo $value['user'];
				 }else{
				 	 echo "vazio";
				 } ?> 
				</p>
				</div>

    			<div class="col s12 l9">

    				
    				<input type="hidden" id="idfollowup" name="idfollowup" value="<?php echo $value['idfollowup'] ?>">
    				<div class="input-field col s12">
			          <i class="material-icons prefix">mode_edit</i>
			          <label for="obs">Follow Up</label>
			          <textarea id="obs" name="texto" required="" class="materialize-textarea" maxlength="299"><?php echo $value['texto'] ?></textarea>
			        </div>

				</div>

				<div class="col s12 l3">

					<button class="waves-effect waves-light btn-small" type="submit" >Salvar
					</button>

					<a class=" red accent-4 btn-small"
					 href="<?php echo $value['idfollowup'] ?>/delete/?id=<?php echo $lead[0]['idlead']; ?>" 
					 onclick="return confirm('Deseja realmente excluir o Serviço')" >Excluir</a>

				</div>

				<div class=" input-field col s12 l9" style="margin-top: -1rem;">
			        	<?php if ($value['imagem'] == null || $value['imagem'] == '') {
			        		?>
			        		<div class="file-field input-field ">
					            <div class="btn">
					              <span>File</span>
					              <input type="file" name="fileUpload" accept=".png, .jpg, .jpeg">
					            </div>
					            <div class="file-path-wrapper">
					              <input class="file-path validate" type="text" accept=".png, .jpg, .jpeg" placeholder="Carregue sua imagem">
					            </div>
				            </div>


			        		<?php
			        	}else{

			        		$path = "uploads/".$rotaPastas[0]['nome_pasta']."/";

			        		?>

			        		<table class="highlight ">

			        		<tbody>
									<tr>
										<td>
											<?php echo $value['imagem']; ?>
										</td>

										<td>

											<a class="waves-effect waves-light btn-small" 
								 href="<?php echo URLestilo ?>/<?php echo $path . $value['imagem'] ?>" target="_blank">Ver</a>

								 			<a class=" red accent-4 btn-small" 
								 href="<?php echo $value['idfollowup'] ?>/delete-img/?id=<?php echo $lead[0]['idlead']; ?>" onclick="return confirm('Deseja realmente excluir este Arquivo?')" >Excluir</a>

										</td>
									</tr>
					        </tbody>
					        </table>
			        		<?php
			        	} ?>
			    </div>

			</div>

    	</form>


    	<?php } ?>




<!-- <div class="row">
    <div class="col s12">
      <blockquote>Quando estiver escrito <strong>VAZIO</strong> significa que o usuário que fez a última atualização foi DELETADO </blockquote>
     </div>
  </div> -->

<!-- CRIAR UMA REGRA PARA ESCONDER O STATUS NOVO -->



    	<?php foreach ($followUpVazio as $value) { ?>



		    	<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/follow-up/<?php echo $idlead; ?>" method="post" enctype="multipart/form-data">

		    		<div class="col s12 linha">
		    			<div class="col s12 l3">
		    				<p>Criado em: <?php echo date('d/m/Y', strtotime($value['data'])); ?></p>
						</div>
						<div class="col s12 l9">
						<p>Ultima atualização: <?php echo date('d/m/Y H:i', strtotime($value['dataAtualizada']));?> - <strong><?php echo "vazio";?> </strong>
						</p>
						</div>

		    			<div class="col s12 l9">

		    				
		    				<input type="hidden" id="idfollowup" name="idfollowup" value="<?php echo $value['idfollowup'] ?>">
		    				<div class="input-field col s12">
					          <i class="material-icons prefix">mode_edit</i>
					          <label for="obs">Follow Up</label>
					          <textarea id="obs" name="texto" required="" class="materialize-textarea" maxlength="200"><?php echo $value['texto'] ?></textarea>
					        </div>

						</div>

						<div class="col s12 l3">

							<button class="waves-effect waves-light btn-small" type="submit" >Salvar
							</button>

							<a class=" red accent-4 btn-small"
							 href="<?php echo $value['idfollowup'] ?>/delete/?id=<?php echo $lead[0]['idlead']; ?>" 
							 onclick="return confirm('Deseja realmente excluir o Serviço')" >Excluir</a>

						</div>

						<div class=" input-field col s12 l9" style="margin-top: -1rem;">
					        	<?php if ($value['imagem'] == null || $value['imagem'] == '') {
					        		?>
					        		<div class="file-field input-field ">
							            <div class="btn">
							              <span>File</span>
							              <input type="file" name="fileUpload" accept=".png, .jpg, .jpeg">
							            </div>
							            <div class="file-path-wrapper">
							              <input class="file-path validate" type="text" accept=".png, .jpg, .jpeg" placeholder="Carregue sua imagem">
							            </div>
						            </div>


					        		<?php
					        	}else{
					        		?>

					        		<table class="highlight ">

					        		<tbody>
											<tr>
												<td>
													<?php echo $value['imagem']; ?>
												</td>

												<td>

													<a class="waves-effect waves-light btn-small" 
										 href="<?php echo URLestilo ?>/uploads/<?php echo $value['imagem'] ?>" target="_blank">Ver</a>

										 			<a class=" red accent-4 btn-small" 
										 href="<?php echo $value['idfollowup'] ?>/delete-img/?id=<?php echo $lead[0]['idlead']; ?>" onclick="return confirm('Deseja realmente excluir este Arquivo?')" >Excluir</a>

												</td>
											</tr>
							        </tbody>
							        </table>
					        		<?php
					        	} ?>
					    </div>

					</div>

		    	</form>


		    	<?php } ?>












    	<div class="input-field col s12 center-align">
    		<a class="waves-effect waves-light btn-small" 
				href="<?php echo URLestilo ?>/dashboard/editar/<?php echo $lead[0]['idlead']?>">Atualizar os dados</a>
			
		</div>
      
     </div>
  </div>

</div>