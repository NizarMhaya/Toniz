<?php
define('_MYSQL_HOST', '127.0.0.1');
define('_MYSQL_PORT', 3306);
define('_MYSQL_DBNAME', 'dbtest');
define('_MYSQL_USER', 'root');
define('_MYSQL_PASSWORD', '');
define('_API_URL', 'http://localhost/Toniz/backend/api_aliments_ajouter_favoris.php');
define('_MYSQL_DBNAME2', 'database');

$connectionString = "mysql:host=" . _MYSQL_HOST;

if (defined('_MYSQL_PORT')) {
    $connectionString .= ";port=" . _MYSQL_PORT;
}

$connectionString .= ";dbname=" . _MYSQL_DBNAME2; //changement ici de _MYSQL_DBNAME pour se connecter à la vraie base de données

$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$pdo = NULL;

try {
    $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erreur) {
    echo json_encode(array('error' => 'Erreur : ' . $erreur->getMessage()));
    exit;
}
