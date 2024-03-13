<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
if(empty($attractie)) {
    $errors[] = "Vul atractie naam in";
}

$capaciteit = $_POST['capaciteit'];
if(!is_numeric($capaciteit))
{
    $errors[] = "Vul voor capaciteit geldig getal in";
}

$melder = $_POST['melder'];
if(empty($melder))
{
    $errors[] = "Vul melder's naam in";
}

$type = $_POST['type'];
if(empty($type))
{
    $errors[] = "Vul type in";
}

$overige_info = $_POST['overige_info'];

if(isset($_POST['prioriteit']))
{
    $prioriteit = 1;
}
else
{
    $prioriteit = 0;
}

if(isset($errors))
{
    var_dump($errors);
    die();
}
//1. Verbinding
require_once '../../../config/conn.php';

//2. Query
$query="INSERT INTO meldingen (attractie, type, melder, capaciteit,prioriteit,overige_info)
VALUES(:attractie,:type, :melder, :capaciteit, :prioriteit, :overige_info)";
//3. Prepare
$statement = $conn->prepare($query);
//4. Execute
$statement->execute([
    ":attractie"=>$attractie,
    ":type"=>$type,
    ":melder"=>$melder,
    ":capaciteit"=>$capaciteit,
    ":prioriteit"=>$prioriteit,
    ":overige_info"=>$overige_info
]);


header("Location: ../../../resources/views/meldingen/index.php?msg=Meldingopgeslagen");
