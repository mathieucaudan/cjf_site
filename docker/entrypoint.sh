#!/bin/sh
# Donne à Apache (www-data) le droit d'écrire là où l'administration du site enregistre
# ses données. Le reste du code n'est pas modifié, pour que « git pull » continue de marcher.
set -e
cd /var/www/html
for chemin in article image galerie info_pdf info_images section competitions \
              article.json calendrier.json resultat.json record.json compteur.json \
              athletes.json nb_art.txt connexion.txt; do
    [ -e "$chemin" ] && chown -R www-data:www-data "$chemin"
done
# Fichiers créés à la volée par le site
for fichier in compteur.json nb_art.txt; do
    [ -e "$fichier" ] || { echo "" > "$fichier"; chown www-data:www-data "$fichier"; }
done
# Dossier privé des comptes admin (monté à côté du site)
mkdir -p /var/www/cjf_prive && chown www-data:www-data /var/www/cjf_prive && chmod 750 /var/www/cjf_prive
exec docker-php-entrypoint "$@"
