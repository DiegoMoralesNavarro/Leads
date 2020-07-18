
h2  Nossos clientes





/////  UPDATE `tb_user` SET `fk_id_cliente`= '1';


ALTER TABLE `meusite`.`tb_followup` 
ADD COLUMN `fk_id_cliente` INT(11) NOT NULL AFTER `fk_id_user`,
ADD INDEX `fk_id_cliente_idx` (`fk_id_cliente` ASC);
;




