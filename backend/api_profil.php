<?php
require_once('init_pdo.php'); // Inclut le fichier qui configure la connexion PDO

header("Content-Type: application/json");

// Vérifie que la requête est une requête POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données JSON
    $json = file_get_contents("php://input");
    $data = json_decode($json);

    // Vérification des données
    if (isset($data->nom) && isset($data->mdp)) {
        // Préparation de la requête SQL
        $query = "INSERT INTO UTILISATEUR (LOGIN, MDP) VALUES (:nom, :mdp)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom', $data->nom);
        $stmt->bindParam(':mdp', $data->mdp);

        // Exécution de la requête
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Erreur lors de l'inscription."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Données manquantes."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Requête non autorisée."]);
}
