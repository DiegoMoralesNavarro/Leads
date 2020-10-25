


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
      <h1>Cadastrar cliente</h1>
      
      
     </div>
  </div>

</div>

<!-- verificar se o nome já existe -->



<div class="container">

  <div class="row">
    <div class="col s12 form">

    	<a href="<?php echo URLestilo ?>/dashboard/configurar/cliente" 
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

	    	<form role="form1" action="/<?php echo pastaPrincipal ?>/dashboard/configurar/cliente/cadastro" method="post" >


	    	<div class="input-field col s12 l12">

		      	<div class="input-field col s12 l6">
					<i class="material-icons prefix">business</i>
			          <input type="text" id="nomecliente" class="autocomplete" name="nomecliente" maxlength="95" class="validate" required="">
			          <label for="nomecliente">Nome do cliente</label>
				</div>

		    </div> <!-- coluna 1 -->	

	    	<div class="input-field col s12 l12">

		      	<div class="input-field col s12 l6">
					<i class="material-icons prefix">account_circle</i>
			          <input type="text" id="usuarioadm" class="autocomplete" name="usuarioadm" maxlength="60" class="validate" required="">
			          <label for="usuarioadm">Nome do usuário administrador</label>
				</div>

				<div class="input-field col s12 l6">
					<i class="material-icons prefix">email</i>
			          <input type="email" id="email" class="autocomplete" name="email" class="validate" required="">
			          <label for="email">E-mail</label>
				</div>

		    </div> 


		    <div class="input-field col s12 l12">

		      	<div class="input-field col s12 l6">
					<i class="material-icons prefix">lock_open</i>
			          <input type="password" id="senha" class="autocomplete" name="senha" class="validate" required="">
			          <label for="senha">Senha</label>
				</div>

				<div class="input-field col s12 l6">
					<i class="material-icons prefix">lock_outline</i>
			          <input type="password" id="confirmarsenha" class="autocomplete" name="confirmarsenha" class="validate" maxlength="60" required="">
			          <label for="confirmarsenha">Confirmar a senha</label>
				</div>

		    </div> 
		    <br>

		    



		      <div class="input-field col s12 ">

		          	<button class="btn waves-effect waves-light" type="submit">Cadastrar cliente
					    <i class="material-icons right">send</i>
					</button>
				</div>


			</form>

		</div>




	</div>
  </div>

</div>

<br><br><br>