<?php
require_once('../init_pdo.php'); // Assurez-vous que le chemin vers init_pdo.php est correct

// Chemin vers le fichier CSV
$file = 'output.csv';

if (($handle = fopen($file, 'r')) !== FALSE) {
    // Lire la première ligne (l'en-tête) sans la traiter
    $header = fgetcsv($handle, 0, ';');

    while (($row = fgetcsv($handle, 0, ';')) !== FALSE) {
        // Vous pouvez accéder aux colonnes par leur index
        $code_barres = $row[0];
        $nom = $row[1];
        $marque = $row[2];
        $categories = $row[3];
        $energie_100g = $row[4];

        // Ajout de débogage pour voir chaque ligne du CSV
        echo "Ligne lue : Code barres : $code_barres, Nom : $nom \n";

        // Préparez les données pour insertion
        $categories = explode(', ', $categories); // Si les catégories sont séparées par des virgules

        // Préparez la chaîne de catégories pour insertion dans la base de données
        $categories_string = implode(', ', array_map(function($category) use ($pdo) {
            return $pdo->quote($category);
        }, $categories));

        // Exemple d'insertion avec PDO (suppose que vous avez une table 'aliment' avec des colonnes correspondantes)
        $insertQuery = "INSERT IGNORE INTO aliment (code_barres, nom, marque, categorie, energie_100g) 
            VALUES (:code_barres, :nom, :marque, :categories, :energie_100g)";
        $insertStatement = $pdo->prepare($insertQuery);
        $insertStatement->bindParam(':code_barres', $code_barres);
        $insertStatement->bindParam(':nom', $nom);
        $insertStatement->bindParam(':marque', $marque);
        $insertStatement->bindParam(':categories', $categories_string);
        $insertStatement->bindParam(':energie_100g', $energie_100g);

        if ($insertStatement->execute()) {
            echo "Ligne insérée avec succès.\n";
            // echo "Utilisation de la mémoire : " . (memory_get_usage() / 1024) . " Ko\n";

        } else {
            echo "Erreur lors de l'insertion. Détails de l'erreur : " . print_r($insertStatement->errorInfo(), true) . "\n";
        }
    }

    fclose($handle);
} else {
    echo "Impossible d'ouvrir le fichier.";
}
?>
