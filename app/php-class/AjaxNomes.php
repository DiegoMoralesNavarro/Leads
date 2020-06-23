<?php 


// include "DB/Sql.php";

// namespace App;

// use \App\DB\Sql;

// if(isset($_POST['search'])){
// //     $search = $_POST['search'];

//     $sql = new Sql();
//       $nome = $sql->select("SELECT * FROM tb_lead WHERE nome like'%".$search."%' limit 3");


//       foreach ($nome as $value) {
//         // array_push($valornomes, $value['nome']);
//         $response[] = array("label"=>$value['nome']);
//       }

//       echo json_encode($response);

// }

// exit;


include "DB/config.php";


if(isset($_POST['search'])){
    $search = $_POST['search'];

   //SQL para selecionar os registros
$result_msg_cont = "SELECT * FROM tb_lead WHERE nome like'%".$search."%' limit 3";

//Seleciona os registros
$resultado_msg_cont = $conn->prepare($result_msg_cont);
$resultado_msg_cont->execute();

while($row_msg_cont = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC)){
     $response[] = array("label"=>$row_msg_cont['nome']);
}

echo json_encode($response);


}

exit;














 ?>

