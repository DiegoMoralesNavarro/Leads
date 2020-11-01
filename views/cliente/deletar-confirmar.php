


<div class="container">

  <div class="row">
    <div class="col s12 center-align">

    	<img class="" style="width: 200px;" src="<?php echo URLestilo; ?>/materialize/panda-triste.png">
      <h1>Deseja realmente deletar o cliente: <?php echo $nomecliente[0]['nome_cliente']; ?></h1>
      
      
     </div>
  </div>

</div>




<div class="container">

  <div class="row">
    <div class="col s12">

    	<div class="input-field col s12 l4 center-align">
				<a href="<?php echo URLestilo ?>/dashboard/configurar/cliente" class="waves-effect waves-light btn">Voltar</a>
		</div>

		<div class="input-field col s12 l4 center-align">
				<a href="<?php echo URLestilo ?>/dashboard/configurar/cliente/editar-dados-cliente/<?php echo $id; ?>" class="waves-effect waves-light btn blue lighten-1">Bloquear</a>
		</div>

		<div class="input-field col s12 l4 center-align">
				<a href="<?php echo URLestilo ?>/dashboard/configurar/cliente/delete-definitivo/<?php echo $id; ?>" class="waves-effect waves-light btn red darken-1">Deletar</a>
		</div>
      
      
     </div>
  </div>

</div>