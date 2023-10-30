<?php

// GET /api_aliments : Récupère tous les aliments de la base de données.


header('Content-Type: application/json'); // Définir le type de contenu JSON

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Utilisez la fonction get_aliments pour obtenir tous les aliments
    $aliments = get_aliments($pdo);

    // Vérifiez si des aliments ont été trouvés
    if ($aliments) {
        http_response_code(200); // OK
        echo json_encode($aliments);
    } else {
        http_response_code(404); // Not Found
        echo json_encode(array('error' => 'Aucun utilisateur trouvé.'));
    }
}
// Fonction pour récupérer tous les aliments
function get_aliments($pdo)
{
    $request = $pdo->prepare("SELECT * FROM aliments");
    $request->execute();
    $aliments = $request->fetchAll(PDO::FETCH_ASSOC);
    return $aliments;
}

// Gérer la méthode POST pour créer un nouvel utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);
    $result = create_user($pdo, $inputData);
    // Vérifiez le résultat de la mise à jour
    if (isset($result['message'])) {
        http_response_code(200); // OK
        echo json_encode($result);
    } elseif (isset($result['error'])) {
        http_response_code(400); // Bad Request ou tout autre code d'erreur approprié
        echo json_encode($result);
    } else {
        http_response_code(500); // Erreur interne du serveur
        echo json_encode(array("error" => "Une erreur inattendue s'est produite lors de la mise à jour de l'utilisateur."));
    }
}

// Fonction pour créer un nouvel utilisateur
function create_user($pdo, $data)
{
    $name = $data['name']; // Récupération du nom depuis les données d'entrée

    try {
        // Préparez la requête SQL d'insertion avec le champ "name"
        $stmt = $pdo->prepare("INSERT INTO aliments (name) VALUES (:name)");

        // Liez les valeurs des paramètres
        $stmt->bindParam(':name', $name);

        // Exécutez la requête
        $stmt->execute();

        // Retournez un message de succès
        return array('message' => 'Nouvel utilisateur cree avec succes.');
    } catch (PDOException $e) {
        // En cas d'erreur, retournez un message d'erreur
        return array('error' => 'Erreur lors de la création de l\'utilisateur : ' . $e->getMessage());
    }
}


// Gérer la méthode DELETE pour supprimer un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // $inputData = json_decode(file_get_contents('php://input'), true); // Comme il n'y a pas cette ligne, on ne prend pas de json de l'utilisateur de l'utilisateurs, tout est dans l'url en GET
    $result = delete_user($pdo, $_GET);
    // Vérifiez le résultat de la mise à jour
    if (isset($result['message'])) {
        http_response_code(200); // OK
        echo json_encode($result);
    } elseif (isset($result['error'])) {
        http_response_code(400); // Bad Request ou tout autre code d'erreur approprié
        echo json_encode($result);
    } else {
        http_response_code(500); // Erreur interne du serveur
        echo json_encode(array("error" => "Une erreur inattendue s'est produite lors de la mise à jour de l'utilisateur."));
    }
}

// Fonction pour supprimer un utilisateur
function delete_user($pdo, $data)
{
    $user_id = $data['id']; // Récupération de l'ID de l'utilisateur depuis les données d'entrée

    try {
        // Préparez la requête SQL de suppression en utilisant l'ID de l'utilisateur
        $stmt = $pdo->prepare("DELETE FROM aliments WHERE id = :id");

        // Liez la valeur de l'ID en tant que paramètre
        $stmt->bindParam(':id', $user_id);

        // Exécutez la requête
        $stmt->execute();

        // Vérifiez combien de lignes ont été affectées (si aucune ligne n'est affectée, l'utilisateur n'existe peut-être pas)
        if ($stmt->rowCount() > 0) {
            // Retournez un message de succès si l'utilisateur a été supprimé
            return array('message' => 'Utilisateur supprimé avec succès.');
        } else {
            // Retournez un message d'erreur si l'utilisateur n'existe pas ou n'a pas pu être supprimé
            return array('error' => 'Utilisateur non trouvé ou impossible de le supprimer.');
        }
    } catch (PDOException $e) {
        // En cas d'erreur, retournez un message d'erreur
        return array('error' => 'Erreur lors de la suppression de l\'utilisateur : ' . $e->getMessage());
    }
}
