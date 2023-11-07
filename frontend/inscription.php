<!DOCTYPE html>
<html>
<head>
    <?php require_once('template_settings.php'); ?>
    <link rel="stylesheet" href="css/styles_menu.css"> <!-- Inclure le CSS du menu -->
</head>

<body>
    <?php require_once('template_menu.php'); 
    renderMenuToHTML('profil'); 
    ?>
    <div class="connexion-form"> <!-- Appliquer la classe connexion-form -->
        <h2>Inscription</h2><br>
        <form id="inscription-form">
            <label for="login">Nom :</label>
            <input type="text" id="login" name="login" required><br><br>

            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" required><br><br>

            <label for="age">Âge :</label>
            <input type="number" id="age" name="age" required><br><br>

            <label for="taille">Taille (en cm) :</label>
            <input type="number" id="taille" name="taille" required><br><br>

            <label for="poids">Poids (en kg) :</label>
            <input type="number" id="poids" name="poids" required><br><br>

            <label for="sexe">Sexe :</label>
            <select id="sexe" name="sexe" required>
                <option value="1">Homme</option>
                <option value="2">Femme</option>
            </select><br><br>

            <label for="activite">Activité sportive :</label>
            <select id="activite" name="activite" required>
                <option value="1">Sédentaire</option>
                <option value="2">Actif faible</option>
                <option value="3">Actif</option>
                <option value="4">Sportif</option>
                <option value="5">Athlète professionnel</option>
            </select><br><br>

            <button type="button" id="inscription-button">S'inscrire</button>
        </form>
        <div id="success-message" style="color: green;"></div>
        <div id="error-message" style="color: red;"></div>
    </div>

    <footer class="py-4 bg-dark">
        <?php require_once('template_footer.php'); ?>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let apiUrlSignIn = "<?php require_once 'config.php';
                        echo _API_URL_SIGNIN; ?> ";
    </script>
    <script src="JS/script_inscription.js" defer></script>
</body>
</html>
