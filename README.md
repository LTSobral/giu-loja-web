Os arquivos alterados estão com o cabeçalho <!-- Lucas Torres Sobral 2020204062 -->

### Alterações de SQL

```sql

CREATE TABLE `cupom` (
  `cupom_id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `data_validade` date NOT NULL,
  `vl_percentual_desconto` int(3) NOT NULL,
  PRIMARY KEY (`cupom_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO cupom (codigo,data_validade,vl_percentual_desconto)
	VALUES ('VIP','9999-12-31', 30);

ALTER TABLE clientes ADD fl_vip INT DEFAULT 0 NULL;

INSERT INTO `clientes` (
    `cpf`,
    `nome`,
    `logradouro`,
    `cidade`,
    `estado`,
    `cep`,
    `telefone`,
    `data_nascimento`,
    `email`,
    `senha`,
    `rg`,
    `tipo`,
    `fl_vip`,
  )
VALUES 
  (
    '187654321-11',
    'Maria da Penha',
    'Rua Aleatória, 345 - apto. 301',
    'Ouro Preto',
    'MG',
    '30006-909',
    '3552-0002',
    '1998-02-11',
    'sobral@email',
    '111',
    '30976100',
    'C',
    1
  );
```

