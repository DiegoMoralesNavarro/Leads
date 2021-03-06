<?php 


namespace App;

use \App\DB\Sql;
use \App\DB\Logs;


class EditarServico{



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
	"tiposervico", "idservicoEditar", "tiposervicoEditar"
];


// get


  public static function listServico()
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_servico where fk_id_cliente = $idcliente");
  }








// pot


 public function saveServico(){
    $sql = new Sql();

    if ($this->gettiposervico() == "") {
      //vazio
    }else{
      $results = $sql->select("INSERT INTO tb_servico (tiposervico, fk_id_cliente) VALUES (:tiposervico, :idcliente)", array(
          
          ":tiposervico"=>$this->gettiposervico(),
          ":idcliente"=>$_SESSION["fk_id_cliente"]
        ));

      $acao = "Cadastrou um serviço <br> Nome: ". $this->gettiposervico();

      $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);

    }

  }



 public function saveServicoUpdate(){
    $sql = new Sql();
    
    $results = $sql->select("UPDATE tb_servico SET tiposervico = :tiposervico, fk_id_cliente = :idcliente WHERE idservico = :idservico and fk_id_cliente = :idcliente", array(
       ":idservico"=>$this->getidservicoEditar(),
        ":tiposervico"=>$this->gettiposervicoEditar(),
        ":idcliente"=>$_SESSION["fk_id_cliente"]
      ));

    $acao = "Atualizou o serviço para o<br> Nome: ". $this->gettiposervicoEditar();

    $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);

  }






public function ServicoDeletar($idservico){

   
    $sql = new Sql();
     $idcliente = $_SESSION['fk_id_cliente'];

  
     $verificar = $sql->select("SELECT idservico FROM tb_categoria where idservico = :idservico and id_cliente = :idcliente", array(
       ":idservico"=>$idservico,
       ":idcliente"=>$_SESSION["fk_id_cliente"]
      ));

     $servico = $sql->select("SELECT tiposervico FROM tb_servico where idservico = :idservico and fk_id_cliente = $idcliente", array(
       ":idservico"=>$idservico
      ));

     var_dump($verificar);


     if(count($verificar) > 0){
        header("location: /".pastaPrincipal."/dashboard/servico?delete=$idservico");
        exit; 

     }else{

        $acao = "Deletou o serviço - ". $servico[0]['tiposervico'];

        $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);


        $results = $sql->select("DELETE FROM tb_servico WHERE idservico = :idservico and fk_id_cliente = :idcliente", array(
         ":idservico"=>$idservico,
         ":idcliente"=>$_SESSION["fk_id_cliente"]
        ));

        header("location: /".pastaPrincipal."/dashboard/servico");
        exit; 

     }

    

  }










}



 ?>