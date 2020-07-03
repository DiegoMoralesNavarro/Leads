<?php 





namespace App\DB;

use \App\DB\Sql;

class Logs {



	public function __construct($idusuario, $datalog, $acao){

		$sql = new Sql();
		$logs = $sql->select("INSERT INTO tb_logs (idusuario, datalog, acao) VALUES ('$idusuario', '$datalog', '$acao')");

	}







}

 ?>