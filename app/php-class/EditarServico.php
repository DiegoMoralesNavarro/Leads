<?php 


namespace App;

use \App\DB\Sql;


class EditarServico{



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
	"tiposervico", "idservicoEditar", "tiposervicoEditar"
];


// get


  public static function listServico()
  {
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_servico");
  }








// pot


 public function saveServico(){
    $sql = new Sql();

    if ($this->gettiposervico() == "") {
      //vazio
    }else{
      $results = $sql->select("INSERT INTO tb_servico (tiposervico) VALUES (:tiposervico)", array(
          
          ":tiposervico"=>$this->gettiposervico()
        ));
    }

  }



 public function saveServicoUpdate(){
    $sql = new Sql();
    
    $results = $sql->select("UPDATE tb_servico SET tiposervico = :tiposervico WHERE idservico = :idservico", array(
       ":idservico"=>$this->getidservicoEditar(),
        ":tiposervico"=>$this->gettiposervicoEditar()
      ));

  }






public function ServicoDeletar($idservico){

   
    $sql = new Sql();

   
     $verificar = $sql->select("SELECT idservico FROM tb_categoria where idservico = :idservico", array(
       ":idservico"=>$idservico
      ));


     if(count($verificar) > 0){
        header("location: /".pastaPrincipal."/dashboard/servico?delete=$idservico");
        exit; 

     }else{
        $results = $sql->select("DELETE FROM tb_servico WHERE idservico = :idservico", array(
         ":idservico"=>$idservico
        ));

        header("location: /".pastaPrincipal."/dashboard/servico");
        exit; 

     }

    

  }










}



 ?>