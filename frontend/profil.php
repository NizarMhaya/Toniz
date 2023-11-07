<!DOCTYPE html>
<html>
<head>
    <?php require_once('template_settings.php'); ?>
</head>

<body>
    <?php 
    require_once('template_menu.php'); 
    renderMenuToHTML('profil'); 
    ?>
    <h1 class="my-custom-h1">Profil</h1>

    <?php if (!isset($_SESSION['login']) && !isset($_COOKIE['login'])) : ?>
        <p class="p-text">Veuillez vous connecter ci-dessous pour voir vos informations personnelles.</p>
        <p class="p-text">Pas encore de compte ? Rendez-vous sur la page <a href="inscription.php">Inscription</a> pour nous rejoindre.</p>
    <div class="connexion-form">
        <h2>Connexion</h2>
        <form id="connexion-form">
            <!-- Formulaire de connexion -->
            <label for="login">Nom :</label>
            <input type="text" id="connexion-login" name="login" required><br>

            <label for "mdp">Mot de passe :</label>
            <input type="password" id="connexion-mdp" name="mdp" required><br>

            <button type="button" id="connexion-button">Se connecter</button>
        </form>
    </div>
    <?php else : ?>
        <p class="p-text">Vos informations personnelles :</p>
        <!-- Afficher les informations personnelles de l'utilisateur ici -->
    <?php endif; ?>

    <div id="message"></div>

    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let apiUrlProfil = "<?php require_once 'config.php';
                        echo _API_URL_PROFIL; ?> ";
    </script>
    <script src="JS/script_profil.js" defer></script>
</body>
</html>
