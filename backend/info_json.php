<?php
$url = "https://fr.openfoodfacts.org/cgi/search.pl?action=process&tagtype_0=stores&tag_contains_0=contains&tag_0=intermarch%C3%A9&sort_by=unique_scans_n&page_size=20";

// Récupérez le contenu JSON depuis l'URL
$jsonData = file_get_contents($url);

// Vérifiez si les données JSON ont été récupérées avec succès
if ($jsonData !== false) {
    // Convertissez les données JSON en un tableau PHP
    $data = json_decode($jsonData, true);

    // Vérifiez si la conversion a réussi
    if ($data !== null) {
        // Vous pouvez maintenant accéder aux données que vous souhaitez
        foreach ($data['products'] as $product) {
            $barcode = $product['code'];
            $name = $product['product_name'];
            $brand = $product['brands'];
            $categories = $product['categories'];
            $energy = $product['nutriments']['energy-kcal_100g'];

            echo "Code Barres : $barcode\n";
            echo "Nom du Produit : $name\n";
            echo "Marque : $brand\n";
            echo "Catégories : $categories\n";
            echo "Énergie (kcal) pour 100g : $energy\n\n";
        }
    } else {
        echo "Erreur lors de la conversion des données JSON.";
    }
} else {
    echo "Erreur lors de la récupération des données depuis l'URL.";
}
?>