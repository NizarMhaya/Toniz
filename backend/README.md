Description de notre API REST c’est-à-dire les endpoints, les méthodes HTTP
attendues (GET, POST, PUT, DELETE, ...), les paramètres et les résultats attendus JSON
ou erreurs de manière similaire à Punk API

**API Aliments**

Description
Cette API permet de gérer les informations sur les aliments, avec des fonctionnalités telles que la récupération de tous les aliments, la création d'un nouvel aliment, la mise à jour d'un aliment existant, et la suppression d'un aliment.

Endpoints
1. Récupération de tous les aliments
Méthode HTTP : GET
URL : http://localhost/Toniz/backend/api_aliments.php
Description : Récupère tous les aliments de la base de données.
Réponse attendue :

json

[{
    "CODE_BARRES": "7612345678901",
    "NOM": "Pomme",
    "MARQUE": "Del Monte",
    "CATEGORIE": "Fruits, Fruits frais, Pommes",
    "ENERGIE_100G": "52",
    "MAT_GRASSES": "0.2",
    "GRAISSES_SATUREES": "0",
    "GLUCIDES": "14",
    "SUCRES": "9",
    "FIBRES": "2.4",
    "PROTEINES": "0.4",
    "SEL": "0",
    "SODIUM": "0",
    "CALCIUM": "11"
}, {
    "CODE_BARRES": "2001000000011",
    "NOM": "Pain complet",
    "MARQUE": "Harrys",
    "CATEGORIE": "Pains, Pains complets",
    "ENERGIE_100G": "250",
    "MAT_GRASSES": "3.5",
    "GRAISSES_SATUREES": "0.6",
    "GLUCIDES": "46",
    "SUCRES": "3.2",
    "FIBRES": "6.5",
    "PROTEINES": "10",
    "SEL": "0.72",
    "SODIUM": "0.29",
    "CALCIUM": "34"
},
]

2. Création d'un nouvel aliment
Méthode HTTP : POST
URL : http://localhost/Toniz/backend/api_aliments.php
Description : Crée un nouvel aliment dans la base de données.
Paramètres :
CODE_BARRES (entier) - Code-barres de l'aliment.
NOM (chaîne) - Nom de l'aliment.
MARQUE (chaîne) - Marque de l'aliment.
CATEGORIE (chaîne) - Catégorie de l'aliment.
... autres paramètres selon les besoins.
Exemple de requête :
POST /Toniz/backend/api_aliments.php HTTP/1.1
Host: localhost
Content-Type: application/json
Content-Length: 383

{
    "CODE_BARRES": "20010000000111",
    "NOM": "Pain complet façon Nizar",
    "MARQUE": "Harrys",
    "CATEGORIE": "Pains, Pains complets",
    "ENERGIE_100G": "250",
    "MAT_GRASSES": "3.5",
    "GRAISSES_SATUREES": "0.6",
    "GLUCIDES": "46",
    "SUCRES": "3.2",
    "FIBRES": "6.5",
    "PROTEINES": "10",
    "SEL": "0.72",
    "SODIUM": "0.29",
    "CALCIUM": "34"
}

3. Mise à jour d'un aliment existant
Méthode HTTP : PUT
URL : http://localhost/Toniz/backend/api_aliments.php
Description : Met à jour les informations d'un aliment existant dans la base de données.
Paramètres :
CODE_BARRES (entier) - Code-barres de l'aliment à mettre à jour.
... autres paramètres à mettre à jour.
Exemple de requête :
PUT /api_aliments
Content-Type: application/json

{
  "CODE_BARRES": 987654321,
  "NOM": "Aliment Mis à Jour",
  "MARQUE": "Ma Marque Mise à Jour",
  "CATEGORIE": "Catégorie Mise à Jour",
  "ENERGIE_100G": 250,
  "MAT_GRASSES": "20g",
  "GRAISSES_SATUREES": "8g",
  "GLUCIDES": "30g",
  "SUCRES": "25g",
  "FIBRES": "6g",
  "PROTEINES": "12g",
  "SEL": "2g",
  "SODIUM": "0.8g",
  "CALCIUM": "130mg"
}

Réponse attendue :
{
  "message": "Aliment mis à jour avec succès."
}

4. Suppression d'un aliment
Méthode HTTP : DELETE
URL : http://localhost/Toniz/backend/api_aliments.php
Description : Supprime un aliment de la base de données.
Paramètres :
CODE_BARRES (entier) - Code-barres de l'aliment à supprimer.
Exemple de requête :
DELETE /api_aliments
Content-Type: application/json

{"CODE_BARRES": "3423182114001"}
Réponse attendue :
{
  "message": "Aliment supprimé avec succès."
}

**API Aliments Favoris**
Description
Cette API permet de créer un lien entre les utilisateurs et leurs aliments favoris respectif. La table qui enregistre les nouvelles
entrées gérées par cette API est aliments_favoris.

Endpoints
1. Récupération de tous les aliments favoris d'un utilisateur
Méthode HTTP : GET
URL : http://localhost/Toniz/backend/api_aliments_ajouter_favoris.php
Description : Récupère tous les aliments favoris de l'utilisateur.
Réponse attendue :

[
  {
    "CODE_BARRES": 123456789,
    "NOM": "Nom de l'aliment favori",
    "MARQUE": "Marque de l'aliment favori",
    "CATEGORIE": "Catégorie de l'aliment favori",
    "ENERGIE_100G": 150,
    "MAT_GRASSES": "10g",
    "GRAISSES_SATUREES": "5g",
    "GLUCIDES": "20g",
    "SUCRES": "15g",
    "FIBRES": "3g",
    "PROTEINES": "8g",
    "SEL": "1g",
    "SODIUM": "0.4g",
    "CALCIUM": "100mg"
  },
]

2. Ajout d'un aliment aux favoris d'un utilisateur
Méthode HTTP : POST
URL : http://localhost/Toniz/backend/api_aliments_ajouter_favoris.php
Description : Ajoute un nouvel aliment aux favoris de l'utilisateur.
Paramètres :
CODE_BARRES (entier) - Code-barres de l'aliment à ajouter aux favoris.
Exemple de requête :

POST /api_aliments_ajouter_favoris
Content-Type: application/json

{
  "CODE_BARRES": 987654321
}

Réponse attendue :
{
  "message": "Aliment ajouté aux favoris avec succès."
}

**API Aliments Favoris**
Description
Cette API gère les aliments favoris des utilisateurs, permettant la récupération de tous les aliments favoris d'un utilisateur et la suppression d'un aliment spécifique de la liste des favoris.
Endpoints
1. Récupération de tous les aliments favoris d'un utilisateur
Méthode HTTP : GET
URL : http://localhost/Toniz/backend/api_aliments_ajouter_favoris.php
Description : Récupère tous les aliments favoris de l'utilisateur.
Réponse attendue :

[
  {
    "CODE_BARRES": 123456789,
    "NOM": "Nom de l'aliment favori",
    "MARQUE": "Marque de l'aliment favori",
    "CATEGORIE": "Catégorie de l'aliment favori",
    "ENERGIE_100G": 150
    // ... autres propriétés de l'aliment
  },
  // ... autres aliments favoris de l'utilisateur
]

2. Suppression d'un aliment favori de l'utilisateur
Méthode HTTP : DELETE
URL : http://localhost/Toniz/backend/api_aliments_ajouter_favoris.php

Description : Supprime un aliment favori de l'utilisateur.
Paramètres :
CODE_BARRES (entier) - Code-barres de l'aliment à supprimer des favoris.
Exemple de requête :
Content-Type: application/json

{"CODE_BARRES": "3423182114001"}
Réponse attendue :
{
  "message": "Aliment favori supprimé avec succès."
}

**API d'Inscription**
Description
Cette API gère le processus d'inscription des utilisateurs. Elle permet la création de nouveaux comptes utilisateurs en vérifiant la disponibilité du nom d'utilisateur.

Endpoint
Inscription d'un nouvel utilisateur
Méthode HTTP : POST
URL : http://localhost/Toniz/backend/api_inscription.php

Description : Permet l'inscription d'un nouvel utilisateur en fournissant les informations nécessaires.
Paramètres requis :
login (chaîne) - Nom d'utilisateur unique.
mdp (chaîne) - Mot de passe de l'utilisateur.
age (entier) - Âge de l'utilisateur.
taille (entier) - Taille de l'utilisateur en centimètres.
poids (entier) - Poids de l'utilisateur en kilogrammes.
sexe (chaîne) - Genre de l'utilisateur (par exemple, "homme", "femme").
activite (chaîne) - Niveau d'activité physique de l'utilisateur.
Exemple de requête :
POST http://localhost/Toniz/backend/api_inscription.php
Content-Type: application/json

{
  "login": "utilisateur123",
  "mdp": "motdepasse123",
  "age": 25,
  "taille": 175,
  "poids": 70,
  "sexe": "homme",
  "activite": "modérée"
}

Réponse attendue en cas de succès :
{
  "message": "Utilisateur inscrit avec succès"
}

Réponse en cas d'échec (nom d'utilisateur déjà pris) :
{
  "error": "Déjà existant. Veuillez rentrer un autre nom d'utilisateur."
}


Réponse en cas d'échec (données manquantes) :
{
  "error": "Données manquantes"
}

Exemple d'utilisation
Inscription d'un nouvel utilisateur

POST http://localhost/Toniz/backend/api_inscription.php
Content-Type: application/json

{
  "login": "nouvel_utilisateur",
  "mdp": "motdepasse123",
  "age": 30,
  "taille": 180,
  "poids": 75,
  "sexe": "femme",
  "activite": "élevée"
}

**API Nutriments**
Description
Cette API gère la récupération des calories et d'autres nutriments absorbés par jour sur une période spécifique par un utilisateur.

Endpoint
Récupération des calories et des nutriments par jour
Méthode HTTP : POST
URL : http://localhost/Toniz/backend/api_nutriment.php
Description : Récupère les calories et d'autres nutriments absorbés par jour sur une période spécifique par un utilisateur.
Paramètres requis :
start_date (chaîne, optionnel) - Date de début de la période (au format Y-m-d). Par défaut, la date du jour.
end_date (chaîne, optionnel) - Date de fin de la période (au format Y-m-d). Par défaut, la date du jour.
nutriment_type (chaîne, optionnel) - Type de nutriment à récupérer (par exemple, "ENERGIE_100G", "MAT_GRASSES", etc.). Par défaut, "ENERGIE_100G".
Exemple de requête :
POST http://localhost/Toniz/backend/api_nutriment.php
Content-Type: application/x-www-form-urlencoded

start_date=2023-01-01
end_date=2023-01-10
nutriment_type=ENERGIE_100G

Réponse attendue en cas de succès :
{
  "dailyNutriments": [
    {"jour": "2023-01-01", "totalNutriment": 1500},
    {"jour": "2023-01-02", "totalNutriment": 1600},
    // ... autres jours ...
  ],
  "userKcal": 2000
}

Réponse en cas d'échec :
{
  "error": "Erreur lors de la récupération du nutriment : [message d'erreur]"
}

Exemple d'utilisation
Récupération des calories et des nutriments par jour
POST http://localhost/Toniz/backend/api_nutriment.php
Content-Type: application/x-www-form-urlencoded

start_date=2023-01-01
end_date=2023-01-10
nutriment_type=ENERGIE_100G


**API Profil**
Description
Cette API gère la gestion du profil utilisateur, y compris la récupération et la mise à jour des informations du profil.

Endpoint
Connexion
Méthode HTTP : POST
URL : http://localhost/Toniz/backend/api_profil.php
Description : Connecte un utilisateur avec les identifiants fournis.
Paramètres requis :
login : Le nom d'utilisateur.
mdp : Le mot de passe.
Exemple de requête :
curl -X POST -H "Content-Type: application/json" -d '{"login": "utilisateur123", "mdp": "motdepasse123"}' http://localhost/Toniz/backend/api_profil.php

Exemple de réponse en cas de succès :
{
  "message": "Connexion réussie"
}
Exemple de réponse en cas d'échec :
{
  "error": "Identifiants incorrects"
}
Récupération des informations du profil
Méthode HTTP : GET
URL : http://localhost/Toniz/backend/api_profil.php
Description : Récupère les informations du profil de l'utilisateur.
Paramètres requis :
Aucun paramètre requis.
Exemple de requête :
curl http://localhost/Toniz/backend/api_profil.php
[
  {
    "LOGIN": "utilisateur123",
    "AGE": 25,
    "TAILLE": 175,
    "POIDS": 70,
    "SEXE": "Homme",
    "ACTIVITE": 3,
    "KCAL_JOUR": 2000
  }
]
Exemple de réponse en cas d'échec (non connecté) :
{
  "error": "Utilisateur non autorisé."
}


Mise à jour du profil
Méthode HTTP : PUT
URL : http://localhost/Toniz/backend/api_profil.php
Description : Met à jour les informations du profil de l'utilisateur.
Paramètres requis :
login : Le nom d'utilisateur.
age : L'âge de l'utilisateur.
taille : La taille de l'utilisateur.
poids : Le poids de l'utilisateur.
sexe : Le sexe de l'utilisateur.
activite : Le niveau d'activité de l'utilisateur.
kcal_jour : Le nombre de calories recommandées par jour pour l'utilisateur.
Exemple de requête :
curl -X PUT -H "Content-Type: application/json" -d '{"login": "utilisateur123", "age": 26, "taille": 178, "poids": 72, "sexe": "Homme", "activite": 4, "kcal_jour": 2200}' http://localhost/Toniz/backend/api_profil.php

Exemple de réponse en cas de succès :
{
  "message": "Utilisateur mis à jour avec succès."
}

Exemple de réponse en cas d'échec (non connecté) :
{
  "error": "Utilisateur non autorisé."
}


**API Repas**
Description
Cette API gère l'enregistrement des repas, y compris les aliments qui les composent.

Endpoint
Enregistrement d'un repas
Méthode HTTP : POST
URL : http://localhost/Toniz/backend/api_repas.php
Description : Enregistre un repas avec les aliments spécifiés.
Paramètres requis :
nomRepas : Le nom du repas.
dateRepas : La date et l'heure du repas au format "Y-m-d H:i:s".
aliments : Un tableau d'aliments avec leurs codes-barres et quantités.
Exemple de requête :
curl -X POST -H "Content-Type: application/json" -d '{"nomRepas": "Déjeuner", "dateRepas": "2023-11-15 12:30:00", "aliments": [{"aliment": 123456789, "quantite": 200}, {"aliment": 987654321, "quantite": 150}, {"aliment": 111222333, "quantite": 100}]}' http://localhost/Toniz/backend/api_repas.php

Exemple de réponse en cas de succès :
{
  "message": "Repas enregistré avec succès.",
  "totalCalories": 750
}

Exemple de réponse en cas d'échec :
{
  "message": "Erreur lors de l'enregistrement du repas : Message d'erreur spécifique."
}
Remarques
Les données du repas comprennent le nom du repas, la date et l'heure du repas, ainsi que les aliments consommés avec leurs quantités.
Les aliments sont spécifiés sous la forme d'un tableau d'objets avec chaque objet ayant les propriétés aliment (code-barres de l'aliment) et quantite (quantité consommée en grammes).
La requête doit être envoyée avec le type de contenu application/json.
En cas de succès, la réponse inclut un message de confirmation ainsi que le total des calories pour le repas enregistré.
En cas d'échec, la réponse inclut un message d'erreur spécifique.


**API Voir Repas**

Description
Cette API permet de récupérer les repas d'un utilisateur avec les détails des aliments associés, et offre également la possibilité de supprimer un repas spécifique.

Endpoints
Récupération des repas de l'utilisateur
Méthode HTTP : GET
URL : http://localhost/Toniz/backend/api_voir_repas.php
Description : Récupère tous les repas d'un utilisateur avec les détails des aliments.
Paramètres requis : Aucun
Exemple de requête :
curl -X GET -b "login=nom_utilisateur" http://localhost/Toniz/backend/api_voir_repas.php
Exemple de réponse en cas de succès :
[
  {
    "ID_REPAS": 1,
    "NOM_REPAS": "Déjeuner",
    "DATE": "2023-11-15 12:30:00",
    "ALIMENTS": "Poulet, Riz, Légumes",
    "MARQUES": "Marque1, Marque2, Marque3",
    "QUANTITE_TOTAL": 500
  },
  {
    "ID_REPAS": 2,
    "NOM_REPAS": "Dîner",
    "DATE": "2023-11-15 19:00:00",
    "ALIMENTS": "Saumon, Quinoa, Salade",
    "MARQUES": "Marque4, Marque5, Marque6",
    "QUANTITE_TOTAL": 600
  },
]

Exemple de réponse en cas d'échec :
[]

Suppression d'un repas
Méthode HTTP : DELETE
URL : http://localhost/Toniz/backend/api_voir_repas.php
Description : Supprime un repas en utilisant son ID_REPAS.
Paramètres requis : id : L'ID_REPAS du repas à supprimer.
Exemple de requête :
curl -X DELETE http://localhost/Toniz/backend/api_voir_repas.php?id=1

Exemple de réponse en cas de succès :
{
  "message": "Repas supprimé avec succès."
}

Exemple de réponse en cas d'échec :
{
  "error": "Repas non trouvé avec l'ID_REPAS spécifié."
}

