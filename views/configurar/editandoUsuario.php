





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
      <h1>Atualizar Dados de Usuário</h1>
      <!-- 
       <blockquote>Crie atualizações sobre o acompanhamento.</blockquote> -->
     </div>
  </div>

</div>





<div class="container">

  <div class="row">
	<div class="col s12 form">

		<a href="<?php echo URLestilo ?>/dashboard/configurar/atualizar-usuario" 
  			class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >arrow_back</i></a>


		<h4>Dados do usuário</h4>

		<?php 

    	if (isset($_GET['login'])) {
			echo "<p style='color: red; font-weight: bold;'>Login não pode ser vazio</p>";
		}else if (isset($_GET['senha'])) {
			echo "<p style='color: red; font-weight: bold;'>Senha não pode ser vazio</p>";
		}else{
			echo "";
		}

    	 ?>

		<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/configurar/atualizar-usuario/<?php echo $usuarioDados[0]['id_user']; ?>" method="post">

			<div class="input-field col s12 l12">

				<div class="input-field col s12 l5">
			        <i class="material-icons prefix">assignment_turned_in</i>
		          	<input id="nomelogin" type="text" class="validate" name="user" value="<?php echo $usuarioDados[0]['user'] ?>">
		          	<label for="nomelogin">Nome de login</label>
				</div>

				<div class="input-field col s12 l5">
			        <i class="material-icons prefix">email</i>
		          	<input id="email" type="email" class="validate" name="email" value="<?php echo $usuarioDados[0]['email'] ?>">
		          	<label for="email">E-mail</label>
				</div>

			</div>


			<?php
				function selectedStatus( $value, $selected ){
				    return $value==$selected ? ' selected="selected"' : '';
				}
			?>




			<div class="input-field col s12 ">

				<div class="input-field col s12 l5">
					<i class="material-icons prefix">camera_front</i>
					<select name="status">
				      <option <?php echo selectedStatus( "1", $usuarioDados[0]['user_status'] ); ?> value="1">Ativo</option>
				      <option <?php echo selectedStatus( "2", $usuarioDados[0]['user_status'] ); ?> value="2">Bloqueado</option>
				    </select>
				    <label>Status</label>
				</div>
	          	
			</div>


			<div class="input-field col s12 ">

	          	<button class="btn waves-effect waves-light" type="submit">Atualizar
				    <i class="material-icons right">send</i>
				</button>
				<br><br><br>
			</div>

		</form>



		<h4 id="senha">Redefinir senha do usuário</h4>

		<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/configurar/atualizar-usuario/<?php echo $usuarioDados[0]['id_user']; ?>" method="post">

			<div class="input-field col s12 l12">

				<div class="input-field col s6">
			        <i class="material-icons prefix">lock_outline</i>
		          	<input id="novaSenha" type="password" class="validate" name="novaSenha" >
		          	<label for="novaSenha">Nova senha</label>
				</div>

			</div>

			<div class="input-field col s12 ">

	          	<button class="btn waves-effect waves-light" type="submit">Atualizar Senha
				    <i class="material-icons right">send</i>
				</button>
				<br><br><br>
			</div>

		</form>

	</div>
  </div>

</div>		