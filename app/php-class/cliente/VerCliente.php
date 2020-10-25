<?php 


namespace App\cliente;

use \App\DB\Sql;
use \App\DB\Logs;


class VerCliente{



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
	"nomecliente", "usuarioadm", "senha", "confirmarsenha", "email"
];




public static function nomecliente($id){

  $sql = new Sql();

  return $sql->select("SELECT * FROM tb_cliente where id_cliente = $id ");

}


public static function totalcontas(){

  $sql = new Sql();

  return $sql->select("SELECT * FROM tb_user where fk_id_cliente not like '1' ");

}


public static function totalarquivos(){

  $sql = new Sql();

  return $sql->select("SELECT * FROM tb_arquivo where fk_id_cliente not like '1' ");

}


public static function usuarioDados($id, $user){

  $sql = new Sql();

  return $sql->select("SELECT * FROM tb_user WHERE id_user = $user and fk_id_cliente = '$id'");

}



/////








public function listUsuario($val, $page, $itemsPerPage, $id){

  $start = ($page - 1) * $itemsPerPage;
  $idcliente = $id;

  if ($val  == "") {
     
    $sql = new Sql();
        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_user where fk_id_cliente = '$idcliente' ORDER BY user LIMIT $start, $itemsPerPage");

        $this->setData($results);


         $results2 = $sql->select("SELECT * FROM tb_user where fk_id_cliente = '$idcliente' AND user like '%$val%' ");

        $_SESSION["paginas"] = count($results2);

      }else{



        $sql = new Sql();
        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_user where fk_id_cliente = '$idcliente' AND user like '%$val%' ORDER BY user LIMIT $start, $itemsPerPage");

        $this->setData($results);


         $results2 = $sql->select("SELECT * FROM tb_user where where fk_id_cliente = '$idcliente' AND user like '%$val%' ");

        $_SESSION["paginas"] = count($results2);



      }




}







public function atualizarDados($id, $users){


   $sql = new Sql();
   $idcliente = $id;


  if ($this->getuser() == '' || $this->getuser() == NULL) {
     header("Location: /".pastaPrincipal."/dashboard/configurar/cliente/atualizar-usuario-cliente/$idcliente/editar/$users");
    exit;
  }else{

    $results = $sql->select("UPDATE tb_user SET user = :user, email = :email, user_status = :status WHERE (id_user = $users) and (fk_id_cliente = :idcliente)", array(
       ":user"=>$this->getuser(),
       ":email"=>$this->getemail(),
       ":idcliente"=>$idcliente,
       ":status"=>$this->getstatus()
    ));



    $tb_user = $sql->select("SELECT * FROM tb_user where id_user = $users and fk_id_cliente = '$idcliente'");

      $acao = "Atualizado os dados do usuário <br> Nome: ". $tb_user[0]['user'] ."<br> No administrador de clientes";

      $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);



    setcookie("Atualizado", "Atualizado");

    header("Location: /".pastaPrincipal."/dashboard/configurar/cliente/atualizar-usuario-cliente/$idcliente/editar/$users");
    exit;
  }


}






public function atualizarSenha($id, $users){

  $sql = new Sql();
  $idcliente = $id;

  if ($this->getnovaSenha() == '' || $this->getnovaSenha() == NULL) {
    header("Location: /".pastaPrincipal."/dashboard/configurar/cliente/atualizar-usuario-cliente/$idcliente/editar/$users");
    exit;

  }else{

    $results = $sql->select("UPDATE tb_user SET senha = :senha WHERE (id_user = $users) and (fk_id_cliente = :idcliente)", array(
         ":senha"=>md5($this->getnovaSenha()),
         ":idcliente"=>$idcliente
        
         ));

    $tb_user = $sql->select("SELECT * FROM tb_user where id_user = $users and fk_id_cliente = '$idcliente'");

      $acao = "Atualizado a senha do usuário <br> Nome: ". $tb_user[0]['user'] ."<br> No administrador de clientes";

      $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);

    setcookie("Atualizado", "Atualizado");

       header("Location: /".pastaPrincipal."/dashboard/configurar/cliente/atualizar-usuario-cliente/$idcliente/editar/$users");
    exit;
      }

    



  
}









}



 ?>