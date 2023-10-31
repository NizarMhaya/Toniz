<?php
header('Content-Type: application/json'); // Définir le type de contenu JSON

require_once('init_pdo.php');

// méthode GET pour récupérer les aliments 
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // si le code barre est précisé : exemple : .../aliments.php?CODE_BARRES=123456
    if (isset($_GET['CODE_BARRES'])) {
        $aliment_code = $_GET['CODE_BARRES'];
        $aliment = get_aliment($pdo, $aliment_code);
        echo json_encode($aliment);
    // si aucun code barres précisé : .../aliments.php
    } else {
        $aliments = get_aliments($pdo);
        echo json_encode($aliments);
    }
}

// méthode POST pour créer un nouvel aliment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);
    $result = create_aliment($pdo, $inputData);
    echo json_encode($result);
}

function get_aliments($pdo)
{
    $request = $pdo->prepare("SELECT * FROM ALIMENT");
    $request->execute();
    $aliments = $request->fetchAll(PDO::FETCH_ASSOC);
    return $aliments;
}

function get_aliment($pdo, $aliment_code)
{
    try {
        if (!is_numeric($aliment_code) || $aliment_code <= 0) {
            return array('error' => 'Le code barres de l\'aliment n\'est pas valide.');
        }

        $selectQuery = "SELECT nom, marque, categorie, energie_100g FROM aliment WHERE code_barres = :code_barres";
        $selectStatement = $pdo->prepare($selectQuery);
        $selectStatement->bindParam(':code_barres', $aliment_code, PDO::PARAM_INT);
        $selectStatement->execute();
        $aliment = $selectStatement->fetch(PDO::FETCH_ASSOC);

        if ($aliment) {
            return $aliment;
        } else {
            return array('error' => 'Aliment non trouvé.');
        }
    } catch (PDOException $e) {
        return array('error' => 'Erreur lors de la récupération des informations de l\'aliment : ' . $e->getMessage());
    }
}

function create_aliment($pdo, $data)
{
    try {
        if (!isset($data['nom'])) {
            return array('error' => 'Un nom d\'aliment est requis.');
            http_response_code(400); // Bad Request
        }

        $nom = $data['nom'];
        $marque = $data['marque'];
        $categorie = $data['categorie'];
        $energie_100g = $data['energie_100g'];

        $insertQuery = "INSERT INTO aliments (nom, marque, categorie, energie_100g) VALUES (:nom, :marque, :categorie, :energie_100g)";
        $insertStatement = $pdo->prepare($insertQuery);
        $insertStatement->bindParam(':nom', $nom);
        $insertStatement->bindParam(':marque', $marque);
        $insertStatement->bindParam(':categorie', $categorie);
        $insertStatement->bindParam(':energie_100g', $energie_100g);

        if ($insertStatement->execute()) {
            http_response_code(201);
            return array('message' => 'Nouvel aliment ajouté avec succès.');
        } else {
            http_response_code(400);
            return array('error' => 'Erreur lors de l\'ajout de l\'aliment.');
        }
    } catch (PDOException $e) {
        return array('error' => 'Erreur lors de l\'ajout de l\'aliment : ' . $e->getMessage());
        http_response_code(500);
    }
}
?>