<?php
$connectionString = "mysql:host=" . _MYSQL_HOST;
if (defined('_MYSQL_PORT'))
    $connectionString .= ";port=" . _MYSQL_PORT;
$connectionString .= ";dbname=" . _MYSQL_DBNAME2; //j'ai changé _MYSQL_DBNAME en _MYSQL_DBNAME2 ici
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$pdo = NULL;
try {
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erreur) {
    echo 'Erreur : ' . $erreur->getMessage();
}
$request = $pdo->prepare("select * from aliments"); //j'ai changé users en aliments ici
$request->execute();
