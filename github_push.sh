#!/bin/bash
# Sur le serveur Hostinger : récupère les mises à jour du site puis renvoie sur GitHub
# les données modifiées depuis l'administration (articles, résultats, photos…).
# Le fichier .gitignore empêche l'envoi du journal des connexions.
set -e

git pull

git add -A
git commit -m "maj hostinger" || echo "Rien à envoyer."

git push
