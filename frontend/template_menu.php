<!DOCTYPE html>
<html>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>

<?php
session_start(); // Démarrer la session

function renderMenuToHTML($currentPageId)
{
    $mymenu = array(
        'index' => array('Accueil', 'index.php'),
        'profil' => array('Profil', 'profil.php'),
        'aliments' => array('Aliments', 'aliments.php'),
        'journal' => array('Journal', 'journal.php'),
    );

echo '
<!-- Responsive navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-5">
        <a class="navbar-brand" href="#!">Toniz\'Food</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <a class="navbar-brand" id="session-status" href="#!">';

                if (isset($_SESSION['login'])) {
                    // Utilisateur est connecté grâce à la session
                    echo "Connecté : " . $_SESSION['login'];
                } else {
                    // Utilisateur non connecté
                    echo "Non connecté";
                }
                // Ajoutez le code de débogage pour afficher la session
                echo '<pre>';
                var_dump($_SESSION);
                echo '</pre>';

echo '</a>';
foreach ($mymenu as $pageId => list($text, $link)) {
    $isActive = ($pageId === $currentPageId) ? 'active' : '';
    echo "<li class='nav-item'><a class='nav-link $isActive' href='$link'>$text</a></li>";
}

echo '
            </ul>
        </div>
        <button type="button" id="logout-button">Se déconnecter</button>
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
