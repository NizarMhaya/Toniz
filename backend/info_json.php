<?php
// Code-barres du produit que vous souhaitez récupérer (ex : Nutella)
$code_barre = "3017620422003";

// Construisez l'URL de l'API pour le produit spécifique
$api_url = "https://world.openfoodfacts.org/api/v0/product/{$code_barre}.json";

// Récupérez les données JSON du produit depuis l'API
$json_data = file_get_contents($api_url);

// Vérifiez si la récupération des données a réussi
if ($json_data === false) {
    die("Échec de la récupération des données depuis l'API");
}

// Décodez les données JSON en tableau associatif
$data = json_decode($json_data, true);

// Vérifiez si le décodage JSON a réussi
if ($data === null) {
    die("Échec du décodage des données JSON");
}

// Accédez aux informations spécifiques du produit
$nom_aliment = $data['product']['product_name'];
$marque = $data['product']['brands'];
$categories = $data['product']['categories'];
$calories_100g = $data['product']['nutriments']['energy-kcal_100g'];

// Affichez les informations spécifiques
echo "Nom de l'aliment : " . $nom_aliment . "<br>";
echo "Marque : " . $marque . "<br>";
echo "Catégorie(s) : " . $categories . "<br>";
echo "Calories pour 100g : " . $calories_100g . " kcal<br>";
?>
