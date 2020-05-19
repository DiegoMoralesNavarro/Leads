








<div class="panda">
  <div class="ear"></div>
  <div class="face">
    <div class="eye-shade"></div>
    <div class="eye-white">
      <div class="eye-ball" style="width: 7.67393px; height: 2.46711px;"></div>
    </div>
    <div class="eye-shade rgt"></div>
    <div class="eye-white rgt">
      <div class="eye-ball" style="width: 7.67393px; height: 2.46711px;"></div>
    </div>
    <div class="nose"></div>
    <div class="mouth"></div>
  </div>
  <div class="body"> </div>
  <div class="foot">
    <div class="finger"></div>
  </div>
  <div class="foot rgt">
    <div class="finger"></div>
  </div>
</div>


<form action="http://localhost/leads/" method="post" class="form">
  <div class="hand"></div>
  <div class="hand rgt"></div>
  <h2>Login Leads</h2>

  <?php if (isset($_GET["login"])) { ?>
		<p class="aviso" style="margin-bottom: 0px;">Usuário ou senha inválido</p>
	<?php } ?>

	<div style="margin: 0 10px;">

	<div class="input-field col s12">
      <input id="user" type="text" class="validate" name="user" required="">
      <label for="user">User</label>
    </div>



    <div class="input-field col s12">
      <input id="password" type="password" class="validate" name="senha" required="">
      <label for="password">Senha</label>
    </div>

  
    </div>

    <div class="input-field col s12 l3 center-align">
		<button class="btn waves-effect waves-light" type="submit">Entrar</button>
	</div>

  
  
</form>