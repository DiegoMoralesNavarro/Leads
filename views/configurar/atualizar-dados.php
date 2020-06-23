



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
      <h1>Atualizar Meus Dados</h1>
      <!-- 
       <blockquote>Crie atualizações sobre o acompanhamento.</blockquote> -->
     </div>
  </div>

</div>





<div class="container">

  <div class="row">
	<div class="col s12 form">

		<a href="<?php echo URLestilo ?>/dashboard/configurar" 
  			class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >arrow_back</i></a>

		<h4>Meus dados</h4>
		<blockquote>Ao atualizar os dados você será desconectado.</blockquote>

		<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/configurar/atualizar-dados" method="post">

			<div class="input-field col s12 l12">

				<div class="input-field col s6">
			        <i class="material-icons prefix">assignment_turned_in</i>
		          	<input id="nomelogin" type="text" class="validate" maxlength="60" name="user" value="<?php echo $meusDados[0]['user'] ?>">
		          	<label for="nomelogin">Nome de login</label>
				</div>

				<div class="input-field col s6">
			        <i class="material-icons prefix">email</i>
		          	<input id="email" type="email" class="validate" name="email" value="<?php echo $meusDados[0]['email'] ?>">
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



		<h4 id="senha">Minha senha</h4>
		<blockquote>Ao atualizar a senha você será desconectado.</blockquote>

		<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/configurar/atualizar-dados" method="post">

			<div class="input-field col s12 l12">

				<div class="input-field col s6">
			        <i class="material-icons prefix">lock_open</i>
		          	<input id="senhaAtual" type="password" class="validate" name="senhaAtual" >
		          	<label for="senhaAtual">Senha atual</label>
				</div>

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