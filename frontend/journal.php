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
        <h1>Journal</h1>
        <p>Ceci est la page journal listant nos repas</p>
    </main>

    <!-- Autres sections ou contenu ici -->

    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>

    </footer>

</body>
</html>
