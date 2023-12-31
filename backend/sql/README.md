Voici une brève explication de chaque table et de son rôle :

1. **Table `aliment` :**
   - Stocke les informations sur les aliments, y compris le code-barres, le nom, la marque, la catégorie et l'énergie (en calories) pour 100g de l'aliment.

2. **Table `a_besoin_de` :**
   - Établit une relation entre les utilisateurs et les nutriments dont ils ont besoin, avec la quantité quotidienne nécessaire de chaque nutriment.

3. **Table `element_de` :**
   - Lie les aliments aux repas, enregistrant la quantité de l'aliment consommée dans un repas particulier.

4. **Table `ingredient_de` :**
   - Établit une relation entre les aliments, en indiquant quels aliments sont des ingrédients d'autres aliments, avec la proportion de chaque ingrédient.

5. **Table `nutriment` :**
   - Contient des informations sur les nutriments, y compris un identifiant unique, la quantité de nutriment pour 100g et le nom du nutriment.

6. **Table `present_dans` :**
   - Indique la quantité d'un nutriment particulier dans un aliment spécifique, enregistré en fonction du code-barres de l'aliment et de l'identifiant du nutriment.

7. **Table `repas` :**
   - Enregistre les repas associés à un utilisateur, avec un identifiant unique pour chaque repas, l'identifiant de l'utilisateur et la date du repas.

8. **Table `utilisateur` :**
   - Stocke les informations sur les utilisateurs, y compris un identifiant unique, le nom de l'utilisateur, l'âge, le sexe, le niveau d'activité sportive et le nombre de calories nécessaires par jour.

9. **Table `aliments_favoris` :**
   Dans cette table, ID_USER est l'identifiant de l'utilisateur et CODE_BARRES est l'identifiant unique du produit (code-barres de l'aliment). La combinaison de ces deux champs forme une clé primaire composite, ce qui signifie qu'une paire utilisateur-code-barres ne peut apparaître qu'une seule fois dans la table, évitant ainsi les doublons.

   Lorsqu'un utilisateur ajoute un produit aux favoris, vous insérez simplement une nouvelle ligne avec son identifiant utilisateur et le code-barres du produit dans la table aliments_favoris. Ensuite, lorsque vous devez récupérer les autres informations sur cet aliment, vous pouvez utiliser le code-barres pour faire correspondre l'enregistrement dans la table principale des aliments. Cela réduit la redondance des données tout en vous permettant de récupérer toutes les informations nécessaires quand c'est nécessaire.



