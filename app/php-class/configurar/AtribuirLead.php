<?php 


namespace App\configurar;

use \App\DB\Sql;
use \App\DB\Logs;


class AtribuirLead{



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



public static function lead($id)
  {
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_lead WHERE idlead = $id");
  }


 public static function user()
  {
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_user WHERE nivel NOT LIKE '1';");
  }


public static function responsavel($id)
  {
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_lead inner join tb_user on tb_lead.fk_id_user = tb_user.id_user WHERE idlead = $id");
  }  





/////

public function atribuirNovo($val, $page, $itemsPerPage){

	$start = ($page - 1) * $itemsPerPage;

	if ($val  == "") {

     
		$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead where fk_id_user LIKE '0' ORDER BY data LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	      $results2 = $sql->select("SELECT * FROM tb_lead where fk_id_user LIKE '0' AND nome like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);

      }else{



      	$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead where fk_id_user LIKE '0' AND nome like '%$val%' ORDER BY data LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	       $results2 = $sql->select("SELECT * FROM tb_lead where fk_id_user LIKE '0' AND nome like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);



      }




}



public function atribuir($id){

	$sql = new Sql();

	 $results = $sql->select("UPDATE tb_lead SET fk_id_user = :responsavel WHERE (idlead = $id)", array(
       ":responsavel"=>$this->getresponsavel()
    ));


	setcookie("Atualizado", "Atualizado");


	$nome = $sql->select("SELECT user FROM tb_user where id_user = :responsavel", array(
       ":responsavel"=>$this->getresponsavel()
    ));

    $nomeLead = $sql->select("SELECT nome FROM tb_lead where idlead = :lead", array(
       ":lead"=>$id
    ));

	$acao = "Atribuiu o lead para o usuário <br>" . "Nome do usuário: " . $nome[0]['user'] ." <br>" . "Nome do lead: " . $nomeLead[0]['nome'];

    $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);

}






public function atribuirExistente($val, $page, $itemsPerPage){

	$start = ($page - 1) * $itemsPerPage;

	if ($val  == "") {

     
		$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead where fk_id_user NOT LIKE '0' ORDER BY data LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	      $results2 = $sql->select("SELECT * FROM tb_lead where fk_id_user NOT LIKE '0' AND nome like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);

      }else{



      	$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead where fk_id_user LIKE '0' AND nome like '%$val%' ORDER BY data LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	       $results2 = $sql->select("SELECT * FROM tb_lead where fk_id_user LIKE '0' AND nome like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);



      }




}







public function atribuirResponsavel($val, $page, $itemsPerPage, $responsavel){

	$start = ($page - 1) * $itemsPerPage;


	if ($responsavel == 0) {
		$valorResp = "fk_id_user NOT LIKE '0'";
	}else{
		$valorResp = "fk_id_user LIKE '".$responsavel."'";
	}


	
	if ($val  == "") {

     
		$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead inner join tb_user on tb_lead.fk_id_user = tb_user.id_user where $valorResp ORDER BY tb_user.dataCriado LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	      $results2 = $sql->select("SELECT * FROM tb_lead inner join tb_user on tb_lead.fk_id_user = tb_user.id_user where $valorResp AND nome like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);

      }else{



      	$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead inner join tb_user on tb_lead.fk_id_user = tb_user.id_user where $valorResp AND nome like '%$val%' ORDER BY tb_user.dataCriado LIMIT $start, $itemsPerPage");

	      $this->setData($results);



	       $results2 = $sql->select("SELECT * FROM tb_lead inner join tb_user on tb_lead.fk_id_user = tb_user.id_user where $valorResp AND nome like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);



      }




}







}



 ?>