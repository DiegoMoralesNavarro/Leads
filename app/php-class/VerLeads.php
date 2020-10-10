<?php 

namespace App;

use \App\DB\Sql;
use \App\DB\Logs;



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
	"pesquisa", "page", "ordemFollow"
];


// get




public function listAll($val, $page, $itemsPerPage, $FollowUP)
	{

    $start = ($page - 1) * $itemsPerPage;

    if ($FollowUP == 1) {
      $Follow = "idlead desc";
    }else if ($FollowUP == 2){
      $Follow = "ultimo_followup asc";
    }else if ($FollowUP == 3){
      $Follow = "ultimo_followup desc";
    }else{
      $Follow = "idlead desc";
    }


    $idcliente = $_SESSION['fk_id_cliente'];



   if ($val  == "") {
     
      $sql = new Sql();
      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead where tb_lead.fk_id_cliente = $idcliente and idstatus not LIKE '2' and visivel not LIKE '0' ORDER BY $Follow LIMIT $start, $itemsPerPage");

      $this->setData($results);


       $results2 = $sql->select("SELECT * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead where nome like '%$val%' and tb_lead.fk_id_cliente = $idcliente and idstatus not LIKE '2' and visivel not LIKE '0'");

      $_SESSION["paginas"] = count($results2);


   }else{
    
    $sql = new Sql();
      $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead where nome like '%$val%' and tb_lead.fk_id_cliente = $idcliente and idstatus not LIKE '2' and visivel not LIKE '0' ORDER BY $Follow LIMIT $start, $itemsPerPage");

      $this->setData($results);


       $results2 = $sql->select("SELECT * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead where nome like '%$val%' and tb_lead.fk_id_cliente = $idcliente and idstatus not LIKE '2' and visivel not LIKE '0'");

      $_SESSION["paginas"] = count($results2);

   }

      // inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.tipo_origem 
    // ver o total de pagina


	}


public static function status(){

  $sql = new Sql();

  $idcliente = $_SESSION['fk_id_cliente'];

  return $sql->select("SELECT * FROM tb_status where fk_id_cliente = $idcliente or fk_id_cliente = 0");

}

public static function totalStatus(){

  $sql = new Sql();
  $idcliente = $_SESSION['fk_id_cliente'];
  return $sql->select("SELECT fk_status, tipostatus FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus and tb_lead.fk_id_cliente = $idcliente");

}


public static function novoLeadsQuatroH($dataA, $dataB){


  $horas = $dataA;        
  $horas->modify( '-5 hours' );

  $datahoras = $horas->format( 'Y-m-d H:i:s' );

  $dataAtual = $dataB->format('Y-m-d H:i:s');

  $idcliente = $_SESSION['fk_id_cliente'];




  $sql = new Sql();
  return $sql->select("SELECT data FROM tb_lead WHERE fk_status = 1 and data between '$datahoras' and '$dataAtual' and fk_id_cliente = $idcliente");

}


public static function novoLeadsUmDia($dataC, $dataD){


 
  $horasA = $dataC;        
  $horasA->modify( '-5 hours' );
  $horasA->modify( '-2 seconds' );

  $datahorasAA = $horasA->format( 'Y-m-d H:i:s' );

  $horasB = $dataD;        
  $horasB->modify( '-24 hours' );

  $datahorasBB = $horasB->format( 'Y-m-d H:i:s' );

$idcliente = $_SESSION['fk_id_cliente'];
  


  
$sql = new Sql();
  return $sql->select("SELECT data FROM tb_lead WHERE fk_status = 1 and data between '$datahorasBB' and '$datahorasAA' and fk_id_cliente = $idcliente");



}


public static function novoLeadsDoisDias($dataE){

 $horasA = $dataE;        
  $horasA->modify( '-24 hours' );
  $horasA->modify( '-3 seconds' );

  $datahorasE = $horasA->format( 'Y-m-d H:i:s' );

  $idcliente = $_SESSION['fk_id_cliente'];




$sql = new Sql();
  return $sql->select("SELECT data FROM tb_lead WHERE fk_status = 1 and data <= '$datahorasE' and fk_id_cliente = $idcliente");


}




// post



public function deleteUser($idlead){

  $sql = new Sql();

  $idcliente = $_SESSION['fk_id_cliente'];



    $tb_lead = $sql->select("SELECT * FROM tb_lead where idlead = $idlead and fk_id_cliente = $idcliente");

    $acao = "Deletado o lead <br> Nome: ". $tb_lead[0]['nome'] ."<br> E-mail: ". $tb_lead[0]['email'] ."<br> Telefone: ". $tb_lead[0]['telefone'];

    $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);



  $results = $sql->select("DELETE FROM tb_lead WHERE idlead = $idlead and fk_id_cliente = $idcliente");



  $tb_categoria = $sql->select("SELECT idlead FROM tb_categoria where idlead = $idlead and id_cliente = $idcliente");

  if(count($tb_categoria) > 0){
    $results = $sql->select("DELETE FROM tb_categoria WHERE idlead = $idlead");
  }


  $tb_obs = $sql->select("SELECT fk_idlead FROM tb_obs where fk_idlead = $idlead and fk_id_cliente = $idcliente");

  if(count($tb_obs) > 0){
  $results = $sql->select("DELETE FROM tb_obs WHERE fk_idlead = $idlead");
  }



  
  $tb_arquivo = $sql->select("SELECT * FROM tb_arquivo where fk_idlead = $idlead and fk_id_cliente = $idcliente");




  if(count($tb_arquivo) > 0){

     $nomePasta = $sql->select("SELECT * FROM tb_cliente where id_cliente = $idcliente ");

  

       for ($i=0; $i < count($tb_arquivo) ; $i++) { 


           $path = 'uploads/'.$nomePasta[0]['nome_pasta'].'/';
            $diretorio = dir($path);


             
            unlink($path.$tb_arquivo[$i]['arquivo']); 

       }
       
  }


  if (count($tb_arquivo) > 0) {

    $results = $sql->select("DELETE FROM tb_arquivo WHERE fk_idlead = $idlead");
    
  }




  $tb_followup = $sql->select("SELECT * FROM tb_followup where idlead = $idlead");



  if(count($tb_followup) > 0){

  $results = $sql->select("DELETE FROM tb_followup WHERE idlead = $idlead and fk_id_cliente = $idcliente");


  }




  $tb_lembrete = $sql->select("SELECT * FROM tb_lembrete where fk_idlead = $idlead");


 if(count($tb_lembrete) > 0){

  $results = $sql->select("DELETE FROM tb_lembrete WHERE fk_idlead = $idlead and fk_id_cliente = $idcliente");


  }



  
 
 

}










}

 ?>