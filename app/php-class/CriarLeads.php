<?php 

namespace App;

use \App\DB\Sql;

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
	"tiposervico", "idservicoEditar", "tiposervicoEditar", "chkl", "email", "site", "origemLead"
];


// get


  public static function listServico()
  {
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_servico");
  }

public static function origem(){
   $sql = new Sql();
    return $sql->select("SELECT * FROM tb_origem_lead");
} 





// post


public function save(){


    if ($this->getnome() == "") {
      setcookie("uploadErro", "Informe Todos os dados do Lead");
      header("location: /".pastaPrincipal."/leads/cadastro");
      exit;

    }else{

      if($_SERVER["REQUEST_METHOD"] === "POST"){

         $file = $_FILES["fileUpload"];
         var_dump($this->getchkl());


         if ($file['name'] == '') {
           $this->cadastraUserSimples();
            header("location: /".pastaPrincipal."/leads");
            exit;
         }

          if($file["error"]){
            
            // $this->cadastraUser();
            // header("location: /".pastaPrincipal."/leads");
            // exit;

          }

          
          //criar um diretorio temporario
          $dirUpload = "uploads";

          if(!is_dir($dirUpload)){
            mkdir($dirUpload);
          }

        //PEGAR o nome do arquivo
        $extension = explode('.', $file['name']);
        //pegar a ultima posição
        $extension = end($extension);

        if ($extension == 'pdf') {
          
          $numero = rand(1, 15). "-";
          
          //verificar se o upload aconteceu
          if(move_uploaded_file($file["tmp_name"], $dirUpload . DIRECTORY_SEPARATOR .$numero . $file["name"])){

            $arquivo = $numero . $file["name"];
            $this->cadastraUser($arquivo);


            header("location: /".pastaPrincipal."/leads");
            exit;
          }


         }else{
          setcookie("uploadErro", "Formato inválido para anexo");
          header("location: /".pastaPrincipal."/leads/cadastro");
          exit;
         }

      } //if post

    }//if nome

}







public function cadastraUser($arquivo){

  $sql = new Sql();

    $results = $sql->select("CALL insert_lead(:nome, :telefone, :fk_status, :email, :site, :origemLead)", array(
      ":nome"=>$this->getnome(),
      ":telefone"=>$this->gettelefone(),
      ":fk_status"=>"5",
      ":email"=>$this->getemail(),
      ":site"=>$this->getsite(),
      ":origemLead"=>$this->getorigemLead()
    ));

    $results2 =  $sql->select("SELECT LAST_INSERT_ID()");
    $idlead = $results2[0]['LAST_INSERT_ID()'];

//arquivo $arquivo, $idlead
    $resultsArquivo = $sql->select("INSERT INTO tb_arquivo (arquivo, fk_idlead) VALUES (:arquivo, :idlead)", array(
          ":arquivo"=>$arquivo,
          ":idlead"=>$idlead
        ));

//

    if ($this->getchkl() == null) {

    }else{
      
      $checkbox1 = count($this->getchkl());
      for ($i=0; $i<$checkbox1; $i++) {  

       $results = $sql->select("INSERT INTO tb_categoria (idlead, idservico) VALUES (:idlead, :idservico)", array(
          ":idlead"=>$idlead,
          ":idservico"=>$this->getchkl()[$i]
        ));
      } 

    }//if


///
     if ($this->getobs() == null){
   
     }else{

       $results = $sql->select("INSERT INTO tb_obs (obs, fk_idlead) VALUES (:idobs, :idlead)", array(
          ":idobs"=>$this->getobs(),
          ":idlead"=>$idlead
        ));

     }

}



public function cadastraUserSimples(){

  $sql = new Sql();

    $results = $sql->select("CALL insert_lead(:nome, :telefone, :fk_status, :email, :site, :origemLead)", array(
      ":nome"=>$this->getnome(),
      ":telefone"=>$this->gettelefone(),
      ":fk_status"=>"5",
      ":email"=>$this->getemail(),
      ":site"=>$this->getsite(),
      ":origemLead"=>$this->getorigemLead()
    ));

    $results2 =  $sql->select("SELECT LAST_INSERT_ID()");
    $idlead = $results2[0]['LAST_INSERT_ID()'];


//

    if ($this->getchkl() == null) {

    }else{
      
      $checkbox1 = count($this->getchkl());
      for ($i=0; $i<$checkbox1; $i++) {  

       $results = $sql->select("INSERT INTO tb_categoria (idlead, idservico) VALUES (:idlead, :idservico)", array(
          ":idlead"=>$idlead,
          ":idservico"=>$this->getchkl()[$i]
        ));
      } 

    }//if


///
     if ($this->getobs() == null){
   
     }else{

       $results = $sql->select("INSERT INTO tb_obs (obs, fk_idlead) VALUES (:idobs, :idlead)", array(
          ":idobs"=>$this->getobs(),
          ":idlead"=>$idlead
        ));

     }

}








}


 ?>