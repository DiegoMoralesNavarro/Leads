




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


<div class="container" id="sua_div">

  <div class="row">
    <div class="col s12 form">
    	<a href="<?php echo URLestilo ?>/dashboard/editar/<?php echo $idlead; ?>" 
  			class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >arrow_back</i></a>


  		<form role="form1" action="/<?php echo pastaPrincipal ?>/dashboard/follow-up/<?php echo $idlead; ?>" method="post" enctype="multipart/form-data">	


  		<div class="col s12 l12">
  			<br>
  			<p> Responsável pelo lead: 
	  		<?php 
	      	if (isset($responsavel[0]['user'])) {
			 	echo "<strong>".$responsavel[0]['user']."</strong>";
			 }else{
			 	?> 
			 	 <strong> Ninguém como responsável </strong>
			 	 <button class="waves-effect light-green btn-small" style="height: 20.4px; line-height: 20.4px;" type="submit" name="posse">Tomar posse</button>
			 	<?php
			 } ?> 

			 </p>
			 <br>
		 </div>		

		</form>

  		<form role="form1" action="/<?php echo pastaPrincipal ?>/dashboard/follow-up/<?php echo $idlead; ?>" method="post" enctype="multipart/form-data">	



    	

    	<h3>Lead: <strong><?php echo $lead[0]['nome']; ?> </strong></h3>

    	<div class="col s12 l6">

	    	

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

    		<div id="follow<?php echo $value['idfollowup'] ?>" class="col s12 linha">
    			<div class="col s12 l3">
    				<p>Criado em: <?php echo date('d/m/Y', strtotime($value['dataf'])); ?></p>
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

				<div class=" input-field col s12 l9" style="margin-top: -1rem; margin-bottom: 0px;">
			        	<?php if ($value['arquivo'] == null || $value['arquivo'] == '') {
			        		?>


			        		<?php if ($listArquivoTotal[0]['sum(tamanho)'] > $listCliente[0]['consumo']) { ?>

			        			<p><strong>Atenção:</strong> O limite de memória foi atingido, para adicionar mais arquivos apague o arquivo mais antigo <br> ou solicite mais espaço em disco. </p>

			        		<?php }else{ ?>
			        		<div class="file-field input-field ">
					            <div class="btn">
					              <span>File</span>
					              <input type="file" name="fileUpload" accept=".png, .jpg, .jpeg">
					            </div>
					            <div class="file-path-wrapper">
					              <input class="file-path validate" type="text" accept=".png, .jpg, .jpeg" placeholder="Carregue sua imagem">
					            </div>
				            </div>

				        <?php }?>




			        		<?php
			        	}else{

			        		$path = "uploads/".$rotaPastas[0]['nome_pasta']."/";

			        		?>

			        		<table class="highlight ">

			        		<tbody>
									<tr>
										<td>
											<?php echo $value['arquivo']; ?>
										</td>

										<td>

											<a class="waves-effect waves-light btn-small" 
								 href="<?php echo URLestilo ?>/<?php echo $path . $value['arquivo'] ?>" target="_blank">Ver</a>

								 			<a class=" red accent-4 btn-small" 
								 href="<?php echo $value['idfollowup'] ?>/delete-img/?id=<?php echo $lead[0]['idlead']; ?>" onclick="return confirm('Deseja realmente excluir este Arquivo?')" >Excluir</a>

										</td>
									</tr>
					        </tbody>
					        </table>
			        		<?php
			        	} ?>
			    </div>

			    <div class="col s12 l12">
  			
  		<?php if (isset(array_count_values(array_column($totalLembrete, 'fk_idfollowup'))[$value['idfollowup']]) ) {  ?>

  			<p><a href="<?php echo URLestilo ?>/dashboard/lembrete/<?php echo $value['idfollowup'] ?>" 
  			class="btn-floating btn-small waves-effect yellow accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >notifications_active</i></a>Total de lembrete: <?php echo array_count_values(array_column($totalLembrete, 'fk_idfollowup'))[$value['idfollowup']]; ?></p>

  			
  		<?php }else{?>

  			<p><a href="<?php echo URLestilo ?>/dashboard/lembrete/<?php echo $value['idfollowup'] ?>" 
  			class="btn-floating btn-small waves-effect yellow accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >notifications_off</i></a>Total de lembrete: 0</p>

  		<?php } ?>
			    </div>



			</div>

    	</form>


    	<?php } ?>









<?php if($_SESSION["nivel"] <= 1) { ?>

		<form role="form2" action="/<?php echo pastaPrincipal ?>/dashboard/follow-up/<?php echo $idlead; ?>" method="post" enctype="multipart/form-data">	
		


		<div class="row">

			<div class="col s12 l12">
	      	<h4>Baixar para excel os dados follow up</h4>
	      </div>

	      <div class="col s12 l2">
	      	<p><button class="btn-floating btn-small waves-effect orange darken-1 " type="submit" name="imprimirsimples" style="padding: 0 0px!important;"><i class="material-icons ">description</i></button>
	      	Baixar</p>

	      	<p><button class="btn-floating btn-small waves-effect  red darken-3 " style="padding: 0 0px!important;" onclick="window.print()"><i class="material-icons ">picture_as_pdf</i></button>
	      	Print dessa página</p>
	      	
	      </div>



	      

	    </div>


	    </form>	
<?php }else{ } ?>
	     


    	<div class="input-field col s12 center-align">
    		<a class="waves-effect waves-light btn-small" 
				href="<?php echo URLestilo ?>/dashboard/editar/<?php echo $lead[0]['idlead']?>">Atualizar os dados</a>
			
		</div>
      
     </div>
  </div>

</div>



