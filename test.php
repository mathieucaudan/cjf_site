import json
from collections import Counter

# Chemin vers le fichier JSON
chemin_fichier = "competitions/Championnat de france de Triathlé 2025/athlestes.json"

# Chargement du fichier JSON
with open(chemin_fichier, "r", encoding="utf-8") as f:
    data = json.load(f)

# Compteur de clubs
club_counter = Counter()

# Parcours des catégories et des participants
for participants in data.values():
    for personne in participants:
        club = personne.get("club", "Inconnu")
        club_counter[club] += 1

# Affichage du résultat
for club, nb in club_counter.most_common():
    print(f"{club}: {nb} participant(s)")
