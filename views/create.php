



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
      <form role="form" action="/<?php echo pastaPrincipal ?>/leads/cadastro" method="post" enctype="multipart/form-data">

      <div class="input-field col s12 l6">

        <div class="input-field col s12">
          <i class="material-icons prefix">person</i>
          <input type="text" id="nome" name="nome" required="" class="validate" maxlength="30">
          <label for="nome">Nome*</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">phone_iphone</i>
          <label for="telefone">Telefone*</label>
          <input type="tel" id="telefone" name="telefone" required="" class="validate" maxlength="25">
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
          <textarea id="obs" name="obs" required="" class="materialize-textarea" maxlength="100"></textarea>
        </div>

      </div> <!-- coluna 1 -->

      <div class="input-field col s12 l6">

        <div class="input-field col s12">
          <select name="origemLead" >
      
            <?php foreach ($origem as $value){ ?>

              <option value="<?php echo $value['id_origem_lead'] ?>" >  <?php echo $value['tipo_origem'] ?> </option>

            <?php } ?> 
          </select>
          <label>Origem do Lead</label>
      </div>

        <div class="input-field col s12">
          <div class="file-field input-field">
            <div class="btn">
              <span>File</span>
              <input type="file" name="fileUpload">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" placeholder="Carregue seu PDF">
            </div>
          </div>
        </div>

        <div class="input-field col s12">
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