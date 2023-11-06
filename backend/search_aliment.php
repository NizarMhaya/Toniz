<!DOCTYPE html>
<html>
<head>
    <title>Recherche d'aliments</title>
</head>
<body>
    <h1>Recherche d'aliments</h1>

    <form method="post" action="">
        <label for="mot_recherche">Entrez un mot de recherche :</label>
        <input type="text" id="mot_recherche" name="mot_recherche">
        <input type="submit" value="Rechercher">
    </form>

    <?php
    // Vérifiez si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérez le mot de recherche depuis le champ de texte du formulaire
        $search_term = $_POST['mot_recherche'];

        // Construisez l'URL de l'API pour la recherche
        $api_url = "https://world.openfoodfacts.org/cgi/search.pl?search_terms={$search_term}&json=1";

        // Récupérez les données JSON depuis l'API
        $json_data = file_get_contents($api_url);

        // Vérifiez si la récupération des données a réussi
        if ($json_data !== false) {
            // Décodez les données JSON en tableau associatif
            $data = json_decode($json_data, true);

            // Vérifiez si le décodage JSON a réussi
            if ($data !== null) {
                // Accédez aux aliments correspondant au mot de recherche
                $foods = $data['products'];

                // Parcourez les aliments et affichez leurs noms
                echo "<h2>Résultats de la recherche pour '$search_term' :</h2>";
                echo "<ul>";
                foreach ($foods as $food) {
                    echo "<li>Nom de l'aliment : " . $food['product_name'] . "</li>";
                }
                echo "</ul>";
            } else {
                echo "Échec du décodage des données JSON";
            }
        } else {
            echo "Échec de la récupération des données depuis l'API";
        }
    }
    ?>
</body>
</html>
