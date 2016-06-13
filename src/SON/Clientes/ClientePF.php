<?php
namespace SON\Clientes;

use SON\Clientes\Abstracts\AbstractCliente;


class ClientePF extends AbstractCliente
{
    private $idade;

    public function __construct($nome, $numDoc, $endereco, $idade)
    {
        parent::__construct($nome, $numDoc, $endereco);
        $this->idade = $idade;
        $this->tipoCliente = "Pessoa Física";
        $this->estrelasCliente = 1; // clientes PF te no mínimo 1 estrela
    }

    /**
     * @return mixed
     */
    public function getIdade()
    {
        return $this->idade;
    }

    /**
     * @param mixed $idade
     */
    public function setIdade($idade)
    {
        $this->idade = $idade;
        return $this;
    }

    public function printCliente()
    {
        echo "Tipo de Clientes: " . $this->getTipoCliente() . " " . $this->estrelasComoAsterisco() . "<br>";
        echo "Nome: " . $this->getNome() . "<br>";
        echo "CPF: " . $this->getNumDoc() . "<br>";
        echo "Idade: " . $this->getIdade() . "<br>";
        echo "Endereço: " . $this->getEndereco() . "<br>";
    }

    public function getEstrelasCliente()
    {
        return $this->estrelasCliente;
    }

    public function setEstrelasCliente($numEstrelas)
    {
        if ($numEstrelas >= 1)
            $this->estrelasCliente = $numEstrelas;

        return $this;
    }

}