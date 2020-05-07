<?php 



namespace App;

use \App\DB\Sql;


class EditarUser{






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
	"nome", "telefone", "statusLead", "obs", "fileUpload","email", "site", "origemLead"
];


// get

public static function listAll()
{
	$sql = new Sql();
	return $sql->select("SELECT * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus order by idlead");
}


public static function listId($idlead){
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus WHERE idlead = $idlead");
  }

public static function listIdOrigem($idlead){
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_lead inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead WHERE idlead = $idlead");
  }  


public static function listAllId($idlead){
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_lead WHERE idlead = $idlead");
  }


 public static function listObs($idlead)
  {
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_obs WHERE fk_idlead = $idlead");
  }


 public static function listStatus()
  {
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_status");
  }


 public static function servicoDesejado($idlead){
  $sql = new Sql();
    return $sql->select("call servico_ativo($idlead);");
}

public static function servicoNaoDesejado($idlead){
   $sql = new Sql();
    return $sql->select("call servico_inativo($idlead);");
} 

public static function nomeArquivo($idlead){
   $sql = new Sql();
    return $sql->select("SELECT * FROM tb_arquivo WHERE fk_idlead = $idlead");
} 

public static function origem(){
   $sql = new Sql();
    return $sql->select("SELECT * FROM tb_origem_lead");
} 





// post

public function saveUpdateLead($idlead){
    $sql = new Sql();
    
    $results = $sql->select("UPDATE tb_lead SET nome = :nome, telefone = :telefone, email = :email, site = :site, fk_status = :statusLead, dataAtualizada = :dataAtualizada, fk_origem_lead = :origemLead WHERE idlead = $idlead", array(
       ":nome"=>$this->getnome(),
        ":telefone"=>$this->gettelefone(),
        ":email"=>$this->getemail(),
        ":site"=>$this->getsite(),
        ":statusLead"=>$this->getstatusLead(),
        ":dataAtualizada"=>date('Y-m-d H:i'),
        ":origemLead"=>$this->getorigemLead()

      ));


    $results2 = $sql->select("SELECT * FROM tb_obs WHERE fk_idlead = $idlead");

    if (count($results2) > 0) {
        $results3 = $sql->select("UPDATE tb_obs SET obs = :obs WHERE fk_idlead = $idlead", array(
           ":obs"=>$this->getobs()
      ));

    }else{

      $results3 = $sql->select("INSERT INTO tb_obs (obs, fk_idlead) VALUES (:obs, $idlead)", array(
           ":obs"=>$this->getobs()
      ));

    }

    


  }


public function adicionaServico($idlead){

  $sql = new Sql();

  // var_dump($this->getidservicoadd());

  $results = $sql->select("INSERT INTO tb_categoria (idlead, idservico) VALUES ($idlead, :idservicoadd)", array(
          ":idservicoadd"=>$this->getidservicoadd()
    ));


   $results2 = $sql->select("UPDATE tb_lead SET dataAtualizada = :dataAtualizada WHERE idlead = $idlead", array(
        ":dataAtualizada"=>date('Y-m-d H:i'),
      ));

}

public function removeServico($idlead){

  $sql = new Sql();
  // var_dump($this->getidserviconao());
  
   $results = $sql->select("DELETE FROM tb_categoria WHERE idlead = $idlead and idservico = :idserviconao", array(
         ":idserviconao"=>$this->getidserviconao()
    ));

    $results2 = $sql->select("UPDATE tb_lead SET dataAtualizada = :dataAtualizada WHERE idlead = $idlead", array(
        ":dataAtualizada"=>date('Y-m-d H:i'),
      ));


 }



public function deleteArquivo($idlead){

  $sql = new Sql();

   $tb_arquivo = $sql->select("SELECT * FROM tb_arquivo where fk_idlead = $idlead");


    if(count($tb_arquivo) > 0){
       $results = $sql->select("DELETE FROM tb_arquivo WHERE fk_idlead = $idlead");

        $path = "uploads/";
        $diretorio = dir($path);


         
           unlink($path.$tb_arquivo[0]['arquivo']);
         

      
        header("location: /".pastaPrincipal."/dashboard/editar/$idlead");
        exit; 

   }


}




public function gravarArquivo($idlead){

  $sql = new Sql();

  $tb_arquivo = $sql->select("SELECT * FROM tb_arquivo where fk_idlead = $idlead");


  if(count($tb_arquivo) > 0){


  }else{


      if($_SERVER["REQUEST_METHOD"] === "POST"){

        $file = $_FILES["fileUpload"];
          if($file["error"]){
            
            $this->cadastraUser();
             header("location: /".pastaPrincipal."/dashboard/editar/$idlead");
            exit;

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
                //
                  //arquivo $arquivo, $idlead
                  $resultsArquivo = $sql->select("INSERT INTO tb_arquivo (arquivo, fk_idlead) VALUES (:arquivo, :idlead)", array(
                      ":arquivo"=>$arquivo,
                      ":idlead"=>$idlead
                    ));
                //
                header("location: /".pastaPrincipal."/dashboard/editar/$idlead");
                exit;

             }else{
              setcookie("uploadErro", "Formato inválido para anexo");
              header("location: /".pastaPrincipal."/dashboard/editar/$idlead");
              exit;
             }

          } //if post

      }//if

  }//count



}







}

 ?>