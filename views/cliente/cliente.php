





<div class="container">

  <div class="row">
    <div class="col s12">
      <a href="<?php echo URLestilo ?>/dashboard/configurar" 
        class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
        <i class="material-icons" >arrow_back</i></a>
        <br><br>
      <h1>Administração de clientes</h1>
      
     </div>
  </div>

</div>


<div class="container">

  <div class="row">


    <div class="col s12 m4 ">
      <div class="card form">
        <div class="card-content center-align" style="padding: 2px;">
          <i class="material-icons prefix " style="font-size: 50px;">account_circle</i>
          <h4>Cadastrar cliente</h4>
        </div>
        <div class="card-action center-align">

          <a class="waves-effect light-green btn-small" 
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/cliente/cadastro">Novo </a>
        </div>
      </div>
    </div>

    <div class="col s12 m4 ">
      <div class="card form">
        <div class="card-content center-align" style="padding: 2px;">
          <i class="material-icons prefix " style="font-size: 50px; color: #e61000;">delete_forever</i>
          <h4>Deletar cliente</h4>
        </div>
        <div class="card-action center-align">

          <a class="waves-effect light-green btn-small" 
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/cliente/deletar-lista/">Deletar</a>
        </div>
      </div>
    </div>


  </div>

</div>

<div class="container">

  <div class="row">
    <div class="col s12">
      <h2>Todos os clientes</h2>
       <blockquote>Consulte e atualize os dados.</blockquote>
      
     </div>
  </div>

</div>


<div class="container">

  <div class="row">

    <?php foreach ($nomecliente as $value) { 
      $ids = $value['id_cliente'];
      
      ?>


  	<div class="col s12 m4 ">
      <div class="card form">

        <div class="card-content" style="padding: 2px;">
          <h4><strong>Nome: </strong><?php echo $value['nome_cliente'] ?></h4>

          <p><strong>Data de criação: </strong><?php echo date('d/m/Y', strtotime($value['cliente_data'])); ?></p>

          <p><strong>Status: </strong> <?php if ($value['status_cliente'] == '1') {
            echo "<span style=' color: #088c0d;'>Ativo </span>";
          }else{
            echo "<span style=' color: red;'>Bloqueado </span>";
          } ?></p>

          <p><strong>Total de contas: </strong> <?php echo array_count_values(array_column($totalcontas, 'fk_id_cliente'))[$ids]; ?> </p>

          <?php if (isset(array_count_values(array_column($totalarquivos, 'fk_id_cliente'))[$ids]) ) { ?>

          <p><strong>Total de arquivos: </strong><?php echo array_count_values(array_column($totalarquivos, 'fk_id_cliente'))[$ids]; ?></p>
        <?php }else{ ?>
            <p><strong>Total de arquivos: </strong>0</p>
        <?php } ?>

          

        </div>
        <div class="right-align">

          <a class="waves-effect blue darken-1 btn-small" style="height: 20.4px; line-height: 20.4px;"
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/cliente/<?php echo $value['id_cliente'] ?>">Entrar </a>
        </div>
      </div>
    </div>

    <?php } ?>
    
  </div>

</div>