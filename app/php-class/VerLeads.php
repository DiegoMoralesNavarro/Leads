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



    $tb_lead = $sql->select("SELECT * FROM tb_lead where idlead = $idlead");

    $acao = "Deletado o lead <br> Nome: ". $tb_lead[0]['nome'] ."<br> E-mail: ". $tb_lead[0]['email'] ."<br> Telefone: ". $tb_lead[0]['telefone'];

    $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);



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

  


  $arquivosTotal = $sql->select("SELECT * FROM tb_followup where imagem NOT LIKE '' and idlead = $idlead");

  if(count($arquivosTotal) > 0){

       for ($i=0; $i < count($arquivosTotal) ; $i++) { 

           $path = "uploads/";
            $diretorio = dir($path);
             
            unlink($path.$arquivosTotal[$i]['imagem']); 

       }
       
  }


  $tb_followup = $sql->select("SELECT * FROM tb_followup where idlead = $idlead");

  if(count($tb_followup) > 0){
  $results = $sql->select("DELETE FROM tb_followup WHERE idlead = $idlead");

  }

 
 

}




public static function imprimir(){

   $sql = new Sql();

   $result = $sql->select("SELECT idlead,nome,empresa,email,telefone FROM tb_lead");




    // //declaramos uma variavel para monstarmos a tabela
    // $dadosXls  = "";
    // $dadosXls .= "  <table border='1' >";
    // $dadosXls .= "       <tr>";
    // $dadosXls .= "          <th>id</th>";
    // $dadosXls .= "          <th>nome</th>";
    // $dadosXls .= "          <th>empresa</th>";
    // $dadosXls .= "          <th>telefone</th>";
    // $dadosXls .= "          <th>email</th>";
    // $dadosXls .= "      </tr>";

    // foreach($result as $res){
    //     $dadosXls .= "      <tr>";
    //     $dadosXls .= "          <td>".$res['idlead']."</td>";
    //     $dadosXls .= "          <td>".$res['nome']."</td>";
    //     $dadosXls .= "          <td>".$res['empresa']."</td>";
    //     $dadosXls .= "          <td>".$res['telefone']."</td>";
    //     $dadosXls .= "          <td>".$res['email']."</td>";
    //     $dadosXls .= "      </tr>";
    // }


    // $dadosXls .= "  </table>";


    // // Definimos o nome do arquivo que será exportado  
    // $arquivo = "MinhaPlanilha.xls";  
    // Configurações header para forçar o download  

    // header('Content-Encoding: UTF-8');
    // header('Content-Encoding: ISO-8859-1');
    // header("Content-Type: text/html; charset=utf-8");
    
    // header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
    // header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    // header ("Content-Description: leads" );

    
    // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    // header('Content-Disposition: attachment;filename="'.$arquivo.'"');
    // header ("Cache-Control: no-cache, must-revalidate");
    // header ("Pragma: no-cache");


 
// Envia o conteúdo do arquivo  
    // echo $dadosXls;  
    // exit;



}





}

 ?>