


CRIAR  UM USUARIO TESTE PARA VER SE MOSTRA AS COISAS


SELECT arquivo, tamanho, data, fk_idlead FROM tb_arquivo where tamanho is not null
UNION ALL 
SELECT imagem, tamanho, data, idlead FROM tb_followup where tamanho is not null;



SELECT MIN(data) FROM meusite.tb_arquivo where fk_id_cliente = 1;


SELECT * FROM meusite.tb_lead where month(data) = 08;

SELECT * FROM meusite.tb_lead where year(data) = 2021 and month(data) = 4;

select min(data) from meusite.tb_lead;




Delete por nome verificando ID
verifica nas 2 tabelas se existe o nome tal se existir faz 
o delete baseado na funções já pronta para aquele tipo.


ALTER TABLE `meusite`.`tb_followup` 
ADD COLUMN `tb_followupcol` VARCHAR(45) NULL AFTER `fk_id_cliente`,
ADD COLUMN `fk_idtarquivo` INT(11) NULL AFTER `tb_followupcol`;

ALTER TABLE `meusite`.`tb_arquivo` 
ADD COLUMN `fk_idfollowup` INT(11) NULL AFTER `fk_id_cliente`;


ALTER TABLE `meusite`.`tb_followup` 
DROP COLUMN `tb_followupcol`;


ALTER TABLE `meusite`.`tb_followup` 
DROP COLUMN `tamanho`,
DROP COLUMN `imagem`;

