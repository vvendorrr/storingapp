<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
$type = $_POST['type'];
$capaciteit = $_POST['capaciteit'];
if(isset($_POST['prioriteit']))
{
    $prioriteit = true;
}
else
{
    $prioriteit = false;
}
$melder = $_POST['melder'];
$overig = $_POST['overig'];

//Validatie
$attractie = $_POST['attractie'];
if(empty($attractie))
{
$errors[] = "Vul de attractie-naam in.";
}
$type = $_POST['type'];
if(empty($type))
{
$errors[] = "Vul het attractie-type in.";
}
$capaciteit = $_POST['capaciteit'];
if(!is_numeric($capaciteit))
{
$errors[] = "Vul voor capaciteit een geldig getal in.";
}
$melder = $_POST['melder'];
if(empty($melder))
{
$errors[] = "Vul de melder in.";
}

if(isset($errors))
{
var_dump($errors);
die();
}

//1. Verbinding
require_once '../../../config/conn.php';

//2. Query
$query = "INSERT INTO meldingen (attractie, capaciteit, melder) VALUES(:attractie, :capaciteit, :melder)";

//3. Prepare
$statement = $conn->prepare($query)

//4. Execute
$statement->execute([
    ":attractie" => $attractie,
    ":capaciteit" => $capaciteit,
    ":melder" => $melder,
]);

header("Location: ../meldingen/index.php?msg=Melding opgeslagen");
