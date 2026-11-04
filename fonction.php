<?php
require_once __DIR__ . '/session.php';

// Toute requête POST d'un administrateur doit porter le jeton CSRF de sa session.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['role']) && !csrf_valide()) {
    http_response_code(403);
    exit('Formulaire expiré. Revenez en arrière, rechargez la page et recommencez.');
}

/* =====================================================================
   Gabarit commun du site : en-tête, navigation, pied de page
   ===================================================================== */

/** Échappe un texte pour l'affichage HTML. */
function e($texte)
{
    return htmlspecialchars((string) $texte, ENT_QUOTES, 'UTF-8');
}

/** Lit une date « 2025-12-13 », « 13/12/2025 » ou « 13/12/25 ». Renvoie un DateTime ou null. */
function lire_date($date)
{
    $date = trim((string) $date);
    if ($date === '') return null;
    if (preg_match('#^\d{1,2}/\d{1,2}/\d{2}$#', $date)) {
        $d = DateTime::createFromFormat('d/m/y', $date);
    } elseif (preg_match('#^\d{4}-\d{2}-\d{2}$#', $date)) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
    } else {
        $d = DateTime::createFromFormat('d/m/Y', $date);
    }
    return $d ?: null;
}

/** Date affichée en toutes lettres : « 13 décembre 2025 ». */
function date_lisible($date)
{
    $d = lire_date($date);
    if (!$d) return (string) $date;
    $mois = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
    return $d->format('j') . ' ' . $mois[(int) $d->format('n') - 1] . ' ' . $d->format('Y');
}

/** Vrai si la personne connectée est administratrice. */
function est_admin()
{
    return isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
}

/** Icônes SVG utilisées dans le gabarit. */
function icone($nom, $taille = 20)
{
    $chemins = [
        'chevron' => "<path d='M6 9l6 6 6-6' fill='none' stroke='currentColor' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/>",
        'lieu' => "<path d='M12 21s-7-6.2-7-11.5A7 7 0 0 1 19 9.5C19 14.8 12 21 12 21z' fill='none' stroke='currentColor' stroke-width='2'/><circle cx='12' cy='9.5' r='2.5' fill='currentColor'/>",
        'tel' => "<path d='M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z' fill='none' stroke='currentColor' stroke-width='2' stroke-linejoin='round'/>",
        'mail' => "<rect x='3' y='5' width='18' height='14' rx='2' fill='none' stroke='currentColor' stroke-width='2'/><path d='M3 7l9 6 9-6' fill='none' stroke='currentColor' stroke-width='2'/>",
        'instagram' => "<rect x='3' y='3' width='18' height='18' rx='5' fill='none' stroke='currentColor' stroke-width='2'/><circle cx='12' cy='12' r='4' fill='none' stroke='currentColor' stroke-width='2'/><circle cx='17.5' cy='6.5' r='1.3' fill='currentColor'/>",
        'facebook' => "<path d='M14 8h3V4h-3a4 4 0 0 0-4 4v2H7v4h3v7h4v-7h3l1-4h-4V8z' fill='currentColor'/>",
        'pdf' => "<path d='M6 2h9l5 5v15H6z' fill='none' stroke='currentColor' stroke-width='2' stroke-linejoin='round'/><path d='M14 2v6h6' fill='none' stroke='currentColor' stroke-width='2'/><path d='M9 13h6M9 17h6' stroke='currentColor' stroke-width='2'/>",
        'fleche' => "<path d='M15 18l-6-6 6-6' fill='none' stroke='currentColor' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/>",
    ];
    $svg = $chemins[$nom] ?? '';
    return "<svg width='$taille' height='$taille' viewBox='0 0 24 24' aria-hidden='true' focusable='false'>$svg</svg>";
}

/**
 * Ouvre le document : <head> commun puis <body>.
 * $titre : titre de la page (onglet du navigateur).
 */
function entete($titre = null, $description = null)
{
    $titreComplet = $titre ? e($titre) . ' — CJF Saint-Malo Pentathlon Moderne' : 'CJF Saint-Malo Pentathlon Moderne';
    $description = $description ?: 'Section Pentathlon Moderne du Cercle Jules Ferry Saint-Malo : laser run, natation, escrime et parcours d\'obstacles.';
    echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>$titreComplet</title>
    <meta name='description' content='" . e($description) . "'>
    <meta property='og:title' content='$titreComplet'>
    <meta property='og:description' content='" . e($description) . "'>
    <meta property='og:image' content='image/logo_cjf.webp'>
    <meta name='theme-color' content='#0e2340'>
    <meta name='csrf' content='" . jeton_csrf() . "'>
    <link rel='preload' href='style/fonts/barlow-condensed-latin-800-italic.woff2' as='font' type='font/woff2' crossorigin>
    <link rel='stylesheet' href='style/cjf.css'>
    <link rel='icon' href='image/favicon.webp'>
</head>
<body>
<a class='skip-link' href='#contenu'>Aller au contenu</a>
";
}

/** En-tête du site avec la navigation. Ouvre la zone <main>. */
function navbar()
{
    $page = basename($_SERVER['SCRIPT_NAME'] ?? '');
    $courant = function ($fichier) use ($page) {
        return $page === $fichier ? " aria-current='page'" : '';
    };
    $chevron = icone('chevron', 16);

    echo "
<header class='entete'>
  <div class='wrap entete__barre'>
    <a class='entete__logo' href='accueil.php'>
      <img src='image/logo_cjf.webp' alt='Cercle Jules Ferry Saint-Malo' width='190' height='42'>
      <span>Pentathlon<small>moderne</small></span>
    </a>
    <button class='burger' type='button' aria-expanded='false' aria-controls='navigation'><span></span><span class='sr-only'>Menu</span></button>
    <nav class='nav' id='navigation' aria-label='Navigation principale'>
      <ul class='nav__liste'>
        <li><a class='nav__lien' href='accueil.php'{$courant('accueil.php')}>Accueil</a></li>
        <li class='nav__deroulant'>
          <button type='button' aria-expanded='false'>Le club $chevron</button>
          <ul class='nav__sousmenu'>
            <li><a href='nous.php'>Qui sommes-nous ?</a></li>
            <li><a href='creneaux.php'>Créneaux d'entraînement</a></li>
            <li><a href='record.php'>Records du club</a></li>
            <li><a href='section.php'>Section sportive scolaire</a></li>
          </ul>
        </li>
        <li><a class='nav__lien' href='article.php'{$courant('article.php')}>Articles</a></li>
        <li><a class='nav__lien' href='calendrier.php'{$courant('calendrier.php')}>Calendrier</a></li>
        <li><a class='nav__lien' href='galerie_photo.php'{$courant('galerie_photo.php')}>Photos</a></li>
        <li><a class='nav__lien' href='partenaire.php'{$courant('partenaire.php')}>Partenaires</a></li>";

    if (est_admin()) {
        echo "
        <li class='nav__deroulant'>
          <button type='button' aria-expanded='false'>Administration $chevron</button>
          <ul class='nav__sousmenu nav__sousmenu--admin'>
            <li><a href='parametres_article.php'>Articles</a></li>
            <li><a href='parametres_nb_article.php'>Articles à la une</a></li>
            <li><a href='parametres_resultat.php'>Infos et résultats</a></li>
            <li><a href='parametres_calendrier.php'>Calendrier</a></li>
            <li><a href='parametres_carousel.php'>Photos d'accueil</a></li>
            <li><a href='parametres_galerie.php'>Galerie</a></li>
            <li><a href='parametres_record.php'>Records</a></li>
            <li><a href='parametres_section.php'>Section</a></li>
            <li><a href='compet.php'>Compétitions</a></li>
            <li><a href='connexion_LR.php'>Statistiques Laser Shot</a></li>
          </ul>
        </li>";
    }

    echo "
      </ul>
      <div class='nav__actions'>";
    if (isset($_SESSION['role'])) {
        echo "<a class='nav__compte' href='deconnexion.php'>Se déconnecter</a>";
    } else {
        echo "<a class='nav__compte' href='connexion.php'>Connexion</a>";
    }
    echo "
        <a class='btn btn--rouge btn--petit' href='inscription.php'>S'inscrire</a>
      </div>
    </nav>
  </div>
</header>
<main id='contenu'>
";
}

/** Bandeau de titre des pages intérieures. */
function bandeau($titre, $intro = null, $admin = false)
{
    echo "<section class='bandeau" . ($admin ? " bandeau--admin" : "") . "'><div class='wrap'><h1>" . e($titre) . "</h1>";
    if ($intro) {
        echo "<p>" . e($intro) . "</p>";
    }
    echo "</div></section>";
}

/**
 * Barre d'onglets accessible. $onglets = ['id_du_panneau' => 'Libellé', ...].
 * Chaque panneau : <div id='id_du_panneau' role='tabpanel' aria-labelledby='onglet-id_du_panneau'>.
 * $memoire : garde l'onglet choisi dans l'adresse (#id) pour pouvoir le partager.
 */
function onglets($onglets, $memoire = true)
{
    echo "<div class='onglets-centre'><div class='onglets' role='tablist'" . ($memoire ? " data-memoire='1'" : "") . ">";
    $premier = true;
    foreach ($onglets as $id => $libelle) {
        $id = e($id);
        echo "<button type='button' role='tab' id='onglet-$id' aria-controls='$id' aria-selected='" . ($premier ? 'true' : 'false') . "'>" . e($libelle) . "</button>";
        $premier = false;
    }
    echo "</div></div>";
}

/**
 * À appeler en tête de chaque page d'administration, avant tout affichage :
 * une personne non connectée voit la page « Accès réservé » et le script s'arrête.
 */
function exiger_admin($titre = 'Administration')
{
    if (!est_admin()) {
        http_response_code(403);
        entete($titre);
        navbar();
        acces_refuse();
        footer();
        exit;
    }
}

/** Message affiché aux personnes non autorisées sur les pages d'administration. */
function acces_refuse()
{
    bandeau('Accès réservé', null, true);
    echo "<section class='section section--serre'><div class='wrap'>
        <div class='carte formulaire--etroit'>
          <p>Cette page est réservée aux administrateurs du club. Connectez-vous avec votre compte pour y accéder.</p>
          <a class='btn' href='connexion.php'>Se connecter</a>
        </div></div></section>";
}

/** Ferme la zone <main>, affiche le pied de page et termine le document. */
function footer()
{
    $annee = date('Y');
    $lieu = icone('lieu');
    $tel = icone('tel');
    $mail = icone('mail');
    $insta = icone('instagram', 22);
    $fb = icone('facebook', 22);
    echo "
</main>
<footer class='pied'>
  <div class='wrap'>
    <div class='pied__grille'>
      <div>
        <p class='pied__accroche'>En espérant vous voir à l'entraînement</p>
        <a class='btn btn--rouge' href='inscription.php'>S'inscrire au club</a>
        <div class='pied__reseaux'>
          <a href='https://www.instagram.com/cjf_pentathlonmoderne/' target='_blank' rel='noopener' aria-label='Instagram du club'>$insta</a>
          <a href='https://www.facebook.com/profile.php?id=100085812112831' target='_blank' rel='noopener' aria-label='Facebook du club'>$fb</a>
        </div>
      </div>
      <div>
        <h2>Le site</h2>
        <ul class='pied__liens'>
          <li><a href='accueil.php'>Accueil</a></li>
          <li><a href='nous.php'>Qui sommes-nous ?</a></li>
          <li><a href='creneaux.php'>Créneaux</a></li>
          <li><a href='record.php'>Records</a></li>
          <li><a href='section.php'>Section sportive</a></li>
          <li><a href='article.php'>Articles</a></li>
          <li><a href='calendrier.php'>Calendrier</a></li>
          <li><a href='galerie_photo.php'>Photos</a></li>
          <li><a href='partenaire.php'>Partenaires</a></li>
          <li><a href='inscription.php'>S'inscrire</a></li>
        </ul>
      </div>
      <div>
        <h2>Nous contacter</h2>
        <ul class='pied__contact'>
          <li>$lieu<a href='https://maps.google.com/?q=22+avenue+de+Marville+Saint-Malo' target='_blank' rel='noopener'>22 avenue de Marville<br>35400 Saint-Malo</a></li>
          <li>$tel<a href='tel:+33608105644'>06 08 10 56 44</a></li>
          <li>$mail<a href='mailto:cjf.saintmalo.pentathlonmoderne@gmail.com'>cjf.saintmalo.pentathlonmoderne@gmail.com</a></li>
        </ul>
      </div>
    </div>
    <div class='pied__bas'>
      <span>© $annee CJF Saint-Malo Pentathlon Moderne. Tous droits réservés.</span>
      <span>Réalisé par les cracks du CJF</span>
      <a href='laser_shot.php'>Laser Shot</a>
    </div>
  </div>
</footer>
<script src='script/site.js'></script>
</body>
</html>";
}

/* =====================================================================
   Outils d'administration : téléversements et suppressions sécurisés
   ===================================================================== */

/**
 * Nettoie un nom de fichier choisi par l'admin : minuscules, tirets, sans accents.
 */
function nom_fichier_propre($nom)
{
    $nom = trim((string) $nom);
    $nom = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $nom) ?: $nom;
    $nom = strtolower(str_replace(' ', '-', $nom));
    $nom = preg_replace('/[^a-z0-9\-_]/', '', $nom);
    return trim($nom, '-_') ?: 'fichier-' . date('YmdHis');
}

/**
 * Vérifie un fichier téléversé contre une liste blanche.
 * $type : 'image' (jpg, jpeg, png, webp) ou 'pdf'.
 * Renvoie l'extension en minuscules, ou null si le fichier est refusé.
 */
function fichier_autorise($fichier, $type)
{
    if (empty($fichier['tmp_name']) || ($fichier['error'] ?? 1) !== UPLOAD_ERR_OK || !is_uploaded_file($fichier['tmp_name'])) {
        return null;
    }
    $ext = strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION));
    $mime = function_exists('finfo_open') ? finfo_file(finfo_open(FILEINFO_MIME_TYPE), $fichier['tmp_name']) : null;
    $permis = $type === 'pdf'
        ? ['pdf' => ['application/pdf']]
        : ['jpg' => ['image/jpeg'], 'jpeg' => ['image/jpeg'], 'png' => ['image/png'], 'webp' => ['image/webp']];
    if (!isset($permis[$ext])) {
        return null;
    }
    if ($mime && !in_array($mime, $permis[$ext], true)) {
        return null;
    }
    return $ext;
}

/**
 * Enregistre une image téléversée en WebP sous $dossier/$nom.webp.
 * Renvoie le nom du fichier enregistré, ou null en cas d'échec.
 */
function enregistrer_image_webp($fichier, $dossier, $nom)
{
    $ext = fichier_autorise($fichier, 'image');
    if (!$ext) {
        return null;
    }
    $cible = rtrim($dossier, '/') . '/' . $nom . '.webp';
    if ($ext === 'webp') {
        return move_uploaded_file($fichier['tmp_name'], $cible) ? $nom . '.webp' : null;
    }
    $image = @imagecreatefromstring(file_get_contents($fichier['tmp_name']));
    if (!$image) {
        return null;
    }
    imagepalettetotruecolor($image);
    $ok = imagewebp($image, $cible, 82);
    imagedestroy($image);
    return $ok ? $nom . '.webp' : null;
}

/** Message de retour après une action d'administration. */
function message_admin($texte, $type = 'ok')
{
    echo "<div class='message message--$type' role='status'>" . e($texte) . "</div>";
}

/**
 * Bouton de suppression : formulaire POST (jeton CSRF ajouté automatiquement),
 * avec confirmation. $ancre : onglet à rouvrir après l'action. $champs : champs cachés en plus.
 */
function bouton_supprimer($valeur, $libelle, $ancre = '', $champs = [])
{
    $action = $ancre ? '#' . e($ancre) : '';
    $caches = '';
    foreach ($champs as $nom => $val) {
        $caches .= "<input type='hidden' name='" . e($nom) . "' value='" . e($val) . "'>";
    }
    return "<form method='post' action='$action' onsubmit=\"return confirm('Supprimer « " . e(addslashes($libelle)) . " » ? Cette action est définitive.')\">
        $caches<input type='hidden' name='action' value='supprimer'>
        <input type='hidden' name='fichier' value='" . e($valeur) . "'>
        <button type='submit' class='btn btn--danger btn--petit'>Supprimer</button>
    </form>";
}

/** Renvoie la valeur à supprimer si la requête est une suppression, sinon null. */
function demande_suppression()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'supprimer' && isset($_POST['fichier'])) {
        return (string) $_POST['fichier'];
    }
    return null;
}

/** Lit un fichier JSON en tableau (vide si absent ou illisible). */
function lire_json($chemin)
{
    return file_exists($chemin) ? (json_decode(file_get_contents($chemin), true) ?: []) : [];
}

/* ---------------------------------------------------------------------
   Galerie
   --------------------------------------------------------------------- */
function ajoutGalerie()
{
    if (!est_admin()) return;
    $jsonFile = 'galerie/data.json';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'ajouter') {
        $titre = trim($_POST['titre'] ?? '');
        $lien = trim($_POST['lien'] ?? '');
        $date = date('d/m/Y', strtotime($_POST['date'] ?? 'now'));
        $nom = nom_fichier_propre($_POST['nom_image'] ?? $titre);
        $donnees = lire_json($jsonFile);

        $doublon = false;
        foreach ($donnees as $item) {
            if ($item['titre'] === $titre || $item['path_image'] === $nom . '.webp') {
                $doublon = true;
            }
        }

        if (!filter_var($lien, FILTER_VALIDATE_URL) || !preg_match('#^https?://#i', $lien)) {
            message_admin("Le lien de l'album doit être une adresse web complète (https://…).", 'erreur');
        } elseif ($doublon) {
            message_admin('Un album avec ce titre ou ce nom d\'image existe déjà.', 'erreur');
        } elseif (!($image = enregistrer_image_webp($_FILES['image'] ?? [], 'image/galerie_image', $nom))) {
            message_admin('Image refusée : formats acceptés JPG, PNG ou WebP.', 'erreur');
        } else {
            $donnees[] = ['titre' => $titre, 'lien' => $lien, 'date' => $date, 'path_image' => $image];
            file_put_contents($jsonFile, json_encode($donnees, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            message_admin("Album « $titre » ajouté.");
        }
    }

    echo "<div class='admin-panel'><div class='w3-content'>
        <form class='formulaire' action='#ajoutGalerie' method='POST' enctype='multipart/form-data'>
            <input type='hidden' name='action' value='ajouter'>
            <label for='gal-titre'>Titre de l'album</label>
            <input id='gal-titre' class='w3-input' type='text' name='titre' required>
            <label for='gal-lien'>Lien vers l'album (Google Photos, Drive…)</label>
            <input id='gal-lien' class='w3-input' type='url' name='lien' placeholder='https://' required>
            <label for='gal-date'>Date de l'album</label>
            <input id='gal-date' class='w3-input' type='date' name='date' required>
            <label for='gal-nom'>Nom de l'image de couverture</label>
            <input id='gal-nom' class='w3-input' type='text' name='nom_image' required>
            <label for='gal-image'>Image de couverture (JPG, PNG ou WebP)</label>
            <input id='gal-image' class='w3-input' type='file' name='image' accept='image/jpeg,image/png,image/webp' required>
            <button type='submit' class='w3-button'>Ajouter l'album</button>
        </form></div></div>";
}

function suppGalerie()
{
    if (!est_admin()) return;
    $jsonFile = 'galerie/data.json';

    if (($fichier = demande_suppression()) !== null) {
        $fichier = basename($fichier);
        $chemin = 'image/galerie_image/' . $fichier;
        if (is_file($chemin) && unlink($chemin)) {
            $albums = array_values(array_filter(lire_json($jsonFile), function ($a) use ($fichier) {
                return $a['path_image'] !== $fichier;
            }));
            file_put_contents($jsonFile, json_encode($albums, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            message_admin("Album supprimé.");
        }
    }

    $titres = [];
    foreach (lire_json($jsonFile) as $a) {
        $titres[$a['path_image']] = $a['titre'];
    }
    echo "<div class='admin-panel'><h2>Albums en ligne</h2>";
    $fichiers = glob('image/galerie_image/*') ?: [];
    if (!$fichiers) {
        echo "<p>Aucun album.</p>";
    } else {
        echo "<ul class='liste-admin'>";
        foreach ($fichiers as $f) {
            $nom = basename($f);
            $libelle = $titres[$nom] ?? $nom;
            echo "<li><span>" . e($libelle) . "</span>" . bouton_supprimer($nom, $libelle, 'suppGalerie') . "</li>";
        }
        echo "</ul>";
    }
    echo "</div>";
}

/* ---------------------------------------------------------------------
   Articles
   --------------------------------------------------------------------- */
function suppArticle()
{
    if (!est_admin()) return;
    $jsonFile = './article/article.json';

    if (($fichier = demande_suppression()) !== null) {
        $fichier = basename($fichier);
        $image = 'image/article_image/' . $fichier;
        $stem = pathinfo($fichier, PATHINFO_FILENAME);
        if (is_file($image)) {
            unlink($image);
            foreach (glob('article/article_pdf/' . $stem . '.*') ?: [] as $pdf) {
                @unlink($pdf);
            }
            $articles = array_values(array_filter(lire_json($jsonFile), function ($a) use ($fichier) {
                return $a['image'] !== $fichier;
            }));
            file_put_contents($jsonFile, json_encode($articles, JSON_PRETTY_PRINT));
            message_admin('Article supprimé.');
        }
    }

    $titres = [];
    foreach (lire_json($jsonFile) as $a) {
        $titres[$a['image']] = $a['titre'];
    }
    echo "<div class='admin-panel'><h2>Articles en ligne</h2>";
    $fichiers = glob('image/article_image/*') ?: [];
    if (!$fichiers) {
        echo "<p>Aucun article.</p>";
    } else {
        echo "<ul class='liste-admin'>";
        foreach ($fichiers as $f) {
            $nom = basename($f);
            $libelle = $titres[$nom] ?? $nom;
            echo "<li><span>" . e($libelle) . (isset($titres[$nom]) ? "" : " <small>(image sans article)</small>") . "</span>" . bouton_supprimer($nom, $libelle, 'suppArticle') . "</li>";
        }
        echo "</ul>";
    }
    echo "</div>";
}

/* ---------------------------------------------------------------------
   Photos d'accueil
   --------------------------------------------------------------------- */
function suppImageCarousel()
{
    if (!est_admin()) return;
    $dossier = './image/carousel/';

    if (($fichier = demande_suppression()) !== null) {
        $chemin = $dossier . basename($fichier);
        if (is_file($chemin) && unlink($chemin)) {
            message_admin('Photo supprimée.');
        }
    }

    echo "<div class='admin-panel'><h2>Photos affichées sur l'accueil</h2>
        <p>La page d'accueil affiche les 5 premières photos, une par feu de la cible.</p>";
    $fichiers = glob($dossier . '*') ?: [];
    if (!$fichiers) {
        echo "<p>Aucune photo.</p>";
    } else {
        echo "<ul class='liste-admin'>";
        foreach ($fichiers as $f) {
            $nom = basename($f);
            echo "<li><img src='" . e($f) . "' alt='' style='width: 96px; height: 60px; object-fit: cover; border-radius: 4px;'>
                <span>" . e($nom) . "</span>
                <a class='btn btn--contour btn--petit' href='" . e($f) . "' target='_blank' rel='noopener'>Afficher</a>"
                . bouton_supprimer($nom, $nom, 'suppImageCarousel') . "</li>";
        }
        echo "</ul>";
    }
    echo "</div>";
}

function changeRecord()
{
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            $disciplineChosen = false;
            $formSubmitted = false; // Variable pour vérifier si le formulaire a été soumis

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $discipline = $_POST['discipline'];

                // JavaScript pour masquer le formulaire de choix
                echo "<script>
                    document.getElementById('discipline-form').style.display = 'none';
                </script>";

                // Vérifiez si une discipline a été choisie
                if (!empty($discipline)) {
                    $disciplineChosen = true;
                }

                // Vérifiez si le formulaire a été soumis avec succès (vous devrez ajouter votre propre logique de validation ici)
                if (isset($_POST['categorie'])) {
                    $formSubmitted = true;
                }
            }
            // Affichez le bouton de retour uniquement lorsque la discipline a été choisie
            if ($disciplineChosen && !$formSubmitted) {
                echo "<p><a href='parametres_record.php' class='btn btn--contour btn--petit'>Changer de discipline</a></p>";
            }


            // Affichez le formulaire de choix de discipline (seulement si une discipline n'a pas encore été choisie et si le formulaire n'a pas été soumis)
            if (!$disciplineChosen && !$formSubmitted) {
                echo "
                <div class='admin-panel'>
                    <h2>Dans quelle discipline ?</h2>
                    <form method='POST' name='formulaire' id='discipline-form' class='formulaire'>
                        <div class='choix'>
                            <label><input type='radio' name='discipline' value='Laser Run' required> Laser Run</label>
                            <label><input type='radio' name='discipline' value='Triathlé'> Triathlé</label>
                            <label><input type='radio' name='discipline' value='Tetrathlon'> Tétrathlon</label>
                            <label><input type='radio' name='discipline' value='Pentathlon'> Pentathlon</label>
                        </div>
                        <input type='submit' value='Continuer'>
                    </form>
                </div>";
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($formSubmitted) {
                    echo "<div class='message message--ok'>Record enregistré.</div>";
                } else {
                    echo "
                    <div class='admin-panel'>
                        <div class='w3-content'>
                            <form class='formulaire' action='' method='POST' enctype='multipart/form-data'>
                                <h2>Nouveau record : $discipline</h2>
                                <label for='rec-nom'>Nom</label><input id='rec-nom' class='w3-input w3-border' type='text' name='nom' pattern='[\p{L}\s,&#039;\-]+' required>
                                <label for='rec-prenom'>Prénom</label><input id='rec-prenom' class='w3-input w3-border' type='text' name='prenom' pattern='[\p{L}\s,&#039;\-]+' required>
                                <label for='rec-date'>Date</label><input id='rec-date' class='w3-input w3-border' type='text' name='date' pattern='\d{2}/\d{2}/\d{4}' placeholder='jj/mm/aaaa' required>
                                <label for='rec-lieu'>Lieu</label><input id='rec-lieu' class='w3-input w3-border' type='text' name='lieu' pattern='[\p{L}\s,&#039;\-]+' required>";

                    if ($discipline == 'Laser Run') {
                        echo "<label for='rec-temps'>Temps</label><input id='rec-temps' class='w3-input w3-border' type='text' name='temps' pattern='(?:[0-9]{2}&#039;[0-9]{2}|[0-9]&#039;[0-9]{2})' placeholder='mm&#039;ss' required><br>";
                    } else {
                        echo "<label for='rec-points'>Points</label><input id='rec-points' class='w3-input w3-border' type='text' name='points' pattern='[0-9]+' required><br>";
                    }

                    if ($discipline == 'Laser Run') {
                        echo "<label for='rec-cat'>Catégorie</label>
                    <select id='rec-cat' class='w3-input w3-border' name='categorie'>
                    <option value=0>U9 F</option>
                    <option value=1>U9 H</option>
                    <option value=2>U11 F</option>
                    <option value=3>U11 H</option>
                    <option value=4>U13 F</option>
                    <option value=5>U13 H</option>
                    <option value=6>U15 F</option>
                    <option value=7>U15 H</option>
                    <option value=8>U17 F</option>
                    <option value=9>U17 H</option>
                    <option value=10>U19 F</option>
                    <option value=11>U19 H</option>
                    <option value=12>U22 F</option>
                    <option value=13>U22 H</option>
                    <option value=14>Senior F</option>
                    <option value=15>Senior H</option>
                    <option value=16>M40 F</option>
                    <option value=17>M40 H</option>
                    <option value=18>M50 F</option>
                    <option value=19>M50 H</option>
                    <option value=20>M60 F</option>
                    <option value=21>M60 H</option>
                    <option value=22>M70 F</option>
                    <option value=23>M70 H</option>
                    <option value=24>Longue Distance F</option>
                    <option value=25>Longue Distance H</option>
                    </select>";
                    } elseif ($discipline == 'Triathlé') {
                        echo "<label for='rec-cat'>Catégorie</label>
                    <select id='rec-cat' class='w3-input w3-border' name='categorie'>
                        <option value=0>U9 F</option>
                        <option value=1>U9 H</option>
                        <option value=2>U11 F</option>
                        <option value=3>U11 H</option>
                        <option value=4>U13 F</option>
                        <option value=5>U13 H</option>
                        <option value=6>U15 F</option>
                        <option value=7>U15 H</option>
                        <option value=8>U17 F</option>
                        <option value=9>U17 H</option>
                        <option value=10>U19 F</option>
                        <option value=11>U19 H</option>
                        <option value=12>U22 F</option>
                        <option value=13>U22 H</option>
                        <option value=14>Senior F</option>
                        <option value=15>Senior H</option>
                        <option value=16>M40 F</option>
                        <option value=17>M40 H</option>
                        <option value=18>M50 F</option>
                        <option value=19>M50 H</option>
                        <option value=20>M60 F</option>
                        <option value=21>M60 H</option>
                        <option value=22>M70 F</option>
                        <option value=23>M70 H</option>
                    </select>";
                    } elseif ($discipline == 'Tetrathlon') {
                        echo "<label for='rec-cat'>Catégorie</label>
                    <select id='rec-cat' class='w3-input w3-border' name='categorie'>
                        <option value=0>U17 F</option>
                        <option value=1>U17 H</option>
                        <option value=2>U19 F</option>
                        <option value=3>U19 H</option>
                        <option value=4>U22 F</option>
                        <option value=5>U22 H</option>
                        <option value=6>Senior F</option>
                        <option value=7>Senior H</option>
                        <option value=8>M30 F</option>
                        <option value=9>M30 H</option>
                        <option value=10>M40 F</option>
                        <option value=11>M40 H</option>
                        <option value=12>M50 F</option>
                        <option value=13>M50 H</option>
                        <option value=14>M60 F</option>
                        <option value=15>M60 H</option>
                        <option value=16>M70 F</option>
                        <option value=17>M70 H</option>
                    </select>";
                    } elseif ($discipline == 'Pentathlon') {
                        echo "<label for='rec-cat'>Catégorie</label>
                    <select id='rec-cat' class='w3-input w3-border' name='categorie'>
                        <option value=0>U17 F</option>
                        <option value=1>U17 H</option>
                        <option value=2>U19 F</option>
                        <option value=3>U19 H</option>
                        <option value=4>U22 F</option>
                        <option value=5>U22 H</option>
                        <option value=6>Senior F</option>
                        <option value=7>Senior H</option>
                        <option value=8>M30 F</option>
                        <option value=9>M30 H</option>
                        <option value=10>M40 F</option>
                        <option value=11>M40 H</option>
                        <option value=12>M50 F</option>
                        <option value=13>M50 H</option>
                        <option value=14>M60 F</option>
                        <option value=15>M60 H</option>
                        <option value=16>M70 F</option>
                        <option value=17>M70 H</option>
                    </select>";
                    }

                    echo "<input type='hidden' name='discipline' value='$discipline'>
                        <input class='w3-button' type='submit' value='Enregistrer'>
                    </form></div></div>";
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categorie'])) {
                    $data = json_decode(file_get_contents('record.json'), true);
                    $discipline = $_POST['discipline'];
                    $cat = $_POST['categorie'];
                    $newnom = $_POST['nom'];
                    $newprenom = $_POST['prenom'];
                    $newdate = $_POST['date'];
                    $newlieu = $_POST['lieu'];

                    if ($discipline == 'Laser Run') {
                        $newtemps = $_POST['temps'];
                        $data[$discipline][$cat]['temps'] = $newtemps;
                        list($minutes, $seconds) = explode("'", $newtemps);
                        $totalSeconds = $minutes * 60 + $seconds;
                        if ($data[$discipline][2]['temps'] != "-") {
                            list($minutes2, $seconds2) = explode("'", $data[$discipline][2]['temps']);
                            $totalSeconds2 = $minutes2 * 60 + $seconds2;
                        } else {
                            $totalSeconds2 = 3600;
                        }
                        if ($data[$discipline][3]['temps'] != "-") {
                            list($minutes3, $seconds3) = explode("'", $data[$discipline][3]['temps']);
                            $totalSeconds3 = $minutes3 * 60 + $seconds3;
                        } else {
                            $totalSeconds3 = 3600;
                        }
                        if ($data[$discipline][12]['temps'] != "-") {
                            list($minutes12, $seconds12) = explode("'", $data[$discipline][12]['temps']);
                            $totalSeconds12 = $minutes12 * 60 + $seconds12;
                        } else {
                            $totalSeconds12 = 3600;
                        }
                        if ($data[$discipline][13]['temps'] != "-") {
                            list($minutes13, $seconds13) = explode("'", $data[$discipline][13]['temps']);
                            $totalSeconds13 = $minutes13 * 60 + $seconds13;
                        } else {
                            $totalSeconds13 = 3600;
                        }
                        if ($data[$discipline][14]['temps'] != "-") {
                            list($minutes14, $seconds14) = explode("'", $data[$discipline][14]['temps']);
                            $totalSeconds14 = $minutes14 * 60 + $seconds14;
                        } else {
                            $totalSeconds14 = 3600;
                        }
                        if ($data[$discipline][15]['temps'] != "-") {
                            list($minutes15, $seconds15) = explode("'", $data[$discipline][15]['temps']);
                            $totalSeconds15 = $minutes15 * 60 + $seconds15;
                        } else {
                            $totalSeconds15 = 3600;
                        }
                        if ($cat == 10 and ($totalSeconds < $totalSeconds12)) {
                            if ($cat == 10 and ($totalSeconds < $totalSeconds14)) {
                                $data[$discipline][14]['nom'] = $newnom;
                                $data[$discipline][14]['prenom'] = $newprenom;
                                $data[$discipline][14]['date'] = $newdate;
                                $data[$discipline][14]['lieux'] = $newlieu;
                                $data[$discipline][14]['temps'] = $newtemps;

                                $data[$discipline][12]['nom'] = $newnom;
                                $data[$discipline][12]['prenom'] = $newprenom;
                                $data[$discipline][12]['date'] = $newdate;
                                $data[$discipline][12]['lieux'] = $newlieu;
                                $data[$discipline][12]['temps'] = $newtemps;
                            } else {
                                $data[$discipline][12]['nom'] = $newnom;
                                $data[$discipline][12]['prenom'] = $newprenom;
                                $data[$discipline][12]['date'] = $newdate;
                                $data[$discipline][12]['lieux'] = $newlieu;
                                $data[$discipline][12]['temps'] = $newtemps;
                            }
                        } elseif ($cat == 12 and ($totalSeconds < $totalSeconds14)) {
                            $data[$discipline][14]['nom'] = $newnom;
                            $data[$discipline][14]['prenom'] = $newprenom;
                            $data[$discipline][14]['date'] = $newdate;
                            $data[$discipline][14]['lieux'] = $newlieu;
                            $data[$discipline][14]['temps'] = $newtemps;
                        } else if ($cat == 11 and ($totalSeconds < $totalSeconds13)) {
                            if ($cat == 11 and ($totalSeconds < $totalSeconds15)) {
                                $data[$discipline][15]['nom'] = $newnom;
                                $data[$discipline][15]['prenom'] = $newprenom;
                                $data[$discipline][15]['date'] = $newdate;
                                $data[$discipline][15]['lieux'] = $newlieu;
                                $data[$discipline][15]['temps'] = $newtemps;

                                $data[$discipline][13]['nom'] = $newnom;
                                $data[$discipline][13]['prenom'] = $newprenom;
                                $data[$discipline][13]['date'] = $newdate;
                                $data[$discipline][13]['lieux'] = $newlieu;
                                $data[$discipline][13]['temps'] = $newtemps;
                            } else {
                                $data[$discipline][13]['nom'] = $newnom;
                                $data[$discipline][13]['prenom'] = $newprenom;
                                $data[$discipline][13]['date'] = $newdate;
                                $data[$discipline][13]['lieux'] = $newlieu;
                                $data[$discipline][13]['temps'] = $newtemps;
                            }
                        } else if ($cat == 13 and ($totalSeconds < $totalSeconds15)) {
                            $data[$discipline][15]['nom'] = $newnom;
                            $data[$discipline][15]['prenom'] = $newprenom;
                            $data[$discipline][15]['date'] = $newdate;
                            $data[$discipline][15]['lieux'] = $newlieu;
                            $data[$discipline][15]['temps'] = $newtemps;
                        } else if ($cat == 0 and ($totalSeconds < $totalSeconds2)) {
                            $data[$discipline][2]['nom'] = $newnom;
                            $data[$discipline][2]['prenom'] = $newprenom;
                            $data[$discipline][2]['date'] = $newdate;
                            $data[$discipline][2]['lieux'] = $newlieu;
                            $data[$discipline][2]['temps'] = $newtemps;
                        } else if ($cat == 1 and ($totalSeconds < $totalSeconds3)) {
                            $data[$discipline][3]['nom'] = $newnom;
                            $data[$discipline][3]['prenom'] = $newprenom;
                            $data[$discipline][3]['date'] = $newdate;
                            $data[$discipline][3]['lieux'] = $newlieu;
                            $data[$discipline][3]['temps'] = $newtemps;
                        }
                    } else {
                        $newpoints = $_POST['points'];
                        $data[$discipline][$cat]['points'] = $newpoints;
                        if ($discipline == 'Pentathlon') {
                            if ($cat == 3 and ($newpoints > $data[$discipline][5]['points'] or $data[$discipline][5]['points'] == "-")) {
                                if ($newpoints > $data[$discipline][7]['points'] or $data[$discipline][7]['points'] == "-") {
                                    $data[$discipline][7]['nom'] = $newnom;
                                    $data[$discipline][7]['prenom'] = $newprenom;
                                    $data[$discipline][7]['date'] = $newdate;
                                    $data[$discipline][7]['lieux'] = $newlieu;
                                    $data[$discipline][7]['points'] = $newpoints;

                                    $data[$discipline][5]['nom'] = $newnom;
                                    $data[$discipline][5]['prenom'] = $newprenom;
                                    $data[$discipline][5]['date'] = $newdate;
                                    $data[$discipline][5]['lieux'] = $newlieu;
                                    $data[$discipline][5]['points'] = $newpoints;
                                } else {
                                    $data[$discipline][5]['nom'] = $newnom;
                                    $data[$discipline][5]['prenom'] = $newprenom;
                                    $data[$discipline][5]['date'] = $newdate;
                                    $data[$discipline][5]['lieux'] = $newlieu;
                                    $data[$discipline][5]['points'] = $newpoints;
                                }
                            } else if ($cat == 5 and ($newpoints > $data[$discipline][7]['points']  or $data[$discipline][7]['points'] == "-")) {
                                $data[$discipline][7]['nom'] = $newnom;
                                $data[$discipline][7]['prenom'] = $newprenom;
                                $data[$discipline][7]['date'] = $newdate;
                                $data[$discipline][7]['lieux'] = $newlieu;
                                $data[$discipline][7]['points'] = $newpoints;
                            } else if ($cat == 2 and ($newpoints > $data[$discipline][4]['points'] or $data[$discipline][4]['points'] == "-")) {
                                if ($newpoints > $data[$discipline][6]['points'] or $data[$discipline][6]['points'] == "-") {
                                    $data[$discipline][6]['nom'] = $newnom;
                                    $data[$discipline][6]['prenom'] = $newprenom;
                                    $data[$discipline][6]['date'] = $newdate;
                                    $data[$discipline][6]['lieux'] = $newlieu;
                                    $data[$discipline][6]['points'] = $newpoints;

                                    $data[$discipline][4]['nom'] = $newnom;
                                    $data[$discipline][4]['prenom'] = $newprenom;
                                    $data[$discipline][4]['date'] = $newdate;
                                    $data[$discipline][4]['lieux'] = $newlieu;
                                    $data[$discipline][4]['points'] = $newpoints;
                                } else {
                                    $data[$discipline][4]['nom'] = $newnom;
                                    $data[$discipline][4]['prenom'] = $newprenom;
                                    $data[$discipline][4]['date'] = $newdate;
                                    $data[$discipline][4]['lieux'] = $newlieu;
                                    $data[$discipline][4]['points'] = $newpoints;
                                }
                            }
                        } else if ($discipline == 'Tetrathlon') {
                            if ($cat == 3 and ($newpoints > $data[$discipline][5]['points']  or $data[$discipline][5]['points'] == "-")) {
                                if ($newpoints > $data[$discipline][7]['points'] or $data[$discipline][7]['points'] == "-") {
                                    $data[$discipline][7]['nom'] = $newnom;
                                    $data[$discipline][7]['prenom'] = $newprenom;
                                    $data[$discipline][7]['date'] = $newdate;
                                    $data[$discipline][7]['lieux'] = $newlieu;
                                    $data[$discipline][7]['points'] = $newpoints;

                                    $data[$discipline][5]['nom'] = $newnom;
                                    $data[$discipline][5]['prenom'] = $newprenom;
                                    $data[$discipline][5]['date'] = $newdate;
                                    $data[$discipline][5]['lieux'] = $newlieu;
                                    $data[$discipline][5]['points'] = $newpoints;
                                } else {
                                    $data[$discipline][5]['nom'] = $newnom;
                                    $data[$discipline][5]['prenom'] = $newprenom;
                                    $data[$discipline][5]['date'] = $newdate;
                                    $data[$discipline][5]['lieux'] = $newlieu;
                                    $data[$discipline][5]['points'] = $newpoints;
                                }
                            } else if ($cat == 5 and ($newpoints > $data[$discipline][7]['points']  or $data[$discipline][7]['points'] == "-")) {
                                $data[$discipline][7]['nom'] = $newnom;
                                $data[$discipline][7]['prenom'] = $newprenom;
                                $data[$discipline][7]['date'] = $newdate;
                                $data[$discipline][7]['lieux'] = $newlieu;
                                $data[$discipline][7]['points'] = $newpoints;
                            } else if ($cat == 2 and ($newpoints > $data[$discipline][4]['points']  or $data[$discipline][4]['points'] == "-")) {
                                if ($newpoints > $data[$discipline][6]['points'] or $data[$discipline][6]['points'] == "-") {
                                    $data[$discipline][6]['nom'] = $newnom;
                                    $data[$discipline][6]['prenom'] = $newprenom;
                                    $data[$discipline][6]['date'] = $newdate;
                                    $data[$discipline][6]['lieux'] = $newlieu;
                                    $data[$discipline][6]['points'] = $newpoints;

                                    $data[$discipline][4]['nom'] = $newnom;
                                    $data[$discipline][4]['prenom'] = $newprenom;
                                    $data[$discipline][4]['date'] = $newdate;
                                    $data[$discipline][4]['lieux'] = $newlieu;
                                    $data[$discipline][4]['points'] = $newpoints;
                                } else {
                                    $data[$discipline][4]['nom'] = $newnom;
                                    $data[$discipline][4]['prenom'] = $newprenom;
                                    $data[$discipline][4]['date'] = $newdate;
                                    $data[$discipline][4]['lieux'] = $newlieu;
                                    $data[$discipline][4]['points'] = $newpoints;
                                }
                            }
                        } else if ($discipline == 'Triathlé') {
                            if ($cat == 11 and ($newpoints > $data[$discipline][13]['points']  or $data[$discipline][13]['points'] == "-")) {
                                if ($newpoints > $data[$discipline][15]['points'] or $data[$discipline][15]['points'] == "-") {
                                    $data[$discipline][15]['nom'] = $newnom;
                                    $data[$discipline][15]['prenom'] = $newprenom;
                                    $data[$discipline][15]['date'] = $newdate;
                                    $data[$discipline][15]['lieux'] = $newlieu;
                                    $data[$discipline][15]['points'] = $newpoints;

                                    $data[$discipline][13]['nom'] = $newnom;
                                    $data[$discipline][13]['prenom'] = $newprenom;
                                    $data[$discipline][13]['date'] = $newdate;
                                    $data[$discipline][13]['lieux'] = $newlieu;
                                    $data[$discipline][13]['points'] = $newpoints;
                                } else {
                                    $data[$discipline][13]['nom'] = $newnom;
                                    $data[$discipline][13]['prenom'] = $newprenom;
                                    $data[$discipline][13]['date'] = $newdate;
                                    $data[$discipline][13]['lieux'] = $newlieu;
                                    $data[$discipline][13]['points'] = $newpoints;
                                }
                            } else if ($cat == 13 and ($newpoints > $data[$discipline][15]['points']  or $data[$discipline][15]['points'] == "-")) {
                                $data[$discipline][15]['nom'] = $newnom;
                                $data[$discipline][15]['prenom'] = $newprenom;
                                $data[$discipline][15]['date'] = $newdate;
                                $data[$discipline][15]['lieux'] = $newlieu;
                                $data[$discipline][15]['points'] = $newpoints;
                            } else if ($cat == 10 and ($newpoints > $data[$discipline][12]['points']  or $data[$discipline][12]['points'] == "-")) {
                                if ($newpoints > $data[$discipline][14]['points'] or $data[$discipline][14]['points'] == "-") {
                                    $data[$discipline][14]['nom'] = $newnom;
                                    $data[$discipline][14]['prenom'] = $newprenom;
                                    $data[$discipline][14]['date'] = $newdate;
                                    $data[$discipline][14]['lieux'] = $newlieu;
                                    $data[$discipline][14]['points'] = $newpoints;

                                    $data[$discipline][12]['nom'] = $newnom;
                                    $data[$discipline][12]['prenom'] = $newprenom;
                                    $data[$discipline][12]['date'] = $newdate;
                                    $data[$discipline][12]['lieux'] = $newlieu;
                                    $data[$discipline][12]['points'] = $newpoints;
                                } else {
                                    $data[$discipline][12]['nom'] = $newnom;
                                    $data[$discipline][12]['prenom'] = $newprenom;
                                    $data[$discipline][12]['date'] = $newdate;
                                    $data[$discipline][12]['lieux'] = $newlieu;
                                    $data[$discipline][12]['points'] = $newpoints;
                                }
                            } else if ($cat == 0 and ($newpoints > $data[$discipline][2]['points']  or $data[$discipline][2]['points'] == "-")) {
                                $data[$discipline][2]['nom'] = $newnom;
                                $data[$discipline][2]['prenom'] = $newprenom;
                                $data[$discipline][2]['date'] = $newdate;
                                $data[$discipline][2]['lieux'] = $newlieu;
                                $data[$discipline][2]['points'] = $newpoints;
                            } else if ($cat == 1 and ($newpoints > $data[$discipline][3]['points']  or $data[$discipline][3]['points'] == "-")) {
                                $data[$discipline][3]['nom'] = $newnom;
                                $data[$discipline][3]['prenom'] = $newprenom;
                                $data[$discipline][3]['date'] = $newdate;
                                $data[$discipline][3]['lieux'] = $newlieu;
                                $data[$discipline][3]['points'] = $newpoints;
                            }
                        }
                    }

                    $data[$discipline][$cat]['nom'] = $newnom;
                    $data[$discipline][$cat]['prenom'] = $newprenom;
                    $data[$discipline][$cat]['date'] = $newdate;
                    $data[$discipline][$cat]['lieux'] = $newlieu;

                    // Sauvegardez le tableau mis à jour dans le fichier JSON
                    file_put_contents('record.json', json_encode($data, JSON_PRETTY_PRINT));
                }
            }
            // Affichez le bouton pour un nouveau record uniquement après que le formulaire a été soumis avec succès
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $formSubmitted) {
                echo "<div class='boutons'>
                        <button class='w3-button' onclick='redirectToPage()'>Ajouter un autre record</button>
                        <a class='btn btn--contour' href='record.php'>Voir les records</a>
                    </div>";
                // JavaScript pour rediriger l'utilisateur vers parametres_record.php
                echo "<script>
                    function redirectToPage() {
                        window.location.href = 'parametres_record.php';
                    }
                </script>";
            }
        }
    }
}
function ajoutArticle()
{
    if (!est_admin()) return;
    $dossierPdf = './article/article_pdf/';
    $dossierImage = './image/article_image/';
    $dossierJson = './article/article.json';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'ajouter') {
        $titre = trim($_POST['titre'] ?? '');
        $nom = nom_fichier_propre($_POST['nom_telechargement'] ?? $titre);
        $description = trim($_POST['description_telechargement'] ?? '');
        $dateSaisie = $_POST['date_telechargement'] ?? '';
        $date = $dateSaisie ? date('d/m/y', strtotime($dateSaisie)) : date('d/m/y');
        $data = lire_json($dossierJson);

        $doublon = false;
        foreach ($data as $item) {
            if ($item['titre'] === $titre || pathinfo($item['image'], PATHINFO_FILENAME) === $nom) {
                $doublon = true;
            }
        }

        if ($doublon) {
            message_admin('Un article avec ce titre ou ce nom de fichier existe déjà.', 'erreur');
        } elseif (!fichier_autorise($_FILES['fichier'] ?? [], 'pdf')) {
            message_admin("L'article doit être un fichier PDF.", 'erreur');
        } elseif (!($image = enregistrer_image_webp($_FILES['img'] ?? [], $dossierImage, $nom))) {
            message_admin('Image refusée : formats acceptés JPG, PNG ou WebP.', 'erreur');
        } elseif (!move_uploaded_file($_FILES['fichier']['tmp_name'], $dossierPdf . $nom . '.pdf')) {
            @unlink($dossierImage . $image);
            message_admin("Le PDF n'a pas pu être enregistré.", 'erreur');
        } else {
            $data[] = ['titre' => $titre, 'image' => $image, 'description' => $description, 'date' => $date];
            file_put_contents($dossierJson, json_encode($data, JSON_PRETTY_PRINT));
            message_admin("Article « $titre » publié.");
        }
    }

    echo "<div class='admin-panel'><div class='w3-content'>
        <form class='formulaire' action='#ajoutArticle' method='POST' enctype='multipart/form-data'>
            <input type='hidden' name='action' value='ajouter'>
            <label for='art-titre'>Titre</label>
            <input id='art-titre' class='w3-input' type='text' name='titre' required>
            <label for='art-desc'>Description courte</label>
            <input id='art-desc' class='w3-input' type='text' name='description_telechargement' required>
            <label for='art-date'>Date</label>
            <input id='art-date' class='w3-input' type='date' name='date_telechargement' value='" . date('Y-m-d') . "' required>
            <label for='art-nom'>Nom du fichier (sans espaces)</label>
            <input id='art-nom' class='w3-input' type='text' name='nom_telechargement' pattern='[A-Za-z0-9_-]+' required>
            <label for='art-pdf'>Article (PDF)</label>
            <input id='art-pdf' class='w3-input' type='file' name='fichier' accept='application/pdf' required>
            <label for='art-img'>Image de l'article (JPG, PNG ou WebP)</label>
            <input id='art-img' class='w3-input' type='file' name='img' accept='image/jpeg,image/png,image/webp' required>
            <button type='submit' class='w3-button'>Publier l'article</button>
        </form></div></div>";
}

function ajoutImageCarousel()
{
    if (!est_admin()) return;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'ajouter') {
        $nomOriginal = pathinfo($_FILES['fichier']['name'] ?? '', PATHINFO_FILENAME);
        $nom = nom_fichier_propre(($_POST['nom_telechargement'] ?? '') ?: $nomOriginal);
        if (enregistrer_image_webp($_FILES['fichier'] ?? [], './image/carousel', $nom)) {
            message_admin('Photo ajoutée à la page d\'accueil.');
        } else {
            message_admin('Image refusée : formats acceptés JPG, PNG ou WebP.', 'erreur');
        }
    }

    echo "<div class='admin-panel'><div class='w3-content'>
        <form class='formulaire' action='#ajoutImageCarousel' method='POST' enctype='multipart/form-data'>
            <input type='hidden' name='action' value='ajouter'>
            <p>Photo en paysage, idéalement 1600 px de large, sujet à droite (le texte s'affiche à gauche).</p>
            <label for='car-img'>Photo (JPG, PNG ou WebP)</label>
            <input id='car-img' class='w3-input' type='file' name='fichier' accept='image/jpeg,image/png,image/webp' required>
            <label for='car-nom'>Nom du fichier (facultatif)</label>
            <input id='car-nom' class='w3-input' type='text' name='nom_telechargement' pattern='[A-Za-z0-9_-]+'>
            <button type='submit' class='w3-button'>Ajouter la photo</button>
        </form></div></div>";
}

/* ---------------------------------------------------------------------
   Section sportive
   --------------------------------------------------------------------- */
function ajoutArticleSection()
{
    if (!est_admin()) return;
    $dossierJson = './section/articles.json';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'ajouter') {
        $titre = trim($_POST['titre'] ?? '');
        $nom = nom_fichier_propre(pathinfo($_FILES['pdf']['name'] ?? '', PATHINFO_FILENAME)) . '.pdf';
        if (!fichier_autorise($_FILES['pdf'] ?? [], 'pdf')) {
            message_admin('Le document doit être un fichier PDF.', 'erreur');
        } elseif (move_uploaded_file($_FILES['pdf']['tmp_name'], './section/articles/' . $nom)) {
            $data = lire_json($dossierJson);
            $data[] = ['titre' => $titre, 'pdf' => $nom];
            file_put_contents($dossierJson, json_encode($data, JSON_PRETTY_PRINT));
            message_admin("Article « $titre » ajouté.");
        }
    }

    echo "<div class='admin-panel'><div class='w3-content'>
        <form class='formulaire' action='#ajoutArticleSection' method='POST' enctype='multipart/form-data'>
            <input type='hidden' name='action' value='ajouter'>
            <label for='sec-titre'>Titre de l'article</label>
            <input id='sec-titre' class='w3-input' type='text' name='titre' required>
            <label for='sec-pdf'>Document (PDF)</label>
            <input id='sec-pdf' class='w3-input' type='file' name='pdf' accept='application/pdf' required>
            <button type='submit' class='w3-button'>Ajouter l'article</button>
        </form></div></div>";
}

function suppArticleSection()
{
    if (!est_admin()) return;
    $dossierJson = './section/articles.json';

    if (($fichier = demande_suppression()) !== null) {
        $fichier = basename($fichier);
        $chemin = './section/articles/' . $fichier;
        if (is_file($chemin) && unlink($chemin)) {
            $articles = array_values(array_filter(lire_json($dossierJson), function ($a) use ($fichier) {
                return $a['pdf'] !== $fichier;
            }));
            file_put_contents($dossierJson, json_encode($articles, JSON_PRETTY_PRINT));
            message_admin('Article supprimé.');
        }
    }

    $titres = [];
    foreach (lire_json($dossierJson) as $a) {
        $titres[$a['pdf']] = $a['titre'];
    }
    echo "<div class='admin-panel'><h2>Articles de la section</h2>";
    $fichiers = glob('./section/articles/*') ?: [];
    if (!$fichiers) {
        echo "<p>Aucun article.</p>";
    } else {
        echo "<ul class='liste-admin'>";
        foreach ($fichiers as $f) {
            $nom = basename($f);
            $libelle = $titres[$nom] ?? $nom;
            echo "<li><span>" . e($libelle) . "</span>" . bouton_supprimer($nom, $libelle, 'suppArticleSection') . "</li>";
        }
        echo "</ul>";
    }
    echo "</div>";
}

/* ---------------------------------------------------------------------
   Calendrier
   --------------------------------------------------------------------- */
function ajoutEvenement()
{
    if (!est_admin()) return;
    $dossierJson = './calendrier.json';
    $data = lire_json($dossierJson);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        $date = $_POST['date'] ?? '';
        if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $date, $m)) {
            $cle = "$m[1]-$m[2]";
            $jour = ltrim($m[3], '0');
            if ($action === 'ajouter' && trim($_POST['evenement'] ?? '') !== '') {
                $data[$cle][$jour] = trim($_POST['evenement']);
                message_admin('Événement ajouté au calendrier.');
            } elseif ($action === 'supprimer' && isset($data[$cle][$jour])) {
                unset($data[$cle][$jour]);
                if (!$data[$cle]) unset($data[$cle]);
                message_admin('Événement retiré du calendrier.');
            }
            ksort($data);
            file_put_contents($dossierJson, json_encode($data, JSON_PRETTY_PRINT));
        }
    }

    echo "<div class='admin-panel'><div class='w3-content'>
        <form class='formulaire' method='POST'>
            <input type='hidden' name='action' value='ajouter'>
            <label for='cal-date'>Date</label>
            <input id='cal-date' class='w3-input' type='date' name='date' value='" . date('Y-m-d') . "' required>
            <label for='cal-evt'>Événement</label>
            <input id='cal-evt' class='w3-input' type='text' name='evenement' placeholder='Ex. : Triathlé de Noël à Marville' required>
            <button type='submit' class='w3-button'>Ajouter au calendrier</button>
        </form></div></div>";

    // Événements à venir, avec suppression
    $aVenir = [];
    foreach ($data as $cle => $jours) {
        foreach ($jours as $jour => $evt) {
            $iso = sprintf('%s-%02d', $cle, $jour);
            if ($iso >= date('Y-m-d')) {
                $aVenir[$iso] = $evt;
            }
        }
    }
    ksort($aVenir);
    echo "<div class='admin-panel'><h2>Événements à venir</h2>";
    if (!$aVenir) {
        echo "<p>Aucun événement à venir.</p>";
    } else {
        echo "<ul class='liste-admin'>";
        foreach ($aVenir as $iso => $evt) {
            echo "<li><span>" . e(date_lisible($iso)) . " : " . e($evt) . "</span>
                <form method='post' onsubmit=\"return confirm('Retirer cet événement du calendrier ?')\">
                    <input type='hidden' name='action' value='supprimer'>
                    <input type='hidden' name='date' value='" . e($iso) . "'>
                    <button type='submit' class='btn btn--danger btn--petit'>Retirer</button>
                </form></li>";
        }
        echo "</ul>";
    }
    echo "</div>";
}

/* ---------------------------------------------------------------------
   Infos et résultats (bloc « Au programme » de l'accueil)
   --------------------------------------------------------------------- */
function suppResultat()
{
    if (!est_admin()) return;
    $dossierJson = './resultat.json';
    $data = lire_json($dossierJson);

    if (($cle = demande_suppression()) !== null) {
        foreach ($data as $i => $info) {
            if (($info['id'] ?? $info['titre']) === $cle) {
                foreach (['pdf' => './info_pdf/', 'image' => './info_images/'] as $champ => $dossier) {
                    if (!empty($info[$champ])) {
                        $chemin = $dossier . basename($info[$champ]);
                        if (is_file($chemin)) unlink($chemin);
                    }
                }
                unset($data[$i]);
                $data = array_values($data);
                file_put_contents($dossierJson, json_encode($data, JSON_PRETTY_PRINT));
                message_admin('Info supprimée.');
                break;
            }
        }
    }

    echo "<div class='admin-panel'><h2>Infos en ligne</h2>";
    if (!$data) {
        echo "<p>Aucune info publiée.</p>";
    } else {
        echo "<ul class='liste-admin'>";
        foreach ($data as $info) {
            echo "<li><span>" . e($info['titre']) . "</span>" . bouton_supprimer($info['id'] ?? $info['titre'], $info['titre'], 'suppResultat') . "</li>";
        }
        echo "</ul>";
    }
    echo "</div>";
}

function ajoutResultat()
{
    if (!est_admin()) return;
    $dossierJson = './resultat.json';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'ajouter') {
        $titre = trim($_POST['titre'] ?? '');
        $date = $_POST['date'] ?? date('Y-m-d');
        $description = trim($_POST['description'] ?? '');
        $url = trim($_POST['url'] ?? '');
        $pdfPath = null;
        $imagePath = null;
        $erreur = null;

        if ($url !== '' && !preg_match('#^https?://#i', $url)) {
            $erreur = "Le lien doit commencer par https://.";
        }
        if (!$erreur && !empty($_FILES['pdf']['name'])) {
            if (!fichier_autorise($_FILES['pdf'], 'pdf')) {
                $erreur = "L'affiche doit être un fichier PDF.";
            } else {
                $pdfPath = './info_pdf/' . nom_fichier_propre(pathinfo($_FILES['pdf']['name'], PATHINFO_FILENAME)) . '-' . uniqid() . '.pdf';
                move_uploaded_file($_FILES['pdf']['tmp_name'], $pdfPath);
            }
        }
        if (!$erreur && !empty($_FILES['image']['name'])) {
            $image = enregistrer_image_webp($_FILES['image'], './info_images', uniqid() . '_' . nom_fichier_propre(pathinfo($_FILES['image']['name'], PATHINFO_FILENAME)));
            if (!$image) {
                $erreur = 'Image refusée : formats acceptés JPG, PNG ou WebP.';
            } else {
                $imagePath = './info_images/' . $image;
            }
        }

        if ($erreur) {
            message_admin($erreur, 'erreur');
        } elseif ($titre === '' && $description === '') {
            message_admin('Indiquez au moins un titre ou une description.', 'erreur');
        } else {
            $data = lire_json($dossierJson);
            $data[] = [
                'titre' => $titre,
                'description' => $description,
                'url' => $url,
                'pdf' => $pdfPath,
                'image' => $imagePath,
                'date' => $date ?: date('Y-m-d'),
                'id' => uniqid(),
            ];
            file_put_contents($dossierJson, json_encode($data, JSON_PRETTY_PRINT));
            message_admin("Info « $titre » publiée sur l'accueil.");
        }
    }

    echo "<div class='admin-panel'><div class='w3-content'>
        <form class='formulaire' action='#ajoutResultat' method='POST' enctype='multipart/form-data'>
            <input type='hidden' name='action' value='ajouter'>
            <label for='res-titre'>Titre</label>
            <input id='res-titre' class='w3-input' type='text' name='titre' required>
            <label for='res-date'>Date de l'événement</label>
            <input id='res-date' class='w3-input' type='date' name='date' value='" . date('Y-m-d') . "'>
            <label for='res-desc'>Description</label>
            <input id='res-desc' class='w3-input' type='text' name='description'>
            <label for='res-url'>Lien (facultatif)</label>
            <input id='res-url' class='w3-input' type='url' name='url' placeholder='https://'>
            <label for='res-pdf'>Affiche ou résultats en PDF (facultatif)</label>
            <input id='res-pdf' class='w3-input' type='file' name='pdf' accept='application/pdf'>
            <label for='res-img'>Image (facultatif, JPG, PNG ou WebP)</label>
            <input id='res-img' class='w3-input' type='file' name='image' accept='image/jpeg,image/png,image/webp'>
            <button type='submit' class='w3-button'>Publier sur l'accueil</button>
        </form></div></div>";
}

/* ---------------------------------------------------------------------
   Nombre d'articles à la une
   --------------------------------------------------------------------- */
function nombre_article()
{
    if (!est_admin()) return;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $choix = (int) ($_POST['choix'] ?? 1);
        if (in_array($choix, [1, 2], true)) {
            file_put_contents('nb_art.txt', (string) $choix);
            message_admin("La page d'accueil affiche maintenant $choix article" . ($choix > 1 ? 's' : '') . ' à la une.');
        }
    }
    $actuel = (int) trim((string) @file_get_contents('nb_art.txt'));
    $actuel = in_array($actuel, [1, 2], true) ? $actuel : 1;

    echo "<div class='admin-panel'><div class='w3-content'>
        <form class='formulaire' method='POST'>
            <label for='choix'>Nombre d'articles affichés sur la page d'accueil</label>
            <select name='choix' id='choix'>
                <option value='1'" . ($actuel === 1 ? ' selected' : '') . ">1 article, en grand</option>
                <option value='2'" . ($actuel === 2 ? ' selected' : '') . ">2 articles, côte à côte</option>
            </select>
            <button type='submit' class='w3-button'>Enregistrer</button>
        </form></div></div>";
}
