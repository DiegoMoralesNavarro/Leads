


<?php 

if (isset($_COOKIE['Atualizado'])) {
	?> 
	<script>
		window.addEventListener("load", function() {
	    M.toast({html: 'Cadastrado'})
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
      <h1>Cadastrar usuário</h1>
      
       <blockquote>Crie um usuário com nivel de permissão</blockquote>
     </div>
  </div>

</div>

<!-- verificar se o nome já existe -->



<div class="container">

  <div class="row">
    <div class="col s12 form">


    	<div class="col s12 l12">

	    	<form role="form1" action="/<?php echo pastaPrincipal ?>/dashboard/configurar/cadastrar-usuario" method="post" >

	    	<div class="input-field col s12 l12">

		      	<div class="input-field col s12 l6">
					<i class="material-icons prefix">account_circle</i>
			          <input type="text" id="user" class="autocomplete" name="user" maxlength="60" class="validate" required="">
			          <label for="user">Nome do usuário</label>
				</div>

				<div class="input-field col s12 l6">
					<i class="material-icons prefix">email</i>
			          <input type="email" id="email" class="autocomplete" name="email" class="validate" required="">
			          <label for="email">E-mail</label>
				</div>

		    </div> <!-- coluna 1 -->


		    <div class="input-field col s12 l12">

		      	<div class="input-field col s12 l6">
					<i class="material-icons prefix">lock_open</i>
			          <input type="password" id="senha" class="autocomplete" name="senha" class="validate" required="">
			          <label for="senha">Senha</label>
				</div>

				<div class="input-field col s12 l6">
					<i class="material-icons prefix">lock_outline</i>
			          <input type="password" id="senhaconfirmar" class="autocomplete" name="senhaconfirmar" class="validate" required="">
			          <label for="senhaconfirmar">Confirmar a senha</label>
				</div>

		    </div> <!-- coluna 1 -->


		    <div class="input-field col s12 l6">
			    <select placeholder="Selecione um cargo">
			      <option value="1">Administrador</option>
			      <option value="2">Gerente</option>
			      <option value="3" selected="">Atendente</option>
			    </select>
			    <label>Selecione um cargo</label>
			</div>



		      <div class="input-field col s12 ">

		          	<button class="btn waves-effect waves-light" type="submit">Cadastrar usuário
					    <i class="material-icons right">send</i>
					</button>
				</div>


			</form>

		</div>


	</div>
  </div>

</div>