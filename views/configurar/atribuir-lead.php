

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
      <h1>Atribuir o lead</h1>
      
       <blockquote>Escolha o responsável para o atendimento do lead</blockquote>
     </div>
  </div>

</div>





<div class="container">

  <div class="row">
	<div class="col s12 form">

		<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/configurar/atribuir-lead/novo/<?php echo $id ?>" method="post">

			
			<div class="col s12">
		        <h4>Lead</h4>
				<blockquote>Confira os dados do lead antes de atribuir um responsável</blockquote>
			</div>

			<div class="input-field col s12">

				<table class="striped centered responsive-table">
			        <thead>
			          <tr>
			              <th>Nome</th>
			              <th>Telefone</th>
			              <th>Email</th>
			          </tr>
			        </thead>

			        <tbody>
			          <tr>
			            <td><?php echo $lead[0]['nome'] ?></td>
			            <td><?php echo $lead[0]['telefone'] ?></td>
			            <td><?php echo $lead[0]['email'] ?></td>
			          </tr>
			        </tbody>
			      </table>

			</div>



			
			<div class="col s12">
		        <h4>Escolha um responsável</h4>
			</div>

			<div class="col s12 l4">
				<div class="input-field col s12">
					
				    <select name="responsavel" >
				    	<?php
							function selected( $value, $selected ){
							    return $value==$selected ? ' selected="selected"' : '';
							}
						?>
				      <?php foreach ($user as $value){ ?>

				      	<?php if (count($responsavel) >= 1 ){ ?>

				      		<option <?php echo selected( $value['id_user'], $responsavel[0]['fk_id_user'] ); ?>  value="<?php echo $value['id_user'] ?>" >  <?php echo $value['user'] ?> </option>

				      	<?php }else{ ?>

				      		<option  value="<?php echo $value['id_user'] ?>" >  <?php echo $value['user'] ?> </option>

				      	<?php } ?>

					    	

					    <?php } ?>
				    </select>
				</div>
			</div>

			<div class="input-field col s12 l6">

	          	<?php if (count($responsavel) >= 1) {
	          		?>
	          			<p>Reponsável: <strong><?php echo $responsavel[0]['user']; ?></strong></p>
	          		<?php
	          	}else{
	          		?>
	          		<p>Reponsável: <strong>Ninguém</strong></p>
	          		<?php
	          	}

	          	?>
			</div>


			<div class="input-field col s12 ">

	          	<button class="btn waves-effect waves-light" type="submit">Atribuir
				    <i class="material-icons right">person</i>
				</button>
				<br><br><br>
			</div>


		</form>

		<div class="input-field col s12 center-align">
    		<a class="waves-effect light-green btn-small" 
				href="<?php echo URLestilo ?>/dashboard/configurar">Início configurar</a>
			
		</div>

	</div>
  </div>

</div>		