<?php 

namespace App;

use \App\DB\Sql;
use \App\DB\Logs;


class CriarLeads{

  public $values = [];

    public function __call($name, $args)
    {
       $method = substr($name, 0, 3);
       $fieldName = substr($name, 3, strlen($name));
       switch ($method)
       {
           case "get":
                           return (isset($this->values[$fieldName])) ? $this->values[$fieldName] : NULL;
           break;
           case "set":
                           $this->values[$fieldName] = $args[0];
           break;
       }
    }

    public function setData($arrayProduto = array())
    {
       foreach ($arrayProduto as $key => $value) {
                      
           $this->{"set".$key}($value);
                      
       }

    }







protected $fields = [
  "tiposervico", "idservicoEditar", "tiposervicoEditar", "chkl", "email", "site", "origemLead", "empresa", "telefone", "obs"
];


// get


  public static function listServico()
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_servico where fk_id_cliente = $idcliente");
  }

public static function origem(){
   $sql = new Sql();
   $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_origem_lead where fk_id_cliente = $idcliente or fk_id_cliente = '0'");
} 





// post


public function save(){


    if ($this->getnome() == "") {
      setcookie("uploadErro", "Informe Todos os dados do Lead");
      header("location: /".pastaPrincipal."/dashboard/cadastro");
      exit;

    }else{

      if($_SERVER["REQUEST_METHOD"] === "POST"){

         $file = $_FILES["fileUpload"];


        
        


         if ($file['name'] == '') {
           $this->cadastraUserSimples();
            header("location: /".pastaPrincipal."/dashboard");
            exit;
         }

          if($file["error"]){
            
            // $this->cadastraUser();
            // header("location: /".pastaPrincipal."/dashboard");
            // exit;

          }


          $sql = new Sql();
          $idcliente = $_SESSION["fk_id_cliente"];
          $nomePasta = $sql->select("SELECT * FROM tb_cliente where id_cliente = $idcliente");

          
          //criar um diretorio temporario
          $dirUpload = $nomePasta[0]['nome_pasta'];

          if(!is_dir('uploads/'.$dirUpload)){
            mkdir('uploads/'.$dirUpload);
          }

        //PEGAR o nome do arquivo
        $extension = explode('.', $file['name']);
        //pegar a ultima posição
        $extension = end($extension);

        if ($extension == 'pdf') {
          
          $numero = rand(1, 200). "-";
          
          //verificar se o upload aconteceu
          if(move_uploaded_file($file["tmp_name"], 'uploads/'.$dirUpload . DIRECTORY_SEPARATOR .$numero . $file["name"])){

            $tamanho = $file['size'];

            $arquivo = $numero . $file["name"];
            $this->cadastraUser($arquivo, $tamanho);


            header("location: /".pastaPrincipal."/dashboard");
            exit;
          }


         }else{
          setcookie("uploadErro", "Formato inválido para anexo");
          header("location: /".pastaPrincipal."/dashboard/cadastro");
          exit;
         }

      } //if post

    }//if nome

}







public function cadastraUser($arquivo, $tamanho){

  // var_dump($this->getnome());
  // var_dump($this->getempresa());
  // var_dump($this->gettelefone());
  // var_dump($this->getemail());
  // var_dump($this->getobs());

  $sql = new Sql();

    $results = $sql->select("CALL insert_lead(:nome, :empresa, :telefone, :fk_status, :email, :site, :origemLead, :idcliente)", array(
      ":nome"=>$this->getnome(),
      ":empresa"=>$this->getempresa(),
      ":telefone"=>$this->gettelefone(),
      ":fk_status"=>"1",
      ":email"=>$this->getemail(),
      ":site"=>$this->getsite(),
      ":origemLead"=>$this->getorigemLead(),
      ":idcliente"=>$_SESSION["fk_id_cliente"]
    ));

    $results2 =  $sql->select("SELECT LAST_INSERT_ID()");
    $idlead = $results2[0]['LAST_INSERT_ID()'];


  

//arquivo $arquivo, $idlead
    $resultsArquivo = $sql->select("INSERT INTO tb_arquivo (arquivo, tamanho, data, fk_idlead, fk_id_cliente) VALUES (:arquivo, :tamanho, :data, :idlead, :idcliente)", array(
          ":arquivo"=>$arquivo,
          ":tamanho"=>$tamanho,
          ":data"=>date('Y-m-d'),
          ":idlead"=>$idlead,
          ":idcliente"=>$_SESSION["fk_id_cliente"]
        ));

//

    if ($this->getchkl() == null) {

    }else{
      
      $checkbox1 = count($this->getchkl());
      for ($i=0; $i<$checkbox1; $i++) {  

       $results = $sql->select("INSERT INTO tb_categoria (idlead, idservico, id_cliente) VALUES (:idlead, :idservico, :idcliente)", array(
          ":idlead"=>$idlead,
          ":idservico"=>$this->getchkl()[$i],
          ":idcliente"=>$_SESSION["fk_id_cliente"]
        ));
      } 

    }//if


///
     if ($this->getobs() == null || $this->getobs() == ""){
   
     }else{

       $results = $sql->select("INSERT INTO tb_obs (obs, fk_idlead, fk_id_user, fk_id_cliente) VALUES (:idobs, :idlead, 0, :idcliente)", array(
          ":idobs"=>$this->getobs(),
          ":idlead"=>$idlead,
          ":idcliente"=>$_SESSION["fk_id_cliente"]
        ));

     }

}



public function cadastraUserSimples(){

  //   var_dump($this->getnome());
  // var_dump($this->getempresa());
  // var_dump($this->gettelefone());
  // var_dump($this->getemail());
  // var_dump($this->getobs());

  $sql = new Sql();

    $results = $sql->select("CALL insert_lead(:nome, :empresa, :telefone, :fk_status, :email, :site, :origemLead, :idcliente)", array(
      ":nome"=>$this->getnome(),
      ":empresa"=>$this->getempresa(),
      ":telefone"=>$this->gettelefone(),
      ":fk_status"=>"1",
      ":email"=>$this->getemail(),
      ":site"=>$this->getsite(),
      ":origemLead"=>$this->getorigemLead(),
      ":idcliente"=>$_SESSION["fk_id_cliente"]
    ));



    $results2 =  $sql->select("SELECT LAST_INSERT_ID()");
    $idlead = $results2[0]['LAST_INSERT_ID()'];



    $nomeLead = $sql->select("SELECT nome FROM tb_lead where idlead = :idlead", array(
       ":idlead"=>$idlead
      ));

    $acao = "Cadastrou o lead<br> Nome: ". $nomeLead[0]['nome'];

    $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);


//

    if ($this->getchkl() == null) {

    }else{
      
      $checkbox1 = count($this->getchkl());
      for ($i=0; $i<$checkbox1; $i++) {  

       $results = $sql->select("INSERT INTO tb_categoria (idlead, idservico, id_cliente) VALUES (:idlead, :idservico, :idcliente)", array(
          ":idlead"=>$idlead,
          ":idservico"=>$this->getchkl()[$i],
          ":idcliente"=>$_SESSION["fk_id_cliente"]
        ));
      } 

    }//if


///
     if ($this->getobs() == null){
   
     }else{

       $results = $sql->select("INSERT INTO tb_obs (obs, fk_idlead, fk_id_user, fk_id_cliente) VALUES (:idobs, :idlead, 0, :idcliente)", array(
          ":idobs"=>$this->getobs(),
          ":idlead"=>$idlead,
          ":idcliente"=>$_SESSION["fk_id_cliente"]
        ));

     }

}








}


 ?>