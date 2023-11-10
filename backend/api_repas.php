<?php
header('Content-Type: application/json');
require_once('init_pdo.php');

// Récupérer les données envoyées dans le corps de la requête
$inputData = json_decode(file_get_contents('php://input'), true);
echo "Données reçues : ";
print_r($inputData);

// Récupérer les valeurs des champs du formulaire
$nomRepas = $inputData['nomRepas'];
$dateRepas = $inputData['dateRepas'];
$aliments = $inputData['aliments'];
$login = $_COOKIE['login'];

try {
    // Commencer une transaction
    $pdo->beginTransaction();

    // Récupérer l'ID de l'utilisateur à partir du login
    $stmt = $pdo->prepare("SELECT ID_USER FROM utilisateur WHERE LOGIN = :login");
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        // Utilisateur non trouvé, gérer l'erreur
        throw new Exception("Utilisateur non trouvé.");
    }

    $idUser = $result['ID_USER'];

    // Insérer le repas dans la table REPAS
    $stmt = $pdo->prepare("INSERT INTO repas (NOM_REPAS, ID_USER_CONNECTE, DATE) VALUES (:nomRepas, :idUser, :dateRepas)");
    $stmt->bindParam(':nomRepas', $nomRepas, PDO::PARAM_STR);
    $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $stmt->bindParam(':dateRepas', $dateRepas, PDO::PARAM_STR);
    $stmt->execute();
    $idRepas = $pdo->lastInsertId(); // Récupérer l'ID du repas inséré

    // Insérer les aliments du repas dans la table ELEMENT_DE
    foreach ($aliments as $aliment) {
        $codeBarres = $aliment['aliment'];
        $quantite = $aliment['quantite'];

        $stmt = $pdo->prepare("INSERT INTO element_de (CODE_BARRES, ID_REPAS, QUANTITE_G) VALUES (:codeBarres, :idRepas, :quantite)");
        $stmt->bindParam(':codeBarres', $codeBarres, PDO::PARAM_INT);
        $stmt->bindParam(':idRepas', $idRepas, PDO::PARAM_INT);
        $stmt->bindParam(':quantite', $quantite, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Calculer les calories pour le repas
    $stmt = $pdo->prepare("
        SELECT
            SUM((a.ENERGIE_100G / 100) * ed.QUANTITE_G) AS TOTAL_CALORIES
        FROM
            ELEMENT_DE ed
        JOIN
            ALIMENT a ON ed.CODE_BARRES = a.CODE_BARRES
        WHERE
            ed.ID_REPAS = :idRepas
    ");
    $stmt->bindParam(':idRepas', $idRepas, PDO::PARAM_INT);
    $stmt->execute();
    $resultCalories = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalCalories = $resultCalories['TOTAL_CALORIES'];

    // Valider la transaction
    $pdo->commit();

    // Répondre avec un message de succès et le total des calories
    http_response_code(200);
    echo json_encode(array('message' => 'Repas enregistré avec succès.', 'totalCalories' => $totalCalories));
} catch (PDOException $e) {
    // En cas d'erreur, annuler la transaction
    $pdo->rollBack();

    // Répondre avec un message d'erreur
    http_response_code(500);
    echo json_encode(array('message' => 'Erreur lors de l\'enregistrement du repas : ' . $e->getMessage()));
}
?>





// Exemple de données de test qui fonctionnent dans reqbin
// {
//     "nomRepas": "Déjeuner",
//     "dateRepas": "2023-11-15 12:30:00",
//     "aliments": [
//       {"aliment": 123456789, "quantite": 200},  
//       {"aliment": 987654321, "quantite": 150}, 
//       {"aliment": 111222333, "quantite": 100} 
//     ]

//   }

//   }

