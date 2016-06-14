<?php

require_once "conexaoDB.php";

echo "#### Executando Fixture ####\n";

$conn = conexaoDB();

echo "Removendo Tabela";
$conn->query("DROP TABLE IF EXISTS clientes;");
echo " - OK\n";

echo "Criando Tabela";
$conn->query("CREATE TABLE clientes (
      id INT NOT NULL AUTO_INCREMENT,
      tipo_cliente VARCHAR(255) CHARACTER SET 'utf8' NULL,
      nome VARCHAR(255) CHARACTER SET 'utf8' NULL,
      num_doc VARCHAR(255) CHARACTER SET 'utf8' NULL,
      endereco VARCHAR(255) CHARACTER SET 'utf8' NULL,
      endereco_cobranca VARCHAR(255) CHARACTER SET 'utf8' NULL,
      idade VARCHAR(255) CHARACTER SET 'utf8' NULL,
      ano_fundacao VARCHAR(255) CHARACTER SET 'utf8' NULL,
      estrelas_cliente VARCHAR(255) CHARACTER SET 'utf8' NULL,
      PRIMARY KEY (id));");
echo " - OK\n";

echo "#### Concluido ####\n";