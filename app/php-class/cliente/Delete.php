<?php 


namespace App\cliente;

use \App\DB\Sql;
use \App\DB\Logs;


class Delete{



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
	"nomecliente"
];





public function deletarUserCliente($iduser, $id){


var_dump($iduser);
var_dump($id);

  $sql = new Sql();
  $idcliente = $id;

 
$nomecliente = $sql->select("SELECT nome_cliente FROM tb_cliente where id_cliente = $idcliente");



  $tb_user = $sql->select("SELECT * FROM tb_user where id_user = $iduser and fk_id_cliente = '$idcliente'");

      $acao = "Deletou o usuário <br> Nome: ". $tb_user[0]['user'] . "<br> Nome do cliente :" . $nomecliente[0]['nome_cliente'];

      $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);



  $results = $sql->select("UPDATE tb_lead SET fk_id_user = 0 WHERE fk_id_user = $iduser ");

  $results2 = $sql->select("UPDATE tb_followup SET fk_id_user = '0' WHERE fk_id_user = '$iduser' and fk_id_cliente = '$idcliente'");

  $results3 = $sql->select("UPDATE tb_obs SET fk_id_user = 0 WHERE (fk_id_user = $iduser) and (fk_id_cliente = $$idcliente)");



  $tb_lembrete = $sql->select("SELECT * FROM tb_lembrete where autor = $iduser");


 if(count($tb_lembrete) > 0){

  $results = $sql->select("DELETE FROM tb_lembrete WHERE autor = $iduser and fk_id_cliente = $idcliente");


  }



    $results4 = $sql->select("DELETE FROM tb_user WHERE (id_user = $iduser) and (fk_id_cliente = $idcliente)");

  setcookie("Atualizado", "Atualizado");




}




public function listCliente($page, $itemsPerPage){

  $start = ($page - 1) * $itemsPerPage;


     
    $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_cliente where id_cliente not like '1' ORDER BY nome_cliente LIMIT $start, $itemsPerPage");

        $this->setData($results);


         $results2 = $sql->select("SELECT * FROM tb_cliente where id_cliente not like '1' ");

        $_SESSION["paginas"] = count($results2);





}





public function deletarTudoCliente($id){

  $sql = new Sql();


  $verifica = $sql->select("SELECT count(fk_id_cliente) FROM tb_lead where fk_id_cliente = $id");

  if ($verifica[0]['count(fk_id_cliente)'] > '0') {
      $delete = $sql->select("DELETE FROM tb_lead where fk_id_cliente = $id ");
  }


  $verifica1 = $sql->select("SELECT count(fk_id_cliente) FROM tb_followup where fk_id_cliente = $id");

  if ($verifica1[0]['count(fk_id_cliente)'] > '0') {
      $delete1 = $sql->select("DELETE FROM tb_followup where fk_id_cliente = $id ");
  }


   $verifica2 = $sql->select("SELECT count(fk_id_cliente) FROM tb_status where fk_id_cliente = $id");

  if ($verifica2[0]['count(fk_id_cliente)'] > '0') {
      $delete2 = $sql->select("DELETE FROM tb_status where fk_id_cliente = $id ");
  }


  
  $verifica3 = $sql->select("SELECT count(id_cliente) FROM tb_categoria where id_cliente = $id");

  if ($verifica3[0]['count(id_cliente)'] > '0') {
      $delete3 = $sql->select("DELETE FROM tb_categoria where id_cliente = $id ");
  }


  $verifica4 = $sql->select("SELECT count(fk_id_cliente) FROM tb_servico where fk_id_cliente = $id");

  if ($verifica4[0]['count(fk_id_cliente)'] > '0') {
      $delete4 = $sql->select("DELETE FROM tb_servico where fk_id_cliente = $id ");
  }


  $verifica5 = $sql->select("SELECT count(fk_id_cliente) FROM tb_lembrete where fk_id_cliente = $id");

  if ($verifica5[0]['count(fk_id_cliente)'] > '0') {
      $delete5 = $sql->select("DELETE FROM tb_lembrete where fk_id_cliente = $id ");
  }


  $verifica6 = $sql->select("SELECT count(fk_id_cliente) FROM tb_obs where fk_id_cliente = $id");

  if ($verifica6[0]['count(fk_id_cliente)'] > '0') {
      $delete6 = $sql->select("DELETE FROM tb_obs where fk_id_cliente = $id ");
  }


  $verifica7 = $sql->select("SELECT count(fk_id_cliente) FROM tb_logs where fk_id_cliente = $id");

  if ($verifica7[0]['count(fk_id_cliente)'] > '0') {
      $delete7 = $sql->select("DELETE FROM tb_logs where fk_id_cliente = $id ");
  }



   $tb_arquivo = $sql->select("SELECT * FROM tb_arquivo where fk_id_cliente = $id");




  if(count($tb_arquivo) > 0){

     $nomePasta = $sql->select("SELECT * FROM tb_cliente where id_cliente = $id ");

  

       for ($i=0; $i < count($tb_arquivo) ; $i++) { 


           $path = 'uploads/'.$nomePasta[0]['nome_pasta'].'/';
            $diretorio = dir($path);


             
            unlink($path.$tb_arquivo[$i]['arquivo']); 

       }

       $path = 'uploads/'.$nomePasta[0]['nome_pasta'];

       rmdir($path);
       
  }


  if (count($tb_arquivo) > 0) {

    $results = $sql->select("DELETE FROM tb_arquivo WHERE fk_id_cliente = $idlead");
    
  }



  

}











}



 ?>