<?php 


namespace App;

use \App\DB\Sql;



class StatusLista{



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




    protected $fields = [ "pesquisa", "page" ];


// get

public static function saberStatus($idstatus){

	$sql = new Sql();
    return $sql->select("SELECT * FROM tb_status where idstatus = $idstatus");
	
}



////




public function listAll($val, $page, $itemsPerPage, $idstatus){

	$start = ($page - 1) * $itemsPerPage;

	if ($val  == "") {
     
		$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead where fk_status = '$idstatus' ORDER BY idlead desc LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	       $results2 = $sql->select("SELECT * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead where fk_status = '$idstatus' AND nome like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);

      }else{



      	$sql = new Sql();
	      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead where fk_status = '$idstatus' AND nome like '%$val%' ORDER BY idlead desc LIMIT $start, $itemsPerPage");

	      $this->setData($results);


	       $results2 = $sql->select("SELECT * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead where fk_status = '$idstatus' AND nome like '%$val%' ");

	      $_SESSION["paginas"] = count($results2);



      }




}











}









 ?>