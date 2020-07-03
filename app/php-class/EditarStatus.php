<?php 



namespace App;

use \App\DB\Sql;
use \App\DB\Logs;



class EditarStatus{






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
	"idstatusEditar", "tipostatus", "tipostatusEditar"
];


// get


 public static function listStatus()
  {
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_status WHERE idstatus not LIKE '%5%'");
  }





// post


 public function saveStatus(){
    $sql = new Sql();

    if ($this->gettipostatus() == "") {
      //vazio
    }else{
       $results = $sql->select("INSERT INTO tb_status (tipostatus) VALUES (:tipostatus)", array(
        
            ":tipostatus"=>$this->gettipostatus()
          ));

      $acao = "Cadastrou um status <br> Nome: ". $this->gettipostatus();

      $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);

      }

   }


  public function saveStatusUpdate(){
    $sql = new Sql();
    
    $results = $sql->select("UPDATE tb_status SET tipostatus = :tipostatus WHERE idstatus = :idstatus", array(
       ":idstatus"=>$this->getidstatusEditar(),
        ":tipostatus"=>$this->gettipostatusEditar()
      ));

    $acao = "Atualizou o status para o<br> Nome: ". $this->gettipostatusEditar();

    $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);


  }



  public function saveStatusDeletar($idstatus){

   
    $sql = new Sql();

   
     $verificar = $sql->select("SELECT fk_status FROM tb_lead where fk_status = :idstatus", array(
       ":idstatus"=>$idstatus
      ));

     $status = $sql->select("SELECT tipostatus FROM tb_status where idstatus = :idstatus", array(
       ":idstatus"=>$idstatus
      ));


     if(count($verificar) > 0){
        header("location: /".pastaPrincipal."/dashboard/status?delete=$idstatus");
        exit; 

     }else{

        $acao = "Deletou o status - ". $status[0]['tipostatus'];

        $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);


        $results = $sql->select("DELETE FROM tb_status WHERE idstatus = :idstatus", array(
         ":idstatus"=>$idstatus
        ));

        header("location: /".pastaPrincipal."/dashboard/status");
        exit; 

     }

    

  }











}




 ?>