<?php 



namespace App;

use \App\DB\Sql;
use \App\DB\Logs;


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
	"nome", "telefone", "statusLead", "obs", "fileUpload","email", "site", "origemLead", "empresa", "tomarposse"
];


// get

public static function listAll()
{
	$sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];
	return $sql->select("SELECT * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus where fk_id_cliente = $idcliente order by idlead");
}


public static function listId($idlead){
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus WHERE idlead = $idlead and tb_lead.fk_id_cliente = $idcliente");
  }

public static function listIdOrigem($idlead){
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_lead inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead WHERE idlead = $idlead and tb_lead.fk_id_cliente = $idcliente or tb_lead.fk_id_cliente = '0'");
  }  


public static function listAllId($idlead){
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_lead WHERE idlead = $idlead and fk_id_cliente = $idcliente");
  }

  public static function responsavel($idlead){
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_lead inner join tb_user on tb_user.id_user = tb_lead.fk_id_user WHERE idlead = $idlead and tb_user.fk_id_cliente = $idcliente");
  }

  public static function responsavelAtualizou($idlead){
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_lead inner join tb_user on tb_lead.fk_id_user_atualiza = tb_user.id_user WHERE idlead = $idlead and tb_user.fk_id_cliente = $idcliente");
  }


 public static function listObs($idlead)
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_obs WHERE fk_idlead = $idlead and fk_id_cliente = $idcliente");
  }


 public static function listStatus()
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_status where fk_id_cliente = $idcliente or fk_id_cliente = 0");
  }


 public static function servicoDesejado($idlead){
  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];
  return $sql->select("SELECT * FROM tb_servico WHERE fk_id_cliente = $idcliente and idservico IN(
          SELECT a.idservico
          FROM tb_servico a
          INNER JOIN tb_categoria b ON a.idservico = b.idservico
          WHERE b.idlead = $idlead
        )");
    // return $sql->select("call servico_ativo($idlead, $idcliente);");
}

public static function servicoNaoDesejado($idlead){
   $sql = new Sql();
   $idcliente = $_SESSION['fk_id_cliente'];
   return $sql->select("SELECT * FROM tb_servico WHERE fk_id_cliente = $idcliente and idservico not IN(
          SELECT a.idservico
          FROM tb_servico a
          INNER JOIN tb_categoria b ON a.idservico = b.idservico
          WHERE b.idlead = $idlead
        )");
    // return $sql->select("call servico_inativo($idlead, $idcliente);");
} 

public static function nomeArquivo($idlead){
   $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_arquivo WHERE fk_idlead = $idlead and fk_id_cliente = $idcliente and fk_idfollowup IS NULL");
} 

public static function origem(){
   $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_origem_lead where fk_id_cliente = $idcliente or fk_id_cliente = '0'");
} 

public static function rotaPastas(){
   $sql = new Sql();
   $idcliente = $_SESSION["fk_id_cliente"];
    return $sql->select("SELECT * FROM tb_cliente where id_cliente = $idcliente");
} 


// post

public function saveUpdateLead($idlead){
    $sql = new Sql();
    $idcliente = $_SESSION["fk_id_cliente"];
    
    $results = $sql->select("UPDATE tb_lead SET nome = :nome, empresa = :empresa, telefone = :telefone, email = :email, site = :site, fk_status = :statusLead, dataAtualizada = :dataAtualizada, fk_origem_lead = :origemLead, fk_id_user_atualiza = :quemAtualizou WHERE idlead = $idlead and fk_id_cliente = :idcliente", array(
       ":nome"=>$this->getnome(),
       ":empresa"=>$this->getempresa(),
        ":telefone"=>$this->gettelefone(),
        ":email"=>$this->getemail(),
        ":site"=>$this->getsite(),
        ":statusLead"=>$this->getstatusLead(),
        ":dataAtualizada"=>date('Y-m-d H:i'),
        ":origemLead"=>$this->getorigemLead(),
        ":quemAtualizou"=>$_SESSION["id_user"],
        ":idcliente"=>$_SESSION["fk_id_cliente"]

      ));


     $acao = "Atualizado os dados do lead<br> Nome: ". $this->getnome();

    $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);


    $results2 = $sql->select("SELECT * FROM tb_obs WHERE fk_idlead = $idlead");

    if (count($results2) > 0) {
        $results3 = $sql->select("UPDATE tb_obs SET obs = :obs WHERE fk_idlead = $idlead and fk_id_cliente = $idcliente", array(
           ":obs"=>$this->getobs()
      ));

    }else{

      $results3 = $sql->select("INSERT INTO tb_obs (obs, fk_idlead, fk_id_user, fk_id_cliente) VALUES (:obs, $idlead, 0, :idcliente)", array(
           ":obs"=>$this->getobs(),
           ":idcliente"=>$_SESSION["fk_id_cliente"]
      ));

    }

    


  }


public function adicionaServico($idlead){

  $sql = new Sql();
  $idcliente = $_SESSION["fk_id_cliente"];

  var_dump($idcliente);

  var_dump($idlead);

  var_dump($this->getidservicoadd());

  //var_dump($this->getidservicoadd());

  $results = $sql->select("INSERT INTO tb_categoria (idlead, idservico, id_cliente) VALUES (:idlead, :idservicoadd, :idcliente)", array(
        ":idlead"=>$idlead,
          ":idservicoadd"=>$this->getidservicoadd(),
          ":idcliente"=>$_SESSION["fk_id_cliente"]
    ));


   $results2 = $sql->select("UPDATE tb_lead SET dataAtualizada = :dataAtualizada WHERE idlead = $idlead and fk_id_cliente = $idcliente", array(
        ":dataAtualizada"=>date('Y-m-d H:i'),
      ));

   $results3 = $sql->select("UPDATE tb_lead SET fk_id_user_atualiza = :quemAtualizou WHERE idlead = $idlead and fk_id_cliente = $idcliente", array(
        ":quemAtualizou"=>$_SESSION["id_user"]

      ));

    

}

public function removeServico($idlead){

  $sql = new Sql();
  $idcliente = $_SESSION["fk_id_cliente"];
  // var_dump($this->getidserviconao());
  
   $results = $sql->select("DELETE FROM tb_categoria WHERE idlead = $idlead and idservico = :idserviconao and id_cliente = :idcliente", array(
         ":idserviconao"=>$this->getidserviconao(),
         ":idcliente"=>$_SESSION["fk_id_cliente"]
    ));

    $results2 = $sql->select("UPDATE tb_lead SET dataAtualizada = :dataAtualizada WHERE idlead = $idlead and fk_id_cliente = $idcliente", array(
        ":dataAtualizada"=>date('Y-m-d H:i'),
      ));

    $results3 = $sql->select("UPDATE tb_lead SET fk_id_user_atualiza = :quemAtualizou WHERE idlead = $idlead and fk_id_cliente = $idcliente", array(
        ":quemAtualizou"=>$_SESSION["id_user"]

      ));

   

 }



public function deleteArquivo($idlead){

  $sql = new Sql();
  $idcliente = $_SESSION["fk_id_cliente"];

   $tb_arquivo = $sql->select("SELECT * FROM tb_arquivo where fk_idlead = $idlead and fk_id_cliente = $idcliente");




    if(count($tb_arquivo) > 0){


       
        $nomePasta = $sql->select("SELECT * FROM tb_cliente where id_cliente = $idcliente");

       $results = $sql->select("DELETE FROM tb_arquivo WHERE fk_idlead = $idlead and fk_id_cliente = $idcliente");

        $path = 'uploads/'.$nomePasta[0]['nome_pasta'].'/';
        $diretorio = dir($path);


         
           unlink($path.$tb_arquivo[0]['arquivo']);

           var_dump($results);

           var_dump($tb_arquivo[0]['arquivo']);
         

      
        header("location: /".pastaPrincipal."/dashboard/editar/$idlead");
        exit; 

   }


}




public function gravarArquivo($idlead){

  $sql = new Sql();

  $tb_arquivo = $sql->select("SELECT * FROM tb_arquivo where fk_idlead = $idlead");


 


      if($_SERVER["REQUEST_METHOD"] === "POST"){

        $file = $_FILES["fileUpload"];
          if($file["error"]){
            
            $this->cadastraUser();
             header("location: /".pastaPrincipal."/dashboard/editar/$idlead");
            exit;

          }

       

          $idcliente = $_SESSION["fk_id_cliente"];
        $nomePasta = $sql->select("SELECT * FROM tb_cliente where id_cliente = $idcliente");

      

          //criar um diretorio temporario
             $dirUpload = $nomePasta[0]['nome_pasta'];

          if(!is_dir('uploads/'.$dirUpload.'/')){
            mkdir('uploads/'.$dirUpload.'/');
            echo $dirUpload;
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
                //
                  //arquivo $arquivo, $idlead
                  $resultsArquivo = $sql->select("INSERT INTO tb_arquivo (arquivo, tamanho, data, fk_idlead, fk_id_cliente) VALUES (:arquivo, :tamanho, :data, :idlead, :idcliente)", array(
                      ":arquivo"=>$arquivo,
                      ":tamanho"=>$tamanho,
                      ":data"=>date('Y-m-d'),
                      ":idlead"=>$idlead,
                      ":idcliente"=>$_SESSION["fk_id_cliente"]
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





}





public function tomarPosseLead($idlead){

  $sql = new Sql();


  $tb_lead = $sql->select("SELECT * FROM tb_lead where idlead = $idlead");


  $acao = "Tomou posse do lead<br> Nome: ". $tb_lead[0]['nome'];

  $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);




  $id = $_SESSION["id_user"];


  $reuslt = $sql->select("UPDATE tb_lead SET fk_id_user = $id WHERE idlead = $idlead");


  header("location: /".pastaPrincipal."/dashboard/editar/$idlead");
  exit; 

}







}

 ?>