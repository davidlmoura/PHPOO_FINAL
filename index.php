<?php

define("CLASS_DIR", 'src/');
set_include_path(get_include_path() . PATH_SEPARATOR . CLASS_DIR);
spl_autoload_register(function( $class ) { include $class . '.php'; });

use SON\Factories\ClienteFactory;
use SON\Db\DataBaseCliente;

$servername = "localhost";
$username = "root";
$password = "root";
$dbName = "phpoo";
$conn = null;

try
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db = new DataBaseCliente($conn);
}
catch(PDOException $e)
{
    die("Erro na conexão: " . $e->getMessage());
}

$arrayTemp = $db->getRecords();

if ($arrayTemp == null)
{
    $arrayTemp = ClienteFactory::createAnyClientArray(10);

    foreach ($arrayTemp as $clienteTemp)
    {
        $db->persist($clienteTemp);
        $db->flush();
    }
}


$arrayC = $db->getRecords();

if (isset($_GET['ord']))
{
    switch ($_GET['ord'])
    {
        case "asc":
            echo "Ordem Crescente!";
            break;
        case "desc":
            echo "Ordem Decrescente!";
            for ($i = 0, $j = count($arrayTemp) - 1; $i < count($arrayTemp); $i++, $j--) {
                $arrayC[$i] = $arrayTemp[$j];
            }
            break;
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <div class="container">
        <h1>Cadastro de Clientes</h1>

        <a class="btn btn-default" href="?ord=asc" role="button">ASC</a>
        <a class="btn btn-default" href="?ord=desc" role="button">DESC</a>

        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

<?php
    $count = 0;
    foreach ($arrayC as $cliente)
    {

?>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading-<?php echo $count; ?>">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $count; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $count; ?>">
                        <?php echo $cliente->getNome() . " [" . $cliente->getTipoCliente() . " " . $cliente->estrelasComoAsterisco() . "]"; ?>
                    </a>
                </h4>
            </div>
            <div id="collapse-<?php echo $count; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?php echo $count; ?>">
                <div class="panel-body">
                    <?php
                        echo $cliente->printCliente();
                        if ($cliente instanceof ClientePJ)
                            echo "Endereço de cobrança: " . $cliente->getEnderecoCobranca();
                    ?>
                </div>
            </div>
        </div>

<?php
        $count++;
    }
?>

        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn = null;
?>