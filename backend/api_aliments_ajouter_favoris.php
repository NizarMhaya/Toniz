<?php

// GET /api_favoris : Récupère tous les aliments favoris de l'utilisateur.

header('Content-Type: application/json'); // Définir le type de contenu JSON

require_once('init_pdo.php');


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

// Fonction pour récupérer l'ID de l'utilisateur en fonction du login
function get_user_id_by_login($pdo, $login)
{
    try {
        // Préparez la requête SQL pour obtenir l'ID de l'utilisateur en fonction du login
        $stmt = $pdo->prepare("SELECT ID_USER FROM utilisateur WHERE LOGIN = :login");

        // Liez la valeur du login en tant que paramètre
        $stmt->bindParam(':login', $login, PDO::PARAM_STR);

        // Exécutez la requête
        $stmt->execute();

        // Récupérez l'ID de l'utilisateur
        $userID = $stmt->fetchColumn();

        return $userID;
    } catch (PDOException $e) {
        // En cas d'erreur, retournez un message d'erreur
        die('Erreur lors de la récupération de l\'ID de l\'utilisateur : ' . $e->getMessage());
    }
} // Remplacez ceci par la méthode appropriée pour obtenir l'ID de l'utilisateur

// Gérer la méthode POST pour ajouter un aliment aux favoris de l'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifiez l'ID de l'utilisateur à partir des données de la session ou du token d'authentification
    $login = $_COOKIE['login'];
    $userID = get_user_id_by_login($pdo, $login); // Ecrire ici une logique permettant de faire le lien entre login et userID
    // rajouter un else se connecter 

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
