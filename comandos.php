
Tempo de atendimento para NOVO Lead

Leads na fila para retorno.

Excelente
Até 4 horas
Leads em espera: 2

Bom
Até 24 horas
Leads em espera: 2

Ruim
Até 48 horas
Leads em espera: 2





SELECT * FROM tb_lead WHERE YEAR(data) = '2020' and MONTH(data) = '4';

SELECT data FROM tb_lead WHERE data between '2020-08-02 19:14:00' and '2020-08-03 19:50:00';

SELECT data FROM tb_lead WHERE data >= '2020-06-19 18:43:22';

SELECT * FROM tb_lead WHERE data between '2020-08-07 13:39:51' and '2020-08-07 18:39:51';



/////  UPDATE `tb_logs` SET `fk_id_cliente`= '1';


ALTER TABLE `meusite`.`tb_followup` 
ADD COLUMN `fk_id_cliente` INT(11) NOT NULL AFTER `fk_id_user`,
ADD INDEX `fk_id_cliente_idx` (`fk_id_cliente` ASC);
;


5 = 1

2 = 3

32 = 2

UPDATE `agencianovaaca01`.`tb_lead` SET `fk_status` = '2' WHERE `fk_status` = '32';


ALTER TABLE `meusite`.`tb_arquivo` 
ADD COLUMN `fk_id_cliente` INT(11) NOT NULL AFTER `fk_idlead`;

ALTER TABLE `meusite`.`tb_cliente` 
ADD COLUMN `nome_pasta` VARCHAR(95) NOT NULL AFTER `nome_cliente`;
