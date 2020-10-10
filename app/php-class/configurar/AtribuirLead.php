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
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_lead WHERE idlead = $id and fk_id_cliente = '$idcliente'");
  }


 public static function user()
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_user WHERE fk_id_cliente = '$idcliente'");
  }


public static function responsavel($id)
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT * FROM tb_lead inner join tb_user on tb_lead.fk_id_user = tb_user.id_user WHERE idlead = $id and tb_lead.fk_id_cliente = '$idcliente'");
  }  

public static function responsavelTotal()
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT count(*) FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus where tb_lead.fk_id_user LIKE '0' and visivel not LIKE '0' and tb_lead.fk_status not LIKE '2'  and tb_lead.fk_id_cliente = '$idcliente'");
  }  

  public static function responsavelTotalLead()
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT count(*) FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus where tb_lead.fk_id_user not LIKE '0' and visivel not LIKE '0' and tb_lead.fk_id_cliente = '$idcliente'");
  }  


  public static function responsavelMeuLead()
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    $iduser = $_SESSION["id_user"];
    return $sql->select("SELECT count(*) FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus where tb_lead.fk_id_user LIKE '0' and tb_lead.fk_id_user = '$iduser' and visivel not LIKE '0' and tb_lead.fk_id_cliente = '$idcliente'");
    
  }  



/////

public function atribuirNovo($val, $page, $itemsPerPage){

	$start = ($page - 1) * $itemsPerPage;
  $idcliente = $_SESSION['fk_id_cliente'];

	if ($val  == "") {

     
		$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead inner join tb_status on tb_lead.fk_status = tb_status.idstatus where fk_id_user LIKE '0' and fk_status not LIKE '2' and visivel not LIKE '0' and tb_lead.fk_id_cliente = '$idcliente' ORDER BY idlead desc LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	      $results2 = $sql->select("SELECT * FROM tb_lead inner join tb_status on tb_lead.fk_status = tb_status.idstatus where fk_id_user LIKE '0' and fk_status not LIKE '2' and visivel not LIKE '0' and tb_lead.fk_id_cliente = '$idcliente' AND nome like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);

      }else{



      	$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead inner join tb_status on tb_lead.fk_status = tb_status.idstatus where fk_id_user LIKE '0' and visivel not LIKE '0' and fk_status not LIKE '2' AND nome like '%$val%' and tb_lead.fk_id_cliente = '$idcliente' ORDER BY idlead desc LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	       $results2 = $sql->select("SELECT * FROM tb_lead inner join tb_status on tb_lead.fk_status = tb_status.idstatus where fk_id_user LIKE '0' and visivel not LIKE '0' and fk_status not LIKE '2' and tb_lead.fk_id_cliente = '$idcliente' AND nome like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);



      }




}



public function atribuir($id){

	$sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];

	 $results = $sql->select("UPDATE tb_lead SET fk_id_user = :responsavel WHERE (idlead = $id) and (fk_id_cliente = :idcliente)", array(
       ":responsavel"=>$this->getresponsavel(),
       ":idcliente"=>$_SESSION["fk_id_cliente"]
    ));


	setcookie("Atualizado", "Atualizado");


	$nome = $sql->select("SELECT user FROM tb_user where id_user = :responsavel and fk_id_cliente = '$idcliente'", array(
       ":responsavel"=>$this->getresponsavel()
    ));

    $nomeLead = $sql->select("SELECT nome FROM tb_lead where idlead = :lead and fk_id_cliente = '$idcliente'", array(
       ":lead"=>$id
    ));

	$acao = "Atribuiu o lead para o usuário <br>" . "Nome do usuário: " . $nome[0]['user'] ." <br>" . "Nome do lead: " . $nomeLead[0]['nome'];

    $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);

}






public function atribuirExistente($val, $page, $itemsPerPage){

	$start = ($page - 1) * $itemsPerPage;
  $idcliente = $_SESSION['fk_id_cliente'];

	if ($val  == "") {

     
		$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead where fk_id_user NOT LIKE '0' and fk_status not LIKE '2' and fk_id_cliente = '$idcliente' ORDER BY idlead desc LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	      $results2 = $sql->select("SELECT * FROM tb_lead where fk_id_user NOT LIKE '0' and fk_status not LIKE '2' and fk_id_cliente = '$idcliente' AND nome like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);

      }else{



      	$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead where fk_id_user LIKE '0' and fk_status not LIKE '2' AND nome like '%$val%' and fk_id_cliente = '$idcliente' ORDER BY idlead desc LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	       $results2 = $sql->select("SELECT * FROM tb_lead where fk_id_user LIKE '0' and fk_status not LIKE '2' AND nome like '%$val%' and fk_id_cliente = '$idcliente'");

	      $_SESSION["paginas"] = count($results2);



      }




}







public function atribuirResponsavel($val, $page, $itemsPerPage, $responsavel){

	$start = ($page - 1) * $itemsPerPage;
  $idcliente = $_SESSION['fk_id_cliente'];


	if ($responsavel == 0) {
		$valorResp = "fk_id_user NOT LIKE '0'";
	}else{
		$valorResp = "fk_id_user LIKE '".$responsavel."'";
	}


	
	if ($val  == "") {

     
		$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS idlead, nivel, nome, telefone, tb_lead.email, user, ultimo_followup, fk_status FROM tb_lead inner join tb_user on tb_lead.fk_id_user = tb_user.id_user inner join tb_status on tb_lead.fk_status = tb_status.idstatus where $valorResp and fk_status not LIKE '2' and tb_status.visivel not LIKE '0' and tb_user.fk_id_cliente = '$idcliente' ORDER BY tb_user.dataCriado LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	      $results2 = $sql->select("SELECT idlead, nivel, nome, telefone, tb_lead.email, user, ultimo_followup, fk_status FROM tb_lead inner join tb_user on tb_lead.fk_id_user = tb_user.id_user inner join tb_status on tb_lead.fk_status = tb_status.idstatus where $valorResp and fk_status not LIKE '2' and tb_status.visivel not LIKE '0' and tb_user.fk_id_cliente = '$idcliente' AND nome like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);

      }else{



      	$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS idlead, nivel, nome, telefone, tb_lead.email, user, ultimo_followup, fk_status FROM tb_lead inner join tb_user on tb_lead.fk_id_user = tb_user.id_user inner join tb_status on tb_lead.fk_status = tb_status.idstatus where $valorResp and fk_status not LIKE '2' and tb_status.visivel not LIKE '0' and tb_user.fk_id_cliente = '$idcliente' AND nome like '%$val%' ORDER BY tb_user.dataCriado LIMIT $start, $itemsPerPage");

	      $this->setData($results);



	       $results2 = $sql->select("SELECT idlead, nivel, nome, telefone, tb_lead.email, user, ultimo_followup, fk_status FROM tb_lead inner join tb_user on tb_lead.fk_id_user = tb_user.id_user inner join tb_status on tb_lead.fk_status = tb_status.idstatus where $valorResp and fk_status not LIKE '2' and tb_status.visivel not LIKE '0' and tb_user.fk_id_cliente = '$idcliente' AND nome like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);



      }




}







public function meuLead($val, $page, $itemsPerPage){

  $start = ($page - 1) * $itemsPerPage;
  $idcliente = $_SESSION['fk_id_cliente'];
  $iduser = $_SESSION["id_user"];

  if ($val  == "") {

     
    $sql = new Sql();
        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead inner join tb_status on tb_lead.fk_status = tb_status.idstatus where fk_id_user = $iduser and tb_lead.fk_id_cliente = '$idcliente' and tb_lead.fk_status not LIKE '2' and visivel not LIKE '0' ORDER BY idlead desc LIMIT $start, $itemsPerPage");

        $this->setData($results);


        $results2 = $sql->select("SELECT * FROM tb_lead inner join tb_status on tb_lead.fk_status = tb_status.idstatus where fk_id_user = $iduser and tb_lead.fk_id_cliente = '$idcliente' and tb_lead.fk_status not LIKE '2' and visivel not LIKE '0' AND nome like '%$val%' ");

        $_SESSION["paginas"] = count($results2);

      }else{



        $sql = new Sql();
        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead inner join tb_status on tb_lead.fk_status = tb_status.idstatus where fk_id_user = $iduser and tb_lead.fk_status not LIKE '2' and visivel not LIKE '0' AND nome like '%$val%' and tb_lead.fk_id_cliente = '$idcliente' ORDER BY idlead desc LIMIT $start, $itemsPerPage");

        $this->setData($results);


         $results2 = $sql->select("SELECT * FROM tb_lead inner join tb_status on tb_lead.fk_status = tb_status.idstatus where fk_id_user = $iduser and tb_lead.fk_id_cliente = '$idcliente' and tb_lead.fk_status not LIKE '2' and visivel not LIKE '0' AND nome like '%$val%' ");

        $_SESSION["paginas"] = count($results2);



      }




}







}



 ?>