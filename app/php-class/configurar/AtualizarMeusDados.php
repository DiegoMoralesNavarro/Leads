<?php 

namespace App\configurar;

use \App\DB\Sql;
use \App\DB\Logs;


class AtualizarMeusDados{

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
	"id_user", "user", "nivel", "email", "senhaAtual", "novaSenha"
];


// get


public static function meusDados($user){

  $sql = new Sql();
  return $sql->select("SELECT * FROM tb_user WHERE id_user = $user");

}


// quando atualizar deslogar


// post



public function atualizarDados($user){

   $sql = new Sql();


  if ($this->getuser() == '' || $this->getuser() == NULL) {
    header("Location: /leads/dashboard/configurar/atualizar-dados?login=Vazio");
    exit;
  }else{

    $results = $sql->select("UPDATE tb_user SET user = :user, email = :email WHERE (id_user = $user)", array(
       ":user"=>$this->getuser(),
       ":email"=>$this->getemail()
    ));


    $acao = "Atualizou os próprios dados";

    $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);


    setcookie("Atualizado", "Atualizado");

   header("Location: /".pastaPrincipal."/dashboard/logout");
    exit;
  }


}


public function atualizarSenha($user){

  $sql = new Sql();

  if ($this->getsenhaAtual() == '' || $this->getsenhaAtual() == NULL) {
    header("Location: /".pastaPrincipal."/dashboard/configurar/atualizar-dados?senha=Vazio#senha");
    exit;
  }else{
    //verificar se senha atual está correta
    $results = $sql->select("SELECT senha FROM tb_user WHERE id_user = $user");

    $md5 = md5($this->getsenhaAtual());

    if ($results[0]['senha'] == $md5) {

      if ($this->getnovaSenha() == '' || $this->getnovaSenha() == NULL) {
        header("Location: /".pastaPrincipal."/dashboard/configurar/atualizar-dados?senhaAtual=Vazio#senha");
        exit;
      }else{
        $results = $sql->select("UPDATE tb_user SET senha = :senha WHERE (id_user = $user)", array(
         ":senha"=>md5($this->getnovaSenha())
        ));


        $acao = "Atualizou a própria senha";

        $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);

        setcookie("Atualizado", "Atualizado");

       header("Location: /".pastaPrincipal."/dashboard/logout");
       exit;
      }

      

    }else{
      header("Location: /".pastaPrincipal."/dashboard/configurar/atualizar-dados?senha=Errado#senha");
    exit;
    }


  }




  
}













}


 ?>