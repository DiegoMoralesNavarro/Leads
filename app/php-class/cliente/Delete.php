<?php 


namespace App\cliente;

use \App\DB\Sql;
use \App\DB\Logs;


class Delete{



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
	"nomecliente"
];





public function deletarUserCliente($iduser, $id){


var_dump($iduser);
var_dump($id);

  $sql = new Sql();
  $idcliente = $id;

 
$nomecliente = $sql->select("SELECT nome_cliente FROM tb_cliente where id_cliente = $idcliente");



  $tb_user = $sql->select("SELECT * FROM tb_user where id_user = $iduser and fk_id_cliente = '$idcliente'");

      $acao = "Deletou o usuário <br> Nome: ". $tb_user[0]['user'] . "<br> Nome do cliente :" . $nomecliente[0]['nome_cliente'];

      $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);



  $results = $sql->select("UPDATE tb_lead SET fk_id_user = 0 WHERE fk_id_user = $iduser ");

  $results2 = $sql->select("UPDATE tb_followup SET fk_id_user = '0' WHERE fk_id_user = '$iduser' and fk_id_cliente = '$idcliente'");

  $results3 = $sql->select("UPDATE tb_obs SET fk_id_user = 0 WHERE (fk_id_user = $iduser) and (fk_id_cliente = $$idcliente)");



  $tb_lembrete = $sql->select("SELECT * FROM tb_lembrete where autor = $iduser");


 if(count($tb_lembrete) > 0){

  $results = $sql->select("DELETE FROM tb_lembrete WHERE autor = $iduser and fk_id_cliente = $idcliente");


  }



    $results4 = $sql->select("DELETE FROM tb_user WHERE (id_user = $iduser) and (fk_id_cliente = $idcliente)");

  setcookie("Atualizado", "Atualizado");







}











}



 ?>