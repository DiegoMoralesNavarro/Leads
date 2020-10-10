<?php 

namespace App;

use \App\DB\Sql;
use \App\DB\Logs;


class Lembrete{

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
  "datafinal","textolembrete","idlead", "textolembretenovo", "idlembrete", "usuario"
];


// get


public static function followMinhaLista()
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    $meuid = $_SESSION["id_user"];
    $datahoje = date("Y-m-d");

    return $sql->select("SELECT * FROM tb_lembrete inner join tb_lead on tb_lembrete.fk_idlead = tb_lead.idlead where autor = $meuid and data_lembrete = '$datahoje' and tb_lembrete.fk_id_cliente = $idcliente");
  }


  public static function follow($idfollow)
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_followup inner join tb_lead on tb_followup.idlead = tb_lead.idlead where idfollowup = $idfollow and tb_followup.fk_id_cliente = $idcliente");
  }


  public static function followUsuario()
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT id_user, user, nivel FROM tb_user where user_status = 1 and fk_id_cliente = $idcliente");
  }



   public static function followLembrete($idfollow)
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_lembrete inner join tb_user on tb_lembrete.autor = tb_user.id_user where fk_idfollowup = $idfollow and tb_lembrete.fk_id_cliente = $idcliente order by date_criado desc");
  }


  public static function totalLembrete(){

  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];
  return $sql->select("SELECT * FROM tb_lembrete left join tb_followup on tb_lembrete.fk_idfollowup = tb_followup.idfollowup and tb_lembrete.fk_id_cliente = $idcliente");

}





//


public function cadastrarLembrete($idfollow){

  $sql = new Sql();

  $user = $this->getusuario();

  $val = $sql->select("SELECT user FROM tb_user where id_user = $user");


  $acao = "Lembrete cadastrado para o <br> Usurário: ".$val[0]['user'];

  $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);



  $datafinal = implode('-', array_reverse(explode('/', $this->getdatafinal()))); 



  $results = $sql->select("INSERT INTO tb_lembrete (autor, data_lembrete, date_criado, texto_lembrete, fk_idfollowup, fk_id_cliente, fk_idlead) VALUES (:iduser, :datafinal, :datacriado, :textolembrete, :idfollow, :idcliente, :idlead)", array(
       ":iduser"=>$this->getusuario(),
       ":datafinal"=>$datafinal,
       ":datacriado"=>date('Y-m-d'),
       ":textolembrete"=>$this->gettextolembrete(),
       ":idfollow"=>$idfollow,
        ":idcliente"=>$_SESSION["fk_id_cliente"],
        ":idlead"=>$this->getidlead()

      ));



  header("Location: /".pastaPrincipal."/dashboard/lembrete/$idfollow");
    exit;


}



public function atualizarLembrete($idfollow){

  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];


  $acao = "Lembrete atualizado do Follow up <br> Id: $idfollow";

  $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);


   $results = $sql->select("UPDATE tb_lembrete SET texto_lembrete = :textolembretenovo WHERE id_lembrete = :idlembrete and fk_id_cliente = :idcliente", array(
        ":idcliente"=>$_SESSION["fk_id_cliente"],
        ":textolembretenovo"=>$this->gettextolembretenovo(),
        ":idlembrete"=>$this->getidlembrete()

      ));



}


public function deletarLembrete($idlembrete, $idfollow){

  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];


  $acao = "Lembrete deletado do Follow up <br> Id: $idfollow";

  $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);


  $results = $sql->select("DELETE FROM tb_lembrete WHERE id_lembrete = $idlembrete and fk_idfollowup = $idfollow and fk_id_cliente = $idcliente");


}



public function deletarMeuLembrete($idlembrete, $idfollow){

  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];


  $acao = "Lembrete deletado do Follow up <br> Id: $idfollow";

  $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);


  $results = $sql->select("DELETE FROM tb_lembrete WHERE id_lembrete = $idlembrete and fk_idfollowup = $idfollow and fk_id_cliente = $idcliente");


}




/////

public function TodosMeusLembretes($page, $itemsPerPage){

  $start = ($page - 1) * $itemsPerPage;
  $idcliente = $_SESSION['fk_id_cliente'];

  $meuid = $_SESSION["id_user"];
  $datahoje = date("Y-m-d");

     
    $sql = new Sql();

    $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lembrete inner join tb_lead on tb_lembrete.fk_idlead = tb_lead.idlead where autor = $meuid and tb_lembrete.fk_id_cliente = $idcliente ORDER BY date_criado desc LIMIT $start, $itemsPerPage");

        $this->setData($results);


    $results2 = $sql->select("SELECT * FROM tb_lembrete inner join tb_lead on tb_lembrete.fk_idlead = tb_lead.idlead where autor = $meuid and tb_lembrete.fk_id_cliente = $idcliente ORDER BY date_criado ");

        $_SESSION["paginas"] = count($results2);


}





















}


 ?>