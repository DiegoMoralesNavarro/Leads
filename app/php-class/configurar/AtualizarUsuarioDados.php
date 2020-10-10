<?php 

namespace App\configurar;

use \App\DB\Sql;
use \App\DB\Logs;

class AtualizarUsuarioDados{

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
	"id_user", "user", "nivel", "email", "senhaAtual", "novaSenha", "status"
];


// get


public static function usuarioDados($user){

  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];
  return $sql->select("SELECT * FROM tb_user WHERE id_user = $user and fk_id_cliente = '$idcliente'");

}


// quando atualizar deslogar


// post



public function atualizarDados($user){

   $sql = new Sql();
   $idcliente = $_SESSION['fk_id_cliente'];


  if ($this->getuser() == '' || $this->getuser() == NULL) {
    header("Location: /".pastaPrincipal."/dashboard/configurar/atualizar-usuario/$user?login=Vazio");
    exit;
  }else{

    $results = $sql->select("UPDATE tb_user SET user = :user, email = :email, user_status = :status WHERE (id_user = $user) and (fk_id_cliente = :idcliente)", array(
       ":user"=>$this->getuser(),
       ":email"=>$this->getemail(),
       ":idcliente"=>$_SESSION["fk_id_cliente"],
       ":status"=>$this->getstatus()
    ));



    $tb_user = $sql->select("SELECT * FROM tb_user where id_user = $user and fk_id_cliente = '$idcliente'");

      $acao = "Atualizado os dados do usuário <br> Nome: ". $tb_user[0]['user'];

      $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);



    setcookie("Atualizado", "Atualizado");

    header("Location: /".pastaPrincipal."/dashboard/configurar/atualizar-usuario/$user");
    exit;
  }


}


public function atualizarSenha($user){

  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];

  if ($this->getnovaSenha() == '' || $this->getnovaSenha() == NULL) {
    header("Location: /".pastaPrincipal."/dashboard/configurar/atualizar-usuario/$user?senha=Vazio#senha");
    exit;

  }else{

    $results = $sql->select("UPDATE tb_user SET senha = :senha WHERE (id_user = $user) and (fk_id_cliente = :idcliente)", array(
         ":senha"=>md5($this->getnovaSenha()),
         ":idcliente"=>$_SESSION["fk_id_cliente"]
        
         ));

    $tb_user = $sql->select("SELECT * FROM tb_user where id_user = $user and fk_id_cliente = '$idcliente'");

      $acao = "Atualizado a senha do usuário <br> Nome: ". $tb_user[0]['user'];

      $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);

    setcookie("Atualizado", "Atualizado");

       header("Location: /".pastaPrincipal."/dashboard/configurar/atualizar-usuario/$user");
       exit;
      }

    



  
}





public function deletarUsuario($id){

  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];

 


  $tb_user = $sql->select("SELECT * FROM tb_user where id_user = $id and fk_id_cliente = '$idcliente'");

      $acao = "Deletou o usuário <br> Nome: ". $tb_user[0]['user'];

      $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);



  $results = $sql->select("UPDATE tb_lead SET fk_id_user = 0 WHERE fk_id_user = $id ");

  $results2 = $sql->select("UPDATE tb_followup SET fk_id_user = '0' WHERE fk_id_user = '$id' and fk_id_cliente = '$idcliente'");

  $results3 = $sql->select("UPDATE tb_obs SET fk_id_user = 0 WHERE (fk_id_user = $id) and (fk_id_cliente = $$idcliente)");



  $tb_lembrete = $sql->select("SELECT * FROM tb_lembrete where autor = $id");


 if(count($tb_lembrete) > 0){

  $results = $sql->select("DELETE FROM tb_lembrete WHERE autor = $id and fk_id_cliente = $idcliente");


  }





  // $results4 = $sql->select("DELETE FROM tb_user WHERE (id_user = $id) and (fk_id_cliente = $idcliente)");

  // setcookie("Atualizado", "Atualizado");




}







}


 ?>