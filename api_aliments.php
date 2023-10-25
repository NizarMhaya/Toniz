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
