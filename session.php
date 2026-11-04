<?php
/* =====================================================================
   Session, jeton CSRF et emplacement des données privées.
   Inclus par fonction.php, login.php, les endpoints et les download_*.
   ===================================================================== */

if (session_status() === PHP_SESSION_NONE) {
    $https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $https,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

/**
 * Dossier des données privées (comptes, journal des connexions).
 * Il doit se trouver HORS du dossier public du site, par exemple
 * /home/<compte>/domains/<domaine>/cjf_prive/ à côté de public_html.
 * Tant qu'il n'existe pas, le site retombe sur les anciens fichiers de la racine,
 * protégés par le .htaccess.
 */
function dossier_prive()
{
    $dossier = dirname(__DIR__) . '/cjf_prive';
    return is_dir($dossier) ? $dossier : null;
}

/** Fichier des comptes administrateurs. */
function fichier_comptes()
{
    $prive = dossier_prive();
    if ($prive && file_exists($prive . '/comptes.json')) {
        return $prive . '/comptes.json';
    }
    return __DIR__ . '/athletes.json';
}

/** Journal des connexions (conservé 90 jours). */
function fichier_journal()
{
    $prive = dossier_prive();
    return $prive ? $prive . '/connexions.log' : __DIR__ . '/connexion.txt';
}

/** Jeton CSRF de la session, créé à la demande. */
function jeton_csrf()
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

/** Vrai si la requête porte le bon jeton (champ « csrf » ou en-tête X-CSRF-Token). */
function csrf_valide()
{
    $recu = $_POST['csrf'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
    return is_string($recu) && !empty($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $recu);
}

/** Champ caché à placer dans chaque formulaire POST. */
function champ_csrf()
{
    return "<input type='hidden' name='csrf' value='" . jeton_csrf() . "'>";
}

/**
 * Vérifie qu'un chemin de fichier JSON de compétition est bien dans competitions/.
 * Renvoie le chemin réel, ou null s'il est refusé.
 */
function fichier_competition($chemin)
{
    $base = realpath(__DIR__ . '/competitions');
    $reel = realpath(__DIR__ . '/' . ltrim((string) $chemin, '/'));
    if (!$base || !$reel || strpos($reel, $base . DIRECTORY_SEPARATOR) !== 0) {
        return null;
    }
    return strtolower(pathinfo($reel, PATHINFO_EXTENSION)) === 'json' ? $reel : null;
}

/**
 * Vérifie un couple discipline / compétition reçu dans l'URL :
 * la discipline doit être connue et la compétition être un dossier existant.
 */
function competition_valide($discipline, $competition)
{
    if (!in_array($discipline, ['laserrun', 'triathle'], true)) {
        return false;
    }
    if (!is_string($competition) || $competition === '' || $competition !== basename($competition) || $competition[0] === '.') {
        return false;
    }
    return is_dir(__DIR__ . "/competitions/$discipline/$competition");
}
