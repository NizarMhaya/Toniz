<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculateur de Besoins Énergétiques</title>
    <link rel="stylesheet" href="CSS/styles_calculateur.css">
    <link rel="icon" type="image/x-icon" href="assets/faviconV2.png" />
    <?php require_once('template_menu.php'); ?>
    <header class="bg-dark py-1">
        <?php renderMenuToHTML('ajouter_favoris'); ?>
    </header>
</head>

<body>
    <div class="container">
        <h1>Calculateur de Besoins Énergétiques</h1>
        <div class="form-group">
            <label for="age">Âge :</label>
            <input type="number" id="age" placeholder="Entrez votre âge">
        </div>
        <div class="form-group">
            <label for="sexe">Sexe :</label>
            <select id="sexe">
                <option value="homme">Homme</option> <!-- Attention ici on considère le champs sexe comme du texte -->
                <option value="femme">Femme</option>
            </select>
        </div>
        <div class="form-group">
            <label for="poids">Poids (kg) :</label>
            <input type="number" id="poids" placeholder="Entrez votre poids">
        </div>
        <div class="form-group">
            <label for="taille">Taille (cm) :</label>
            <input type="number" id="taille" placeholder="Entrez votre taille">
        </div>
        <div class="form-group">
            <label for="niveauActivite">Niveau d'activité :</label> <!-- Attention ici on les valeurs possibles du champs niveauActivite ne sont pas eleve, moyen, bas -->
            <select id="niveauActivite">
                <option value="sedentaire">Sédentaire</option>
                <option value="legerement_actif">Légèrement Actif</option>
                <option value="moderement_actif">Modérément Actif</option>
                <option value="tres_actif">Très Actif</option>
                <option value="extremement_actif">Extrêmement Actif</option>
            </select>
        </div>
        <div id="resultat"></div>
    </div>
    <script src="JS/script_calculateur.js"></script>
</body>

</html>