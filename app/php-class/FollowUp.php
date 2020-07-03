<?php 

namespace App;

use \App\DB\Sql;
use \App\DB\Logs;


class FollowUp{


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
	"idfollowup", "texto", "data", "idlead", "dataAtualizada", "imagem", "textofollow", "statusLead", "fileUpload"
];





//get


public static function listFolloUp($idlead){
	$sql = new Sql();


  $results = $sql->select("SELECT * FROM tb_followup inner join tb_user on tb_followup.fk_id_user = tb_user.id_user WHERE idlead = $idlead ORDER BY idfollowup DESC");

  if (count($results) == 0 || count($results) == null) {
      return $sql->select("SELECT * FROM tb_followup WHERE idlead = $idlead ORDER BY idfollowup DESC");
  }else{
      return $sql->select("SELECT * FROM tb_followup inner join tb_user on tb_followup.fk_id_user = tb_user.id_user WHERE idlead = $idlead ORDER BY idfollowup DESC");
  }



}



public static function listFolloUpVazio($idlead){
  $sql = new Sql();

      return $sql->select("SELECT * FROM tb_followup WHERE idlead = $idlead and fk_id_user = 0 ORDER BY idfollowup DESC");
  



}





public static function listLead($idlead){
  $sql = new Sql();
  return $sql->select("SELECT * FROM tb_lead WHERE idlead = $idlead");
}

public static function listStatus()
  {
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_status");
  }

public static function listAll($idlead)
{
  $sql = new Sql();
  return $sql->select("SELECT * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus WHERE idlead = $idlead");
}



public static function selectImg($idlead){
  $sql = new Sql();

  return $sql->select("SELECT imagem FROM tb_followup where idlead = $idlead");
  
}



//pot


public function cadastrarFollowUp($idlead){


  $sql = new Sql();

  if ($this->gettextofollow() == "") {
      //vazio
    }else{
       $results = $sql->select("INSERT INTO tb_followup (texto, data, idlead, dataAtualizada, fk_id_user) VALUES (:texto, :data, $idlead, :dataAtualizada, :userId)", array(
            ":texto"=>$this->gettextofollow(),
            ":data"=>date('Y-m-d'),
            ":dataAtualizada"=>date('Y-m-d H:i'),
            ":userId"=>$_SESSION["id_user"]
          ));

       $results2 = $sql->select("UPDATE tb_lead SET ultimo_followup = :dataAtualizada WHERE (idlead = '$idlead')", array(
         ":dataAtualizada"=>date('Y-m-d H:i')
        ));




      $tb_lead = $sql->select("SELECT * FROM tb_lead where idlead = $idlead");

      $acao = "Criado um Follow Up para o lead <br> Nome: ". $tb_lead[0]['nome'];

      $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);




       header("location: /".pastaPrincipal."/dashboard/follow-up/$idlead");
      exit;

       

      }


}



public function deletarFollowUp($idlead, $val){


$sql = new Sql();

$imagemverifica = $sql->select("SELECT imagem FROM tb_followup WHERE idfollowup = $idlead");



$tb_lead = $sql->select("SELECT * FROM tb_lead where idlead = $val");

$acao = "Deletado um Follow Up do lead <br> Nome: ". $tb_lead[0]['nome'];

$log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);
 


 if ($imagemverifica[0]['imagem'] == '' || $imagemverifica == null){
     
 }else{
   $this->deleteImg($idlead);
   
 }



$results = $sql->select("DELETE FROM tb_followup WHERE idfollowup = $idlead");



$valor = $sql->select("SELECT * FROM tb_followup WHERE idlead = $val order by dataAtualizada desc limit 1");


if (count($valor) == 0 ) {

  $sql = new Sql();
  
  $results2 = $sql->select("UPDATE tb_lead SET ultimo_followup = :dataAtualizada WHERE (idlead = '$val')", array(
       ":dataAtualizada"=>"vazio"
      ));


  header("location: /".pastaPrincipal."/dashboard/follow-up/$val");
   exit; 

}else{

  $sql = new Sql();
  $results3 = $sql->select("UPDATE tb_lead SET ultimo_followup = :dataAtualizada WHERE (idlead = '$val')", array(
       ":dataAtualizada"=>$valor[0]['dataAtualizada']
      ));

  header("location: /".pastaPrincipal."/dashboard/follow-up/$val");
   exit; 
   
}




}



public function salvarFollowUp($idlead){

  $sql = new Sql();

  $tb_followup = $sql->select("SELECT imagem FROM tb_followup where idfollowup = :idfollowup",array(
    
     ":idfollowup"=>$this->getidfollowup()
    ));
 


  if ($tb_followup[0]['imagem'] == null) {

  
  

     if($_SERVER["REQUEST_METHOD"] === "POST"){

        $file = $_FILES["fileUpload"];


        if ($file['name'] == '') {

          $this->salvarFollowUpSimples($idlead);

         }

          if($file["error"]){
            
            
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

          if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {

            $numero = rand(1, 200). "-";
              
            if(move_uploaded_file($file["tmp_name"], $dirUpload . DIRECTORY_SEPARATOR .$numero . $file["name"])){

              $arquivo = $numero . $file["name"];
              var_dump( $arquivo);


              $results = $sql->select("UPDATE tb_followup SET texto = :texto, dataAtualizada = :dataAtualizada, imagem = :imagem, fk_id_user = :userId WHERE idfollowup = :idfollowup", array(
                      ":texto"=>$this->gettexto(),
                       ":dataAtualizada"=>date('Y-m-d H:i'),
                       ":imagem"=>$arquivo,
                       ":idfollowup"=>$this->getidfollowup(),
                       ":userId"=>$_SESSION["id_user"]
                      ));

              $results2 = $sql->select("UPDATE tb_lead SET ultimo_followup = :dataAtualizada WHERE (idlead = '$idlead')", array(
               ":dataAtualizada"=>date('Y-m-d H:i')
              ));


              $datacriado = $sql->select("SELECT data FROM tb_followup where idfollowup = :idfollowup", array(
                ":idfollowup"=>$this->getidfollowup()
              ));

              $tb_lead = $sql->select("SELECT * FROM tb_lead where idlead = $idlead");

              $acao = "Atualizado o Follow Up do lead <br> Nome: ". $tb_lead[0]['nome'] ."<br> Criado em: ". $datacriado[0]['data'];

              $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);
                  



               header("location: /".pastaPrincipal."/dashboard/follow-up/$idlead");
                exit;

              
            }else{

             header("location: /".pastaPrincipal."/dashboard/follow-up/$idlead");
              exit;
             }

              

          }


        }

  }else{


    $this->salvarFollowUpSimples($idlead);


  }
    

   
}



public function salvarFollowUpSimples($idlead){


  $sql = new Sql();


   $results = $sql->select("UPDATE tb_followup SET texto = :texto, dataAtualizada = :dataAtualizada, fk_id_user = :userId WHERE idfollowup = :idfollowup", array(
       ":texto"=>$this->gettexto(),
       ":dataAtualizada"=>date('Y-m-d H:i'),
       ":userId"=>$_SESSION["id_user"],
       ":idfollowup"=>$this->getidfollowup()
      ));


    $results2 = $sql->select("UPDATE tb_lead SET ultimo_followup = :dataAtualizada WHERE (idlead = '$idlead')", array(
       ":dataAtualizada"=>date('Y-m-d H:i')
      ));


    $datacriado = $sql->select("SELECT data FROM tb_followup where idfollowup = :idfollowup", array(
      ":idfollowup"=>$this->getidfollowup()
    ));

    $tb_lead = $sql->select("SELECT * FROM tb_lead where idlead = $idlead");

    $acao = "Atualizado o Follow Up do lead <br> Nome: ". $tb_lead[0]['nome'] ."<br> Criado em: ". $datacriado[0]['data'];

    $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);




   header("location: /".pastaPrincipal."/dashboard/follow-up/$idlead");
  exit;

}








public function salvarStatus($idlead){

  $sql = new Sql();
    
    $results = $sql->select("UPDATE tb_lead SET fk_status = :statusLead, dataAtualizada = :dataAtualizada, fk_id_user_atualiza = :quemAtualizou WHERE idlead = $idlead", array(
       ":statusLead"=>$this->getstatusLead(),
       ":dataAtualizada"=>date('Y-m-d H:i'),
       ":quemAtualizou"=>$_SESSION["id_user"]
      ));

  

    $status = $sql->select("SELECT * FROM tb_status where idstatus = :statusLead", array(
      ":statusLead"=>$this->getstatusLead()
    ));

    $tb_lead = $sql->select("SELECT * FROM tb_lead where idlead = $idlead");

    $acao = "Atualizado o status do lead <br> Nome: ". $tb_lead[0]['nome'] ."<br> status: ". $status[0]['tipostatus'];

    $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);

  




}





public function deleteImg($idlead){




$sql = new Sql();

   $tb_arquivo = $sql->select("SELECT imagem FROM tb_followup where idfollowup = $idlead");


    if(!$tb_arquivo == '' || !$tb_arquivo == null){






      var_dump($tb_arquivo);
     
        $path = "uploads/";
        $diretorio = dir($path);
         
           unlink($path.$tb_arquivo[0]['imagem']);


         $results = $sql->select("UPDATE tb_followup SET dataAtualizada = :dataAtualizada, imagem = '' WHERE idfollowup = $idlead", array(
       ":dataAtualizada"=>date('Y-m-d H:i')
      )); 

   
        

   }





}









}

 ?>