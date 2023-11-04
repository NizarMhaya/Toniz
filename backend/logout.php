<?php
header('Content-Type: application/json');
require_once('init_pdo.php');

session_start(); // Démarrer la session

// Déconnexion de l'utilisateur en supprimant ses informations de session
unset($_SESSION['login']);
session_destroy();

// Rediriger l'utilisateur vers la page d'accueil ou une autre page de votre choix
$response = array('redirect' => 'index.php'); // Remplacez 'index.php' par l'URL de votre choix
echo json_encode($response);
?>
