  $results = $sql->select("UPDATE tb_followup SET texto = :texto, dataAtualizada = :dataAtualizada, imagem = :imagem WHERE idfollowup = :idfollowup", array(
                      ":texto"=>$this->gettexto(),
                       ":dataAtualizada"=>date('Y-m-d H:i'),
                       ":imagem"=>$arquivo,
                       ":idfollowup"=>$this->getidfollowup()
                      ));
                  






                  //verificar se o upload aconteceu
              if(move_uploaded_file($file["tmp_name"], $dirUpload . DIRECTORY_SEPARATOR .$numero . $file["name"])){

                $arquivo = $numero . $file["name"];

                var_dump($arquivo);
                //

                
                //
                header("location: /".pastaPrincipal."/dashboard/follow-up/$idlead");
                exit;

             }else{

             header("location: /".pastaPrincipal."/dashboard/follow-up/$idlead");
              exit;
             }