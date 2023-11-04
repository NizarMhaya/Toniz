<?php
header('Content-Type: application/json');
require_once('init_pdo.php');

session_start(); // Démarrez la session

$successfullyLogged = false; // Définir l'état de connexion par défaut

// Vérifie si le cookie 'login' existe
if (isset($_COOKIE['login'])) {
    $login = $_COOKIE['login'];
    $mdp = ''; // Vous pouvez initialiser cela comme vous le souhaitez

    if (user_exists($pdo, $login, $mdp)) {
        // L'utilisateur est connecté avec succès
        $successfullyLogged = true;
        $_SESSION['login'] = $login; // Stocker le login de l'utilisateur dans la session
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);

    if (isset($inputData['login']) && isset($inputData['mdp'])) {
        $login = $inputData['login'];
        $mdp = $inputData['mdp'];
    
        if (user_exists($pdo, $login, $mdp)) {
            $successfullyLogged = true;
            $_SESSION['login'] = $login; // Stocker le login de l'utilisateur dans la session
            http_response_code(200); // OK
            echo json_encode(array('message' => 'Connexion réussie.'));
            setcookie('login', $login, time() + 3600 * 24 * 30, '/'); 
        } else {
            http_response_code(401); // Unauthorized
            echo json_encode(array('error' => 'Identifiants incorrects.'));
        }
    } elseif (isset($inputData['login']) && isset($inputData['mdp']) && isset($inputData['age']) && isset($inputData['taille']) && isset($inputData['poids']) && isset($inputData['sexe']) && isset($inputData['activite'])) {
        // Tous les champs requis sont présents, il s'agit d'une inscription
        $login = $inputData['login'];
        $mdp = $inputData['mdp'];
        $age = $inputData['age'];
        $taille = $inputData['taille'];
        $poids = $inputData['poids'];
        $sexe = $inputData['sexe'];
        $activite = $inputData['activite'];

        $result = create_user($pdo, $login, $mdp, $age, $taille, $poids, $sexe, $activite);

        if ($result['success']) {
            http_response_code(201); // Created
            echo json_encode(array('message' => 'Utilisateur inscrit avec succès.'));
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(array('error' => 'Erreur lors de l\'inscription.'));
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(array('error' => 'Données manquantes.'));
    }
}

function user_exists($pdo, $login, $mdp)
{
    $query = "SELECT MDP FROM UTILISATEUR WHERE LOGIN = :login";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $row = $stmt->fetch();

    if ($row) {
        $mdpHash = $row['MDP'];
        return password_verify($mdp, $mdpHash);
    } else {
        return false;
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
?>