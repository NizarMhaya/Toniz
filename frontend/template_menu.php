<!DOCTYPE html>
<html>
<?php
function renderMenuToHTML($currentPageId)
{
    $mymenu = array(
        'index' => array('Accueil', 'index.php'),
        'ajouter_favoris' => array('Ajouter des favoris', 'front_aliments_ajouter_favoris.php'),
        'favoris' => array('Favoris', 'front_favoris.php'),
        'aliments' => array('Gestionnaire des aliments', 'front_aliments_reel.php'),
        'repas' => array('Créer un repas', 'front_creer_repas.php'),
        'calculateur' => array('Calculateur KCAL', 'calculateur.php'),
    );


    echo '
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="#!">Toniz\'Food</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    ';

    foreach ($mymenu as $pageId => list($text, $link)) {
        $isActive = ($pageId === $currentPageId) ? 'active' : '';
        echo "<li class='nav-item'><a class='nav-link $isActive' href='$link'>$text</a></li>";
    }

    echo '
                </ul>
            </div>
        </div>
    </nav>
    ';
}
?>

</html>