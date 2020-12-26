<?php 


namespace App\cliente;

use \App\DB\Sql;
use \App\DB\Logs;


class CriarCliente{



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
	"nomecliente", "usuarioadm", "senha", "confirmarsenha", "email", "consumo"
];




public static function nomecliente(){

  $sql = new Sql();

  return $sql->select("SELECT * FROM tb_cliente where id_cliente not like '1' ");

}


public static function totalcontas(){

  $sql = new Sql();

  return $sql->select("SELECT * FROM tb_user where fk_id_cliente not like '1' ");

}


public static function totalarquivos(){

  $sql = new Sql();

  return $sql->select("SELECT * FROM tb_arquivo where fk_id_cliente not like '1' ");

}









/////////////

public function cadastar(){


    $sql = new Sql();

    $nomeempresa =  $sql->select("SELECT nome_cliente FROM tb_cliente where nome_cliente = :nome", array(
           ":nome"=>$this->getnomecliente()
    ));

    $nomeusuario =  $sql->select("SELECT user FROM tb_user where user = :nome", array(
           ":nome"=>$this->getusuarioadm()
    ));


    if (!$nomeempresa == $this->getnomecliente() || !$nomeempresa == "") {
      
        
        if (!$nomeusuario == $this->getusuarioadm() || !$nomeusuario == "") {
          
            if ($this->getsenha() == $this->getconfirmarsenha()){

              $pasta = $this->getnomecliente();
              $pasta = str_replace('.', '', $pasta);
              $pasta = str_replace(" ","",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($pasta))));

              $val = $this->getconsumo();
              $v1 = ($val*1000)/1;
              $v2 = ($v1*1000)/1;

              $results = $sql->select("INSERT INTO tb_cliente (nome_cliente, nome_pasta, status_cliente, cliente_data, consumo) VALUES (:cliente, :pasta, :status, :data, :consumo)", array(
                 ":cliente"=>$this->getnomecliente(),
                 ":pasta"=>$pasta,
                 ":status"=>"1",
                 ":consumo"=>$v2,
                 ":data"=>date('Y-m-d')
                 
              ));


              $id =  $sql->select("SELECT LAST_INSERT_ID()");
              $idlead = $id[0]['LAST_INSERT_ID()'];

              // var_dump($idlead);


              $results = $sql->select("INSERT INTO tb_user (user, senha, nivel, dataCriado, email, fk_id_cliente, user_status) VALUES (:user, :senha, :nivel, :dataCriado, :email, :cliente, :status)", array(
                 ":user"=>$this->getusuarioadm(),
                 ":senha"=>md5($this->getsenha()),
                 ":nivel"=>"1",
                 ":dataCriado"=>date('Y-m-d'),
                 ":email"=>$this->getemail(),
                 ":cliente"=>$idlead,
                 ":status"=>"1"
              ));


              $acao = "Cadastrado empresa/cliente <br> Nome: ". $this->getnomecliente();

              $log = new Logs($_SESSION["id_user"], date('Y-m-d H:i'), $acao);

              setcookie("Atualizado", "Atualizado");

              header("Location: /".pastaPrincipal."/dashboard/configurar/cliente");
              exit;


            }else{
              header("Location: /".pastaPrincipal."/dashboard/configurar/cliente/cadastro?senha=errado");
              exit;
            }

        }else{
          header("Location: /".pastaPrincipal."/dashboard/configurar/cliente/cadastro?nomeusuario=duplicado");
          exit;
        }


    }else{
      header("Location: /".pastaPrincipal."/dashboard/configurar/cliente/cadastro?nomecliente=duplicado");
      exit;
    }




}








public function deletar(){

}







}



 ?>