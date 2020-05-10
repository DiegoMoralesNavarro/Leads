

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
      <h1>Lead</h1>
      
       <blockquote>Atualize os dados do Lead e o serviço desejado.</blockquote>
     </div>
  </div>

</div>




<div class="container">

  <div class="row">
  	<div class="col s12 form">
  		<div class="col s12 l5 "></div>
      	<div class="col s5 l3"><p>Cadastrado em: <?php echo date('d/m/Y', strtotime($userId[0]['data'])); ?> </p></div>
      	<div class="col s5 l4"><p>Ultima atualização: <?php if ($userId[0]['dataAtualizada'] == null) {
      		echo date('d/m/Y', strtotime($userId[0]['data']));
      	}else{
      		echo date('d/m/Y  H:i', strtotime($userId[0]['dataAtualizada']));
      	} ?> </p></div>


		 <form role="form1" action="/<?php echo pastaPrincipal ?>/dashboard/editar/<?php echo $userId[0]['idlead'] ?>" method="post" enctype="multipart/form-data">

		 <br>
	  	<h3 class="left-align">Atualizar os dados</h3>

	  	<?php foreach ($userId as $value) { ?>



	  	<div class="col s12 l6"> 
	      	<div class="input-field col s12">
		        <input id="icon_prefix" type="text" class="validate" name="nome" value="<?php echo $value['nome'] ?>">
          		<label for="icon_prefix">Nome</label>
			</div>

			<div class="input-field col s12">
		        <input id="icon_prefix2" type="text" class="validate" name="email" value="<?php if ($value['email'] == null){echo "";} else{echo $value['email']; }?>" >
          		<label for="icon_prefix2">E-mail</label>
			</div>
		</div>


			
		<div class="col s12 l6">
			<div class="input-field col s12">
		        <input id="icon_prefix3" type="tel" class="validate" name="telefone" value="<?php echo $value['telefone'] ?>">
          		<label for="icon_prefix3">Telefone</label>
			</div>

			<div class="input-field col s12">
		        <input id="icon_prefix4" type="text" class="validate" name="site" value="<?php if ($value['site'] == null){echo "";} else{echo $value['site'];}?>" >
          		<label for="icon_prefix4">Site</label>
			</div>
		</div>
	   
	      	


	    
		<div class="col s12 l6">
			<div class="input-field col s12">
				
			    <select name="statusLead" >
			    	<?php
						function selected( $value, $selected ){
						    return $value==$selected ? ' selected="selected"' : '';
						}
					?>
			      <?php foreach ($userStatus as $value){ ?>

				    	<option <?php echo selected( $value['tipostatus'], $userlistId[0]['tipostatus'] ); ?> value="<?php echo $value['idstatus'] ?>" >  <?php echo $value['tipostatus'] ?> </option>

				    <?php } ?>
			    </select>
			    <label>Status atual: <?php echo $userlistId[0]['tipostatus'] ?></label>
			</div>
		</div>


		

		<div class="col s12 l6">
			<div class="input-field col s12">
			    <select name="origemLead" >
			    	<?php
						function selectedOrigem( $value, $selected ){
						    return $value==$selected ? ' selected="selected"' : '';
						}
					?>
			
			      <?php foreach ($origem as $value){ ?>

				    	<option <?php echo selectedOrigem( $value['tipo_origem'], $userlistIdOrigem[0]['tipo_origem'] ); ?> value="<?php echo $value['id_origem_lead'] ?>" >  <?php echo $value['tipo_origem'] ?> </option>

				    <?php } ?> 
			    </select>
			    <label>Origem do Lead: <?php echo $userlistIdOrigem[0]['tipo_origem']; ?></label>
			</div>
		</div>







		<div class="col s12 l12">
			<div class="input-field col s12">

				<?php if ($nomeArquivo == null) { ?>

					<div class="file-field">
						<div class="btn">
				            <span>File</span>
				            <input type="file" name="fileUpload">
				        </div>
				        <div class="file-path-wrapper">
				            <input class="file-path validate" type="text" accept=".fdf" placeholder="Carregue seu PDF">
		            	</div>
	            	</div>

					<?php }else{ ?>	

					<?php foreach ($nomeArquivo as $value) { 
						$path = "uploads/";
					?>

					<table class="highlight">
			        <thead>
			          <tr>
			              <th>Arquivo PDF</th>
			              <th>Editar</th>
			          </tr>
			        </thead>

			        <tbody>

			          
							<tr>

								<td>
									<?php echo $value['arquivo']; ?>
								</td>

								<td>

									<a class="waves-effect waves-light btn-small" 
								 href="http://localhost/<?php echo pastaPrincipal ?>/<?php echo $path . $value['arquivo'] ?>" target="_blank">Ler</a>

								 <a class=" red accent-4 btn-small" 
								 href="<?php echo $value['fk_idlead'] ?>/delete" onclick="return confirm('Deseja realmente excluir este Arquivo?')" >Excluir</a>

								</td>

							</tr>

			        </tbody>

					</table>
					<?php } ?>

				<?php } ?>
	          
	        </div>
		</div>
	      
			
		<div class="col s12 l12">
			<div class="input-field col s12">
		         <label for="obs">OBS</label>
      			<textarea id="obs" name="obs" required="" class="materialize-textarea" maxlength="100"><?php if ($userObs == null) {echo "";} else{echo $userObs[0]['obs'];}?></textarea>
			</div>
		</div>
	        

	    
	       <!--  -->

	    <?php } ?>

	    <div class="input-field col s12">

	        <button class="btn waves-effect waves-light" type="submit" name="action">Atualizar
	          <i class="material-icons right">send</i>
	        </button>

	     </div>

		</form>

		<div class="input-field col s12 linha">
			<br>
		</div>

		<div class="col s12">

			<h3>Atualizar os serviços</h3>

		      <div id="servico" class="input-field col s12 l6">

		      	 <table class="highlight">
			        <thead>
			          <tr>
			              <th>Serviço não Desejado</th>
			              <th>Editar</th>
			          </tr>
			        </thead>

			        <tbody>
			          <?php 
						if ($servicoNao == null) { ?>
							<tr>
								<td>O Lead desejou todos os Serviços</td>
								<td></td>
							</tr>
						<?php }else{  ?>
							
							<?php foreach ($servicoNao as $value) { ?>
							<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/editar/<?php echo $userId[0]['idlead'] ?>#servico" method="post" enctype="multipart/form-data" >
								<input style="display: none;" type="file" name="fileUpload">
								<tr>
									<input type="hidden" id="idservicoadd" name="idservicoadd" value="<?php echo $value['idservico'] ?>"> 

									<td> <?php echo $value['tiposervico']; ?> </td>

									<td><button class="waves-effect waves-light btn-small" >Adicionar</button> </td>
								</tr>
							</form>
							<?php
							 } //for
						} //if
						?>
			        </tbody>
			      </table>


		      </div> <!-- coluna 1 -->

		      <div class="input-field col s12 l6">

		      	<table class="highlight">
			        <thead>
			          <tr>
			              <th>Serviço Desejado</th>
			              <th>Editar</th>
			          </tr>
			        </thead>

			        <tbody>
			          <?php 
						if ($servicoDesejado == null) { ?>
							<tr>
								<td>Não foi escolhido um Serviço da lista.</td>
								<td></td>
							</tr>
						<?php }else{  ?>
							
							<?php foreach ($servicoDesejado as $value) { ?>
							<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/editar/<?php echo $userId[0]['idlead'] ?>#servico" method="post" enctype="multipart/form-data">
								<input style="display: none;" type="file" name="fileUpload">
								<tr> 
									<input type="hidden" id="idserviconao" name="idserviconao" value="<?php echo $value['idservico'] ?>"> 

									<td> <?php echo $value['tiposervico']; ?> </td>
									<td><button class=" red accent-4 btn-small" type="submit" type="submit" >Remover</button> </td>
								</tr>
							</form>
							<?php
							 } //for
						} //if
						?>
			        </tbody>
			      </table>

		      </div> <!-- coluna 2 -->
		
	    </div>

	    <div class="col s12 linha">
			<br>
		</div>

		 <div class="col s12 center-align">
			<a class="waves-effect light-green btn-small" href="http://localhost/<?php echo pastaPrincipal ?>/dashboard/follow-up/<?php echo $userId[0]['idlead']?>">Follow up</a>

			<br><br>
		</div>



	</div>

  </div> <!-- row -->

</div><!-- container -->

<br><br>






