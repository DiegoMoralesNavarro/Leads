<?php 

namespace App\configurar;

use \App\DB\Sql;
use \App\DB\Logs;


class CadastrarUsuario{


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



 public static function listlog()
  {
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_logs");
  }





protected $fields = [
	"id_user", "user", "nivel", "email", "senha", "senhaconfirmar"
];




public function cadastrar(){

	$sql = new Sql();

	$nome = $this->getuser();

	$results = $sql->select("SELECT user FROM tb_user WHERE user = '$nome'");

	$nomeVerifica = count($results);

	if ($nomeVerifica == '' || $nomeVerifica == 0) {

		if ($this->getsenha() == $this->getsenhaconfirmar()) {

			$results = $sql->select("INSERT INTO tb_user (user, senha, nivel, dataCriado, email) VALUES (:user, :senha, :nivel, :data, :email)", array(
		       ":user"=>$this->getuser(),
		       ":senha"=>md5($this->getsenha()),
		       ":nivel"=>$this->getnivel(),
		       ":data"=>date('Y-m-d'),
		       ":email"=>$this->getemail()
		    ));

       $acao = "Cadastrado usuário <br> Nome: ". $this->getuser(). "<br> Nivel: ". $this->getnivel();

      $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);

		    setcookie("Atualizado", "Atualizado");
			
		}else{
			header("Location: /".pastaPrincipal."/dashboard/configurar/cadastrar-usuario?senha=errado");
    		exit;
		}
		
	}else{
		header("Location: /".pastaPrincipal."/dashboard/configurar/cadastrar-usuario?login=existente");
    	exit;
	}






}








}










 ?>