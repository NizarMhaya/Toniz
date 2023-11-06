<?php

// GET /api_repas : Récupère tous les repas de l'utilisateur.

header('Content-Type: application/json'); // Définir le type de contenu JSON

require_once('init_pdo.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Vérifiez l'ID de l'utilisateur à partir des données de la session ou du token d'authentification
    $userID = 1; // Remplacez ceci par la méthode appropriée pour obtenir l'ID de l'utilisateur

    // Utilisez la fonction get_repas_utilisateur pour obtenir les repas de l'utilisateur
    $repasUtilisateur = get_repas_utilisateur($pdo, $userID);

    // Vérifiez si des repas ont été trouvés
    if ($repasUtilisateur) {
        http_response_code(200); // OK
        echo json_encode($repasUtilisateur);
    } else {
        http_response_code(200); // OK (ou 204 No Content selon le cas)
        echo json_encode(array()); // Renvoyer un tableau vide si aucune donnée n'est disponible
    }
}

// Fonction pour récupérer les repas de l'utilisateur
function get_repas_utilisateur($pdo, $userID)
{
    try {
        // Préparez la requête SQL pour obtenir les repas de l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM repas WHERE ID_USER = :user_id");

        // Liez la valeur de l'ID de l'utilisateur en tant que paramètre
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);

        // Exécutez la requête
        $stmt->execute();

        // Récupérez les repas de l'utilisateur
        $repasUtilisateur = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $repasUtilisateur;
    } catch (PDOException $e) {
        // En cas d'erreur, retournez un message d'erreur
        return array('error' => 'Erreur lors de la récupération des repas de l\'utilisateur : ' . $e->getMessage());
    }
}

// Gérer la méthode POST pour créer un nouveau repas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $data = json_decode(file_get_contents("php://input"));

    // Vérifier si toutes les données nécessaires sont présentes dans la demande
    if (isset($data->ID_USER) && isset($data->NOM_REPAS) && isset($data->DATE)) {
        // Récupérer les valeurs des champs du formulaire
        $userID = $data->ID_USER;
        $nomRepas = $data->NOM_REPAS;
        $dateRepas = date('Y-m-d H:i:s', strtotime($data->DATE));

        // Insérer le nouveau repas dans la base de données en appelant la fonction creer_repas
        $result = creer_repas($pdo, $userID, $nomRepas, $dateRepas);

        // Vérifier le résultat de l'opération et renvoyer la réponse appropriée
        if (isset($result['message'])) {
            http_response_code(200); // OK
            echo json_encode($result);
        } elseif (isset($result['error'])) {
            http_response_code(400); // Bad Request ou tout autre code d'erreur approprié
            echo json_encode($result);
        } else {
            http_response_code(500); // Erreur interne du serveur
            echo json_encode(array("error" => "Une erreur inattendue s'est produite lors de la création du repas."));
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(array('error' => 'Toutes les données du formulaire sont requises.'));
    }
}

// Fonction pour créer un nouveau repas
function creer_repas($pdo, $userID, $nomRepas, $dateRepas)
{
    try {
        // Préparez la requête SQL d'insertion avec les champs nécessaires
        $stmt = $pdo->prepare("INSERT INTO repas (ID_USER, NOM_REPAS, DATE) VALUES (:user_id, :nom_repas, :date_repas)");
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':nom_repas', $nomRepas, PDO::PARAM_STR);
        $stmt->bindParam(':date_repas', $dateRepas, PDO::PARAM_STR);

        // Exécutez la requête
        $stmt->execute();

        // Retournez un message de succès
        return array('message' => 'Repas créé avec succès.');
    } catch (PDOException $e) {
        // En cas d'erreur, retournez un message d'erreur
        return array('error' => 'Erreur lors de la création du repas : ' . $e->getMessage());
    }
}
