import pandas as pd
import tkinter as tk
from tkinter import filedialog
import os

# Obtenir le chemin du répertoire du script Python
script_dir = os.path.dirname(__file__)

# Créer une fenêtre Tkinter pour sélectionner le fichier CSV
root = tk.Tk()
root.withdraw()
file_path = filedialog.askopenfilename(filetypes=[("Fichiers CSV", "*.csv")])

if file_path:
    # Lire le fichier CSV en utilisant pandas
    df = pd.read_csv(file_path, delimiter='\t')


    # Sélectionner les colonnes requises
    selected_columns = df[['code', 'product_name_fr', 'brands', 'categories', 'energy-kcal_value',
                        'fat_value', 'saturated-fat_value', 'carbohydrates_value', 'sugars_value',
                        'fiber_value', 'proteins_value', 'salt_value', 'sodium_value',
                        'calcium_value']]

    # Renommer les colonnes
    selected_columns = selected_columns.rename(columns={
        'code': 'CODE_BARRES',
        'product_name_fr': 'NOM',
        'brands': 'MARQUE',
        'categories': 'CATEGORIE',
        'energy-kcal_value': 'ENERGIE_100G',
        'fat_value': 'MATIERES_GRASSES',
        'saturated-fat_value': 'GRAISSES_SATUREES',
        'carbohydrates_value': 'GLUCIDES',
        'sugars_value': 'SUCRES',
        'fiber_value': 'FIBRES',
        'proteins_value': 'PROTEINES',
        'salt_value': 'SEL',
        'sodium_value': 'SODIUM',
        'calcium_value': 'CALCIUM',
    })

    # Supprimer les lignes sans code barres (non-entiers) et sans nom (vide) et sans kcalories
    selected_columns = selected_columns.dropna(subset=['CODE_BARRES', 'NOM', 'ENERGIE_100G'])
    selected_columns = selected_columns[selected_columns['CODE_BARRES'].apply(lambda x: str(x).isdigit())]

    # Chemin complet pour le fichier de sortie dans le même répertoire que le script
    output_file = os.path.join(script_dir, 'output2.csv')

    # Enregistrer le DataFrame résultant dans le nouveau fichier CSV
    selected_columns.to_csv(output_file, index=False, sep=';')

    print(f"Les données ont été extraites avec succès dans le fichier : {output_file}")
else:
    print("Aucun fichier sélectionné.")

# Fermer la fenêtre Tkinter
root.destroy()
