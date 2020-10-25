<?php 


namespace App\cliente;

use \App\DB\Sql;
use \App\DB\Logs;


class ListarCliente{



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
  "tudo", "chkl"
];



public static function totalContas($id){

  $sql = new Sql();

  return $sql->select("SELECT count(user) FROM tb_user where fk_id_cliente = $id ");

}

public static function totalLeads($id){

  $sql = new Sql();

  return $sql->select("SELECT count(nome) FROM tb_lead where fk_id_cliente = $id ");
  
}

public static function totalArquivos($id){

  $sql = new Sql();

  return $sql->select("SELECT count(arquivo) FROM tb_arquivo where fk_id_cliente = $id ");

}

public static function totalConsumo($id){

  $sql = new Sql();

  return $sql->select("SELECT sum(tamanho) FROM tb_arquivo where fk_id_cliente = $id ");

}






}



 ?>