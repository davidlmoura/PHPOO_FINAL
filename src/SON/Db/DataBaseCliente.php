<?php
namespace SON\Db;

use PDO;
use PDOException;
use SON\Clientes\Abstracts\AbstractCliente;
use SON\Clientes\ClientePF;
use SON\Clientes\ClientePJ;

class DataBaseCliente
{
    private $pdo = null;
    private $cliente = null;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function persist(AbstractCliente $cliente)
    {
        if ($cliente instanceof ClientePF)
        {
            $this->cliente = new ClientePF($cliente->getNome(), $cliente->getNumDoc(), $cliente->getEndereco(), $cliente->getIdade());
        }
        if ($cliente instanceof ClientePJ)
        {
            $this->cliente = new ClientePJ($cliente->getNome(), $cliente->getNumDoc(), $cliente->getEndereco(), $cliente->getAnoFundacao());
        }
    }


    public function flush()
    {

        if ($this->cliente == null)
        {
            return;
        }


        if ($this->cliente instanceof AbstractCliente)
        {
            $tipoCliente = $this->cliente->getTipoCliente();
            $nome = $this->cliente->getNome();
            $numDoc = $this->cliente->getNumDoc();
            $endereco = $this->cliente->getEndereco();
            $estrelasCliente = $this->cliente->getEstrelasCliente();
        }


        $idade = 0;
        if ($this->cliente instanceof ClientePF)
        {
            $idade = $this->cliente->getIdade();
        }

        $anoFundacao = 0;
        $enderecoCobranca = "";
        if ($this->cliente instanceof ClientePJ)
        {
            $anoFundacao = $this->cliente->getAnoFundacao();
            $enderecoCobranca = $this->cliente->getEnderecoCobranca();
        }

        $sql = "";
        try
        {
            $stmt = $this->pdo->prepare("INSERT INTO
                      clientes (
                        `tipo_cliente`,
                        `nome`,
                        `num_doc`,
                        `endereco`,
                        `endereco_cobranca`,
                        `idade`,
                        `ano_fundacao`,
                        `estrelas_cliente`
                      )
                    VALUES (:a1, :a2, :a3, :a4, :a5, :a6, :a7, :a8)");

            $stmt->execute(array(":a1"=>$tipoCliente, ":a2"=>$nome, ":a3"=>$numDoc, ":a4"=>$endereco, ":a5"=>$enderecoCobranca, ":a6"=>$idade, ":a7"=>$anoFundacao, ":a8"=>$estrelasCliente));
//
        }
        catch(PDOException $e)
        {
            die($sql . "<br>" . $e->getMessage());
        }
    }


    public function getRecords()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $arrayClientes = null;

        if (count($results) > 0)
        {
            $count = 0;

            foreach($results as $row)
            {
                if ($row["tipo_cliente"] === "Pessoa Jurídica") // means it is a ClientPJ
                {
                    $cliente = new ClientePJ($row["nome"], $row["num_doc"], $row["endereco"], $row["ano_fundacao"]);
                    $cliente->setEnderecoCobranca($row["endereco_cobranca"]);
                    $arrayClientes[$count] = $cliente;
                }
                else
                {
                    $cliente = new ClientePF($row["nome"], $row["num_doc"], $row["endereco"], $row["idade"]);
                    $arrayClientes[$count] = $cliente;
                }
                $count++;
            }
        }

        return $arrayClientes;

    }
}