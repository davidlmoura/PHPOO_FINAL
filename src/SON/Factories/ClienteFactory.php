<?php
namespace SON\Factories;
use SON\Clientes\ClientePF;
use SON\Clientes\ClientePJ;



class ClienteFactory
{
    public static function createClientePFArray ($numClientes)
    {
        $arrayClientes = null;

        for ($i = 0; $i < $numClientes; $i++)
        {
            $arrayClientes[$i] = new ClientePF("Cliente ".$i, "123.456.789.".$i, "Rua número ".$i, 30+$i);
        }
        return $arrayClientes;
    }

    public static function createClientePJArray ($numClientes)
    {
        $arrayClientes = null;

        for ($i = 0; $i < $numClientes; $i++)
        {
            $arrayClientes[$i] = new ClientePJ("Cliente ".$i, "123.456.789/0001-".$i, "Rua número ".$i, 1940+$i);
            $arrayClientes[$i]->setEnderecoCobranca("Rua cobrar aqui, número " . $i);
        }
        return $arrayClientes;
    }

    public static function createAnyClientArray ($numClientes)
    {
        $arrayClientes = null;

        for ($i = 0; $i < $numClientes; $i++)
        {
            $cliente = null;
            switch (rand(2,3))
            {
                case 2:
                    $cliente = new ClientePF("Cliente ".$i, "123.456.789.".$i, "Rua número ".$i, 30+$i);
                    $cliente->setEstrelasCliente($cliente->getEstrelasCliente() + rand(0,5));
                    break;
                case 3:
                    $cliente = new ClientePJ("Cliente ".$i, "123.456.789/0001-".$i, "Rua número ".$i, 1940+$i);
                    $cliente->setEnderecoCobranca("Rua cobrar aqui, número " . $i);
                    $cliente->setEstrelasCliente($cliente->getEstrelasCliente() + rand(0,5));
            }

            $arrayClientes[$i] = $cliente;
        }
        return $arrayClientes;
    }
}