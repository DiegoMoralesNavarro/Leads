



<?php



// $path = "uploads/leads/";
// $tamanho = 0;
// $resultado = 0;

// $diretorio = scandir($path);
// $qtd = count($diretorio) - 2;

// $fileInfo2 = "'777-corporate.jpg','833-dormitorios.jpg'";


// echo $idcliente = $_SESSION["fk_id_cliente"];
// echo "<br>";
// echo "<br>";
// echo "<br>";





// // Loop que gera registros 
// foreach (new DirectoryIterator($path) as $fileInfo) { 


//     if($fileInfo->isDot()) continue;

//    //echo $fileInfo->getFilename();
   

//     $fs = $fileInfo->getSize(); 
// 	$tamanho += $fs;
   
// }



//     if ($tamanho >= 1000000) { 
//       $resultado = round($tamanho /1024 /1024,2) . " Mb"; 

//     } else if ($tamanho >= 100) {
       
//        $resultado = round($tamanho /1000,2) . " kb"; 

//     } else { 
//     	$resultado = $tamanho . " bytes"; 
        

//     }


// echo "Total de arquivos: ".$qtd;
// echo "<br>";
// echo "Consumo em disco: ".$resultado;






 ?>





<div class="container">

  <div class="row">
    <div class="col s12">

      	<div class="col s11 l9"> <h1>Dashboard</h1> </div>

      	<?php if (count($followMinhaLista) >= 1) { ?>

      		<div class="col s1 l3 right-align">
	       		<a href="<?php echo URLestilo ?>/dashboard/#lembrete" 
	  			class="btn-floating btn-small waves-effect yellow accent-4 heartbeat" style="padding: 0 0px!important;">
	  			<i class="material-icons" >notifications_active</i></a>
	  		</div>
      		
      	<?php } ?>

      	
  		<div class="col s12 linha ">
		</div>
     
     </div>
  </div>

</div>


<div class="container">

  <div class="row">
    <div class="col s12">
      <h4>Novo Lead em espera</h4>
      
       <blockquote>Leads com <strong>status NOVO </strong>esperando um retorno</blockquote>
     </div>
  </div>

</div>



<div class="container">

  <div class="row status">
    <div class="col s12 form center-align">

    	
    	<div class="col s12 m4">
	      <div class="">
	        <div class="card-content center-align">
	          <i class="material-icons prefix " style="font-size: 70px; color: #4bdc4b;">account_circle</i> 
	          <h4 style="margin-top: 2px;"><strong>Até 5 horas</strong></h4>
	          <?php if (0 == count($tempoum)) {?>
	          	<h4 style="margin-top: 2px;">Lead em espera:<strong> <?php echo count($tempoum); ?></strong></h4>
	          <?php }else{?>

	          	<a href="<?php echo URLestilo ?>/dashboard/lead-espera/?tempo=1">
		          <h4 style="margin-top: 2px;">Lead em espera:<strong> <?php echo count($tempoum); ?></strong></h4>
		          </a>
	          <?php } ?>

	          
	          <br>
	        </div>
	      </div>
	    </div>

	    <div class="col s12 m4">
	      <div class="">
	        <div class="card-content center-align">
	          <i class="material-icons prefix " style="font-size: 70px; color: #ff9800;">account_circle</i>
	          <h4 style="margin-top: 2px;"><strong>Até 24 horas</strong></h4>
	        <?php if (0 == count($tempodois)) {?>
	          	<h4 style="margin-top: 2px;">Lead em espera:<strong> <?php echo count($tempodois); ?></strong></h4>
	          <?php }else{?>

	          	<a href="<?php echo URLestilo ?>/dashboard/lead-espera/?tempo=2">
		          <h4 style="margin-top: 2px;">Lead em espera:<strong> <?php echo count($tempodois); ?></strong></h4>
		          </a>
	          <?php } ?>
	          
	          <br>
	        </div>
	      </div>
	    </div>

	    <div class="col s12 m4">
	      <div class="">
	        <div class="card-content center-align">
	          <i class="material-icons prefix " style="font-size: 70px; color: #e61000;">account_circle</i>
	          <h4 style="margin-top: 2px;"><strong>Mais de 24 horas</strong></h4>
	          <?php if (0 == count($tempotres)) {?>
	          	<h4 style="margin-top: 2px;">Lead em espera:<strong> <?php echo count($tempotres); ?></strong></h4>
	          <?php }else{?>

	          	<a href="<?php echo URLestilo ?>/dashboard/lead-espera/?tempo=3">
		          <h4 style="margin-top: 2px;">Lead em espera:<strong> <?php echo count($tempotres); ?></strong></h4>
		          </a>
	          <?php } ?>

	          <br>
	        </div>
	      </div>
	    </div>


 	</div>
  </div>

</div>


<?php 


if (isset($_GET['pesquisa'])) {
	$_SESSION["pesquisa"] = $_GET['pesquisa'];

	$valor = $_SESSION["pesquisa"];
}else{
	$_SESSION["pesquisa"] = "";

	$valor = $_SESSION["pesquisa"];
}


if (isset($_GET['followup'])) {
	$_SESSION["followup"] = $_GET['followup'];

	$followup = $_SESSION["followup"];
}else{
	$_SESSION["followup"] = 1;

	$followup = 1;
}



?>


<!--  -->

<div class="container">

  <div class="row status">
    <div class="col s12">
    	<h4>Tabela de Lead</h4>
      
		<blockquote>Consulte, Edite ou Exclua um Lead</blockquote>

     </div>
  </div>

</div>


<div class="container">

  <div class="">
  	<div class="col s12 form ">




<form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/?pesquisa=$pesquisa&page=$numero&followup=$followup" method="get">

	<div class="row">
		<div class="input-field col s12 l4">
		<table>
            <tr>

                
					<i class="material-icons prefix">textsms</i>
			          <input type="text" id="autocomplete-input" class="autocomplete" name="pesquisa" value="<?php echo $valor; ?>">
			          <label for="autocomplete-input">Nome do Lead</label>
				
            </tr>
        </table>
        </div>

        <div class="input-field col s12 l3">
					
		    <select name="followup" >
		    	<?php
					function selectedfollowup( $value, $selected ){
					    return $value==$selected ? ' selected="selected"' : '';
					}
				?>
		    

			    <option <?php echo selectedfollowup( $_SESSION["followup"], 1 ); ?> value="1" > Padrão </option>
			    <option <?php echo selectedfollowup( $_SESSION["followup"], 2 ); ?> value="2" > Follow UP asc </option>
			    <option <?php echo selectedfollowup( $_SESSION["followup"], 3 ); ?> value="3" > Follow UP desc </option>

			    
		    </select>
		    <label>Ordenar Follow UP</label>
		    
		</div>
		
		<div class="input-field col s12 l3 center-align">
			<button class="btn waves-effect waves-light" type="submit">Pesquisar
				 <i class="material-icons right">search</i>
			</button>
		</div>
	</div>
	

<table class="striped centered responsive-table">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Empresa</th>
			<th>Telefone</th>
			<th>E-mail</th>
			<th>Último <br>Follow UP</th>
			<th>Status</th>
			<th>Editar</th>
		</tr>
	</thead>
	<tbody>

		  <?php foreach ($users as $value) { 

		

		  	if (!$value == null) {

		  		for ($i=0; $i < count($value); $i++) { 

		  	?>

			<tr>
				
				<td style="overflow: hidden; max-width: 150px;" ><?php echo $value[$i]['nome']; ?></td>
				<td style="overflow: hidden; max-width: 150px;" ><?php echo $value[$i]['empresa']; ?></td>

				<td><?php
				$numero = preg_replace("/[^0-9]/", "", $value[$i]['telefone']);
				if (strlen($value[$i]['telefone']) == 14) {

					?>	<a href="https://api.whatsapp.com/send?phone=55<?php echo $numero ?>" target="_blank"><?php echo $value[$i]['telefone']; ?></a> <?php
				}else{ ?>
					<a href="tel:+55<?php echo $value[$i]['telefone']; ?>" target="_blank"><?php echo $value[$i]['telefone']; ?></a>
					<?php
				}

				?> </td>


				<td ><a href="mailto:<?php echo $value[$i]['email']; ?>"><?php echo $value[$i]['email']; ?></a></td>


				<td><?php if ($value[$i]['ultimo_followup'] == "vazio" || $value[$i]['ultimo_followup'] == null) {
					echo "Não existe <br> Follow UP";
				}else{
					echo date('d/m/Y', strtotime($value[$i]['ultimo_followup']));
				} ?>
					
				</td>

				

				<td><?php echo $value[$i]['tipostatus']; ?></td>
				<td class="edite-form"> 

				<a href="editar/<?php echo $value[$i]['idlead']?>" 
  			class="btn-floating btn-small waves-effect waves-light " style="padding: 0 0px!important;">
  			<i class="material-icons" >edit</i></a>

  				<a href="<?php echo $value[$i]['idlead']?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn-floating btn-small waves-effect red accent-4 " style="padding: 0 0px!important;">
  			<i class="material-icons" >delete_forever</i></a>

  				<a href="follow-up/<?php echo $value[$i]['idlead']?>" class="btn-floating btn-small waves-effect light-green " style="padding: 0 0px!important;">
  			<i class="material-icons" >done_all</i></a>

				</td>
			</tr>
		<?php } // for?>

			<?php

			
			}else{  ?>

				<tr>
					<td>xx</td>
					<td>vazio</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>

		<?php
			}// if
		 } //for
		?>
	
	</tbody>
</table>

<br>
<!-- pagina -->

<?php 


$voltar = $page - 1;
$avancar = $page + 1;
$numerosPorPagina = 4;

$linhas = $_SESSION["paginas"];

$total_Paginas = ceil($linhas/$itemsPerPage);

function selected( $value, $selected ){
    return $value==$selected ? ' class="active" style="color: #fff;" "' : '';
}

 ?>





<div class="col s12 m4 l12 center-align">

<ul class="pagination">

	<?php 
	if ($linhas > $itemsPerPage) { 
		if($page == 1){
			?>

	<?php }else{ ?>
	<li class="disabled">
		<button name="page" type="submit" value="<?php echo $voltar; ?>"><i class="material-icons">chevron_left</i></button>
	</li>
	<?php } ?>



	<?php for($i = $page - $numerosPorPagina; $i <= $page; $i++ ){

	if($i >= 1){ ?>
		<li <?php echo selected( $page, $i ); ?> > <button <?php echo selected( $page, $i ); ?> id="paginar" name="page" type="submit" value="<?php echo $i ?>"><?php echo $i ?></button> </li>
		
	<?php 	}

	}
	?> 


	<?php for($i = $page + 1; $i <= $page + $numerosPorPagina; $i++ ){
	if($i <= $total_Paginas){ ?>
		<li class="waves-effect">
			<button name="page" type="submit" value="<?php echo $i ?>"><?php echo $i ?></button>
		</li>
		
	<?php 	}
	}
	?> 


	<?php if($page == $total_Paginas){ ?>

	<?php }else{ ?>
	<li class="disabled">
		<button name="page" type="submit" value="<?php echo $avancar; ?>"><i class="material-icons">chevron_right</i></button>
	</li>
	<?php } ?>

	<?php 
	}else{
			// não mostrar paginação pois o total do DB é menor que o o limite exibido
	} ?>

 </ul>

</div>

</form>
<br><br>






	</div>
  </div> <!-- row -->

</div>


<br>


<!--  -->

<div class="container">

  <div class="row status">
    <div class="col s12">
    	<h4>Status dos Lead</h4>
      
       <blockquote>Total geral dos Status</blockquote>
       <br>
    </div>

 

<?php

foreach ($status as $value) {

	$nome = $value['tipostatus'];

	if (isset(array_count_values(array_column($totalStatus, 'tipostatus'))[$nome]) ) {
		 ?>

		<div class="col s12 l3">
	    	<div class="col s12 form ">

	    	<a href="<?php echo URLestilo ?>/dashboard/status-lista/<?php echo $value['idstatus']; ?>">
	    		
		       	<h3 class="center-align"><?php echo array_count_values(array_column($totalStatus, 'tipostatus'))[$nome]; ?></h3>

		       	<p class="center-align"><?php echo $value['tipostatus']; ?></p>

	       	</a>

	    	</div>
	    </div>

		 <?php
	}else{

		 ?>

		<div class="col s12 l3">
	    	<div class="col s12 form ">
	       	<h3 class="center-align"><?php echo "0"; ?></h3>

	       	<p class="center-align"><?php echo $value['tipostatus']; ?></p>

	    	</div>
	    </div>

		 <?php
	}
	
}


 ?>

 </div>


</div>



<div class="container">

  	<div class="row status">

  		<div class="col s12">
	    	<h4>Gerenciar Responsável por Lead</h4>
	      
	       <blockquote>Não esta sendo exibido o Lead finalizado ou configurado como invisível.</blockquote>
	       <br>
	    </div>


  		<div class="col s12 form center-align">

    	
			<div class="col s12 m4">
		        <div class="card-content center-align">

		          <i class="material-icons prefix " style="font-size: 70px; ">folder</i> 
		          <h4 style="margin-top: 2px;"><strong>Atribuir lead</strong></h4>
		          <a href="<?php echo URLestilo ?>/dashboard/configurar/atribuir-lead/novo">Lead sem responável: <strong><?php echo $responsavelTotal[0]['count(*)']; ?></strong></a>

		          
		          <br>
		        </div>
		    </div>

		    <div class="col s12 m4">
		        <div class="card-content center-align">

		          <i class="material-icons prefix " style="font-size: 70px; ">folder_shared</i> 
		          <h4 style="margin-top: 2px;"><strong>Responsável por lead</strong></h4>
		          <a href="<?php echo URLestilo ?>/dashboard/configurar/responsavel-lead">Lead com responável: <strong><?php echo $responsavelTotalLead[0]['count(*)']; ?></strong></a>

		          
		          <br>
		        </div>
		    </div>

		    <div class="col s12 m4">
		        <div class="card-content center-align">

		          <i class="material-icons prefix " style="font-size: 70px; color: #64dd17;">folder_special</i> 
		          <h4 style="margin-top: 2px;"><strong>Meu lead</strong></h4>
		          <a href="<?php echo URLestilo ?>/dashboard/configurar/meu-lead">Você está responável por: <strong><?php echo $responsavelMeuLead[0]['count(*)']; ?></strong></a>

		          
		          <br>
		        </div>
		    </div>

		</div>


	</div>

</div>  



<div class="container">

  	<div class="row status">

  		<div id="lembrete" class="col s12">
	    	<h4>Meus lembretes</h4>
	      
	       <blockquote>O lembrete esta associado ao Follow Up </blockquote>
	       <br>
	    </div>

	    <div class="col s12 form ">

	    	<div class="right-align">
	    		<a href="meus-lembretes" class="right-align">Ver todos<i class="material-icons" style="font-size: 18px;" >notifications_active</i></a>
  			</div>

	    	<div class="input-field col s12 center-align">

	    		<h4><strong>Meu lembrete do dia</strong></h4>

	            <table class="highlight">
	                  <thead>
	                    <tr>
	                        <th>Data do lembrete </th>
	                        <th>Descrição</th>
	                        <th>Nome do lead</th>
	                        <th>Ver Follow Up</th>
	                    </tr>
	                  </thead>

	                  <tbody>

	                    <?php if ($followMinhaLista == null || $followMinhaLista == ""){ ?>
	                      
	                      <tr>
	                        <td>xx</td>
	                        <td>vazio</td>
	                        <td></td>
	                        <td></td>
	                      </tr>


	                    <?php }else{ ?>

	                      <?php foreach ($followMinhaLista as $value) { ?>

	                        <tr>


	                          <td><?php echo date('d/m/Y', strtotime($value['data_lembrete']));?></td>

	                          <td>
	                            <?php echo $value['texto_lembrete'] ?>
	                          </td>

	                          <td>
	                            <?php echo $value['nome'] ?>
	                          </td>

	                          <td>

	                            
	                          	<a href="follow-up/<?php echo $value['fk_idlead']?>#follow<?php echo $value['fk_idfollowup']?>" class="btn-floating btn-small waves-effect light-green " style="padding: 0 0px!important;"><i class="material-icons" >done_all</i></a>

	                          </td>

	                        </tr>

	                      <?php } ?>


	                    <?php } ?>



	                  </tbody>
	                </table>

	         </div>



  		</div>
  		

  	</div>

</div>  	

<br><br><br><br>
