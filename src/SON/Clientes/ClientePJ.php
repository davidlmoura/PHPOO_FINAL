<?php
namespace SON\Clientes;

use SON\Clientes\Abstracts\AbstractCliente;
use SON\Interfaces\InterfaceEnderecoCobranca;


class ClientePJ extends AbstractCliente implements InterfaceEnderecoCobranca
{
    private $anoFundacao;
    private $enderecoCobranca;

    public function __construct($nome, $numDoc, $endereco, $anoFundacao)
    {
        parent::__construct($nome, $numDoc, $endereco);
        $this->anoFundacao = $anoFundacao;
        $this->tipoCliente = "Pessoa Jurídica";
        $this->estrelasCliente = 2; // clientes PJ tem no mínimo 2 estrelas
    }

    /**
     * @return mixed
     */
    public function getAnoFundacao()
    {
        return $this->anoFundacao;
    }

    /**
     * @param mixed $anoFundacao
     * @return ClientePJ
     */
    public function setAnoFundacao($anoFundacao)
    {
        $this->anoFundacao = $anoFundacao;
        return $this;
    }

    public function printCliente()
    {
        echo "Tipo de Clientes: " . $this->getTipoCliente() . " " . $this->estrelasComoAsterisco() . "<br>";
        echo "Nome: " . $this->getNome() . "<br>";
        echo "CNPJ: " . $this->getNumDoc() . "<br>";
        echo "Ano de fundação: " . $this->getAnoFundacao() . "<br>";
        echo "Endereço: " . $this->getEndereco() . "<br>";
    }

    public function getEstrelasCliente()
    {
        return $this->estrelasCliente;
    }

    public function setEstrelasCliente($numEstrelas)
    {
        if ($numEstrelas >= 2)
            $this->estrelasCliente = $numEstrelas;

        return $this;
    }

    public function getEnderecoCobranca()
    {
        return $this->enderecoCobranca;
    }

    public function setEnderecoCobranca($enderecoCobranca)
    {
        $this->enderecoCobranca = $enderecoCobranca;

        return $this;
    }
}