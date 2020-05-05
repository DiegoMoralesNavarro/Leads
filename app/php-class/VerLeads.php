<?php 

namespace App;

use \App\DB\Sql;


class VerLeads{


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
	"pesquisa", "page"
];


// get


public function listAll($val, $page, $itemsPerPage)
	{

    $start = ($page - 1) * $itemsPerPage;



   if ($val  == "") {
     
      $sql = new Sql();
      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead ORDER BY idlead desc LIMIT $start, $itemsPerPage");

      $this->setData($results);


       $results2 = $sql->select("SELECT * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead where nome like '%$val%' ");

      $_SESSION["paginas"] = count($results2);


   }else{
    
    $sql = new Sql();
      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead where nome like '%$val%' ORDER BY idlead desc LIMIT $start, $itemsPerPage");

      $this->setData($results);


       $results2 = $sql->select("SELECT * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead where nome like '%$val%' ");

      $_SESSION["paginas"] = count($results2);

   }

      // inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.tipo_origem 
    // ver o total de pagina


	}


public static function status(){

  $sql = new Sql();
  return $sql->select("SELECT * FROM tb_status;");

}

public static function totalStatus(){

  $sql = new Sql();
  return $sql->select("SELECT fk_status, tipostatus FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus;");

}


// post



public function deleteUser($idlead){

  $sql = new Sql();

  $results = $sql->select("DELETE FROM tb_lead WHERE idlead = $idlead");



  $tb_categoria = $sql->select("SELECT idlead FROM tb_categoria where idlead = $idlead");

  if(count($tb_categoria) > 0){
    $results = $sql->select("DELETE FROM tb_categoria WHERE idlead = $idlead");
  }


  $tb_obs = $sql->select("SELECT fk_idlead FROM tb_obs where fk_idlead = $idlead");

  if(count($tb_obs) > 0){
  $results = $sql->select("DELETE FROM tb_obs WHERE fk_idlead = $idlead");
  }


  $tb_arquivo = $sql->select("SELECT * FROM tb_arquivo where fk_idlead = $idlead");


  if(count($tb_arquivo) > 0){
      $results = $sql->select("DELETE FROM tb_arquivo WHERE fk_idlead = $idlead");

      $path = "uploads/";
      $diretorio = dir($path);

      
      unlink($path.$tb_arquivo[0]['arquivo']);

  }





}








}

 ?>