<?php 


namespace App\configurar;

use \App\DB\Sql;


class MostrarLogs{



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
	"id_user", "responsavel"
];




 public static function user()
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_user where fk_id_cliente = '$idcliente'");
  }



///

public function atribuirResponsavel($page, $itemsPerPage, $responsavel){

	$start = ($page - 1) * $itemsPerPage;
  $idcliente = $_SESSION['fk_id_cliente'];


	if ($responsavel == 0) {
		$valorResp = "id_user NOT LIKE '0'";
	}else{
		$valorResp = "id_user LIKE '".$responsavel."'";
	}



     
		$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_logs inner join tb_user on tb_user.id_user = tb_logs.idusuario where $valorResp and tb_user.fk_id_cliente = '$idcliente' ORDER BY datalog desc LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	      $results2 = $sql->select("SELECT * FROM tb_logs inner join tb_user on tb_user.id_user = tb_logs.idusuario where $valorResp and tb_user.fk_id_cliente = '$idcliente'");

	      $_SESSION["paginas"] = count($results2);

  

}







}



 ?>