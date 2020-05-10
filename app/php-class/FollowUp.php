<?php 

namespace App;

use \App\DB\Sql;


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
	return $sql->select("SELECT * FROM tb_followup WHERE idlead = $idlead ORDER BY idfollowup DESC");

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
       $results = $sql->select("INSERT INTO tb_followup (texto, data, idlead, dataAtualizada) VALUES (:texto, :data, $idlead, :dataAtualizada)", array(
            ":texto"=>$this->gettextofollow(),
            ":data"=>date('Y-m-d'),
            ":dataAtualizada"=>date('Y-m-d H:i')
          ));

       

      }


}



public function deletarFollowUp($idlead){

  $sql = new Sql();
  $results = $sql->select("DELETE FROM tb_followup WHERE idfollowup = $idlead");
 

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

            $numero = rand(1, 15). "-";
              
            if(move_uploaded_file($file["tmp_name"], $dirUpload . DIRECTORY_SEPARATOR .$numero . $file["name"])){

              $arquivo = $numero . $file["name"];
              var_dump( $arquivo);


              $results = $sql->select("UPDATE tb_followup SET texto = :texto, dataAtualizada = :dataAtualizada, imagem = :imagem WHERE idfollowup = :idfollowup", array(
                      ":texto"=>$this->gettexto(),
                       ":dataAtualizada"=>date('Y-m-d H:i'),
                       ":imagem"=>$arquivo,
                       ":idfollowup"=>$this->getidfollowup()
                      ));
                  



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


   $results = $sql->select("UPDATE tb_followup SET texto = :texto, dataAtualizada = :dataAtualizada WHERE idfollowup = :idfollowup", array(
       ":texto"=>$this->gettexto(),
       ":dataAtualizada"=>date('Y-m-d H:i'),
       ":idfollowup"=>$this->getidfollowup()
      ));


   header("location: /".pastaPrincipal."/dashboard/follow-up/$idlead");
  exit;

}








public function salvarStatus($idlead){

  $sql = new Sql();
    
    $results = $sql->select("UPDATE tb_lead SET fk_status = :statusLead, dataAtualizada = :dataAtualizada WHERE idlead = $idlead", array(
       ":statusLead"=>$this->getstatusLead(),
       ":dataAtualizada"=>date('Y-m-d H:i')
      ));




}









}

 ?>