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
            echo json_encode(array('message' => 'Connexion réussie'));
            setcookie('login', $login, time() + 3600 * 24 * 30, '/');
        } else {
            http_response_code(401); // Unauthorized
            echo json_encode(array('error' => 'Identifiants incorrects'));
        }
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
?>
