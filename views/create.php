



<div class="container">

  <div class="row">
    <div class="col s12">
      <h1>Cadastro de Lead</h1>
      
       <blockquote>Preencha todo os campos abaixo.</blockquote>
     </div>
  </div>

</div>


<div class="container">

  <div class="row">
    <div class="col s12 form">
      
      <a href="<?php echo URLestilo ?>/dashboard" 
        class="btn-floating btn-small waves-effect teal accent-4 " style="padding: 0 0px!important;">
        <i class="material-icons" >arrow_back</i></a>

      <form role="form" action="/<?php echo pastaPrincipal ?>/dashboard/cadastro" method="post" enctype="multipart/form-data">

      <div class="input-field col s12 l6">

        <div class="input-field col s12">
          <i class="material-icons prefix">person</i>
          <input type="text" id="nome" name="nome" required="" class="validate" maxlength="30">
          <label for="nome">Nome*</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">business</i>
          <input type="text" id="empresa" name="empresa" class="validate" maxlength="45">
          <label for="empresa">Empresa*</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">phone_iphone</i>
          <label for="telefone">Telefone* 119000-0000</label>
          <input type="tel" id="telefone" maxlength="14"  name="telefone" required="" class="validate" data-js="phone">
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">mail</i>
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" class="validate" maxlength="45">
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">web</i>
          <label for="site">Site</label>
          <input type="text" id="site" name="site" class="validate" maxlength="45">
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">mode_edit</i>
          <label for="obs">OBS</label>
          <textarea id="obs" name="obs" required="" class="materialize-textarea" maxlength="299"></textarea>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">explore</i>
          <select name="origemLead" >
      
            <?php foreach ($origem as $value){ ?>

              <option value="<?php echo $value['id_origem_lead'] ?>" >  <?php echo $value['tipo_origem'] ?> </option>

            <?php } ?> 
          </select>
          <label>Meio de Contato</label>
      </div>

      </div> <!-- coluna 1 -->

      <div class="input-field col s12 l6">

        

        <div class="input-field col s12">
          <div class="file-field input-field">
            <div class="btn">
              <span>File</span>
              <input type="file" name="fileUpload" accept=".pdf">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" placeholder="Carregue seu PDF">
            </div>
          </div>
        </div>

        <div class="input-field col s12" style="margin-top: 0;">
          <label for="servico">Serviço desejado</label>
        </div>

        <div class="input-field col s12">

          <?php foreach ($servico as $value) {?>
          <p>
            <label>
            <input type = "checkbox" class="filled-in"  name = "chkl[]"  value = "<?php echo $value['idservico'] ?>" >
            <span> <?php echo $value['tiposervico'] ?> </span>
            </label> 
          </p>
          <?php } ?>
          
        </div>

      </div> <!-- coluna 2 -->

      <div class="input-field col s12">

        <button class="btn waves-effect waves-light" type="submit" name="action">Cadastrar
          <i class="material-icons right">send</i>
        </button>

      </div>


      </form>
    </div>
  </div> <!-- row -->

</div>

<br><br>


<?php 



if(isset($_COOKIE['upload'])):
    echo "<p class='center green lighten-2 white-tect'>" ;
      echo $_COOKIE['upload'];
      setcookie("upload", '', time() - 2000);
    echo "</p>";

  elseif(isset($_COOKIE['uploadErro'])):
    echo "<p class='center red lighten-2 white-tect'>";
      echo $_COOKIE['uploadErro'];
      setcookie("uploadErro", '', time() - 2000);
    echo "</p>";

endif;

 ?> 