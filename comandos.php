


CRIAR  UM USUARIO TESTE PARA VER SE MOSTRA AS COISAS


SELECT arquivo, tamanho, data, fk_idlead FROM tb_arquivo where tamanho is not null
UNION ALL 
SELECT imagem, tamanho, data, idlead FROM tb_followup where tamanho is not null;

ALTER TABLE `meusite`.`tb_arquivo` 
ADD COLUMN `data` DATE NULL AFTER `tamanho`;



Delete por nome verificando ID
verifica nas 2 tabelas se existe o nome tal se existir faz 
o delete baseado na funções já pronta para aquele tipo.
