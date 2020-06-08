<?php 

namespace App\configurar;

use \App\DB\Sql;

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
	"id_user", "user", "nivel", "email", "senhaAtual", "novaSenha"
];


// get


public static function usuarioDados($user){

  $sql = new Sql();
  return $sql->select("SELECT * FROM tb_user WHERE id_user = $user");

}


// quando atualizar deslogar


// post



public function atualizarDados($user){

   $sql = new Sql();


  if ($this->getuser() == '' || $this->getuser() == NULL) {
    header("Location: /".pastaPrincipal."/dashboard/configurar/atualizar-usuario/$user?login=Vazio");
    exit;
  }else{

    $results = $sql->select("UPDATE tb_user SET user = :user, email = :email WHERE (id_user = $user)", array(
       ":user"=>$this->getuser(),
       ":email"=>$this->getemail()
    ));

    setcookie("Atualizado", "Atualizado");

    header("Location: /".pastaPrincipal."/dashboard/configurar/atualizar-usuario/$user");
    exit;
  }


}


public function atualizarSenha($user){

  $sql = new Sql();

  if ($this->getnovaSenha() == '' || $this->getnovaSenha() == NULL) {
    header("Location: /".pastaPrincipal."/dashboard/configurar/atualizar-usuario/$user?senha=Vazio#senha");
    exit;

  }else{

    $results = $sql->select("UPDATE tb_user SET senha = :senha WHERE (id_user = $user)", array(
         ":senha"=>md5($this->getnovaSenha())
        
         ));

    setcookie("Atualizado", "Atualizado");

       header("Location: /".pastaPrincipal."/dashboard/configurar/atualizar-usuario/$user");
       exit;
      }

    



  
}





public function deletarUsuario($id){

  $sql = new Sql();

  echo "string".$id;

  $results = $sql->select("UPDATE tb_lead SET fk_id_user = 0 WHERE (fk_id_user = $id)");

  $results2 = $sql->select("UPDATE tb_followup SET fk_id_user = 0 WHERE (fk_id_user = $id)");

  $results3 = $sql->select("UPDATE tb_obs SET fk_id_user = 0 WHERE (fk_id_user = $id)");


  $results4 = $sql->select("DELETE FROM tb_user WHERE (id_user = $id)");

  setcookie("Atualizado", "Atualizado");




}







}


 ?>