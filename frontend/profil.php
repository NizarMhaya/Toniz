<!DOCTYPE html>
<html>
<?php
require_once('template_settings.php');
?>
<body>
    <?php 
    require_once('template_menu.php'); 
    renderMenuToHTML('profil'); 
    ?>
    <h2>Profil</h2>

    <?php if (!isset($_SESSION['login']) && !isset($_COOKIE['login'])) : ?>
        <p>Veuillez vous connecter ci-dessous pour voir vos informations personnelles.</p>
        <p>Pas encore de compte ? Rendez-vous sur la page <a href="inscription.php">Inscription</a> pour nous rejoindre.</p>

        <h2>Connexion</h2>
        <form id="connexion-form">
            <!-- Formulaire de connexion -->
            <label for="login">Nom :</label>
            <input type="text" id="connexion-login" name="login" required><br><br>

            <label for "mdp">Mot de passe :</label>
            <input type="password" id="connexion-mdp" name="mdp" required><br><br>

            <button type="button" id="connexion-button">Se connecter</button>
        </form>
    <?php else : ?>
        <p>Vos informations personnelles :</p>
        <!-- Afficher les informations personnelles de l'utilisateur ici -->
    <?php endif; ?>

    <div id="message"></div>

    <footer>
        <!-- Pied de page -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let apiUrlProfil = "<?php require_once 'config.php';
                        echo _API_URL_PROFIL; ?> ";
    </script>
    <script src="JS/script_profil.js" defer></script>
</body>
</html>