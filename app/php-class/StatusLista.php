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




    protected $fields = [ "pesquisa", "page", "imprimirsimples", "imprimir" ];


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



public static function imprimir($val, $page, $itemsPerPage, $idstatus){

 
   // $sql = new Sql();

   // $result = $sql->select("SELECT idlead,nome,empresa,email,telefone FROM tb_lead where fk_status = '$idstatus'");

   $start = ($page - 1) * $itemsPerPage;

  if ($val  == "") {
     
    $sql = new Sql();

        $result = $sql->select("SELECT idlead,nome,empresa,email,telefone FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead where fk_status = '$idstatus' ORDER BY idlead desc LIMIT $start, $itemsPerPage");

   
      }else{



        $sql = new Sql();
       

        $result = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_lead inner join tb_status ON tb_lead.fk_status = tb_status.idstatus inner join tb_origem_lead ON tb_lead.fk_origem_lead = tb_origem_lead.id_origem_lead where fk_status = '$idstatus' AND nome like '%$val%' ORDER BY idlead desc LIMIT $start, $itemsPerPage");
       


      }

     



    //declaramos uma variavel para monstarmos a tabela
    $dadosXls  = "";
    $dadosXls .= "  <table>";
    $dadosXls .= "       <tr>";
    $dadosXls .= "          <th>id</th>";
    $dadosXls .= "          <th>nome</th>";
    $dadosXls .= "          <th>empresa</th>";
    $dadosXls .= "          <th>telefone</th>";
    $dadosXls .= "          <th>email</th>";
    $dadosXls .= "      </tr>";

    foreach($result as $res){
        $dadosXls .= "      <tr>";
        $dadosXls .= "          <td>".$res['idlead']."</td>";
        $dadosXls .= "          <td>".$res['nome']."</td>";
        $dadosXls .= "          <td>".$res['empresa']."</td>";
        $dadosXls .= "          <td>".$res['telefone']."</td>";
        $dadosXls .= "          <td>".$res['email']."</td>";
        $dadosXls .= "      </tr>";
    }


    $dadosXls .= "  </table>";

    

    // Definimos o nome do arquivo que será exportado  
    $arquivo = "MinhaPlanilha.xls";  

    header("Content-Type: text/html; charset=utf-8");
    header("Content-Type: multipart/form-data; boundary=something");

    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Content-Description: form-data; leads" );

    header('Content-Type: application/xls');
    header('Content-Type: application/pkix-attr-cert');
    header('Content-Type: application/vnd.ms-excel');

    header('Content-Disposition: attachment; filename="'.$arquivo.'"');
    header("Content-Type: application/download");

    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");


    echo $dadosXls;  
    exit;



}




public static function imprimirSimples($idstatus){

 
   $sql = new Sql();

   $result = $sql->select("SELECT idlead,nome,empresa,email,telefone FROM tb_lead where fk_status = '$idstatus'");



    //declaramos uma variavel para monstarmos a tabela
    $dadosXls  = "";
    $dadosXls .= "  <table>";
    $dadosXls .= "       <tr>";
    $dadosXls .= "          <th>id</th>";
    $dadosXls .= "          <th>nome</th>";
    $dadosXls .= "          <th>empresa</th>";
    $dadosXls .= "          <th>telefone</th>";
    $dadosXls .= "          <th>email</th>";
    $dadosXls .= "      </tr>";

    foreach($result as $res){
        $dadosXls .= "      <tr>";
        $dadosXls .= "          <td>".$res['idlead']."</td>";
        $dadosXls .= "          <td>".$res['nome']."</td>";
        $dadosXls .= "          <td>".$res['empresa']."</td>";
        $dadosXls .= "          <td>".$res['telefone']."</td>";
        $dadosXls .= "          <td>".$res['email']."</td>";
        $dadosXls .= "      </tr>";
    }


    $dadosXls .= "  </table>";

    

    // Definimos o nome do arquivo que será exportado  
    $arquivo = "MinhaPlanilha.xls";  

    header("Content-Type: text/html; charset=utf-8");
    header("Content-Type: multipart/form-data; boundary=something");

    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Content-Description: form-data; leads" );

    header('Content-Type: application/xls');
    header('Content-Type: application/pkix-attr-cert');
    header('Content-Type: application/vnd.ms-excel');

    header('Content-Disposition: attachment; filename="'.$arquivo.'"');
    header("Content-Type: application/download");

    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");


    echo $dadosXls;  
    exit;



}







}









 ?>