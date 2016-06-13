<?php
namespace SON\Clientes\Abstracts;

use SON\Interfaces\InterfaceImportanciaCliente;

abstract class AbstractCliente implements InterfaceImportanciaCliente
{
    protected $tipoCliente;

    protected $nome;
    protected $numDoc;
    protected $endereco;

    protected $estrelasCliente;

    public function __construct($nome, $numDoc, $endereco)
    {
        $this->nome = $nome;
        $this->numDoc = $numDoc;
        $this->endereco = $endereco;
        $this->tipoCliente = "Sem Classificação";
        $this->estrelasCliente = 0; // fixo
    }

    /**
     * @return mixed
     */
    public function getNumDoc()
    {
        return $this->numDoc;
    }

    /**
     * @param mixed $numDoc
     */
    public function setNumDoc($numDoc)
    {
        $this->numDoc = $numDoc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public abstract function printCliente();

    public function getTipoCliente()
    {
        return $this->tipoCliente;
    }

    public abstract function getEstrelasCliente();

    public abstract function setEstrelasCliente($numEstrelas);

    public function estrelasComoAsterisco()
    {
        $estrelas = "";
        for ($i = 0; $i < $this->estrelasCliente; $i++)
            $estrelas .= "*";

        return $estrelas;
    }
}