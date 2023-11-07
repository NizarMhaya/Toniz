<!DOCTYPE html>
<html>

<head>
    <?php require_once('template_settings.php'); ?>
</head>

<body>
    <?php 
    require_once('template_menu.php'); 

    renderMenuToHTML('journal'); ?>

    <main>
        <!-- Contenu de la page "profil.php" -->
        <h1 class="my-custom-h1">Journal </h1>
        <h2 id="custom-description">Voici l'ensemble des aliments que vous avez mis en favoris</h2>
    </main>

    <!-- Autres sections ou contenu ici -->

    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>

    </footer>

</body>

</html>