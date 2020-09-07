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
	"idfollowup", "texto", "data", "idlead", "dataAtualizada", "imagem", "textofollow", "statusLead", "fileUpload", "fileUpload"
];





//get



public static function listFolloUp1($idlead){
  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];


 
      return $sql->select("SELECT * FROM tb_followup left JOIN tb_arquivo on tb_followup.fk_idtarquivo = tb_arquivo.idtarquivo inner join tb_user on tb_followup.fk_id_user = tb_user.id_user WHERE idlead = $idlead and tb_user.fk_id_cliente = $idcliente ORDER BY idfollowup DESC;");
 



}
///////






public static function listFolloUpVazio($idlead){
  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];

      return $sql->select("SELECT * FROM tb_followup WHERE idlead = $idlead and fk_id_cliente = $idcliente and fk_id_user = 0 ORDER BY idfollowup DESC");
  



}





public static function listLead($idlead){
  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];

  return $sql->select("SELECT * FROM tb_lead WHERE idlead = $idlead and fk_id_cliente = $idcliente");
}

public static function listStatus()
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];

    return $sql->select("SELECT * FROM tb_status where fk_id_cliente = $idcliente or fk_id_cliente = 0");
  }

public static function listAll($idlead)
{
  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];
  return $sql->select("SELECT * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus WHERE idlead = $idlead and tb_lead.fk_id_cliente = $idcliente");
}



public static function selectImg($idlead){
  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];
  return $sql->select("SELECT imagem FROM tb_followup where idlead = $idlead and fk_id_cliente = $idcliente");
  
}



//pot


public function cadastrarFollowUp($idlead){


  $sql = new Sql();

  if ($this->gettextofollow() == "") {
      //vazio
    }else{
       $results = $sql->select("INSERT INTO tb_followup (texto, dataf, idlead, dataAtualizada, fk_id_user, fk_id_cliente) VALUES (:texto, :data, $idlead, :dataAtualizada, :userId, :idcliente)", array(
            ":texto"=>$this->gettextofollow(),
            ":data"=>date('Y-m-d'),
            ":dataAtualizada"=>date('Y-m-d H:i'),
            ":userId"=>$_SESSION["id_user"],
            ":idcliente"=>$_SESSION["fk_id_cliente"]
          ));

       $results2 = $sql->select("UPDATE tb_lead SET ultimo_followup = :dataAtualizada WHERE (idlead = '$idlead') and (fk_id_cliente = :idcliente)", array(
         ":dataAtualizada"=>date('Y-m-d H:i'),
         ":idcliente"=>$_SESSION["fk_id_cliente"]
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

  $idcliente = $_SESSION['fk_id_cliente'];


  $tb_lead = $sql->select("SELECT * FROM tb_lead where idlead = $val and fk_id_cliente = $idcliente");

  $acao = "Deletado um Follow Up do lead <br> Nome: ". $tb_lead[0]['nome'];

  $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);




   $arquivo = $sql->select("SELECT * FROM tb_followup where idfollowup = $idlead");

  


   if ($arquivo[0]['fk_idtarquivo'] == null || $arquivo[0]['fk_idtarquivo'] == '') {



     $results = $sql->select("DELETE FROM tb_followup WHERE idfollowup = $idlead and fk_id_cliente = $idcliente");

     header("location: /".pastaPrincipal."/dashboard/follow-up/$val");
   exit; 

   
   }else{

 

    var_dump($idlead);//113
    var_dump($val); // 166

    $idtarquivo = $sql->select("SELECT * FROM tb_followup where idfollowup = $idlead");

    $arquivo = $idtarquivo[0]['fk_idtarquivo'];


    var_dump($arquivo);



    $this->deleteImg($idlead, $val, $arquivo);

    $results = $sql->select("DELETE FROM tb_arquivo WHERE idtarquivo = $arquivo and fk_id_cliente = $idcliente");

    $results = $sql->select("DELETE FROM tb_followup WHERE idfollowup = $idlead and fk_id_cliente = $idcliente");



    header("location: /".pastaPrincipal."/dashboard/follow-up/$val");
   exit; 


   }




  




}



public function salvarFollowUp($idlead){

  $sql = new Sql();




  $tb_followup = $sql->select("SELECT * FROM tb_followup where idfollowup = :idfollowup and fk_id_cliente = :idcliente",array(
     ":idfollowup"=>$this->getidfollowup(),
     ":idcliente"=>$_SESSION["fk_id_cliente"]
    ));

  var_dump($tb_followup);



 


  if ($tb_followup[0]['fk_idtarquivo'] == null || $tb_followup[0]['fk_idtarquivo'] == '') {

     echo "não tem";

    $this->salvarFollowUpSimples($idlead);



      if (isset($_FILES["fileUpload"])) {



           $file = $_FILES["fileUpload"];

         


        if ($file['name'] == '') {

          $this->salvarFollowUpSimples($idlead);

         }

          if($file["error"]){
            
            
          }


          $idcliente = $_SESSION["fk_id_cliente"];
        $nomePasta = $sql->select("SELECT * FROM tb_cliente where id_cliente = $idcliente");
          

             $dirUpload = $nomePasta[0]['nome_pasta'];

          if(!is_dir('uploads/'.$dirUpload)){
            mkdir('uploads/'.$dirUpload);
          }


          //PEGAR o nome do arquivo
          $extension = explode('.', $file['name']);
          //pegar a ultima posição
          $extension = end($extension);


          if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {

            $numero = rand(1, 900). "-";
              
            if(move_uploaded_file($file["tmp_name"], 'uploads/'. $dirUpload. DIRECTORY_SEPARATOR .$numero . $file["name"])){

              $tamanho = $file['size'];

              $arquivo = $numero . $file["name"];




              $results3 = $sql->select("INSERT INTO tb_arquivo (arquivo, tamanho, data, fk_idlead, fk_id_cliente, fk_idfollowup) VALUES (:arquivo, :tamanho, :data, :idlead, :idcliente, :idfollowup)", array(
               ":arquivo"=>$arquivo,
               ":tamanho"=>$tamanho,
               ":data"=>date('Y-m-d'),
               ":idlead"=>$idlead,
                ":idcliente"=>$_SESSION["fk_id_cliente"],
                ":idfollowup"=>$this->getidfollowup()

              ));

              $resul =  $sql->select("SELECT LAST_INSERT_ID()");
              $idarquivo = $resul[0]['LAST_INSERT_ID()'];

              var_dump($idarquivo);

              $results2 = $sql->select("UPDATE tb_followup SET fk_idtarquivo = :idarquivo WHERE (idfollowup = :idfollowup)", array(
                ":idarquivo"=>$idarquivo,
                ":idfollowup"=>$this->getidfollowup()
              ));




               header("location: /".pastaPrincipal."/dashboard/follow-up/$idlead");
                exit;

               } 

              
            }else{

             header("location: /".pastaPrincipal."/dashboard/follow-up/$idlead");
              exit;
            

          }




      }


   }else{

    echo "string";

    $this->salvarFollowUpSimples($idlead);

     header("location: /".pastaPrincipal."/dashboard/follow-up/$idlead");
    exit;


   }
   
 


    

   
}







public function salvarFollowUpSimples($idlead){


  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];


   $results = $sql->select("UPDATE tb_followup SET texto = :texto, dataAtualizada = :dataAtualizada, fk_id_user = :userId WHERE idfollowup = :idfollowup and fk_id_cliente = :idcliente", array(
       ":texto"=>$this->gettexto(),
       ":dataAtualizada"=>date('Y-m-d H:i'),
       ":userId"=>$_SESSION["id_user"],
       ":idfollowup"=>$this->getidfollowup(),
       ":idcliente"=>$_SESSION["fk_id_cliente"]
      ));


    $results2 = $sql->select("UPDATE tb_lead SET ultimo_followup = :dataAtualizada WHERE (idlead = '$idlead')", array(
       ":dataAtualizada"=>date('Y-m-d H:i')
      ));


    $datacriado = $sql->select("SELECT dataf FROM tb_followup where idfollowup = :idfollowup and fk_id_cliente = $idcliente", array(
      ":idfollowup"=>$this->getidfollowup()
    ));

  

    $tb_lead = $sql->select("SELECT * FROM tb_lead where idlead = $idlead and fk_id_cliente = $idcliente");

   

    $acao = "Atualizado o Follow Up do lead <br> Nome: ". $tb_lead[0]['nome'] ."<br> Criado em: ". $datacriado[0]['dataf'];

    $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);




  

}








public function salvarStatus($idlead){

  $sql = new Sql();

  $idcliente = $_SESSION['fk_id_cliente'];
    
    $results = $sql->select("UPDATE tb_lead SET fk_status = :statusLead, dataAtualizada = :dataAtualizada, fk_id_user_atualiza = :quemAtualizou WHERE idlead = $idlead and fk_id_cliente = $idcliente", array(
       ":statusLead"=>$this->getstatusLead(),
       ":dataAtualizada"=>date('Y-m-d H:i'),
       ":quemAtualizou"=>$_SESSION["id_user"]
      ));

  

    $status = $sql->select("SELECT * FROM tb_status where idstatus = :statusLead", array(
      ":statusLead"=>$this->getstatusLead()
    ));

    $tb_lead = $sql->select("SELECT * FROM tb_lead where idlead = $idlead and fk_id_cliente = $idcliente");

    $acao = "Atualizado o status do lead <br> Nome: ". $tb_lead[0]['nome'] ."<br> status: ". $status[0]['tipostatus'];

    $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);

  




}





public function deleteImg($idlead, $val, $arquivo){




$sql = new Sql();

$idcliente = $_SESSION['fk_id_cliente'];


$idfollow = $this->getidfollowup();


   $tb_arquivo = $sql->select("SELECT * FROM tb_arquivo where idtarquivo = $arquivo and fk_id_cliente = $idcliente");

  $nomePasta = $sql->select("SELECT * FROM tb_cliente where id_cliente = $idcliente ");


     
        $path = 'uploads/'.$nomePasta[0]['nome_pasta'].'/';
        $diretorio = dir($path);

         
        unlink($path.$tb_arquivo[0]['arquivo']);



}






public function deleteImg2($idlead, $val){




$sql = new Sql();

$idcliente = $_SESSION['fk_id_cliente'];


$idtarquivo = $sql->select("SELECT * FROM tb_followup where idfollowup = $idlead");

$arquivo = $idtarquivo[0]['fk_idtarquivo'];




  $tb_arquivo = $sql->select("SELECT * FROM tb_arquivo where idtarquivo = $arquivo and fk_id_cliente = $idcliente");

  $nomePasta = $sql->select("SELECT * FROM tb_cliente where id_cliente = $idcliente ");


     
        $path = 'uploads/'.$nomePasta[0]['nome_pasta'].'/';
        $diretorio = dir($path);

         
        unlink($path.$tb_arquivo[0]['arquivo']);




    $resultsarquivo = $sql->select("DELETE FROM tb_arquivo WHERE idtarquivo = $arquivo and fk_id_cliente = $idcliente");

    

  $resulfollowup = $sql->select("UPDATE tb_followup SET fk_idtarquivo = NULL WHERE idfollowup = $idlead");


 

    header("location: /".pastaPrincipal."/dashboard/follow-up/$val");
   exit; 
   




}









}

 ?>