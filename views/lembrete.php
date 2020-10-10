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
      <h1>Lembrete do Follow up</h1>
      
       <blockquote>Crie para você um lembrete no Follow up específico. No Dashboard será exibido seu lembrete do dia.</blockquote>
     </div>
  </div>

</div>



<div class="container">

  	<div class="row">
    	<div class="col s12 form">

    		<a href="<?php echo URLestilo ?>/dashboard/follow-up/<?php echo $follow[0]['idlead']; ?>#follow<?php echo $idfollow; ?>" 
  			class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >arrow_back</i></a>
        <br>

    		<div class="col s12">
          <br>

    			<h3>Follow up do lead: <strong><?php echo $follow[0]['nome'] ?></strong> - Empresa: <strong><?php echo $follow[0]['empresa'] ?></strong></h3>
    			
    			
    			<p>Texto do Follow up criado no dia: <?php echo date('d/m/Y', strtotime($follow[0]['dataf'])); ?></p>
    			<p><?php echo $follow[0]['texto'] ?></p>
    			
    		</div>

    		<div class="col s12 linha "><br></div>


    		<div class="col s12">
    			<h3>Cadastrar lembrete</h3>

    			<form role="form1" action="/<?php echo pastaPrincipal ?>/dashboard/lembrete/<?php echo $idfollow; ?>" method="post" enctype="multipart/form-data">	

          <div class="col s12"> 

        			<div class="input-field col s12 l12">
                <input type="hidden" id="idlead" name="idlead" value="<?php echo $follow[0]['idlead'] ?>">
        				<textarea id="textolembrete" name="textolembrete" required="" class="materialize-textarea" maxlength="100"></textarea>
        				<label for="textolembrete">Descrição</label>
        			</div>

          </div>    

          <?php
            function selected( $value, $selected ){
                return $value==$selected ? ' selected="selected"' : '';
            }
          ?>

          <div class="col s12 l3">

            <div class="input-field col s12 l12">
                <input type="text" class="datafinal" name="datafinal" required="" value="">
                <label for="datafinal">Data</label>
              </div>

            

          </div>


           <div class="col s12 l6">
              <div class="input-field col s12 l6">
                <select name="usuario" >

                  <?php foreach ($followUsuario as $value){ ?>

                  
                    <option <?php echo selected( $value['id_user'], $_SESSION["id_user"] ); ?> value="<?php echo $value['id_user']; ?>" >  <?php echo $value['user']; ?> </option>
                   
                  <?php } ?>
               
                </select>
                <label>Lembrete para o usuário:</label>

              </div>


              <div class="input-field s12 l4 center-align">
                  <button class="btn waves-effect waves-light" type="submit" name="action">Cadastrar
                    <i class="material-icons right">send</i>
                </button>
              </div>

          </div>



    			


    			</form>

    		</div>

    		<div class="col s12 linha "><br></div>

    		<div class="col s12">
    			<h3>Lista de lembrete</h3>

          <div class="input-field col s12">

            <table class="highlight">
                  <thead>
                    <tr>
                        <th>Dono do <br> lembrete</th>
                        <th>Data para o<br> lembrete </th>
                        <th>Descrição</th>
                        <th>Editar</th>
                    </tr>
                  </thead>

                  <tbody>

                    <?php if ($followLembrete == null || $followLembrete == ""){ ?>
                      
                      <tr>
                        <td>xx</td>
                        <td>vazio</td>
                        <td></td>
                        <td></td>
                      </tr>


                    <?php }else{ ?>

                      <?php foreach ($followLembrete as $value) { ?>
                      <form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/lembrete/<?php echo $idfollow; ?>" method="post" enctype="multipart/form-data">  
                        <tr>

                          <td><?php echo $value['user']; ?></td>

                          <td><?php echo date('d/m/Y', strtotime($value['data_lembrete']));?></td>
                          

                          <input type="hidden" id="idlembrete" name="idlembrete" value="<?php echo $value['id_lembrete']; ?>">

                          <td>
                            <textarea id="textolembretenovo" name="textolembretenovo" required="" class="materialize-textarea" maxlength="100" style="background-color: #fff;"><?php echo $value['texto_lembrete']; ?></textarea>
                          </td>

                          <td>

                            <?php if ($_SESSION["id_user"] == $value['autor'] || $_SESSION["nivel"] == 1) {
                              ?>
                              <button class="waves-effect waves-light btn-small" type="salvar" name="action">Salvar
                              </button>

                              <a class=" red accent-4 btn-small"
                               href="/<?php echo pastaPrincipal ?>/dashboard/lembrete/<?php echo $value['id_lembrete']; ?>/delete/<?php echo $idfollow; ?>" 
                               onclick="return confirm('Deseja realmente excluir o Lembrete')" >Excluir</a>
                            <?php  }else{
                              echo "Somente o dono do <br> lembrete pode editar";
                            } ?>


                          </td>

                        </tr>
                      </form>
                      <?php } ?>

                    <?php } ?>



                  </tbody>
                </table>

          </div>

    			
    		</div> <!-- tabela -->

    		

 		</div>
 	</div>

</div>



<script type="text/javascript">
	

	$(document).ready(function(){

$('.datafinal').datepicker({
i18n: {
months: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
today: 'Hoje',
clear: 'Limpar',
cancel: 'Sair',
done: 'Confirmar',
labelMonthNext: 'Próximo mês',
labelMonthPrev: 'Mês anterior',
labelMonthSelect: 'Selecione um mês',
labelYearSelect: 'Selecione um ano',
selectMonths: true,
selectYears: 15,
},
format: 'dd/mm/yyyy',
container: 'body',
minDate: new Date(),
//maxDate: new Date(),
defaultDate: new Date(),
});



  });

</script>



