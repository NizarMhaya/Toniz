<?php
header('Content-Type: application/json');
require_once('init_pdo.php');

session_start(); // Démarrez la session

// Supprimer le cookie 'login'
if (isset($_COOKIE['login'])) {
    unset($_COOKIE['login']);
    setcookie('login', '', time() - 3600, '/'); // Réglez le temps d'expiration dans le passé pour supprimer le cookie
}

// Déconnexion de l'utilisateur en supprimant ses informations de session
unset($_SESSION['login']);
session_destroy();

// Rediriger l'utilisateur vers la page d'accueil ou une autre page de votre choix
$response = array('redirect' => 'index.php'); // Remplacez 'index.php' par l'URL de votre choix
echo json_encode($response);
?>