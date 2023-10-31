<?php

// GET /api_aliment : Récupère tous les utilisateurs de la base de données.


header('Content-Type: application/json'); // Définir le type de contenu JSON

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Utilisez la fonction get_aliment pour obtenir tous les aliment
    $aliment = get_aliment($pdo);

    // Vérifiez si des aliment ont été trouvés
    if ($aliment) {
        http_response_code(200); // OK
        echo json_encode($aliment);
    } else {
        http_response_code(404); // Not Found
        echo json_encode(array('error' => 'Aucun utilisateur trouvé.'));
    }
}
// Fonction pour récupérer tous les aliment
function get_aliment($pdo)
{
    $request = $pdo->prepare("SELECT * FROM utilisateur");
    $request->execute();
    $aliment = $request->fetchAll(PDO::FETCH_ASSOC);
    return $aliment;
}

// Gérer la méthode POST pour créer un nouvel aliment
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
    $ID_USER = $data['ID_USER']; // pas utile
    $nom = $data['NOM'];
    $AGE = $data['AGE'];
    $SEXE = $data['SEXE'];
    $SPORT = $data['SPORT'];


    try {
        // Préparez la requête SQL d'insertion qui effectue le calcule des kcal_jour
        $stmt = $pdo->prepare("INSERT INTO utilisateur (ID_USER, NOM, AGE, SEXE, SPORT, KCAL_JOUR)
        VALUES (:ID_USER, :nom, :AGE, :SEXE, :SPORT, 
        CASE 
            WHEN SPORT = 'eleve' AND SEXE = 1 THEN 10 * AGE + 20
            WHEN SPORT = 'eleve' AND SEXE = 2 THEN 8 * AGE + 16
            WHEN SPORT = 'moyen' AND SEXE = 1 THEN 10 * AGE + 10
            WHEN SPORT = 'moyen' AND SEXE = 2 THEN 8 * AGE + 8
            WHEN SPORT = 'bas' AND SEXE = 1 THEN 10 * AGE + 5
            WHEN SPORT = 'bas' AND SEXE = 2 THEN 8 * AGE + 4
            ELSE 0
        END
        );
        ");

        // Liez les valeurs des paramètres
        $stmt->bindParam(':ID_USER', $ID_USER, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':AGE', $AGE, PDO::PARAM_STR);
        $stmt->bindParam(':SEXE', $SEXE, PDO::PARAM_STR);
        $stmt->bindParam(':SPORT', $SPORT, PDO::PARAM_INT);

        // Exécutez la requête
        $stmt->execute();

        // Retournez un message de succès
        return array('message' => 'Nouvel aliment cree avec succes.');
    } catch (PDOException $e) {
        // En cas d'erreur, retournez un message d'erreur
        return array('error' => 'Erreur lors de la création de l\'aliment : ' . $e->getMessage());
    }
}


// Gérer la méthode DELETE pour supprimer un aliment
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // $inputData = json_decode(file_get_contents('php://input'), true); // Comme il n'y a pas cette ligne, on ne prend pas de json de l'utilisateur de l'utilisateurs, tout est dans l'url en GET
    $result = delete_aliment($pdo, $_GET);
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

// Fonction pour supprimer un aliment
function delete_aliment($pdo, $data)
{
    $user_id = $data['ID_USER']; // Récupération de l'ID de l'utilisateur depuis les données d'entrée

    try {
        // Préparez la requête SQL de suppression en utilisant l'ID de l'utilisateur
        $stmt = $pdo->prepare("DELETE FROM aliment WHERE ID_USER = :id");

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

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $inputData = json_decode(file_get_contents('php://input'), true);
    $result = update_aliment($pdo, $inputData);

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

function update_aliment($pdo, $data)
{
    $id = $data['ID_USER']; // Récupération du ID_USER depuis les données d'entrée
    $nom = $data['NOM']; // Récupération du NOM depuis les données d'entrée
    $AGE = $data['AGE']; // Récupération du AGE depuis les données d'entrée
    $SEXE = $data['SEXE']; // Récupération du SEXE depuis les données d'entrée
    $SPORT = $data['SPORT'];
    $KCAL_JOUR = $data['KCAL_JOUR'];


    try {
        // Préparez la requête SQL de mise à jour avec les champs appropriés
        $stmt = $pdo->prepare("UPDATE utilisateur SET NOM = :nom, AGE = :AGE, SEXE = :SEXE, SPORT = :SPORT, KCAL_JOUR = :KCAL_JOUR WHERE ID_USER = :id");

        // Liez les valeurs des paramètres
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':AGE', $AGE, PDO::PARAM_STR);
        $stmt->bindParam(':SEXE', $SEXE, PDO::PARAM_STR);
        $stmt->bindParam(':SPORT', $SPORT, PDO::PARAM_INT);
        $stmt->bindParam(':KCAL_JOUR', $KCAL_JOUR, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Assurez-vous que l'ID est traité comme un entier


        // Exécutez la requête
        $stmt->execute();

        // Vérifiez si la mise à jour a affecté des lignes (au moins une ligne a été mise à jour)
        if ($stmt->rowCount() > 0) {
            // La mise à jour a réussi, retournez un message de succès
            return array('message' => 'Utilisateur mis à jour avec succès.');
        } else {
            // Aucune ligne n'a été mise à jour, l'utilisateur avec l'ID spécifié n'a pas été trouvé
            return array('error' => 'Utilisateur non trouvé ou aucune mise à jour nécessaire.'); // reAGE : ce message est renvoyé également si l'utilisateur existe mais que l'on met à jour avec le même mail et name
        }
    } catch (PDOException $e) {
        // En cas d'erreur, retournez un message d'erreur
        return array('error' => 'Erreur lors de la mise à jour de l\'utilisateur : ' . $e->getMessage());
    }
}
