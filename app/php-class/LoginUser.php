<?php 

namespace App;

use \App\DB\Sql;


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
	"user", "senha"
];




	public static function login($login, $password){

		$md5 = md5($password);

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_user WHERE user = :user", array(
			":user"=>$login
		));
		if(count($results) === 0) {
			header("Location: /leads/?login=invalido");
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

		} else {
			header("Location: /leads/?login=invalido");
			exit;
		}
	}


	public static function verifyLogin()
	{

		//$inadmin é uma verificação se o user poder entra por ser adm
		if(!isset($_SESSION["senha"]) || !$_SESSION["senha"]) {

			header("Location: /leads/");
			exit;

		}else{

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