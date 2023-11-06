<?php

// GET /api_favoris : Récupère tous les aliments favoris de l'utilisateur.

header('Content-Type: application/json'); // Définir le type de contenu JSON

require_once('init_pdo.php');
//Ce code sera à utiliser pour afficher seulement les favoris. Or ici je veux afficher tous les aliments donc je reprends le meme get que api_aliments_reel
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Vérifiez l'ID de l'utilisateur à partir des données de la session ou du token d'authentification
    $userID = 1; // Remplacez ceci par la méthode appropriée pour obtenir l'ID de l'utilisateur
    // rajouter un else se connecter 

    // Utilisez la fonction get_aliments_favoris pour obtenir les aliments favoris de l'utilisateur
    $alimentsFavoris = get_aliments_favoris($pdo, $userID);

    // Vérifiez si des aliments favoris ont été trouvés
    if ($alimentsFavoris) {
        http_response_code(200); // OK
        echo json_encode($alimentsFavoris);
    } else {
        http_response_code(200); // OK (ou 204 No Content selon le cas)
        echo json_encode(array()); // Renvoyer un tableau vide si aucune donnée n'est disponible
    }
}

// Fonction pour récupérer les aliments favoris de l'utilisateur
function get_aliments_favoris($pdo, $userID)
{
    try {
        // Préparez la requête SQL pour obtenir les aliments favoris de l'utilisateur
        $stmt = $pdo->prepare("SELECT a.CODE_BARRES, a.NOM, a.MARQUE, a.CATEGORIE, a.ENERGIE_100G
                              FROM aliment a
                              JOIN aliments_favoris af ON a.CODE_BARRES = af.CODE_BARRES
                              WHERE af.ID_USER = :user_id");

        // Liez la valeur de l'ID de l'utilisateur en tant que paramètre
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);

        // Exécutez la requête
        $stmt->execute();

        // Récupérez les aliments favoris de l'utilisateur
        $alimentsFavoris = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $alimentsFavoris;
    } catch (PDOException $e) {
        // En cas d'erreur, retournez un message d'erreur
        return array('error' => 'Erreur lors de la récupération des aliments favoris : ' . $e->getMessage());
    }
}


// DELETE /api_favoris : Supprime un aliment favori de l'utilisateur.


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Vérifiez l'ID de l'utilisateur à partir des données de la session ou du token d'authentification
    $userID = 1; // Remplacez ceci par la méthode appropriée pour obtenir l'ID de l'utilisateur

    // Récupérez l'ID de l'aliment favori à partir de la requête DELETE
    $codeBarres = $_GET['CODE_BARRES']; // Assurez-vous que le nom du paramètre correspond à votre URL

    // Utilisez la fonction delete_aliment_favori pour supprimer l'aliment favori de l'utilisateur
    $result = delete_aliment_favori($pdo, $userID, $codeBarres);

    // Vérifiez le résultat de la suppression
    if (isset($result['message'])) {
        http_response_code(200); // OK
        echo json_encode($result);
    } elseif (isset($result['error'])) {
        http_response_code(400); // Bad Request ou tout autre code d'erreur approprié
        echo json_encode($result);
    } else {
        http_response_code(500); // Erreur interne du serveur
        echo json_encode(array("error" => "Une erreur inattendue s'est produite lors de la suppression de l'aliment favori."));
    }
}

// Fonction pour supprimer un aliment favori de l'utilisateur
function delete_aliment_favori($pdo, $userID, $codeBarres)
{
    try {
        // Préparez la requête SQL de suppression de l'aliment favori en utilisant l'ID de l'utilisateur et l'ID de l'aliment
        $stmt = $pdo->prepare("DELETE FROM aliments_favoris WHERE ID_USER = :user_id AND CODE_BARRES = :code_barres");

        // Liez les valeurs des paramètres
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':code_barres', $codeBarres, PDO::PARAM_INT);

        // Exécutez la requête
        $stmt->execute();

        // Vérifiez combien de lignes ont été affectées (si aucune ligne n'est affectée, l'aliment favori n'existe peut-être pas)
        if ($stmt->rowCount() > 0) {
            // Retournez un message de succès si l'aliment favori a été supprimé
            return array('message' => 'Aliment favori supprimé avec succès.');
        } else {
            // Retournez un message d'erreur si l'aliment favori n'existe pas ou n'a pas pu être supprimé
            return array('error' => 'Aliment favori non trouvé ou impossible de le supprimer.');
        }
    } catch (PDOException $e) {
        // En cas d'erreur, retournez un message d'erreur
        return array('error' => 'Erreur lors de la suppression de l\'aliment favori : ' . $e->getMessage());
    }
}
