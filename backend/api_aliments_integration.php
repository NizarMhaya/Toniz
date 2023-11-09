<?php

// GET /api_favoris : Récupère tous les aliments favoris de l'utilisateur.

header('Content-Type: application/json'); // Définir le type de contenu JSON

require_once('init_pdo.php');
//Ce code sera à utiliser pour afficher seulement les favoris. Or ici je veux afficher tous les aliments donc je reprends le meme get que api_aliments_reel
// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     // Vérifiez l'ID de l'utilisateur à partir des données de la session ou du token d'authentification
//     $userID = 1; // Remplacez ceci par la méthode appropriée pour obtenir l'ID de l'utilisateur

//     // Utilisez la fonction get_aliments_favoris pour obtenir les aliments favoris de l'utilisateur
//     $alimentsFavoris = get_aliments_favoris($pdo, $userID);

//     // Vérifiez si des aliments favoris ont été trouvés
//     if ($alimentsFavoris) {
//         http_response_code(200); // OK
//         echo json_encode($alimentsFavoris);
//     } else {
//         http_response_code(404); // Not Found
//         echo json_encode(array('error' => 'Aucun aliment favori trouvé.'));
//     }
// }

// // Fonction pour récupérer les aliments favoris de l'utilisateur
// function get_aliments_favoris($pdo, $userID)
// {
//     try {
//         // Préparez la requête SQL pour obtenir les aliments favoris de l'utilisateur
//         $stmt = $pdo->prepare("SELECT a.CODE_BARRES, a.NOM, a.MARQUE, a.CATEGORIE, a.ENERGIE_100G
//                               FROM aliment a
//                               JOIN aliments_favoris af ON a.CODE_BARRES = af.CODE_BARRES
//                               WHERE af.ID_USER = :user_id");

//         // Liez la valeur de l'ID de l'utilisateur en tant que paramètre
//         $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);

//         // Exécutez la requête
//         $stmt->execute();

//         // Récupérez les aliments favoris de l'utilisateur
//         $alimentsFavoris = $stmt->fetchAll(PDO::FETCH_ASSOC);

//         return $alimentsFavoris;
//     } catch (PDOException $e) {
//         // En cas d'erreur, retournez un message d'erreur
//         return array('error' => 'Erreur lors de la récupération des aliments favoris : ' . $e->getMessage());
//     }
// }


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Utilisez la fonction get_aliment pour obtenir tous les aliment
    $aliment = get_aliment($pdo);

    // Vérifiez si des aliment ont été trouvés
    if ($aliment) {
        http_response_code(200); // OK
        echo json_encode($aliment);
    } else {
        http_response_code(200); // OK (ou 204 No Content selon le cas)
        echo json_encode(array()); // Renvoyer un tableau vide si aucune donnée n'est disponible
    }
}
// Fonction pour récupérer tous les aliment
function get_aliment($pdo)
{
    $request = $pdo->prepare("SELECT * FROM aliment");
    $request->execute();
    $aliment = $request->fetchAll(PDO::FETCH_ASSOC);
    return $aliment;
}



// Gérer la méthode POST pour ajouter un aliment aux favoris de l'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifiez l'ID de l'utilisateur à partir des données de la session ou du token d'authentification
    $userID = 1; // Remplacez ceci par la méthode appropriée pour obtenir l'ID de l'utilisateur

    $inputData = json_decode(file_get_contents('php://input'), true);

    $codeBarres = $inputData['CODE_BARRES'];

    // Utilisez la fonction add_aliment_to_favoris pour ajouter l'aliment aux favoris de l'utilisateur
    $result = add_aliment_to_favoris($pdo, $userID, $codeBarres);

    // Vérifiez le résultat de l'ajout
    if (isset($result['message'])) {
        http_response_code(200); // OK
        echo json_encode($result);
    } elseif (isset($result['error'])) {
        http_response_code(400); // Bad Request ou tout autre code d'erreur approprié
        echo json_encode($result);
    } else {
        http_response_code(500); // Erreur interne du serveur
        echo json_encode(array("error" => "Une erreur inattendue s'est produite lors de l'ajout de l'aliment aux favoris."));
    }
}

// Fonction pour ajouter un aliment aux favoris de l'utilisateur
function add_aliment_to_favoris($pdo, $userID, $codeBarres)
{
    try {
        // Préparez la requête SQL d'insertion dans la table aliments_favoris
        $stmt = $pdo->prepare("INSERT INTO aliments_favoris (ID_USER, CODE_BARRES) VALUES (:user_id, :code_barres)");

        // Liez les valeurs des paramètres
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':code_barres', $codeBarres, PDO::PARAM_INT);

        // Exécutez la requête
        $stmt->execute();

        // Retournez un message de succès
        return array('message' => 'Aliment ajouté aux favoris avec succès.');
    } catch (PDOException $e) {
        // En cas d'erreur, retournez un message d'erreur
        return array('error' => 'Erreur lors de l\'ajout de l\'aliment aux favoris : ' . $e->getMessage());
    }
}
