<?php 


namespace App\cliente;

use \App\DB\Sql;
use \App\DB\Logs;


class EditarDadosClientes{



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
	"nomecliente", "status", "consumo"
];



public static function limiteConsumo($id){

  $sql = new Sql();

  return $sql->select("SELECT consumo FROM tb_cliente where id_cliente = $id ");

}





public function atualizarDadosCliente($id){


  $sql = new Sql();

  $nomeempresa =  $sql->select("SELECT nome_cliente FROM tb_cliente where nome_cliente = :nome", array(
           ":nome"=>$this->getnomecliente()
  ));


  $val = $this->getconsumo();
  $v1 = ($val*1000)/1;
  $v2 = ($v1*1000)/1;


  $results = $sql->select("UPDATE tb_cliente SET nome_cliente = :nome_cliente, status_cliente = :status_cliente, consumo = :consumo WHERE (id_cliente = $id) ", array(
       ":nome_cliente"=>$this->getnomecliente(),
       ":status_cliente"=>$this->getstatus(),
       ":consumo"=>$v2
    ));






}







}



 ?>