<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74); color: white'>";
navbar();
      // Obtenez l'année actuelle
      $anneeActuelle = date('Y');
      $moisActuel = date('n');
      $jourActuel = date('j');
      // Variable pour vérifier si nous avons dépassé le 1er septembre
      $depasserSeptembre = ($moisActuel > 9 || ($moisActuel == 9 && $jourActuel >= 1)) ? -1 : 0;
      // Variable pour vérifier si nous avons dépassé le 1er janvier
      $saison = ($moisActuel > 8 || ($moisActuel == 8 && $jourActuel >= 1)) ? $anneeActuelle.' - '. ($anneeActuelle+1) : ($anneeActuelle-1).' - '. $anneeActuelle;
?>
<div>
  <div class="w3-container w3-quarter w3-center">
    <p>idée a trouver</p>
  </div>
  <div class="w3-container w3-half w3-center">
    <h1>Dossiers d'inscription</h1> 
    <h2>Adultes</h2>
    <p>Téléchargez le dossier d'inscription pour les adultes :</p>
    <a href="./inscription/majeur.pdf" download>
        <button>Télécharger le dossier pour adultes</button>
    </a>
    <h2>Mineurs</h2>
    <p>Téléchargez le dossier d'inscription pour les mineurs :</p>
    <a href="./inscription/mineur.pdf" download>
        <button>Télécharger le dossier pour mineurs</button>
    </a>
    </div>
    <div class="w3-container w3-quarter w3-center">
    <h1>Catégories d'âge pour la saison <?php echo($saison); ?></h1> 
    <table>
      <tr>
        <th>Catégorie d'âge</th>
        <th>Âge requis</th>
        <th>Année de naissance</th>
      </tr>
      <?php
      // Obtenez l'année actuelle
      $anneeActuelle = date('Y');
      $moisActuel = date('n');
      $jourActuel = date('j');
      // Variable pour vérifier si nous avons dépassé le 1er septembre
      $depasserSeptembre = ($moisActuel > 9 || ($moisActuel == 9 && $jourActuel >= 1)) ? -1 : 0;


      // Tableau des catégories d'âge avec l'âge requis
      $categories = array(
        array('Master 60+', '60+', ($anneeActuelle - 60 + $depasserSeptembre) . ' et avant'),
        array('Master 50+', 50, ($anneeActuelle - 50 + $depasserSeptembre) . ' - ' . ($anneeActuelle - 59 + $depasserSeptembre)),
        array('Master 40+', 40, ($anneeActuelle - 40 + $depasserSeptembre) . ' - ' . ($anneeActuelle - 49 + $depasserSeptembre)),
        array('Master 30+', 30, ($anneeActuelle - 30 + $depasserSeptembre) . ' - ' . ($anneeActuelle - 39 + $depasserSeptembre)),
        array('Sénior', 22, ($anneeActuelle - 22 + $depasserSeptembre) . ' - ' . ($anneeActuelle - 29 + $depasserSeptembre)),
        array('U22', 19, ($anneeActuelle - 19 + $depasserSeptembre) . ' - ' . ($anneeActuelle - 21 + $depasserSeptembre)),
        array('U19', 17, ($anneeActuelle - 17 + $depasserSeptembre) . ' - ' . ($anneeActuelle - 18 + $depasserSeptembre)),
        array('U17', 15, ($anneeActuelle - 15 + $depasserSeptembre) . ' - ' . ($anneeActuelle - 16 + $depasserSeptembre)),
        array('U15', 13, ($anneeActuelle - 13 + $depasserSeptembre) . ' - ' . ($anneeActuelle - 14 + $depasserSeptembre)),
        array('U13', 11, ($anneeActuelle - 11 + $depasserSeptembre) . ' - ' . ($anneeActuelle - 12 + $depasserSeptembre)),
        array('U11', 10, ($anneeActuelle - 9 + $depasserSeptembre) . ' - ' . ($anneeActuelle - 10 + $depasserSeptembre))
      );
    
      // Parcourir le tableau des catégories d'âge et afficher les informations
      foreach ($categories as $categorie) {
        $categorieNom = $categorie[0];
        $ageRequis = $categorie[1];
        $anneeNaissance = $categorie[2];
    
        echo "<tr>";
        echo "<td>$categorieNom</td>";
        echo "<td>$ageRequis</td>";
        echo "<td>$anneeNaissance</td>";
        echo "</tr>";
      }
      ?>
    </table>
    </div>
    </div>
    
    <?php
    footer();
    echo "</body>";
    ?>