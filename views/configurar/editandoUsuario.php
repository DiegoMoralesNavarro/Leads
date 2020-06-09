





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





COLOCAR SÓ PARA ADM poder mudar o cargo
 

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

		<h4>Dados do usuário</h4>

		<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/configurar/atualizar-usuario/<?php echo $usuarioDados[0]['id_user']; ?>" method="post">

			<div class="input-field col s12 l12">

				<div class="input-field col s6">
			        <i class="material-icons prefix">assignment_turned_in</i>
		          	<input id="nomelogin" type="text" class="validate" name="user" value="<?php echo $usuarioDados[0]['user'] ?>">
		          	<label for="nomelogin">Nome de login</label>
				</div>

				<div class="input-field col s6">
			        <i class="material-icons prefix">email</i>
		          	<input id="email" type="email" class="validate" name="email" value="<?php echo $usuarioDados[0]['email'] ?>">
		          	<label for="email">E-mail</label>
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