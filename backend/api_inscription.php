<?php
header('Content-Type: application/json; charset=utf-8');
require_once('init_pdo.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);

    if (
        isset($inputData['login']) && isset($inputData['mdp']) &&
        isset($inputData['age']) && isset($inputData['taille']) && 
        isset($inputData['poids']) && isset($inputData['sexe']) && 
        isset($inputData['activite'])
    ) {
        // Tous les champs requis sont présents, il s'agit d'une inscription
        $login = $inputData['login'];

        // Vérifier si le login existe déjà
        if (is_login_taken($pdo, $login)) {
            http_response_code(400); // Bad Request
            echo json_encode(array('error' => 'Déjà existant. Veuillez rentrer un autre nom d\'utilisateur.'), JSON_UNESCAPED_UNICODE);
            exit; // Arrête le script
        }

        $mdp = $inputData['mdp'];
        $age = $inputData['age'];
        $taille = $inputData['taille'];
        $poids = $inputData['poids'];
        $sexe = $inputData['sexe'];
        $activite = $inputData['activite'];

        $result = create_user($pdo, $login, $mdp, $age, $taille, $poids, $sexe, $activite);

        if ($result['success']) {
            http_response_code(201); // Created
            echo json_encode(array('message' => 'Utilisateur inscrit avec succès'));
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(array('error' => 'Erreur lors de l\'inscription'));
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(array('error' => 'Données manquantes'));
    }
}

function create_user($pdo, $login, $mdp, $age, $taille, $poids, $sexe, $activite)
{
    $mdpHash = password_hash($mdp, PASSWORD_BCRYPT);
    $insertQuery = "INSERT INTO UTILISATEUR (LOGIN, MDP, AGE, TAILLE, POIDS, SEXE, ACTIVITE) VALUES (:login, :mdp, :age, :taille, :poids, :sexe, :activite)";
    $insertStatement = $pdo->prepare($insertQuery);
    $insertStatement->bindParam(':login', $login);
    $insertStatement->bindParam(':mdp', $mdpHash);
    $insertStatement->bindParam(':age', $age);
    $insertStatement->bindParam(':taille', $taille);
    $insertStatement->bindParam(':poids', $poids);
    $insertStatement->bindParam(':sexe', $sexe);
    $insertStatement->bindParam(':activite', $activite);

    if ($insertStatement->execute()) {
        return array('success' => true);
    } else {
        return array('success' => false);
    }
}

function is_login_taken($pdo, $login)
{
    $query = "SELECT COUNT(*) FROM UTILISATEUR WHERE LOGIN = :login";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':login', $login);
    $statement->execute();
    $count = $statement->fetchColumn();

    return $count > 0;
}
?>
