
<div class="container">

  <div class="row">
    <div class="col s12">
      <h1>Configurar Usuário</h1>
      
       <blockquote>Está área é dedicada para ajuste e configuração na conta de Usuário, para gerenciar Leads volte para o Dashboard.</blockquote>
     </div>
  </div>

</div>




<div class="container">

  <div class="row">


    <div class="col s12 m4 ">
      <div class="card form">
        <div class="card-content center-align">
          <i class="material-icons prefix " style="font-size: 50px;">account_circle</i>
          <h4>Editar meu usuário</h4>
           <p><br></p>
        </div>
        <div class="card-action center-align">

          <a class="waves-effect light-green btn-small" 
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/atualizar-dados">Meu usuário</a>
        </div>
      </div>
    </div>

    <?php if($_SESSION["nivel"] <= 1) { ?>

    <div class="col s12 m4 ">
      <div class="card form">
        <div class="card-content center-align">
          <i class="material-icons prefix " style="font-size: 50px;">face</i>
          <h4>Editar dados de usuário</h4>
           <p><br></p>
        </div>
        <div class="card-action center-align">

          <a class="waves-effect light-green btn-small" 
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/atualizar-usuario">Editar usuário</a>
        </div>
      </div>
    </div>

    <?php }else{ } ?>


    <?php if($_SESSION["nivel"] <= 1) { ?>

    <div class="col s12 m4 ">
      <div class="card form">
        <div class="card-content center-align">
          <i class="material-icons prefix " style="font-size: 50px;">group_add</i>
          <h4>Cadastrar usuário</h4>
           <p><br></p>
        </div>
        <div class="card-action center-align">

          <a class="waves-effect light-green btn-small" 
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/cadastrar-usuario">Cadastrar</a>
        </div>
      </div>
    </div>

    <?php }else{ } ?>


    <?php if($_SESSION["nivel"] <= 3) { ?>

    <div class="col s12 m4 ">
      <div class="card form">
        <div class="card-content center-align">
          <i class="material-icons prefix " style="font-size: 50px;">folder</i>
          <h4>Atribuir lead</h4>
          <p>Lead sem responável: <?php echo $responsavelTotal[0]['count(*)']; ?></p>
        </div>
        <div class="card-action center-align">

          <a class="waves-effect light-green btn-small" 
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/atribuir-lead/novo">Novo responsável</a>
        </div>
      </div>
    </div>

    <?php }else{ } ?>

    


    <?php if($_SESSION["nivel"] <= 3) { ?>

    <div class="col s12 m4 ">
      <div class="card form">
        <div class="card-content center-align">
          <i class="material-icons prefix " style="font-size: 50px;">folder_shared</i>
          <h4>Responsável por lead</h4>
           <p>Lead com responável: <?php echo $responsavelTotalLead[0]['count(*)']; ?></p>
        </div>
        <div class="card-action center-align">

          <a class="waves-effect light-green btn-small" 
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/responsavel-lead">Visualizar</a>
        </div>
      </div>
    </div>

    <?php }else{ } ?>


    <?php if($_SESSION["nivel"] <= 3) { ?>

    <div class="col s12 m4 ">
      <div class="card form">
        <div class="card-content center-align">
          <i class="material-icons prefix " style="font-size: 50px;">folder_special</i>
          <h4>Meu lead</h4>
          <p>Você está responável por: <?php echo $responsavelMeuLead[0]['count(*)']; ?></p>
        </div>
        <div class="card-action center-align">

          <a class="waves-effect light-green btn-small" 
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/meu-lead">Visualizar</a>
        </div>
      </div>
    </div>

    <?php }else{ } ?>



    <?php if($_SESSION["nivel"] <= 1) { ?>

    <div class="col s12 m4 ">
      <div class="card form">
        <div class="card-content center-align">
          <i class="material-icons prefix " style="font-size: 50px;">visibility</i>
          <h4>Log básico</h4>
          <p><br></p>
        </div>
        <div class="card-action center-align">

          <a class="waves-effect light-green btn-small" 
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/log">Ver log</a>
        </div>
      </div>
    </div>

    <?php }else{ } ?>



     <?php if($_SESSION["nivel"] <= 2) { ?>

    <div class="col s12 m4 ">
      <div class="card form">
        <div class="card-content center-align">
          <i class="material-icons prefix " style="font-size: 50px;">burst_mode</i>
          <h4>Arquivos</h4>
          <p>Arquivos: <?php echo $totalArquivos[0]['count(arquivo)'] ?> | Consumo: <?php echo $resultado ?></p>
        </div>
        <div class="card-action center-align">

          <a class="waves-effect light-green btn-small" 
                 href="/<?php echo pastaPrincipal ?>/dashboard/configurar/arquivos">Visualizar</a>
        </div>
      </div>
    </div>

    <?php }else{ } ?>
   





  </div>
</div> 

