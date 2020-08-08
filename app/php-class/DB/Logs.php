<?php 





namespace App\DB;

use \App\DB\Sql;

class Logs {



	public function __construct($idusuario, $datalog, $acao){

		$idcliente = $_SESSION["fk_id_cliente"];

		$sql = new Sql();
		$logs = $sql->select("INSERT INTO tb_logs (idusuario, datalog, acao, fk_id_cliente) VALUES ('$idusuario', '$datalog', '$acao', '$idcliente')");

	}







}

 ?>