<?php 

namespace App;

use \App\DB\Sql;
use \App\DB\Logs;


class LoginUser{

	const SESSION = "User";


	private $values = [];

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

	public function getValues()
	{
		return $this->values;
	}



/////



protected $fields = [
	"user", "senha", "valor1", "valor2", "totalvalores"
];




	public static function login($login, $password){

		$md5 = md5($password);

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_user WHERE user = :user", array(
			":user"=>$login
		));

		// var_dump($results);


		if ($results == null) {
			header("Location: /leads/?login=nulo");
			exit;
		}else{
			$cliente = $results[0]['fk_id_cliente'];
			$results2 = $sql->select("SELECT * FROM tb_cliente WHERE id_cliente = $cliente");
		}

		$cliente = $results[0]['fk_id_cliente'];


		




		if(count($results) === 0) {
			header("Location: /leads/?login=invalido");
			exit;
			
		}

		if($results[0]['user_status'] === "2" || $results2[0]['status_cliente'] === "2") {
			header("Location: /leads/?login=bloqueado");
			exit;
			
		}

		$data = $results[0];
		
		if ($md5 === $data["senha"]){
			echo "sim";

			var_dump($data);

			$_SESSION["id_user"] = $data["id_user"];

			$_SESSION["user"] = $data["user"];

			$_SESSION["senha"] = $data["senha"];

			$_SESSION["nivel"] = $data["nivel"];
			
			$_SESSION["fk_id_cliente"] = $data["fk_id_cliente"];

			$log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'),'Realizou login');

		} else {
			header("Location: /leads/?login=invalido");
			exit;
		}
	}


	public static function verifyLogin()
	{

		//$inadmin é uma verificação se o user poder entra por ser adm
		if(!isset($_SESSION["user"]) || !isset($_SESSION["senha"]) || !$_SESSION["senha"]) {

			

			header("Location: /leads/");
			exit;

		}else{

		}
	}

	
	public static function verifyNivelMaster()
	{

		//$inadmin é uma verificação se o user poder entra por ser adm
		if($_SESSION["nivel"] == 1 && $_SESSION["fk_id_cliente"] == 1) {

		}else{
			header("Location: /leads/dashboard");
			exit;
		}
	}


	public static function verifyNivel1()
	{

		//$inadmin é uma verificação se o user poder entra por ser adm
		if($_SESSION["nivel"] == 1) {

		}else{
			header("Location: /leads/dashboard");
			exit;
		}
	}


	public static function verifyNivel2()
	{

		//$inadmin é uma verificação se o user poder entra por ser adm
		if($_SESSION["nivel"] <= 2) {

		}else{
			header("Location: /leads/dashboard");
			exit;
		}
	}


	public static function logout()
	{
		$_SESSION["user"] = NULL;

		$_SESSION["senha"] = NULL;

		$_SESSION["nivel"] = NULL;

		$_SESSION["id_user"] = NULL;

		session_destroy();
	}


	public static function verifyNivel(){
		// aqui somente na pagina explusiva
		// fora disso verificar nivel para mostrar coisas na tela
		// admin faz tudo
		// gerente não atualiza só deleta
	}

	









}



 ?>