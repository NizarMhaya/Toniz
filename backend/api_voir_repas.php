<?php

// GET /api_favoris : Récupère tous les aliments favoris de l'utilisateur.

header('Content-Type: application/json'); // Définir le type de contenu JSON

require_once('init_pdo.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Vérifiez l'ID de l'utilisateur à partir des données de la session ou du token d'authentification
    $login = $_COOKIE['login']; // Remplacez ceci par la méthode appropriée pour obtenir l'ID de l'utilisateur

    try {
        // Préparez la requête SQL pour obtenir les repas de l'utilisateur avec les détails des aliments
        $stmt = $pdo->prepare("SELECT r.ID_REPAS, r.NOM_REPAS, r.DATE, GROUP_CONCAT(a.NOM SEPARATOR ', ') AS ALIMENTS, GROUP_CONCAT(a.MARQUE SEPARATOR ', ') AS MARQUES, SUM(ed.QUANTITE_G) AS QUANTITE_TOTAL 
        FROM repas r 
        LEFT JOIN element_de ed ON r.ID_REPAS = ed.ID_REPAS 
        LEFT JOIN aliment a ON ed.CODE_BARRES = a.CODE_BARRES 
        LEFT JOIN utilisateur u ON r.ID_USER_CONNECTE = u.ID_USER
        WHERE u.LOGIN = :login 
        GROUP BY r.ID_REPAS;
        ");

        // Liez la valeur de l'ID de l'utilisateur en tant que paramètre
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);

        // Exécutez la requête
        $stmt->execute();

        // Récupérez les repas de l'utilisateur avec les détails des aliments
        $repasDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($repasDetails) {
            http_response_code(200); // OK
            echo json_encode($repasDetails);
        } else {
            http_response_code(200); // OK (ou 204 No Content selon le cas)
            echo json_encode(array()); // Renvoyer un tableau vide si aucune donnée n'est disponible
        }
    } catch (PDOException $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(array('error' => 'Erreur lors de la récupération des repas : ' . $e->getMessage()));
    }
}
