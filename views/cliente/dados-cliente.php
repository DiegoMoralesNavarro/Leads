


<div class="container">

  <div class="row">
    <div class="col s12">
      <h1>Dados do cliente</h1>
      
     </div>
  </div>

</div>



<div class="container">

  <div class="row">
    <div class="col s12 form">

      	<a href="<?php echo URLestilo ?>/dashboard/configurar/cliente" 
  			class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >arrow_back</i></a>
  			<br><br>
      	
      	<h2><strong>Nome:</strong> <?php echo $nomecliente[0]['nome_cliente']; ?></h2>

      	<div class="col s12 linha ">
		<br><br>
		</div>

		<div class="col s12 center-align">
			<h3><strong>Visão geral</strong></h3>
			<br>
		</div>

		<div class="col s12 m4 ">

			<div class="card">
		        <div class="card-content center-align">
		          
		          <h3><i class="small material-icons " style="top: 6px; position: relative; color: #009688;">contacts</i> <strong>Contas / Usuário</strong> </h3>
		          <br>
		          <div class="col s12 linha "></div>
		          <p><strong>Total de contas:</strong> <?php echo $totalContas[0]['count(user)']; ?></p>
		        </div>
		    </div>
  		</div>


  		<div class="col s12 m4 ">

			<div class="card">
		        <div class="card-content center-align">
		          
		          <h3><i class="small material-icons " style="top: 6px; position: relative; color: #009688;">people</i> <strong>Leads</strong> </h3>
		          <br>
		          <div class="col s12 linha "></div>
		          <p><strong>Total de leads:</strong> <?php echo $totalLeads[0]['count(nome)']; ?></p>
		        </div>
		    </div>
  		</div>


  		<div class="col s12 m4 ">

			<div class="card">
		        <div class="card-content center-align">
		          
		          <h3><i class="small material-icons " style="top: 6px; position: relative; color: #009688;">description</i> <strong>Consumo</strong> </h3>
		          <br>
		          <div class="col s12 linha "></div>
		          <p><strong>Total de arquivos:</strong> <?php echo $totalArquivos[0]['count(arquivo)']; ?> | <strong>Consumo:</strong> <?php echo $resultado; ?></p>
		        </div>
		    </div>
  		</div>


  		<div class="col s12 center-align">
     	<br><br><br>
		<h3><strong>Editar / consultar</strong></h3>
		<br>
	</div>

	<div class="col s12 m4 ">
      <div class="card ">
        <div class="card-content center-align" style="padding: 2px;">
          <i class="material-icons prefix " style="font-size: 50px;">face</i>
          <h4>Editar dados de usuário</h4>
        </div>
        <div class="card-action center-align">

          <a class="waves-effect light-green btn-small" 
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/cliente/atualizar-usuario-cliente/<?php echo $nomecliente[0]['id_cliente']; ?>">Editar </a>
        </div>
      </div>
    </div>

   <!-- colocar o limite de arquivo -->
    <div class="col s12 m4 ">
      <div class="card ">
        <div class="card-content center-align" style="padding: 2px;">
          <i class="material-icons prefix " style="font-size: 50px;">burst_mode</i>
          <h4>Controle de arquivos</h4>
        </div>
        <div class="card-action center-align">

          <a class="waves-effect light-green btn-small" 
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/cliente/arquivos/<?php echo $nomecliente[0]['id_cliente']; ?>">Remover </a>
        </div>
      </div>
    </div>



     <!-- colocar o limite de arquivo , status ativo block, nome edit-->
    <div class="col s12 m4 ">
      <div class="card ">
        <div class="card-content center-align" style="padding: 2px;">
          <i class="material-icons prefix " style="font-size: 50px;">business</i>
          <h4>Dados do cliente</h4>
        </div>
        <div class="card-action center-align">

          <a class="waves-effect light-green btn-small" 
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/cliente">Editar </a>
        </div>
      </div>
    </div>

    <div class="col s12 m4 ">
      <div class="card ">
        <div class="card-content center-align" style="padding: 2px;">
          <i class="material-icons prefix " style="font-size: 50px;">remove_red_eye</i>
          <h4>Log básico</h4>
        </div>
        <div class="card-action center-align">

          <a class="waves-effect light-green btn-small" 
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/cliente">Consultar </a>
        </div>
      </div>
    </div>




<div class="col s12 center-align"><br><br></div>


     </div>

     

  </div>

</div>


<br><br><br>