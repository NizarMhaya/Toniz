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