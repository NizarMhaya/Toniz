<!DOCTYPE html>
<html>
<head>
    <title>Profil - Mon Site Web</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <script src="js/script_profil.js"></script>
</head>
<body>
    <?php require_once('template_menu.php'); 
    renderMenuToHTML('profil'); ?>

    <main>
    <h1>Inscription</h1>
    <form id="inscription-form">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>
        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required><br><br>
        <button type="button" id="inscription-button">S'inscrire</button>
    </form>
    <div id="message"></div>
    </main>


    <!-- Autres sections ou contenu ici -->

    <footer>
        <!-- Pied de page -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
