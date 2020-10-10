


CRIAR  UM USUARIO TESTE PARA VER SE MOSTRA AS COISAS


SELECT arquivo, tamanho, data, fk_idlead FROM tb_arquivo where tamanho is not null
UNION ALL 
SELECT imagem, tamanho, data, idlead FROM tb_followup where tamanho is not null;



SELECT MIN(data) FROM meusite.tb_arquivo where fk_id_cliente = 1;


SELECT * FROM meusite.tb_lead where month(data) = 08;

SELECT * FROM meusite.tb_lead where year(data) = 2021 and month(data) = 4;

select min(data) from meusite.tb_lead;



////////////////////////////////////////////////

////////////////////////////////////////////////////


ALTER TABLE `tb_lembrete` 
ADD COLUMN `data_lembrete_final` DATE NULL AFTER `data_lembrete`;
