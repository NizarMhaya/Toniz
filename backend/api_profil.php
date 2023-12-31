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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Utilisez la fonction get_aliment pour obtenir tous les aliment
    $aliment = get_aliment($pdo, $login);
    $login = $_COOKIE['login'];

    // Vérifiez si des aliment ont été trouvés
    if ($aliment) {
        http_response_code(200); // OK
        echo json_encode($aliment);
    } else {
        http_response_code(200); // OK (ou 204 No Content selon le cas)
        echo json_encode(array()); // Renvoyer un tableau vide si aucune donnée n'est disponible
    }
}
function get_aliment($pdo, $login)
{
    $sql = "SELECT LOGIN, AGE, TAILLE, POIDS, SEXE, ACTIVITE, KCAL_JOUR FROM utilisateur WHERE LOGIN = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->execute();
    $aliment = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $aliment;
}




if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Récupérer les données envoyées dans le corps de la requête
    $data = json_decode(file_get_contents("php://input"), true);
    error_log(json_encode($_PUT));

    // Récupérer les valeurs des champs du formulaire
    $login = $data['login'];
    $age = $data['age'];
    $taille = $data['taille'];
    $poids = $data['poids'];
    $sexe = $data['sexe'];
    $activite = $data['activite'];
    $kcal_jour = $data['kcal_jour'];

    // Exécuter la mise à jour dans la base de données (remplacez ceci par votre logique de mise à jour)
    // $pdo est votre objet de connexion à la base de données PDO
    // Ici, nous supposons que vous avez une table 'utilisateur' avec des colonnes correspondantes à chaque champ du formulaire
    $stmt = $pdo->prepare("UPDATE utilisateur SET AGE = :age, TAILLE = :taille, POIDS = :poids, SEXE = :sexe, ACTIVITE = :activite, KCAL_JOUR = :kcal_jour WHERE login = :login");
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->bindParam(':age', $age, PDO::PARAM_INT);
    $stmt->bindParam(':taille', $taille, PDO::PARAM_INT);
    $stmt->bindParam(':poids', $poids, PDO::PARAM_INT);
    $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
    $stmt->bindParam(':activite', $activite, PDO::PARAM_INT);
    $stmt->bindParam(':kcal_jour', $kcal_jour, PDO::PARAM_INT);

    // Exécutez la requête
    if ($stmt->execute()) {
        http_response_code(200); // OK
        echo json_encode(array("message" => "Utilisateur mis à jour avec succès."));
    } else {
        http_response_code(500); // Erreur du serveur
        echo json_encode(array("message" => "Erreur lors de la mise à jour de l'utilisateur."));
    }
}

//GET et PUT

// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     // Vérifiez si l'utilisateur est connecté
//     if (isset($_SESSION['login'])) {
//         $login = $_SESSION['login']; // Obtenez l'ID de l'utilisateur à partir de la session
//         $aliments = get_aliments($pdo, $login);

//         // Vérifiez si des aliments ont été trouvés pour cet utilisateur
//         if ($aliments) {
//             http_response_code(200); // OK
//             echo json_encode($aliments);
//         } else {
//             http_response_code(204); // No Content
//             echo json_encode(array()); // Renvoyer un tableau vide si aucune donnée n'est disponible
//         }
//     } else {
//         http_response_code(401); // Unauthorized
//         echo json_encode(array('error' => 'Utilisateur non autorisé.'));
//     }
// }

// // Fonction pour récupérer les aliments de l'utilisateur
// function get_aliments($pdo, $login)
// {
//     try {
//         $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE LOGIN = :user_login");
//         $stmt->bindParam(':user_login', $login);
//         $stmt->execute();
//         $aliments = $stmt->fetchAll(PDO::FETCH_ASSOC);
//         return $aliments;
//     } catch (PDOException $e) {
//         return array('error' => 'Erreur lors de la récupération des données de l\'utilisateur : ' . $e->getMessage());
//     }
// }

