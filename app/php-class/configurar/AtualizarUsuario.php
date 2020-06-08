<?php 

namespace App\configurar;

use \App\DB\Sql;

class AtualizarUsuario{



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
	"id_user", "user", "nivel", "email", "pesquisa", "page"
];









public function listUsuario($val, $page, $itemsPerPage, $nivel){

	$start = ($page - 1) * $itemsPerPage;

	if ($val  == "") {
     
		$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_user where nivel NOT LIKE '%$nivel%' AND nivel NOT LIKE '1' ORDER BY user LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	       $results2 = $sql->select("SELECT * FROM tb_user where nivel NOT LIKE '%$nivel%' AND nivel NOT LIKE '1' AND user like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);

      }else{



      	$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_user where  nivel NOT LIKE '%$nivel%' AND nivel NOT LIKE '1' AND user like '%$val%' ORDER BY user LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	       $results2 = $sql->select("SELECT * FROM tb_user where where nivel NOT LIKE '%$nivel%' AND nivel NOT LIKE '1' AND user like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);



      }




}




public static function listAll()
{
	$sql = new Sql();
	return $sql->select("SELECT * FROM tb_user order by user");
}










}



?>