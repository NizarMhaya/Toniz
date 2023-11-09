<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/styles_menu.css">

</head>

<?php
session_start(); // Démarrer la session

function renderMenuToHTML($currentPageId)
{
    $mymenu = array(
        'index' => array('Accueil', 'index.php'),
        'profil' => array('Profil', 'profil.php'),
        'aliments' => array('Aliments', 'aliments.php'),
        'journal' => array('Journal', 'journal.php'),
        'ajouter_favoris' => array('Ajouter des favoris', 'aliments_ajouter_favoris.php'),
        'favoris' => array('Favoris', 'favoris.php'),
        'repas' => array('Créer un repas', 'repas.php'),
        'voir_repas' => array('Vos repas', 'voir_repas.php'),
        'calculateur' => array('Calculateur KCAL', 'calculateur.php'),


    );

    echo '
    <!-- Responsive navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" id="session-status" href="#!">';
    if (isset($_COOKIE['login'])) {
        // Utilisateur est connecté grâce à la session
        echo "Connecté : " . $_COOKIE['login'];
        echo '<button class="red-link" id="logout-button">Log out</button>';
    } else {
        // Utilisateur non connecté
        echo '
                <a href="profil.php" class="green-link">Log in</a>
                <a href="inscription.php" class="yellow-link">Sign in</a>
            ';
    }
    echo '</a>';
    // <a class="navbar-brand" href="#!">Toniz\'Food</a>
    echo '        <button class="navbar-toggler" type "button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">';

    $groups = array(
        'accueil' => array('Accueil', array('index')),
        'aliments' => array('Aliments', array('aliments', 'favoris', 'ajouter_favoris')),
        'journal' => array('Mon journal', array('journal', 'voir_repas', 'repas')),
        'profil' => array('Mon profil', array('profil', 'calculateur')),

    );

    foreach ($groups as $groupId => list($groupName, $groupItems)) {
        echo '<li class="nav-item dropdown">';
        echo '<a class="nav-link dropdown-toggle" href="#" id="' . $groupId . 'Dropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $groupName . '</a>';
        echo '<div class="dropdown-menu" aria-labelledby="' . $groupId . 'Dropdown">';
        echo '<ul>';
        foreach ($groupItems as $pageId) {
            $isActive = ($pageId === $currentPageId) ? 'active' : '';
            echo '<li><a class="dropdown-item ' . $isActive . '" href="' . $mymenu[$pageId][1] . '">' . $mymenu[$pageId][0] . '</a></li>';
        }
        echo '</ul>';
        echo '</div>';
        echo '</li>';
    }

    echo '
            </ul>
        </div>
    </div>
</nav>
';
}
?>

<script>
    let apiUrlDeco = "<?php require_once 'config.php';
                        echo _API_URL_DECO; ?> ";
</script>
<script src="JS/script_menu.js" defer></script>

</html>