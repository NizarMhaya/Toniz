<?php

require_once('init_pdo.php');

$sql = file_get_contents("sql/database.sql");
$request = $pdo->prepare($sql);

if ($request->execute()) {
    // Succès : la requête s'est exécutée avec succès
    echo "La base de données a été initialisée avec succès!";
} else {
    // Échec : il y a eu une erreur lors de l'exécution de la requête
    echo "Erreur lors de l'initialisation de la base de données : " . implode(" ", $request->errorInfo());
}

$pdo = null;
?>
