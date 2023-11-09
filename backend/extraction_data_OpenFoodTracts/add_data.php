<?php
require_once('../init_pdo.php'); // Assurez-vous que le chemin vers init_pdo.php est correct

// Chemin vers le fichier CSV
$file = 'output2.csv';

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
        $matieres_grasses = $row[5];
        $graisses_saturees = $row[6];
        $glucides = $row[7];
        $sucres = $row[8];
        $fibres = $row[9];
        $proteines = $row[10];
        $sel = $row[11];
        $sodium = $row[12];
        $calcium = $row[13];

        // Préparez les données pour insertion
        $categories = explode(', ', $categories); // Si les catégories sont séparées par des virgules

        // Préparez la chaîne de catégories pour insertion dans la base de données
        $categories_string = implode(', ', array_map(function($category) use ($pdo) {
            return $pdo->quote($category);
        }, $categories));

        // Exemple d'insertion avec PDO (suppose que vous avez une table 'aliment' avec des colonnes correspondantes)
        $insertQuery = "INSERT IGNORE INTO aliment (CODE_BARRES, NOM, MARQUE, CATEGORIE, ENERGIE_100G, MATIERES_GRASSES, GRAISSES_SATUREES, GLUCIDES, SUCRES, FIBRES, PROTEINES, SEL, SODIUM, CALCIUM) 
            VALUES (:code_barres, :nom, :marque, :categories, :energie_100g, :matieres_grasses, :graisses_saturees, :glucides, :sucres, :fibres, :proteines, :sel, :sodium, :calcium)";
        $insertStatement = $pdo->prepare($insertQuery);
        $insertStatement->bindParam(':code_barres', $code_barres);
        $insertStatement->bindParam(':nom', $nom);
        $insertStatement->bindParam(':marque', $marque);
        $insertStatement->bindParam(':categories', $categories_string);
        $insertStatement->bindParam(':energie_100g', $energie_100g);
        $insertStatement->bindParam(':matieres_grasses', $matieres_grasses);
        $insertStatement->bindParam(':graisses_saturees', $graisses_saturees);
        $insertStatement->bindParam(':glucides', $glucides);
        $insertStatement->bindParam(':sucres', $sucres);
        $insertStatement->bindParam(':fibres', $fibres);
        $insertStatement->bindParam(':proteines', $proteines);
        $insertStatement->bindParam(':sel', $sel);
        $insertStatement->bindParam(':sodium', $sodium);
        $insertStatement->bindParam(':calcium', $calcium);

        if ($insertStatement->execute()) {
            echo "Ligne insérée avec succès.\n";
        } else {
            echo "Erreur lors de l'insertion. Détails de l'erreur : " . print_r($insertStatement->errorInfo(), true) . "\n";
        }
    }

    fclose($handle);
} else {
    echo "Impossible d'ouvrir le fichier.";
}
?>
