<?php
// POST /api_calories : Récupère les calories absorbées par jour sur une période spécifique par un utilisateur.

header('Content-Type: application/json'); // Définir le type de contenu JSON

require_once('init_pdo.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Utilisez le cookie pour obtenir le login de l'utilisateur
    $loginUtilisateur = $_COOKIE['login'];
    $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d');
    $endDate = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d');
    $nutrimentType = isset($_POST['nutriment_type']) ? $_POST['nutriment_type'] : 'ENERGIE_100G';

    try {
        // Préparez la requête SQL pour obtenir les totaux des calories par jour avec le login et le type de nutriment sur une période
        $stmt = $pdo->prepare("SELECT 
                                DATE(R.DATE) AS jour,
                                SUM(CASE 
                                    WHEN :nutrimentType = 'ENERGIE_100G' THEN A.ENERGIE_100G
                                    WHEN :nutrimentType = 'MAT_GRASSES' THEN A.MAT_GRASSES
                                    WHEN :nutrimentType = 'GRAISSES_SATUREES' THEN A.GRAISSES_SATUREES
                                    WHEN :nutrimentType = 'GLUCIDES' THEN A.GLUCIDES
                                    WHEN :nutrimentType = 'SUCRES' THEN A.SUCRES
                                    WHEN :nutrimentType = 'FIBRES' THEN A.FIBRES
                                    WHEN :nutrimentType = 'PROTEINES' THEN A.PROTEINES
                                    WHEN :nutrimentType = 'SEL' THEN A.SEL
                                    WHEN :nutrimentType = 'SODIUM' THEN A.SODIUM
                                    WHEN :nutrimentType = 'CALCIUM' THEN A.CALCIUM
                                END * ED.QUANTITE_G / 100) AS totalNutriment
                              FROM ELEMENT_DE ED
                              JOIN ALIMENT A ON ED.CODE_BARRES = A.CODE_BARRES
                              JOIN REPAS R ON ED.ID_REPAS = R.ID_REPAS
                              JOIN UTILISATEUR U ON R.ID_USER_CONNECTE = U.ID_USER
                              WHERE U.LOGIN = :loginUtilisateur
                                AND DATE(R.DATE) BETWEEN :startDate AND :endDate
                              GROUP BY jour");

        // Liez la valeur du login en tant que paramètre
        $stmt->bindParam(':loginUtilisateur', $loginUtilisateur, PDO::PARAM_STR);
        $stmt->bindParam(':startDate', $startDate, PDO::PARAM_STR);
        $stmt->bindParam(':endDate', $endDate, PDO::PARAM_STR);
        $stmt->bindParam(':nutrimentType', $nutrimentType, PDO::PARAM_STR);

        // Exécutez la requête
        $stmt->execute();

        // Récupérez les résultats
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Maintenant, ajoutez une requête pour récupérer KCAL_JOUR de l'utilisateur
        $stmtUserKcal = $pdo->prepare("SELECT KCAL_JOUR FROM UTILISATEUR WHERE LOGIN = :loginUtilisateur");
        $stmtUserKcal->bindParam(':loginUtilisateur', $loginUtilisateur, PDO::PARAM_STR);
        $stmtUserKcal->execute();
        $userKcal = $stmtUserKcal->fetch(PDO::FETCH_ASSOC);

        // Retournez les résultats
        if ($results) {
            http_response_code(200); // OK
            echo json_encode(['dailyNutriments' => $results, 'userKcal' => $userKcal['KCAL_JOUR']]);
        } else {
            http_response_code(204); // No Content
            echo json_encode(['dailyNutriments' => [], 'userKcal' => $userKcal['KCAL_JOUR']]);
        }

    } catch (PDOException $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Erreur lors de la récupération du nutriment : ' . $e->getMessage()]);
        // Ajoutez cette ligne pour afficher les détails de l'erreur dans les logs
        error_log($e->getMessage());
    }
}
?>