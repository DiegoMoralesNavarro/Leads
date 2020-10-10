<?php 


namespace App\configurar;

use \App\DB\Sql;
use \App\DB\Logs;


class Arquivo{



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
	"tudo", "chkl", "page", "datainicio", "datafinal"
];



public static function arquivoTamanhoTotal()
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT sum(tamanho) FROM tb_arquivo where fk_id_cliente = $idcliente");
  }

 public static function totalArquivos()
  {
    $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT count(arquivo) FROM tb_arquivo where fk_id_cliente = $idcliente");
  } 


   public static function dataInicio()
  {
     $sql = new Sql();
    $idcliente = $_SESSION['fk_id_cliente'];
    return $sql->select("SELECT MIN(data) FROM tb_arquivo where fk_id_cliente = $idcliente");
  } 




public function listaArquivos($itemsPerPage){

  if (!isset($_SESSION['page'])) {
    $_SESSION['page'] = 1;
  }

  if ($_SESSION['page'] == null) {
    $pagina = 1;
  }else{
    $pagina = $_SESSION['page'];
  }

  $start = ($pagina - 1) * $itemsPerPage;
  $idcliente = $_SESSION['fk_id_cliente'];


  $sql = new Sql();
    $datainicio = $sql->select("SELECT MIN(data) FROM tb_arquivo where fk_id_cliente = $idcliente");


  if ($this->getdatainicio() == null) {
    // $_SESSION['datainicio'] = $datainicio[0]['MIN(data)'];
  }else{
    $dataI = implode('-', array_reverse(explode('/', $this->getdatainicio()))); 
    $_SESSION['datainicio'] = $dataI;
  }

  if ($this->getdatafinal() == null) {
    // $_SESSION['datafinal'] = date('Y-m-d');
  }else{
    $dataF = implode('-', array_reverse(explode('/', $this->getdatafinal()))); 
    $_SESSION['datafinal'] = $dataF;
  }

  $valI = $_SESSION['datainicio'];
  $valF = $_SESSION['datafinal'];


   
        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_arquivo WHERE data BETWEEN '$valI' AND '$valF' AND fk_id_cliente = '$idcliente' ORDER BY data desc LIMIT $start, $itemsPerPage");

        $this->setData($results);


        $results2 = $sql->select("SELECT * FROM tb_arquivo  WHERE data BETWEEN '$valI' AND '$valF' AND fk_id_cliente = '$idcliente'");

        $_SESSION["paginas"] = count($results2);

  

}





public function paginavalor(){


  if ($this->getpage() == null) {

  }else{
    $_SESSION['page'] = $this->getpage();
  }


}



public function deleteSimples($id){

  $sql = new Sql();

  $idcliente = $_SESSION['fk_id_cliente'];



      $acao = "Deletado arquivo no Controle de arquivos";

      $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);



   $tb_arquivo = $sql->select("SELECT * FROM tb_arquivo where idtarquivo = $id and fk_id_cliente = $idcliente");

  $nomePasta = $sql->select("SELECT * FROM tb_cliente where id_cliente = $idcliente ");


        $path = 'uploads/'.$nomePasta[0]['nome_pasta'].'/';
        $diretorio = dir($path);

         
        unlink($path.$tb_arquivo[0]['arquivo']);


  $verificar = $sql->select("SELECT COUNT(*) FROM tb_arquivo where idtarquivo = $id and fk_id_cliente = '$idcliente' ");

  if ($verificar[0]['COUNT(*)'] >= 1) {
   $result = $sql->select("DELETE FROM tb_arquivo WHERE idtarquivo = $id and fk_id_cliente = '$idcliente'");
  }

   
  $verificar2 = $sql->select("SELECT COUNT(*) FROM tb_followup where fk_idtarquivo = $id and fk_id_cliente = '$idcliente'");


  if ($verificar2[0]['COUNT(*)'] >= 1) {
    $result2 = $sql->select("UPDATE tb_followup SET fk_idtarquivo = NULL WHERE fk_idtarquivo = $id and fk_id_cliente = '$idcliente'");
  }



}






public function deletar(){



  $sql = new Sql();

  $idcliente = $_SESSION['fk_id_cliente'];


   $acao = "Deletado vários arquivos no Controle de arquivos";

      $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);

  

    if (!$this->getchkl() == null) {
     
        $checkbox1 = count($this->getchkl());

        for ($i=0; $i<$checkbox1; $i++) {  


          $id = $this->getchkl()[$i];


          $tb_arquivo = $sql->select("SELECT * FROM tb_arquivo where idtarquivo = $id and fk_id_cliente = $idcliente");

          $nomePasta = $sql->select("SELECT * FROM tb_cliente where id_cliente = $idcliente ");


          $path = 'uploads/'.$nomePasta[0]['nome_pasta'].'/';
          $diretorio = dir($path);

           
          unlink($path.$tb_arquivo[0]['arquivo']);

            

          $verificar = $sql->select("SELECT COUNT(*) FROM tb_arquivo where idtarquivo = $id and fk_id_cliente = '$idcliente' ");

          if ($verificar[0]['COUNT(*)'] >= 1) {
             $result = $sql->select("DELETE FROM tb_arquivo WHERE idtarquivo = $id and fk_id_cliente = '$idcliente'");
          }


          $verificar2 = $sql->select("SELECT COUNT(*) FROM tb_followup where fk_idtarquivo = $id and fk_id_cliente = '$idcliente'");


          if ($verificar2[0]['COUNT(*)'] >= 1) {
              $result2 = $sql->select("UPDATE tb_followup SET fk_idtarquivo = NULL WHERE fk_idtarquivo = $id and fk_id_cliente = '$idcliente'");
          }


        } //for

    } //if




}







}



 ?>