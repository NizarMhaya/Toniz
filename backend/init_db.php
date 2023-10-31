<?php
require_once('config.php'); // Inclut le fichier de configuration de la base de données
require_once('init_pdo.php');

// Exécute les commandes SQL depuis le fichier en utilisant file_get_contents
$sql = file_get_contents("sql/database.sql"); // changement ici de aliments en database pour avoir la vraie base de données.
$request = $pdo->prepare($sql);
$request->execute();

$pdo = null;
echo 'La base de données a été initialisée avec succès.';
