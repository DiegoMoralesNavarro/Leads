
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
      <h1>Editar dados do cliente: <?php echo $nomecliente[0]['nome_cliente']; ?></h1>
      
     </div>
  </div>

</div>





<div class="container">

  <div class="row">
    <div class="col s12 form">

    	<a href="<?php echo URLestilo ?>/dashboard/configurar/cliente/<?php echo $id ?>" 
  			class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >arrow_back</i></a>

    	<?php 

    	if (isset($_GET['senha'])) {
			echo "<p style='color: red; font-weight: bold;'>Senha não confere</p>";
		}else if (isset($_GET['nomeusuario'])) {
			echo "<p style='color: red; font-weight: bold;'>Este nome de Login para o Administrador já está em uso</p>";
		}else{
			echo "";
		}

    	 ?>


    	<div class="col s12 l12">

	    	<form role="form1" action="/<?php echo pastaPrincipal ?>/dashboard/configurar/cliente/editar-dados-cliente/<?php echo $id ?>" method="post" >


			<?php
				function selectedStatus( $value, $selected ){
				    return $value==$selected ? ' selected="selected"' : '';
				}
			?>

	    	<div class="input-field col s12 l12">

		      	<div class="input-field col s12 l4">
					<i class="material-icons prefix">business</i>
			          <input type="text" id="nomecliente" class="autocomplete" name="nomecliente" maxlength="95" class="validate" required="" value="<?php echo $nomecliente[0]['nome_cliente']; ?>">
			          <label for="nomecliente">Nome do cliente / empresa</label>
				</div>


		      	<div class="input-field col s12 l4">
					<i class="material-icons prefix">camera_front</i>
					<select name="status">
				      <option <?php echo selectedStatus( "1", $nomecliente[0]['status_cliente'] ); ?> value="1">Ativo</option>
				      <option <?php echo selectedStatus( "2", $nomecliente[0]['status_cliente'] ); ?> value="2">Bloqueado</option>
				    </select>
				    <label>Status</label>
				</div>


				<div class="input-field col s12 l4">
					<i class="material-icons prefix">burst_mode</i>
			          <input type="number" id="consumo" class="autocomplete" name="consumo" max="900" class="validate" required="" value="<?php echo $resultado; ?>">
			          <label for="consumo">Comsumo máximo em MB</label>
				</div>
				

		    </div> 




		      <div class="input-field col s12 ">

		          	<button class="btn waves-effect waves-light" type="submit">Atualizar dados
					    <i class="material-icons right">send</i>
					</button>
				</div>


			</form>

		</div>




	</div>
  </div>

</div>

<br><br><br>