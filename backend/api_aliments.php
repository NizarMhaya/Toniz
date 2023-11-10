<?php

// GET /api_aliment : Récupère tous les aliments de la base de données.


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

// Gérer la méthode POST pour créer un nouvel aliment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);
    $result = create_aliment($pdo, $inputData);
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

// Fonction pour créer un nouvel aliment
function create_aliment($pdo, $data)
{
    $code_barres = $data['CODE_BARRES'];
    $nom = $data['NOM'];
    $marque = $data['MARQUE'];
    $categorie = $data['CATEGORIE'];
    $energie_100g = $data['ENERGIE_100G'];
    $MAT_GRASSES = $data['MAT_GRASSES'];
    $graisses_saturees = $data['GRAISSES_SATUREES'];
    $glucides = $data['GLUCIDES'];
    $sucres = $data['SUCRES'];
    $fibres = $data['FIBRES'];
    $proteines = $data['PROTEINES'];
    $sel = $data['SEL'];
    $sodium = $data['SODIUM'];
    $calcium = $data['CALCIUM'];

    try {
        // Préparez la requête SQL d'insertion avec tous les champs
        $stmt = $pdo->prepare("INSERT INTO ALIMENT 
            (CODE_BARRES, NOM, MARQUE, CATEGORIE, ENERGIE_100G, MAT_GRASSES, GRAISSES_SATUREES, GLUCIDES, SUCRES, FIBRES, PROTEINES, SEL, SODIUM, CALCIUM)
            VALUES (:code_barres, :nom, :marque, :categorie, :energie_100g, :MAT_GRASSES, :graisses_saturees, :glucides, :sucres, :fibres, :proteines, :sel, :sodium, :calcium)");

        // Liez les valeurs des paramètres
        $stmt->bindParam(':code_barres', $code_barres, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':marque', $marque, PDO::PARAM_STR);
        $stmt->bindParam(':categorie', $categorie, PDO::PARAM_STR);
        $stmt->bindParam(':energie_100g', $energie_100g, PDO::PARAM_INT);
        $stmt->bindParam(':MAT_GRASSES', $MAT_GRASSES, PDO::PARAM_STR);
        $stmt->bindParam(':graisses_saturees', $graisses_saturees, PDO::PARAM_STR);
        $stmt->bindParam(':glucides', $glucides, PDO::PARAM_STR);
        $stmt->bindParam(':sucres', $sucres, PDO::PARAM_STR);
        $stmt->bindParam(':fibres', $fibres, PDO::PARAM_STR);
        $stmt->bindParam(':proteines', $proteines, PDO::PARAM_STR);
        $stmt->bindParam(':sel', $sel, PDO::PARAM_STR);
        $stmt->bindParam(':sodium', $sodium, PDO::PARAM_STR);
        $stmt->bindParam(':calcium', $calcium, PDO::PARAM_STR);

        // Exécutez la requête
        $stmt->execute();

        // Retournez un message de succès
        return array('message' => 'Nouvel aliment créé avec succès.');
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
    $user_id = $data['id']; // Récupération de l'ID de l'utilisateur depuis les données d'entrée

    try {
        // Préparez la requête SQL de suppression en utilisant l'ID de l'utilisateur
        $stmt = $pdo->prepare("DELETE FROM aliment WHERE CODE_BARRES = :id");

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
    $id = $data['CODE_BARRES'];
    $nom = $data['NOM'];
    $marque = $data['MARQUE'];
    $categorie = $data['CATEGORIE'];
    $energie_100g = $data['ENERGIE_100G'];
    $MAT_GRASSES = $data['MAT_GRASSES'];
    $graisses_saturees = $data['GRAISSES_SATUREES'];
    $glucides = $data['GLUCIDES'];
    $sucres = $data['SUCRES'];
    $fibres = $data['FIBRES'];
    $proteines = $data['PROTEINES'];
    $sel = $data['SEL'];
    $sodium = $data['SODIUM'];
    $calcium = $data['CALCIUM'];

    try {
        // Préparez la requête SQL de mise à jour avec les champs appropriés
        $stmt = $pdo->prepare("UPDATE ALIMENT SET 
            NOM = :nom, 
            MARQUE = :marque, 
            CATEGORIE = :categorie, 
            ENERGIE_100G = :energie_100g, 
            MAT_GRASSES = :MAT_GRASSES, 
            GRAISSES_SATUREES = :graisses_saturees, 
            GLUCIDES = :glucides, 
            SUCRES = :sucres, 
            FIBRES = :fibres, 
            PROTEINES = :proteines, 
            SEL = :sel, 
            SODIUM = :sodium, 
            CALCIUM = :calcium 
            WHERE CODE_BARRES = :id");

        // Liez les valeurs des paramètres
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':marque', $marque, PDO::PARAM_STR);
        $stmt->bindParam(':categorie', $categorie, PDO::PARAM_STR);
        $stmt->bindParam(':energie_100g', $energie_100g, PDO::PARAM_INT);
        $stmt->bindParam(':MAT_GRASSES', $MAT_GRASSES, PDO::PARAM_STR);
        $stmt->bindParam(':graisses_saturees', $graisses_saturees, PDO::PARAM_STR);
        $stmt->bindParam(':glucides', $glucides, PDO::PARAM_STR);
        $stmt->bindParam(':sucres', $sucres, PDO::PARAM_STR);
        $stmt->bindParam(':fibres', $fibres, PDO::PARAM_STR);
        $stmt->bindParam(':proteines', $proteines, PDO::PARAM_STR);
        $stmt->bindParam(':sel', $sel, PDO::PARAM_STR);
        $stmt->bindParam(':sodium', $sodium, PDO::PARAM_STR);
        $stmt->bindParam(':calcium', $calcium, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécutez la requête
        $stmt->execute();

        // Vérifiez si la mise à jour a affecté des lignes (au moins une ligne a été mise à jour)
        if ($stmt->rowCount() > 0) {
            // La mise à jour a réussi, retournez un message de succès
            return array('message' => 'Aliment mis à jour avec succès.');
        } else {
            // Aucune ligne n'a été mise à jour, l'aliment avec l'ID spécifié n'a pas été trouvé
            return array('error' => 'Aliment non trouvé ou aucune mise à jour nécessaire.');
        }
    } catch (PDOException $e) {
        // En cas d'erreur, retournez un message d'erreur
        return array('error' => 'Erreur lors de la mise à jour de l\'aliment : ' . $e->getMessage());
    }
}

